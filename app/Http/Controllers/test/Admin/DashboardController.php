<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployementDetails;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Models\Activity;


class DashboardController extends Controller
{

    public function allUsers(Request $request)
    {
        $users = new User();
        $user_type = Auth::user()->usertype;
        if ($user_type == 'user')
        {
            $employees = User::findOrFail(Auth::user()->id);
            if (!User::hasAccess($employees)) {
                return redirect('/dashboard')->with([
                    'success' => 'You are not authorized to view this page!'
                ]);
            }
        }
        
        if ($request->has('emp_type') || $request->has('department') || $request->has('verified') || $request->has('dep_id')
            || $request->has('name') || $request->has('emis_code') || $request->has('cnic') || $request->has('phone')
            || $request->has('gender') || $request->has('marital_status') || $request->has('refugee_status')
            || $request->has('province_domicile') || $request->has('district_domicile')
        ) {
            if ($request->input('name')) {
                $users =
                    $users->where('first_name', 'like', "%$request->name%")
                        ->orWhere('middle_name', 'like', "%$request->name%")
                        ->orWhere('last_name', 'like', "%$request->name%");
            }

            if($user_type == 'department_admin')
            {
                $users = $users->where('dep_id', Auth::user()->dep_id);
            }

            if ($request->input('emis_code')) {
                $users = $users->where('emis_code', $request->emis_code);
            }
            if ($request->input('personal_no')) {
                $users = $users->where('personal_no', $request->cnic);
            }

            if ($request->input('cnic')) {
                $users = $users->where('cnic', $request->cnic);
            }
            if ($request->input('personal_no')) {
                $users = $users->where('personal_no', $request->personal_no);
            }
            if ($request->input('phone')) {
                $users = $users->where('residential_phone', $request->phone)
                    ->orWhere('office_phone', 'like', "%$request->phone%")
                    ->orWhere('mobile_phone', 'like', "%$request->phone%")
                    ->orWhere('fax_number', 'like', "%$request->phone%");
            }
            if ($request->input('gender')) {
                $users = $users->whereIn('gender', $request->gender);
            }
            if ($request->input('marital_status')) {
                $users = $users->whereIn('marital_status', $request->marital_status);
            }
            if ($request->input('refugee_status')) {
                $users = $users->whereIn('refugee_status', $request->refugee_status);
            }
            if ($request->input('emp_type')) {
                $users = $users->whereIn('emp_type', $request->emp_type);
            }
            if ($request->input('province_domicile')) {
                $users = $users->whereIn('province_domicile', $request->province_domicile);
            }
            if ($request->input('district_domicile')) {
                $users = $users->whereIn('district_domicile', $request->district_domicile);
            }
            if (isset($request->verified)) {
                $users = $users->whereIn('verified', $request->verified);
            }
            if ($request->input('dep_id')) {
                $users = $users->whereIn('dep_id', $request->dep_id);
            }

            $users = $users->paginate(10);
        } else {
            if ($user_type == 'department_admin')
                $users = User::where('dep_id', Auth::user()->dep_id)->paginate(10);
            else
                $users = User::paginate(10);
        }
        $dept = Department::all();
        return view('user.index', compact('users', 'dept'));
    }


    public function edit(Request $request, $emp_id)
    {
        $employees = User::findOrFail($emp_id);
        if (!User::hasAccess($employees)) {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }

        return view('user.edit', compact('employees'));
    }

