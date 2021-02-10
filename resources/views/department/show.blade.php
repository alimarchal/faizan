@extends('layouts.master')

@section('title')
        Department
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    @if(empty($department->logo))
                        <img src="{{url('assets/img/logo.png')}}" width="150" height="auto" class="float-left mr-4">
                    @else
                        <img src="{{url('uploads/department/'. $department->logo)}}" class="float-left mr-4" width="150" height="auto">
                    @endif
                    <br>
                    <h1 class="mb-0">{{$department->dep_name}}</h1>
                    <h3 class="mb-0">Azad Government of The State of Jammu & Kashmir</h3>
                    <div class="clearfix"></div>
                    <hr>
                </div>
                <div class="card-body">
                    {!! html_entity_decode($department->description, ENT_QUOTES, 'UTF-8') !!}
                    <h3>Employees</h3>
                    <div class="row" id="adminCard">
                        <div class="col-md-3">
                            <div class="card border-info bg-light border" align="center">
                                <div class="card-body" style="">
                                    <a href="{{url('employees?dep_id[]=' . $department->id)}}" style="text-decoration: none">
                                        <i class="now-ui-icons business_badge" style="color: #141e30; font-size: 40px"></i>
                                        <h4 style="font-size:60px; margin-top:0; padding-top:0;">{{$total_emp}}</h4>
                                        <p style="margin-top:-25px; padding-top:0px;"> Total Employees</p>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card border-info bg-light border" align="center">
                                <div class="card-body" style="">
                                    <a href="{{url('employees?dep_id[]='.$department->id . '&emp_type[]=permanent')}}" style="text-decoration: none">
                                        <i class="fas fa-chalkboard-teacher" style="color: #141e30; font-size: 40px"></i>
                                        <h4 style="font-size:60px; margin-top:0; padding-top:0;">{{$data['permanent']}}</h4>
                                        <p style="margin-top:-25px; padding-top:0px;"> Permanent Employees</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-info bg-light border" align="center">
                                <div class="card-body" style="">
                                    <a href="{{url('employees?dep_id[]='.$department->id . '&emp_type[]=adhoc')}}" style="text-decoration: none">
                                        <i class="now-ui-icons education_agenda-bookmark" style="color: #141e30; font-size: 40px"></i>
                                        <h4 style="font-size:60px; margin-top:0; padding-top:0;">{{$data['adhoc']}}</h4>
                                        <p style="margin-top:-25px; padding-top:0px;">Adhoc Employees</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-info bg-light border" align="center">
                                <div class="card-body" style="">
                                    <a href="{{url('employees?dep_id[]='.$department->id . '&emp_type[]=deputation')}}" style="text-decoration: none">
                                        <i class="now-ui-icons location_map-big" style="color: #141e30; font-size: 40px"></i>
                                        <h4 style="font-size:60px; margin-top:0; padding-top:0;">{{$data['deputation']}}</h4>
                                        <p style="margin-top:-25px; padding-top:0px;">Deputation Employees</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-info bg-light border" align="center">
                                <div class="card-body" style="">
                                    <a href="{{url('employees?dep_id[]='.$department->id . '&emp_type[]=contract')}}" style="text-decoration: none">
                                        <i class="now-ui-icons files_box" style="color: #141e30; font-size: 40px"></i>
                                        <h4 style="font-size:60px; margin-top:0; padding-top:0;">{{$data['contract']}}</h4>
                                        <p style="margin-top:-25px; padding-top:0px;"> Contract Employees</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-info bg-light border" align="center">
                                <div class="card-body" style="">
                                    <a href="{{url('employees?dep_id[]='.$department->id . '&emp_type[]=temporary')}}" style="text-decoration: none">
                                        <i class="now-ui-icons arrows-1_minimal-right" style="color: #141e30; font-size: 40px"></i>
                                        <h4 style="font-size:60px; margin-top:0; padding-top:0;">{{$data['temporary']}}</h4>
                                        <p style="margin-top:-25px; padding-top:0px;"> Temporary Employees</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-info bg-light border" align="center">
                                <div class="card-body" style="">
                                    <a href="{{url('employees?dep_id[]='.$department->id . '&emp_type[]=internee')}}" style="text-decoration: none">
                                        <i class="now-ui-icons design-2_ruler-pencil" style="color: #141e30; font-size: 40px"></i>
                                        <h4 style="font-size:60px; margin-top:0; padding-top:0;">{{$data['internee']}}</h4>
                                        <p style="margin-top:-25px; padding-top:0px;">Internees</p>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card border-info bg-light border" align="center">
                                <div class="card-body" style="">
                                    <a href="{{url('employees?dep_id[]='.$department->id . '&emp_type[]=')}}" style="text-decoration: none">
                                        <i class="now-ui-icons design-2_ruler-pencil" style="color: #141e30; font-size: 40px"></i>
                                        <h4 style="font-size:60px; margin-top:0; padding-top:0;">{{$data['notSet']}}</h4>
                                        <p style="margin-top:-25px; padding-top:0px;">Not Set</p>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
@endsection
