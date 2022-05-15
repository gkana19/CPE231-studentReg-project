@extends('layouts.default')
@section('title','Manage | section')
@section('content')
<link rel="icon" type="image/x-icon" href="/images/kmutt-logo.png">


<div class="height-100 bg-light" style="margin-right: 10px;">
    <div class="container">
    <br>
    <br>
    <h1><i class="fa fa-bars fa-xs"></i> จัดการข้อมูลห้องเรียน</h1>
    <div class="row d-flex">    
        <hr>
        <div class="col-12 mt-2 d-flex justify-content-center">
            <a href="#insertModal"><button class="btn ms-sm-5 mx-2 btn-success" 
            data-bs-toggle="modal" data-bs-target="#insertClassModal">เพิ่มรายละเอียดห้องเรียน</button></a> 
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
        
        <table class="table table-striped shadow-sm text-center mt-3">
            <thead class="table table-dark">
                <tr>
                    <th>รหัสคลาส</th>
                    <th>รหัสวิชา</th>
                    <th>ชื่อวิชา</th>
                    <th>กลุ่ม</th>
                    <th>ภาคการศึกษา</th>
                    <th>อาจารย์ผู้สอน</th>
                    <th>จำนวนนักศึกษา</th>
                    <th>แก้ไข</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classinfo as $row)
                <tr>
                    <th>{{$row->ClassID}}</th>
                    <td>{{$row->CourseID}}</td>
                    <td>{{$row->CourseName}}</td>
                    <td>{{$row->Section}}</td>
                    <td>{{$row->Semester}}</td>
                    <td><a href="#"><button class="btn ms-sm-5 mx-2 btn-info" data-bs-toggle="modal" data-bs-target="#editModal">แก้ไขข้อมูล</button></a> </td>
                    <td><a onclick="return confirm('ยืนยันที่จะลบ คลาส {{$row->ClassID}} รายวิชา {{$row->CourseName}}')" href="{{url('/admin/SectionManage/delete/'.$row->ClassID)}}"><button class="btn ms-sm-5 mx-2 btn-danger" >ลบข้อมูล</button></a></td>

                @endforeach
            </tbody>
        </table>
        {{$classinfo->links()}}
    </div>
</div>
</div>
<!--Container Main end-->

    <!-- เพิ่มรายละเอียดคลาส -->
    <div class="modal fade" id="insertClassModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เพิ่มรายละเอียดคลาส</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button> <!-- close button-->
                </div>
                <form action = "{{route('sectionAdd')}}"  method="POST">
                @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                            <div class="row">

                                <div class="col-md-12 mt-2"><label class="labels">รหัสคลาส</label>
                                @error('ClassID')<span class="text-danger py-2">({{$message}})</span>@enderror
                                <input type="text" name="ClassID" class="form-control" placeholder="" value=""></div>
                                
                                <div class="col-md-12">
                                    <label class="mt-2">รหัสวิชา</label>
                                    @error('CourseID')<span class="text-danger py-2">({{$message}})</span>@enderror
                                        <select class="form-select" aria-label="Default select example" name="CourseID">
                                            <option value="" selected>Select Course</option>
                                            @foreach($CourseInfo as $row)
                                                <option value="{{$row->CourseID}}">{{$row->CourseName}}</option>
                                            @endforeach
                                        </select>                                        
                        </div> 
                                
                                <div class="col-md-6 mt-2"><label class="labels">กลุ่ม</label>
                                @error('Section')<span class="text-danger py-2">({{$message}})</span>@enderror
                                <input type="text" name="Section" class="form-control" value="" placeholder=""></div>
                                
                                <div class="col-md-6 mt-2"><label class="labels">ภาคการศึกษา</label>
                                @error('Semester')<span class="text-danger py-2">({{$message}})</span>@enderror
                                <input type="text" name="Semester" class="form-control" placeholder="" value=""></div>

                            </div>
                    </div>
                </div>
                <div class="modal-footer mt-3">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <input type="submit" value="บันทึกข้อมูล" class="btn btn-primary profile-button add_button">
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- แก้ไขรายละเอียดคลาส -->
    <div class="modal fade" id="editClassModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">แก้ไขรายละเอียดคลาส</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button> <!-- close button-->
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 mt-2"><label class="labels">รหัสคลาส</label><input type="text" class="form-control" placeholder="คลาสไอดีเดิม" value=""></div>
                                <div class="col-md-12 mt-2"><label class="labels">รหัสวิชา</label><input type="text" class="form-control" placeholder="แก้ไม่ได้ เป็น(PK) ของตารางคอร์สดีเทล" value="" disabled></div>
                                <div class="col-md-6 mt-2"><label class="labels">กลุ่ม</label><input type="text" class="form-control" value="" placeholder="กรุ๊ปเดิม"></div>
                                <div class="col-md-6 mt-2"><label class="labels">ภาคการศึกษา</label><input type="text" class="form-control" placeholder="ภาคการศึกษาเดิม" value=""></div>
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

    <!-- ลบคลาส -->
    <div class="modal fade" id="deleteClassModal">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ยืนยันการลบรายละเอียดวิชา</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button> <!-- close button-->
                </div>
                <div class="modal-body">
                    คุณต้องการที่จะลบรายละเอียดวิชานี้หรือไม่
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button class="btn btn-danger">ตกลง</button>
                </div>
            </div>
        </div>
    </div>