    public function update(Request $request, $emp_id)
    {
        $employees = User::findOrFail($emp_id);
        if (!User::hasAccess($employees)) {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }

        $filename = null;
        if ($request->hasFile('emp_img')) {
            $file = $request->file('emp_img');
            $name = $file->getClientOriginalName();
            if ($request->root() == "http://127.0.0.1:8000") {
                $destination = base_path() . '/public/uploads/employee';
            } else {
                $destination = 'uploads' . '/employee';
            }
            $filename = time() . '_' . auth()->id() . '_' . $name;
            $file->move($destination, $filename);
            $request->merge(['image' => $filename]);
        }
        $x = explode(':', $request->district_domicile);
        $request->merge(['province_domicile' => $x[0]]);
        $request->merge(['district_domicile' => $x[1]]);
        $employees->update($request->all());
        if ($request->submit == "Save") {
            return back()->with('message', 'Employee details has been updated...');
        } elseif ($request->submit == "Next") {
            return redirect('employement-details/' . $emp_id . '/edit')->with('message', 'Employee details has been updated...');
        }
    }



    public function index()
    {
        $user = Auth::user();
        $user_employee_dep = $user->dep_id;
        $employees = new User();
        $depEmp = '';
        $total_emp = 0;
        $total_dep = 0;
        $not_verified_users = 0;
        $verified_users = 0;
        $data = [];
        $employment_count = 0;
        $academic_count = 0;
        $professional_count = 0;
        $trainings_count = 0;
        $transfer_count = 0;
        $teaching_details_count = 0;
        $result_history_count = 0;
        $promotion_count = 0;

        if (Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'department_admin') {

            if (Auth::user()->usertype == 'admin') {

                $total_dep = Department::count();

                $not_verified_users = User::where('verified', '=', 0)
                    ->count();
                $verified_users = User::where('verified', '=', 1)->count();

                $depEmp = $employees->selectRaw('users.emp_type , count(*) AS total')
                    ->groupBy('users.emp_type')
                    ->get();

            } elseif (Auth::user()->usertype == 'department_admin') {


                $not_verified_users = User::where('verified', '=', 0)->where('dep_id', '=', $user_employee_dep)->count();
                $verified_users = User::where('verified', '=', 1)->where('dep_id', '=', $user_employee_dep)->count();

                $depEmp = $employees->selectRaw('users.emp_type , count(*) AS total')
                    ->where('users.dep_id', '=', $user_employee_dep)
                    ->groupBy('users.emp_type')
                    ->get();

            }
            $data = ['notSet' => 0,
                'permanent' => 0,
                'adhoc' => 0,
                'deputation' => 0,
                'contract' => 0,
                'temporary' => 0,
                'internee' => 0];

            foreach ($depEmp as $de) {
                if (empty($de['emp_type']))
                    $data['notSet'] += $de['total'];
                else
                    $data[$de['emp_type']] += $de['total'];
            }

            $total_emp = $data['notSet'] + $data['permanent'] + $data['adhoc'] + $data['deputation'] + $data['contract'] + $data['temporary'] + $data['internee'];


        } else {
            $employment_count = $user->EmployementDetails->count();
            $academic_count = $user->qualification->count();
            $professional_count = $user->professional_qualification->count();
            $trainings_count = $user->trainings->count();
            $transfer_count = $user->transfer->count();
            $teaching_details_count = $user->teaching_details->count();
            $result_history_count = $user->result_history->count();
            $promotion_count = $user->promotion->count();
        }
        return view('admin.dashboard')->with(
            [


                'total_dep' => $total_dep,
                'total_emp' => $total_emp,
                'data' => $data,
                'not_verified_users' => $not_verified_users,
                'verified_users' => $verified_users,

                'employment_count' => $employment_count,
                'academic_count' => $academic_count,
                'professional_count' => $professional_count,
                'trainings_count' => $trainings_count,
                'teaching_details_count' => $teaching_details_count,
                'result_history_count' => $result_history_count,
                'transfer_count' => $transfer_count,
                'promotion_count' => $promotion_count,
            ]);
    }

    public
    function ViewEmployee($emp_id)
    {
        $employees = User::find($emp_id);
        if (!User::hasAccess($employees)) {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }
        return view('admin.employee-profile', compact('employees'));
    }

    public
    function VerifyUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->verified = 1;
        $user->update();

        return redirect()->back()->with('success', 'Employee has been verified.');
    }

    public function markAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
