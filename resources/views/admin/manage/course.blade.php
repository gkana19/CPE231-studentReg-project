@extends('layouts.default')
@section('title','Manage | course')
@section('content')


<div class="height-100 bg-light" style="margin-right: 10px;">
    <div class="container">
        <br>
        <br>
        <div class="d-flex bd-highlight">
            <div class="">
                <h1><i class="fa fa-book fa-xs"></i> จัดการข้อมูลรายวิชา</h1>
            </div>
            <div class="ms-auto p-2 bd-highlight">
                <font size="5">จำนวนวิชา <span>{{count($coursecount)}}</span> วิชา</font>
            </div>
        </div>
        <div class="row d-flex">
            <hr>
            <div class="col-12 mt-2 d-flex justify-content-center">
                <a href="#insertModal"><button class="btn ms-sm-5 mx-2 btn-success" data-bs-toggle="modal" data-bs-target="#insertCourseModal">เพิ่มวิชาเรียน</button></a>
            </div>
            <table class="table table-striped shadow-sm text-center mt-3">
                
                {{-- alert message --}}
                @if(Session::has('success'))
                <div class="d-inline-flex">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>
                        {{Session::get('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @elseif(Session::has('delete'))
                <div class="d-inline-flex">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                            <use xlink:href="#exclamation-triangle-fill" />
                        </svg>
                        {{Session::get('delete')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif
                
            @if ($errors->any())
                <div class="d-inline-flex mt-3">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                        {{'กรุณากรอกข้อมูลให้ถูกต้อง'}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
                
                {{-- table --}}
                <thead class="table table-dark">
                    <tr>
                        <th>รหัสวิชา</th>
                        <th>ชื่อวิชา</th>
                        <th>หน่วยกิต</th>
                        <th>ภาควิชา</th>
                        <th>จำนวนกลุ่ม</th>
                        <th>แก้ไข</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courseinfo as $row)
                    <tr>
                        <th style="text-transform: uppercase">{{$row->CourseID}}</th>
                        <td>{{$row->CourseName}}</td>
                        <td>{{$row->Credit}}</td>
                        <td>{{$row->DepartmentName}}</td>
                        <td>{{$classinfo->where('CourseID',$row->CourseID)->count()}}</td>
                        
                        <td>
                            <a href="{{url('/admin/courseManage/edit/'.$row->CourseID)}}" class="btn btn-info" >แก้ไขข้อมูล</a>
                            <a href="{{url('/admin/courseManage/delete/'.$row->CourseID)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">ลบข้อมูล</a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$courseinfo->links()}}
        </div>
    </div>
</div>
<!--Container Main end-->

<!-- เพิ่มคอร์ส -->
<div class="modal fade" id="insertCourseModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">เพิ่มวิชาเรียน</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button> <!-- close button-->
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form action="{{route('courseManage_add')}}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-12 mt-2"><label class="labels">รหัสวิชา</label>
                                @error('CourseID')<span class="text-danger py-0">({{$message}})</span>@enderror
                                <input name="CourseID" style="text-transform: uppercase" type="text" class="form-control" placeholder="" value="">
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12 mt-2"><label class="labels">ภาควิชา</label>

                                @error('DepartmentID')<span class="text-danger py-0">({{$message}})</span>@enderror

                                    <select name="DepartmentID" class="form-select">
                                        <option value="" selected>Select department...</option>
                                        @foreach($departments as $row)
                                            <option value="{{$row->DepartmentID}}">{{$row->DepartmentName}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mt-2"><label class="labels">ชื่อวิชา</label>
                                    @error('CourseName')<span class="text-danger py-0">({{$message}})</span>@enderror
                                    <input name="CourseName" type="text" class="form-control" placeholder="" value="">
                                </div>

                                <div class="col-md-6 mt-2"><label class="labels">หน่วยกิต</label>
                                    @error('Credit')<span class="text-danger py-0">({{$message}})</span>@enderror
                                    <input name="Credit" type="text" class="form-control" value="" placeholder="">
                                </div>
                            </div>                            
                            <div class="modal-footer mt-3">
                                <input type="submit" value="Save Profile" class="btn btn-primary profile-button add_button">
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>


        <!-- ลบคอร์ส -->
        <div class="modal fade" id="deleteCourseModal">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">ยืนยันการลบวิชา</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button> <!-- close button-->
                    </div>
                    <div class="modal-body">
                        คุณต้องการที่จะลบรายวิชานี้หรือไม่
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                        <button class="btn btn-danger">ตกลง</button>
                    </div>
                </div>
            </div>
        </div>