<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportConroller extends Controller
{
   public function index(Request $request)
   {
      $users = DB::table('users')
         ->where('dep_id', '13')
         ->select('designation', 'district', DB::raw('count(district)'))
         ->groupBy('district')

         ->get();
      return view('admin.reportingHealth', compact('users'));
   }
   public function HEAJK()
   {
      $users = DB::table('users')
         ->where('dep_id', '51')
         ->select('district', 'designation', 'qualification_hed', 'emp_type', DB::raw('count(designation)'))
         ->orderBy('district', 'asc')
         ->orderBy('designation', 'asc')
         ->groupBy('qualification_hed')
         ->get();
      return view('admin.reportingHealth', compact('users'));
   }
}
