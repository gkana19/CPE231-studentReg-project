@extends('layouts.default')
@section('title','Manage | course')
@section('content')


<div class="height-100 bg-light" style="margin-right: 10px;">
    <div class="container">
        <br>
        <br>
        <div class="d-flex bd-highlight">
            <div class=""><h1><i class="fa fa-book fa-xs"></i> จัดการข้อมูลรายวิชา</h1></div>
            <div class="ms-auto p-2 bd-highlight"><font size = "5" >จำนวนวิชา <span>{{count($courseinfo)}}</span> วิชา</font></div>
        </div>
    <div class="row d-flex">
        <hr>
        <div class="col-12 mt-2 d-flex justify-content-center">
            <a href="#insertModal"><button class="btn ms-sm-5 mx-2 btn-success" 
            data-bs-toggle="modal" data-bs-target="#insertCourseModal">เพิ่มวิชาเรียน</button></a> 
        </div>

        {{-- alert message --}}
        @if(Session::has('success'))
        <div class="d-inline-flex">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                {{Session::get('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>                  
        </div>
        @elseif(Session::has('delete'))      
            <div class="d-inline-flex">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    {{Session::get('delete')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <table class="table table-striped shadow-sm text-center mt-3">
            <thead class="table table-dark">
                <tr>
                    <th>รหัสวิชา</th>
                    <th>ชื่อวิชา</th>
                    <th>หน่วยกิต</th>
                    <th>ภาควิชา</th>
                    <th>จำนวนกลุ่ม</th>
                    <th>แก้ไขข้อมูล</th>
                    <th>ลบข้อมูล</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courseinfo as $row)
                <tr>
                    <th>{{$row->CourseID}}</th>
                    <td>{{$row->CourseName}}</td>
                    <td>{{$row->Credit}}</td>
                    <td>{{$row->DepartmentName}}</td>
                    <td>{{$classinfo->where('CourseID',$row->CourseID)->count()}}</td>
                    <td><a href="#"><button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editModal">แก้ไขข้อมูล</button></a> </td>
                    <td><a href="#"><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">ลบข้อมูล</button></a> </td>
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
                            <div class="row">
                                <div class="col-md-12 mt-2"><label class="labels">รหัสวิชา</label><input type="text" class="form-control" placeholder="" value=""></div>
                                <div class="col-md-6 mt-2"><label class="labels">ชื่อวิชา</label><input type="text" class="form-control" placeholder="" value=""></div>
                                <div class="col-md-6 mt-2"><label class="labels">หน่วยกิต</label><input type="text" class="form-control" value="" placeholder=""></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-2"><label class="labels">ภาควิชา</label>
                                    <select name="DepartmentID" class="form-select">
                                        <option selected>Choose department...</option>
                                        <option value="101">Computer Engineering</option>
                                        <option value="102">ME</option>
                                        <option value="111">Maths</option>
                                    </select>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer mt-3">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button class="btn btn-success">บันทึกข้อมูล</button>
                </div>
            </div>
        </div>
    </div>

    <!-- แก้ไขคอร์ส -->
    <div class="modal fade" id="editCourseModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">แก้ไขวิชา</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button> <!-- close button-->
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 mt-2"><label class="labels">รหัสวิชา</label><input type="text" class="form-control" placeholder="คอร์สไอดีเดิม" value=""></div>
                                <div class="col-md-6 mt-2"><label class="labels">ชื่อวิชา</label><input type="text" class="form-control" placeholder="ชื่อวิชาเดิม" value=""></div>
                                <div class="col-md-6 mt-2"><label class="labels">หน่วยกิต</label><input type="text" class="form-control" value="" placeholder="หน่วยกิตเดิม"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-2"><label class="labels">ภาควิชา</label><input type="text" class="form-control" placeholder="สาขาเดิม" value=""></div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer mt-3">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button class="btn btn-success">บันทึกข้อมูล</button>
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