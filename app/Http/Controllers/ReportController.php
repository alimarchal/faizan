<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function designationWise(Request $request)
    {
        $employees = User::findOrFail(auth()->user()->id);
        if (!User::hasAccess($employees)) {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }
        $users = new User();
        //SELECT designation, count(*) from users where dep_id = '13' GROUP by designation
        // DB::enableQueryLog();
        $users = $users->select(DB::raw('designation, count(*) as total'));
        if (auth()->user()->usertype == 'department_admin') {
            $users = $users->where('dep_id', Auth::user()->dep_id);
        } elseif (auth()->user()->usertype == 'admin') {
            // 
        }
        // $users = $users->where('dep_id', 13);
        $collection = $users->groupBy('designation')->get();
        // $collection = User::select(DB::raw('designation, count(*) as total'))->where('dep_id', '13')->groupBy('district')->get();
        // dd(DB::getQueryLog());
        // $collection = DB::table('users')->where('dep_id', '13')->select('designation', DB::raw('count(*) as total'))->groupBy('district')->get();
        return view('report.designationWise', compact('collection'));
    }
    public function districtWise(Request $request)
    {

        if ($request->has('designation')) {
            $employees = User::findOrFail(auth()->user()->id);
            if (!User::hasAccess($employees)) {
                return redirect('/dashboard')->with([
                    'success' => 'You are not authorized to view this page!'
                ]);
            }
            if ($request->input('designation')) {
                $users = new User();
                $users = $users->select(DB::raw('designation,district, count(*) as total'));
                if (auth()->user()->usertype == 'department_admin') {
                    $users = $users->where('dep_id', Auth::user()->dep_id)->where('designation', $request->designation);
                    // Auth::user()->dep_id 
                } elseif (auth()->user()->usertype == 'admin') {
                    $users = $users->where('designation', $request->designation);

                }
            }
            $collection = $users->groupBy('district')->get();
            return view('report.districtWise', compact('collection'));
        }
    }
}
