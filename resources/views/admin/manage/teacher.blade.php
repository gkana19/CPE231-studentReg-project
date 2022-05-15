@extends('layouts.default')
@section('title','Manage | teacher')
@section('content')

<div class="height-100 bg-light" style="margin-right: 10px;">
    <div class="container">
        <br>
        <br>
        <div class="d-flex bd-highlight">
            <div class=""><h1><i class="fa fa-address-book fa-xs"></i> จัดการข้อมูลอาจารย์</h1></div>
            <div class="ms-auto p-2 bd-highlight"><font size = "5">จำนวนอาจารย์ <span>{{count($teacherscount)}}</span> คน</font></div>
        </div>

        <hr>

        <div class="row d-flex">
            <div class="col-12 mt-2 d-flex justify-content-center">
                <a href="#insertModal"><button class="btn ms-sm-5 mx-2 btn-success" 
                data-bs-toggle="modal" data-bs-target="#insertModal">เพิ่มข้อมูลอาจารย์</button></a> 
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

            @if ($errors->any())
                <div class="d-inline-flex mt-3">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                        {{'กรุณากรอกข้อมูลให้ถูกต้อง'}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            <table class="table table-striped shadow-sm text-center mt-2">
            <thead class="table table-dark">
                <tr>
                    <th>รหัสอาจารย์</th>
                    <th>ชื่อ-สกุล</th>
                    <th>Email</th>
                    <th>คณะ</th>
                    <th>สาขา</th>
                    <th>แก้ไข </th>
                </tr>
            </thead>
            <tbody>
                @foreach($teachersinfo as $row)
                <tr>

                    <th>{{$row->TeacherID}}</th>
                    <td>{{$row->TeacherName}}</td>
                    <td>{{$row->Email}}</td>
                    <td>{{$row->FacultyName}}</td>
                    <td>{{$row->DepartmentName}}</td>

                    <td>
                        <a href="#"><button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editModal">แก้ไขข้อมูล</button></a>
                        <a onclick="return confirm('ยืนยันที่จะลบ อ.{{$row->TeacherName}}')" href="{{url('/admin/teacherManage/delete/'.$row->TeacherID)}}"><button class="btn btn-danger" >ลบข้อมูล</button></a> 
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        {{$teachersinfo->links()}}
    </div>
</div>
</div>
<!--Container Main end-->

<!-- edit Modal -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">แก้ไขข้อมูลอาจารย์</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button> <!-- close button-->
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12"><label class="labels">รหัสอาจารย์</label><input type="text" class="form-control" placeholder="id before" value=""></div>
                            <div class="col-md-6"><label class="labels">ชื่อ-สกุล</label><input type="text" class="form-control" placeholder="first name before" value=""></div>
                            <div class="col-md-6"><label class="labels">วัน/เดือน/ปีเกิด</label><input type="text" class="form-control" placeholder="dob before" value=""></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"><label class="labels">Email</label><input type="email" class="form-control" placeholder="email before" value=""></div>
                            <div class="col-md-12"><label class="labels">ภาควิชา</label><input type="text" class="form-control" placeholder="department before" value=""></div>
                            <div class="col-md-12"><label class="labels">ที่อยู่</label><input type="text" class="form-control" placeholder="ddress before" value=""></div>
                            <div class="col-md-12"><label class="labels">เบอร์</label><input type="text" class="form-control" placeholder="phone number before" value=""></div>
                            <div class="col-md-12"><label class="labels">เพศ</label><input type="text" class="form-control" placeholder="Sex before" value=""></div>
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

    <!-- insert Modal -->
    <div class="modal fade" id="insertModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เพิ่มข้อมูลอาจารย์</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button> <!-- close button-->
                </div>

                <form action = "{{route('teacherAdd')}}"  method="POST">
                @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12"><label class="labels">รหัสอาจารย์</label>
                                @error('TeacherID')<span class="text-danger py-2">({{$message}})</span>@enderror
                                <input type="text" name="TeacherID"class="form-control" placeholder="" value="{{old('TeacherID')}}"></div>
                                
                                <div class="col-md-12"><label class="labels">ชื่อ-สกุล</label>
                                @error('TeacherName')<span class="text-danger py-2">({{$message}})</span>@enderror
                                <input type="text" name="TeacherName" class="form-control" placeholder="" value="{{old('TeacherName')}}"></div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12"><label class="labels mt-3">ภาควิชา (required)</label>
                                @error('DepartmentID')<span class="text-danger py-2">({{$message}})</span>@enderror
                                    <select name="DepartmentID" class="form-select">
                                        <option value="">Select department...</option>
                                        @foreach($departments as $row)
                                            <option value="{{$row->DepartmentID}}">{{$row->DepartmentName}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12 mt-2"><label class="labels">Email</label>
                                @error('Email')<span class="text-danger py-2">({{$message}})</span>@enderror
                                <input type="text" name="Email" class="form-control" placeholder="" value="{{old('Email')}}"></div>

                                <div class="col-md-12 mt-2"><label class="labels">เบอร์</label>
                                @error('Email')<span class="text-danger py-2">({{$message}})</span>@enderror
                                <input type="text" name="Phone" class="form-control" placeholder="" value="{{old('Phone')}}"></div>    

                                <div class="col-md-12 mt-2"><label class="labels">ที่อยู่</Address></label>
                                @error('Address')<span class="text-danger py-2">({{$message}})</span>@enderror
                                <input type="text" name="Address" class="form-control" placeholder="" value="{{old('Address')}}"></div>
                                
                            </div>
                    </div>
                </div>
                <div class="modal-footer mt-3">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button class="btn btn-success">บันทึกข้อมูล</button>
                </div></form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ยืนยันการลบอาจารย์</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button> <!-- close button-->
                </div>
                <div class="modal-body">
                    คุณต้องการที่จะลบอาจารย์ท่านนี้หรือไม่
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <td><a href="" class="btn ms-sm-5 mx-2 btn-danger">ยืนยัน</a></td>
                </div>
            </div>
        </div>
    </div>