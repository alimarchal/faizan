@extends('layouts.master')

@section('title')
    Dashboard
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @if(\Illuminate\Support\Facades\Auth::user()->usertype == 'department_admin')
                    <div class="card-header">
                        <h2 class="card-title" style="text-align: center">
                        <img src="{{url('uploads/department/' . Auth::user()->department->logo)}}"
                                 style="text-align:left; height: 60px; width:60px">
                            <span>{{Auth::user()->department->dep_name}}</span>
                        </h2>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-info" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-body">
                    @if(Auth::user()->usertype != 'user')
                        <style>
                            #adminCard {
                                /*padding: 30px;*/
                            }

                            #adminCard .withBG p, #adminCard .withBG i, #adminCard .withBG h4 {
                                color: white;
                            }

                            #adminCard p {
                                color: #141e30;
                                margin-top: -25px;
                                padding-top: 0px;
                                font-size: 20px;
                                font-weight: bold;
                            }

                            #adminCard h4 {
                                font-size: 60px;
                                margin-top: 0;
                                padding-top: 0;
                                color: #1da2ff;
                            }

                            #adminCard i {
                                color: #141e30;
                                font-size: 40px
                            }

                            #adminCard .card {
                                border-radius: 10px !important;
                            }

                            #adminCard .card:hover {
                                background: url("https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQqYMbCmATDzVcB9hzuzwnM-tpyMEqSQKZoAQ&usqp=CAU");
                                color: white !important;
                                background-position: center;
                                background-size: cover;

                            }

                            #adminCard .card:hover h4, #adminCard .card:hover i {
                                color: white;
                            }

                            #adminCard .card:hover p {
                                color: white;
                            }

                            #adminCard a {
                                text-decoration: none;
                            }

                        </style>
                        <div class="row" id="adminCard">
                            @if(\Illuminate\Support\Facades\Auth::user()->usertype == 'admin')
                                <div class="col-md-3">
                                    <div class="card border-info bg-light border" align="center">
                                        <div class="card-body">
                                            <a href="/departments">
                                                <i class="now-ui-icons business_bank"></i>
                                                <h4>{{$total_dep}}</h4>
                                                <p>Departments</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-3">
                                <div class="card border-info bg-light border" align="center">
                                    <div class="card-body">
                                        <a href="/employees">
                                            <i class="now-ui-icons business_badge"></i>
                                            <h4>{{$total_emp}}</h4>
                                            <p> Total Employees</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card border-info bg-light border" align="center">
                                    <div class="card-body">
                                        <a href="/employees?emp_type[]=permanent">
                                            <i class="fas fa-chalkboard-teacher"></i>
                                            <h4>{{$data['permanent']}}</h4>
                                            <p> Permanent Employees</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card border-info bg-light border" align="center">
                                    <div class="card-body">
                                        <a href="/employees?emp_type[]=adhoc">
                                            <i class="now-ui-icons education_agenda-bookmark"></i>
                                            <h4>{{$data['adhoc']}}</h4>
                                            <p>Adhoc Employees</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card border-info bg-light border" align="center">
                                    <div class="card-body">
                                        <a href="/employees?emp_type[]=deputation">
                                            <i class="now-ui-icons location_map-big"></i>
                                            <h4>{{$data['deputation']}}</h4>
                                            <p>Deputation Employees</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card border-info bg-light border" align="center">
                                    <div class="card-body">
                                        <a href="/employees?emp_type[]=contract">
                                            <i class="now-ui-icons files_box"></i>
                                            <h4>{{$data['contract']}}</h4>
                                            <p> Contract Employees</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card border-info bg-light border" align="center">
                                    <div class="card-body">
                                        <a href="/employees?emp_type[]=temporary">
                                            <i class="now-ui-icons arrows-1_minimal-right"></i>
                                            <h4>{{$data['temporary']}}</h4>
                                            <p> Temporary Employees</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card border-info bg-light border" align="center">
                                    <div class="card-body">
                                        <a href="/employees?emp_type[]=internee">
                                            <i class="now-ui-icons design-2_ruler-pencil"></i>
                                            <h4>{{$data['internee']}}</h4>
                                            <p>Internees</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 withBG">
                                <div class="card bg-info border" align="center">
                                    <div class="card-body">
                                        <a href="/employees?verified[]=1">
                                            <i class="fas fa-user-check"></i>
                                            <h4>{{$verified_users}}</h4>
                                            <p>Verified Users</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 withBG">
                                <div class="card bg-danger border" align="center">
                                    <div class="card-body">
                                        <a href="/employees?verified[]=0">
                                            <i class="fas fa-user-alt-slash "></i>
                                            <h4>{{$not_verified_users}}</h4>
                                            <p>Pending Users</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
							
							<div class="col-md-4 withBG">
                                <div class="card bg-warning border" align="center">
                                    <div class="card-body">
										@if(auth()->user()->usertype == "department_admin")
                                            <a href="/employees?last_24hrs[]=24hr">
                                        @else
                                            <a href="/employees?last_24hrs[]=24hrs">
                                        @endif
                                            <i class="fas fa-clock"></i>
                                            @if(auth()->user()->usertype == "department_admin")
											<h4>{{\App\User::where('dep_id',auth()->user()->id)->where("created_at",">",\Carbon\Carbon::now()->subDay())->where("created_at","<",\Carbon\Carbon::now())->count()}}</h4>
												@else
                                                <h4>{{\App\User::where("created_at",">",\Carbon\Carbon::now()->subDay())->where("created_at","<",\Carbon\Carbon::now())->count()}}</h4>
                                            @endif
                                            <p>Last 24hrs</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
					
					
 
                    @else
                        <div class="row">
                            <div class="col-md-12" align="">
                                <h2 align="center">
                                    Welcome to Employee Management Information System
                                </h2>

                            </div>
                            @if(Auth::user()->verified == 0)
                                <div class="col-md-12" align="center">
                                    <h5 style="color: green;">You have successfully Registered with EMIS</h5>
                                    @if(!Auth::user()->email_verified_at && empty(!Auth::user()->email))
                                        <h6 style="color: green;">We have send you an email to verify your email address
                                            pelase check your inbox/junk/spam.</h6>
                                    @endif
                                    <h6 style="color: red">You can not make changes until verified by concerned
                                        authorities</h6>
                                </div>
                            @else

                                <style>
                                    #userCard i.now-ui-icons {
                                        font-size: 30px;
                                    }

                                    #userCard h4 {
                                        color: black !important;
                                    }

                                    #userCard p {
                                        color: black !important;
                                    }

                                    #userCard .card:hover {
                                        background-color: #9fcdff !important;
                                    }

                                </style>
                                <div class="col-md-12">
                                    <div class="row" id="userCard">
                                        <div class="col-md-4">
                                            <div class="card bg-light border" align="center">
                                                <div class="card-body" style=" font-size: large">
                                                    <a href="/employement-details/{{Auth::user()->id}}/edit">
                                                        <i class="now-ui-icons business_badge" style="color: red"></i>
                                                        <h4 style="font-size:40px; margin-top:0; padding-top:0; text-decoration: none">{{$employment_count}}</h4>
                                                        <p style=" margin-top:-25px;">Employment Details </p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card bg-light border" align="center">
                                                <div class="card-body" style=" font-size: large">
                                                    <a href="/qualifications/{{Auth::user()->id}}/edit">
                                                        <i class="now-ui-icons education_hat" style="color: red"></i>
                                                        <h4 style="font-size:40px; margin-top:0; padding-top:0; text-decoration: none">{{$academic_count}}</h4>
                                                        <p style=" margin-top:-25px;">Academic Qualifications </p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card bg-light border" align="center">
                                                <div class="card-body" style=" font-size: large">
                                                    <a href="/edit-professional/{{Auth::user()->id}}/edit">
                                                        <i class="now-ui-icons business_briefcase-24"
                                                           style="color: red"></i>
                                                        <h4 style="font-size:40px; margin-top:0; padding-top:0; text-decoration: none">{{$professional_count}}</h4>
                                                        <p style=" margin-top:-25px;">Professional Qualifications</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card bg-light border" align="center">
                                                <div class="card-body" style=" font-size: large">
                                                    <a href="/edit-trainings/{{Auth::user()->id}}/edit">
                                                        <i class="now-ui-icons ui-2_settings-90" style="color: red"></i>
                                                        <h4 style="font-size:40px; margin-top:0; padding-top:0; text-decoration: none">{{$trainings_count}}</h4>
                                                        <p style=" margin-top:-25px;">Trainings</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @if(Auth::user()->dep_id == 4)
                                            <div class="col-md-4">
                                                <div class="card bg-light border" align="center">
                                                    <div class="card-body" style=" font-size: large">
                                                        <a href="/edit-teaching_details/{{Auth::user()->id}}/edit">
                                                            <i class="now-ui-icons business_bulb-63"
                                                               style="color: red"></i>
                                                            <h4 style="font-size:40px; margin-top:0; padding-top:0; text-decoration: none">{{$teaching_details_count}}</h4>
                                                            <p style=" margin-top:-25px;">Teaching Details</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card bg-light border" align="center">
                                                    <div class="card-body" style=" font-size: large">
                                                        <a href="/edit-result-history/{{Auth::user()->id}}/edit">
                                                            <i class="now-ui-icons files_paper" style="color: red"></i>
                                                            <h4 style="font-size:40px; margin-top:0; padding-top:0; text-decoration: none">{{$result_history_count}}</h4>
                                                            <p style=" margin-top:-25px;">Result History</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-md-4">
                                            <div class="card bg-light border p-1" align="center">
                                                <div class="card-body" style=" font-size: large">
                                                    <a href="/edit-promotion-history/{{Auth::user()->id}}/edit">
                                                        <i class="now-ui-icons business_chart-bar-32"
                                                           style="color: red"></i>
                                                        <h4 style="font-size:40px; margin-top:0; padding-top:0; text-decoration: none">{{$promotion_count}}</h4>
                                                        <p style=" margin-top:-25px;">Promotion History</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card bg-light border" align="center">
                                                <div class="card-body" style=" font-size: large">
                                                    <a href="/edit-transfer-history/{{Auth::user()->id}}/edit">
                                                        <i class="now-ui-icons sport_user-run" style="color: red"></i>
                                                        <h4 style="font-size:40px; margin-top:0; padding-top:0; text-decoration: none">{{$transfer_count}}</h4>
                                                        <p style=" margin-top:-25px;">Transfer History</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-4">
                                             <div class="card bg-light border" align="center">
                                                 <div class="card-body" style=" font-size: large">
                                                     <a href="/employee-profile/{{ Auth::user()->employee_id}}">
                                                     <i class="now-ui-icons users_single-02" style="color: red"></i>
                                                     <p>Profile</p>
                                                     </a>
                                                 </div>
                                             </div>
                                         </div>--}}
                                    </div>
                                </div>

                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Male', 11],
                ['Female', 2],
            ]);

            var options = {
                title: ''
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
@endsection
