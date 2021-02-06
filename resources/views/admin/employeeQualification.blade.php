@extends('layouts.master')

@section('title')
    Add Qualification
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3> Academic Qualification
                            <span style="color: #777777"> - Step 3</span>
                        </h3>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-info" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(count($errors)>0)
                        <ul>
                            @foreach($errors->all() as $error)
                                <li class="alert alert-danger">add missing fields</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="card-body">
                        <style>
                            label {
                                font-weight: bold !important;
                                color: #000000 !important;
                            }
                        </style>
                        <div class="row">
                            <div class="col-md-12">
                                <form action="/qualifications/{{$employee_id}}" method="POST"
                                      enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    @if(count($employee->qualification)>0)
                                        @foreach($employee->qualification as $qual)
                                            <div class="myqual">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a href="{{url('qualifications/' . $qual->employee_id . '/' . $qual->id )}}"
                                                           class="btn btn-danger float-right">Edit</a>
                                                        @php $link = 'qualifications/'; @endphp
                                                        @if((auth()->user()->usertype == 'department_admin' || auth()->user()->usertype == 'admin') && $qual->verified != 1)
                                                            <a href="{{url($link . $qual->id )}}" class="btn btn-outline-warning btn-sm" title="Not Verified: Click to verify."><i class="fa fa-user-check"></i> Verify</a>
                                                        @elseif((auth()->user()->usertype == 'department_admin' || auth()->user()->usertype == 'admin') && $qual->verified == 1)
                                                            <a href="javascript:;" class="btn btn-outline-success btn-sm" title="Verified"><i class="fa fa-user-check"></i> Verified</a>
                                                        @endif
                                                        @if(auth()->user()->usertype == 'user' && $qual->verified != 1)
                                                            <a href="javascript:;" class="btn btn-outline-warning btn-sm"> Not Verified</a>
                                                        @elseif(auth()->user()->usertype == 'user' && $qual->verified == 1)
                                                            <a href="javascript:;" class="btn btn-outline-success btn-sm"><i class="fa fa-user-check"></i> Verified</a>
                                                        @endif

                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Degree
                                                            Name:</label> {{$qual->degree_name}}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Year of
                                                            Passing:</label> {{$qual->year}}
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            Field/Subject:</label>{{$qual->field}}
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            Start Date:</label>{{ Carbon\Carbon::parse($qual->start_date)->format('d-m-Y')}}
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            End Date:</label>{{Carbon\Carbon::parse($qual->end_date)->format('d-m-Y')}}
                                                    </div>




                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            National/Foreign:</label>{{$qual->national_foreign}}
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            Institution :</label>{{$qual->institute}}
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            City :</label>{{$qual->city}}
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            Country :</label>{{$qual->country}}
                                                    </div>


                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            Degree Status :</label>{{$qual->degree_status}}
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            Subject:</label> {{$qual->subject}}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            Marks(%age):</label> {{$qual->marks_percentage}}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            Division/Grade:</label>{{$qual->grade}}
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            Major Specialization:</label>{{$qual->major_specialization}}
                                                    </div>


                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            Minor Specialization :</label>{{$qual->minor_specialization}}
                                                    </div>


                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            Source of Funding:</label>{{$qual->source_of_funding}}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            Bond Details:</label>{{$qual->bond_details}}
                                                    </div>


                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            Country:</label>{{$qual->country}}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            Province:</label>{{$qual->province}}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            District:</label>{{$qual->district}}
                                                    </div>
                                                    @if($qual->degree_image)

                                                        <div class="col-md-4">
                                                            <label for="exampleInputEmail1" class="col-md-6">
                                                                Image:</label>
                                                            <a href="{{ asset('uploads/employee/'. $qual->degree_image) }}"
                                                               target="_blank">Show Certificate
                                                            </a>
                                                        </div>
                                                    @endif
                                                    <hr width="100%" style="margin-top: 3rem">
                                                </div>
                                            </div>

                                        @endforeach
                                    @else
                                        <div class="myqual">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="file" name="filelogo[]" for="exampleInputEmail1"
                                                           class="form-control-file">
                                                    <label class="form-label  mt-0" for="file">Any file Notification/Certificate</label>
                                                </div>
                                                <hr width="100%" style="margin-top: 1rem">
                                                <div class="col-md-6 ">

                                                    <label for="browser" class="col-md-6"> Degree Name</label>
                                                    <input list="browsers" name="degree_name[]" id="browser"
                                                           class="form-control" required>
                                                    <datalist id="browsers">
                                                        <option value="Matric Science">
                                                        <option value="Matric Arts">
                                                        <option value="O Level">
                                                        <option value="FA">
                                                        <option value="FSc Pre-M">
                                                        <option value="FSc Pre-Engg">
                                                        <option value="A-Level">
                                                        <option value="BA Arts">
                                                        <option value="MA">
                                                        <option value="MBA">
                                                        <option value="BA">
                                                        <option value="BCS">
                                                        <option value="BSC">
                                                        <option value="MBBS">
                                                        <option value="BE">
                                                        <option value="M.Phil">
                                                        <option value="MSCS">
                                                        <option value="PHD">
                                                    </datalist>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Year of
                                                        Passing</label>
                                                    <select name="year[]" id="year" class="form-control select2">
                                                        @for($i = 1900; $i <= date('Y'); $i++)
                                                            <option value="{{$i}}">{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6">
                                                        Field/Subject</label>
                                                    <input type="text" name="subject[]" class="form-control">
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6">Start Date</label>
                                                    <input type="date" name="start_date[]" class="form-control">
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6">End Date</label>
                                                    <input type="date" name="end_date[]" class="form-control">
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="national_foreign"
                                                           class="col-md-6">National/Foreign</label>
                                                    <select name="national_foreign[]" id="national_foreign"
                                                            class="form-control select2" required>
                                                        <option value="National">National</option>
                                                        <option value="Foreign">Foreign</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1"
                                                           class="col-md-6">Institution/School/College/University</label>
                                                    <input type="text" name="institute[]" class="form-control" required>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Country</label>
                                                    <input type="text" name="country[]" value="" class="form-control" required>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Province</label>
                                                    <input type="text" name="province[]" value="" class="form-control ">
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="city" class="col-md-6">District/City/Location</label>
                                                    <input type="text" name="city[]" value="" class="form-control ">
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="marks" class="col-md-6">
                                                        Division/Grade/GPA/CGPA/Marks(%)</label>
                                                    <input type="text" name="marks_percentage[]" id="marks"
                                                           class="form-control" required>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="major_specialization" class="col-md-6"> Major
                                                        Specialization(e.g.Accounting)</label>
                                                    <input type="text" name="major_specialization[]"
                                                           id="major_specialization" class="form-control">
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="minor_spacialization" class="col-md-6"> Minor
                                                        Specialization (e.g. Finance)</label>
                                                    <input type="text" name="minor_spacialization[]"
                                                           class="form-control">
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="bond_details" class="col-md-6">Bond details</label>
                                                    <input type="text" name="bond_details[]" class="form-control">
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="source_of_funding" class="col-md-6">Source of
                                                        funding</label>
                                                    <input type="text" name="source_of_funding[]" class="form-control">
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6">
                                                        Division/Grade</label>
                                                    <input type="text" name="grade[]" class="form-control ">
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="degree_status" class="col-md-6">Degree Status</label>
                                                    <select name="degree_status[]" id="degree_status"
                                                            class="form-control select2" required>
                                                        <option value="Completed">Completed</option>
                                                        <option value="In Process">In Process</option>
                                                        <option value="Failed">Failed</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12" align="center">
                                                <button type="submit" name="submit" value="Save" class="btn btn-info">
                                                    Save
                                                </button>
                                                <button type="submit" name="submit" value="Next" class="btn btn-primary">
                                                    Save & Next
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="myrow">

                                    </div>
                                    <div class="row">
                                        <div class="col-md-3" align="left">
                                            <a id="add_more" type="" class="btn btn-success"> Add More</a>
                                        </div>

                                        <div class="col-md-6" align="center">
                                        </div>
                                        <div class="">

                                        </div>
                                        <div class="col-md-3" align="right">
                                            <a href="/professional_qualifications/{{$employee_id}}/edit" type=""
                                               class="btn btn-danger"> Skip </a>
                                        </div>

                                    </div>

                                </form>
                                <div class="newqual" style="display: none">
                                    <br>
                                    <div class="row">

                                        <div class="cross col-md-6">
                                            <a href="javascript:(0);" class=""><i
                                                    class="now-ui-icons ui-1_simple-remove"></i></a>
                                        </div>
                                        <div class="col-md-12" align="right">
                                            <input type="file" name="filelogo[]" for="exampleInputEmail1"
                                                   class="form-control-file">
                                            <label class="form-label  mt-0" for="file">Any file Notification/Certificate</label>
                                        </div>
                                        <hr width="100%" style="margin-top: 1rem">
                                        <div class="col-md-6 ">

                                            <label for="browser" class="col-md-6"> Degree Name</label>
                                            <input list="browsers" name="degree_name[]" id="browser"
                                                   class="form-control">
                                            <datalist id="browsers">
                                                <option value="Matric Science">
                                                <option value="Matric Arts">
                                                <option value="O Level">
                                                <option value="FA">
                                                <option value="FSc Pre-M">
                                                <option value="FSc Pre-Engg">
                                                <option value="A-Level">
                                                <option value="BA Arts">
                                                <option value="BCS">
                                                <option value="BSC">
                                                <option value="MBBS">
                                                <option value="BE">
                                                <option value="M.Phil">
                                                <option value="MSCS">
                                                <option value="PHD">
                                            </datalist>
                                        </div>
                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Year of
                                                Passing*</label>
                                            <select name="year[]" id="year" class="form-control" tabindex="0" aria-hidden="false" required>
                                                <option value="1900">1900</option>
                                                <option value="1901">1901</option>
                                                <option value="1902">1902</option>
                                                <option value="1903">1903</option>
                                                <option value="1904">1904</option>
                                                <option value="1905">1905</option>
                                                <option value="1906">1906</option>
                                                <option value="1907">1907</option>
                                                <option value="1908">1908</option>
                                                <option value="1909">1909</option>
                                                <option value="1910">1910</option>
                                                <option value="1911">1911</option>
                                                <option value="1912">1912</option>
                                                <option value="1913">1913</option>
                                                <option value="1914">1914</option>
                                                <option value="1915">1915</option>
                                                <option value="1916">1916</option>
                                                <option value="1917">1917</option>
                                                <option value="1918">1918</option>
                                                <option value="1919">1919</option>
                                                <option value="1920">1920</option>
                                                <option value="1921">1921</option>
                                                <option value="1922">1922</option>
                                                <option value="1923">1923</option>
                                                <option value="1924">1924</option>
                                                <option value="1925">1925</option>
                                                <option value="1926">1926</option>
                                                <option value="1927">1927</option>
                                                <option value="1928">1928</option>
                                                <option value="1929">1929</option>
                                                <option value="1930">1930</option>
                                                <option value="1931">1931</option>
                                                <option value="1932">1932</option>
                                                <option value="1933">1933</option>
                                                <option value="1934">1934</option>
                                                <option value="1935">1935</option>
                                                <option value="1936">1936</option>
                                                <option value="1937">1937</option>
                                                <option value="1938">1938</option>
                                                <option value="1939">1939</option>
                                                <option value="1940">1940</option>
                                                <option value="1941">1941</option>
                                                <option value="1942">1942</option>
                                                <option value="1943">1943</option>
                                                <option value="1944">1944</option>
                                                <option value="1945">1945</option>
                                                <option value="1946">1946</option>
                                                <option value="1947">1947</option>
                                                <option value="1948">1948</option>
                                                <option value="1949">1949</option>
                                                <option value="1950">1950</option>
                                                <option value="1951">1951</option>
                                                <option value="1952">1952</option>
                                                <option value="1953">1953</option>
                                                <option value="1954">1954</option>
                                                <option value="1955">1955</option>
                                                <option value="1956">1956</option>
                                                <option value="1957">1957</option>
                                                <option value="1958">1958</option>
                                                <option value="1959">1959</option>
                                                <option value="1960">1960</option>
                                                <option value="1961">1961</option>
                                                <option value="1962">1962</option>
                                                <option value="1963">1963</option>
                                                <option value="1964">1964</option>
                                                <option value="1965">1965</option>
                                                <option value="1966">1966</option>
                                                <option value="1967">1967</option>
                                                <option value="1968">1968</option>
                                                <option value="1969">1969</option>
                                                <option value="1970">1970</option>
                                                <option value="1971">1971</option>
                                                <option value="1972">1972</option>
                                                <option value="1973">1973</option>
                                                <option value="1974">1974</option>
                                                <option value="1975">1975</option>
                                                <option value="1976">1976</option>
                                                <option value="1977">1977</option>
                                                <option value="1978">1978</option>
                                                <option value="1979">1979</option>
                                                <option value="1980">1980</option>
                                                <option value="1981">1981</option>
                                                <option value="1982">1982</option>
                                                <option value="1983">1983</option>
                                                <option value="1984">1984</option>
                                                <option value="1985">1985</option>
                                                <option value="1986">1986</option>
                                                <option value="1987">1987</option>
                                                <option value="1988">1988</option>
                                                <option value="1989">1989</option>
                                                <option value="1990">1990</option>
                                                <option value="1991">1991</option>
                                                <option value="1992">1992</option>
                                                <option value="1993">1993</option>
                                                <option value="1994">1994</option>
                                                <option value="1995">1995</option>
                                                <option value="1996">1996</option>
                                                <option value="1997">1997</option>
                                                <option value="1998">1998</option>
                                                <option value="1999">1999</option>
                                                <option value="2000">2000</option>
                                                <option value="2001">2001</option>
                                                <option value="2002">2002</option>
                                                <option value="2003">2003</option>
                                                <option value="2004">2004</option>
                                                <option value="2005">2005</option>
                                                <option value="2006">2006</option>
                                                <option value="2007">2007</option>
                                                <option value="2008">2008</option>
                                                <option value="2009">2009</option>
                                                <option value="2010">2010</option>
                                                <option value="2011">2011</option>
                                                <option value="2012">2012</option>
                                                <option value="2013">2013</option>
                                                <option value="2014">2014</option>
                                                <option value="2015">2015</option>
                                                <option value="2016">2016</option>
                                                <option value="2017">2017</option>
                                                <option value="2018">2018</option>
                                                <option value="2019">2019</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6">
                                                Field/Subject*</label>
                                            <input type="text" name="subject[]" class="form-control">
                                        </div>


                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6">Start Date</label>
                                            <input type="date" name="start_date[]" class="form-control">
                                        </div>

                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6">End Date</label>
                                            <input type="date" name="end_date[]" class="form-control">
                                        </div>
                                        <div class="col-md-6 ">
                                            <label for="national_foreign"
                                                   class="col-md-6">National/Foreign</label>
                                            <select name="national_foreign[]" id="national_foreign"
                                                    class="form-control select2" required>
                                                <option value="National">National</option>
                                                <option value="Foreign">Foreign</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1"
                                                   class="col-md-6">Institution/School/College/University</label>
                                            <input type="text" name="institute[]" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Country</label>
                                            <input type="text" name="country[]" value="" class="form-control" required>
                                        </div>

                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Province</label>
                                            <input type="text" name="province[]" value="" class="form-control ">
                                        </div>
                                        <div class="col-md-6 ">
                                            <label for="city" class="col-md-6">District/City/Location</label>
                                            <input type="text" name="city[]" value="" class="form-control ">
                                        </div>



                                        <div class="col-md-6 ">
                                            <label for="marks" class="col-md-6">
                                                Division/Grade/GPA/CGPA/Marks(%)</label>
                                            <input type="text" name="marks_percentage[]" id="marks"
                                                   class="form-control" required>
                                        </div>


                                        <div class="col-md-6 ">
                                            <label for="major_specialization" class="col-md-6"> Major
                                                Specialization(e.g.Accounting)</label>
                                            <input type="text" name="major_specialization[]"
                                                   id="major_specialization" class="form-control">
                                        </div>

                                        <div class="col-md-6 ">
                                            <label for="minor_spacialization" class="col-md-6"> Minor
                                                Specialization (e.g. Finance)</label>
                                            <input type="text" name="minor_spacialization[]"
                                                   class="form-control">
                                        </div>


                                        <div class="col-md-6 ">
                                            <label for="bond_details" class="col-md-6">Bond details</label>
                                            <input type="text" name="bond_details[]" class="form-control">
                                        </div>


                                        <div class="col-md-6 ">
                                            <label for="source_of_funding" class="col-md-6">Source of
                                                funding</label>
                                            <input type="text" name="source_of_funding[]" class="form-control">
                                        </div>

                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6">
                                                Division/Grade</label>
                                            <input type="text" name="grade[]" class="form-control ">
                                        </div>

                                        <div class="col-md-6 ">
                                            <label for="degree_status" class="col-md-6">Degree Status*</label>
                                            <select name="degree_status[]" id="degree_status"
                                                    class="form-control" required>
                                                <option value="Completed">Completed</option>
                                                <option value="In Process">In Process</option>
                                                <option value="Failed">Failed</option>
                                            </select>
                                        </div>

                                        <hr width="100%" style="margin-top: 2rem">

                                        <div class="col-md-12" align="center">
                                            <button type="submit" name="submit" value="Save" class="btn btn-info">
                                                Save
                                            </button>
                                            <button type="submit" name="submit" value="Next" class="btn btn-primary">
                                                Save & Next
                                            </button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
