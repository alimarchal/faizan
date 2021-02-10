@extends('layouts.master')

@section('title')
    Departments
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-header">
                                <h3>Departments</h3>
                            </div>
                        </div>
                        <div class="col-md-6" style="padding-top: 15px; padding-left: 300px">
                            Total: {{$total}}
                            <button type="button" id="advance" style="" class="btn btn-info">
                                <i class="fa fa-plus"></i>
                                 Add Department / Hide
                            </button>
                        </div>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-info" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <style>
                            th {
                                font-weight: bold !important;
                            }

                            #adminCard p {
                                color: #141e30;
                            }

                            #adminCard h4 {
                            }
                        </style>
                        <div class="card" id="filters" style="display: none;">
                            <div class="col-md-12">
                                {{--{{$all_dep}}--}}
                                <form action="{{ url('departments') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="exampleInputEmail1" class="">Department Name</label>
                                            <input type="text" name="dep_name" class="form-control" value="" class="col-md-3">
                                            {{--<button type="submit" class="btn btn-primary"> Add </button>--}}
                                        </div>

                                        <div class="col-md-6">
                                            <label for="exampleInputEmail1" class="">Short Name</label>
                                            <input type="text" name="short_name" class="form-control" value="" placeholder="Type description here"
                                                   class="col-md-3">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="exampleInputEmail1" class="">Website URL</label>
                                            <input type="text" name="website_url" class="form-control" value="" class="col-md-3">
                                            {{--<button type="submit" class="btn btn-primary"> Add </button>--}}
                                        </div>

                                        <div class="col-md-6">
                                            <label for="exampleInputEmail1" class="">Logo</label><br>
                                            <input type="file" name="filelogo">
                                        </div>


                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1" class="">Description</label>
                                            <textarea name="description" class="form-control tinymce" placeholder="e.g; CD for Civil Defence"
                                                      class="col-md-3"></textarea>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <br>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="submit" class="btn btn-danger" value="Add">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="datatable" class="table table-striped table-bordered dataTable dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable_info"
                                           style="width: 100%;">
                                        <thead>

                                        <tr role="row">
                                            <th width="30" colspan="2">#</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                                aria-label="Position: activate to sort column ascending">Department Name
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                                aria-label="Position: activate to sort column ascending">Focal Person
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                                aria-label="Office: activate to sort column ascending">Employees
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                                aria-label="Age: activate to sort column ascending">Actions
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php $count = 0?>
                                        @foreach($departments as $dep)
                                            <?php $count++ ?>
                                            <tr role="row">
                                                <td> {{ $loop->iteration }}</td>
                                                <td>
                                                    @if(empty($dep->logo))
                                                        <img src="{{url('assets/img/logo.png')}}" width="50" height="auto" class="float-left mr-4">
                                                    @else
                                                        <img src="{{url('uploads/department/'. $dep->logo)}}" class="float-left mr-4" width="50" height="auto">
                                                    @endif
                                                </td>
                                                <td>
                                                 <a href="{{url('departments/'. $dep->id)}}" style="text-decoration: none">{{$dep->dep_name}}</a></td>
                                                <td>@if(isset($focal_person[$dep->id]))
                                                    <a href="{{url('employee_profile/'.$focal_person[$dep->id]->id)}}">{{ucwords($focal_person[$dep->id]->first_name . ' ' . $focal_person[$dep->id]->last_name)}}</a><br>
                                                    <small><strong>
                                                        @if(isset($focal_person[$dep->id]->mobile_phone))
                                                        Phone: <a href="tel:{{$focal_person[$dep->id]->personal_no}}">{{$focal_person[$dep->id]->mobile_phone}}</a><br>
                                                        @endif
                                                        @if(isset($focal_person[$dep->id]->email))
                                                        Email: <a href="mailto:{{$focal_person[$dep->id]->email}}">{{$focal_person[$dep->id]->email}}</a>
                                                        @endif
                                                        </strong>
                                                    </small>
                                                @endif
                                                </td>

                                                <td style="text-align: center;">
                                                    <a href="{{url('employees?dep_id[]=') . $dep->id}}">{{$dep->totalEmployees}}</a>
                                                </td>
                                                <td style="text-align: center;">

                                                    <a href="{{url('departments/'. $dep->id .'/edit')}}" class="btn btn-outline-success btn-sm"><i class="fa fa-edit"></i></a>
                                                    <form method="post" action="{{ url('departments/'. $dep->id ) }}" style="display: inline-block;">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
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
    <script type="text/javascript">
        $('#advance').click(function () {
            $('#filters').slideToggle(1000);
        });
    </script>
@endsection
