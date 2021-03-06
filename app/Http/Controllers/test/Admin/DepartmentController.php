<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
{
    public function index()
    {
        $employee_in = Department::leftJoin('users', function ($join) {
            $join->on('departments.id', '=', 'users.dep_id');
        })->select('departments.id', 'departments.dep_name', DB::raw('count(users.id) as totalEmployees'))
            ->groupBy('departments.id', 'departments.dep_name')
            ->paginate(10);
        return view('department.index')->with(['department' => $employee_in, 'total' => count($employee_in)]);
    }

    public function store(Request $request)
    {
        $filename = null;
        if ($request->hasFile('filelogo')) {
            $file = $request->file('filelogo');
            $name = $file->getClientOriginalName();
            if ($request->root() == "http://127.0.0.1:8000") {
                $destination = base_path() . '/public/uploads/department';
            } else {
                $destination = 'uploads'  . '/department';
            }
            $filename = time() . '_' . auth()->id() . '_' . $name;
            $file->move($destination, $filename);
            $request->merge(['logo' => $filename]);
        }
        Department::create($request->all());
        $all_dep = Department::all();
        $total = Department::count();
        return redirect()->back()->with([
            'success' => 'Added Successfully',
            'department' => $all_dep,
            'total' => $total,
        ]);
    }

    public function edit(Request $request, Department $department)
    {
        return view('department.edit', compact('department'));
    }


    public function update(Request $request, Department $department)
    {
        $filename = null;
             if ($request->hasFile('filelogo')) {
            $file = $request->file('filelogo');
            $name = $file->getClientOriginalName();
            if ($request->root() == "http://127.0.0.1:8000") {
                $destination = base_path() . '/public/uploads/department';
            } else {
                $destination = 'uploads'  . '/department';
            }
            $filename = time() . '_' . auth()->id() . '_' . $name;
            $file->move($destination, $filename);
            $request->merge(['logo' => $filename]);
        }
        $department->update($request->all());
        return redirect()->back()->with('success', 'Department updated successfully.');
//        return view('department.edit',compact('department'))->with(['success' =>'scnn']);
    }

    public function show(Request $request, Department $department)
    {

        $empl = new User();

        $depEmp = $empl->selectRaw('users.emp_type , count(*) AS total')
            ->where('users.dep_id', '=', $department->id)
            ->groupBy('users.emp_type')
            ->get();

        $data = ['notSet' => 0,
            'permanent' => 0,
            'adhoc' => 0,
            'deputation' => 0,
            'contract' => 0,
            'emp_status' => 0,
            'temporary' => 0,
            'internee' => 0];


        foreach ($depEmp as $de) {
            if (empty($de['emp_type']))
                $data['notSet'] = $data['notSet'] + $de['total'];
            else
                $data[$de['emp_type']] += $de['total'];

        }


        $total_emp = $data['notSet'] + $data['permanent'] + $data['adhoc'] + $data['deputation'] + $data['contract'] + $data['temporary'] + $data['internee'];

//        dd($depEmp);
        return view('department.show', compact(['department', 'data', 'total_emp']));
    }

    public function destroy(Request $request, Department $department)
    {
        $department->delete();
        return redirect()->back()->with('success', 'Department deleted successfully.');
    }
}
