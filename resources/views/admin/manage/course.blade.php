@extends('layouts.default')
@section('title','Admin | Manage')
@section('content')


<div class="height-100 bg-light" style="margin-right: 10px;">
    <div class="container">
        <br>
        <br>
        <h1>จัดการข้อมูลรายวิชา</h1>
           <div class="row d-flex">
            <div class="col-12 mt-2 d-flex justify-content-center">
               <a href="#insertModal"><button class="btn ms-sm-5 mx-2 btn-success" 
                data-bs-toggle="modal" data-bs-target="#insertCourseModal">เพิ่มวิชาเรียน</button></a> 
           </div>
           <table class="table table-striped shadow-sm text-center mt-3">
            <thead class="table table-dark">
                <tr>
                    <th>คอร์สไอดี</th>
                    <th>ชื่อคอร์ส</th>
                    <th>หน่วยกิต</th>
                    <th>สาขา</th>
                    <th> </th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>CPE101</td>
                    <td>คอมโปร</td>
                    <td>3</td>
                    <td>วิศวกรรมคอมพิวเตอร์</td>
                    <td><a href="#"><button class="btn ms-sm-5 mx-2 btn-info" data-bs-toggle="modal" data-bs-target="#editCourseModal">แก้ไขข้อมูล</button></a> </td>
                    <td><a href="#"><button class="btn ms-sm-5 mx-2 btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCourseModal">ลบข้อมูล</button></a> </td>
                </tr>
                <tr>
                    <td>CPE102</td>
                    <td>คอมโปรสอง</td>
                    <td>3</td>
                    <td>วิศวกรรมคอมพิวเตอร์</td>
                    <td><a href="#"><button class="btn ms-sm-5 mx-2 btn-info" data-bs-toggle="modal" data-bs-target="#editCourseModal">แก้ไขข้อมูล</button></a> </td>
                    <td><a href="#"><button class="btn ms-sm-5 mx-2 btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCourseModal">ลบข้อมูล</button></a> </td>
                </tr>
            </tbody>
        </table>
        <hr>
        <div class="row text-center">
        <a href="#insertModal"><button class="btn ms-sm-5 mx-2 btn-success mt-5" 
            data-bs-toggle="modal" data-bs-target="#insertClassModal">เพิ่มรายละเอียดภายในวิชา</button></a> 
        </div>
        <table class="table table-striped shadow-sm text-center mt-3">
            <thead class="table table-dark">
                <tr>
                    <th>เลขคลาส</th>
                    <th>คอร์สไอดี</th>
                    <th>กรุ๊ป</th>
                    <th>ภาคการศึกษา</th>
                    <th> </th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>007CPE101</td>
                    <td>CPE101</td>
                    <td>Thai section</td>
                    <td>1/65</td>
                    <td><a href="#"><button class="btn ms-sm-5 mx-2 btn-info" data-bs-toggle="modal" data-bs-target="#editClassModal">แก้ไขข้อมูล</button></a> </td>
                    <td><a href="#"><button class="btn ms-sm-5 mx-2 btn-danger" data-bs-toggle="modal" data-bs-target="#deleteClassModal">ลบข้อมูล</button></a> </td>
                </tr>
                <tr>
                    <td>007CPE102</td>
                    <td>CPE102</td>
                    <td>National section</td>
                    <td>1/65</td>
                    <td><a href="#"><button class="btn ms-sm-5 mx-2 btn-info" data-bs-toggle="modal" data-bs-target="#editClassModal">แก้ไขข้อมูล</button></a> </td>
                    <td><a href="#"><button class="btn ms-sm-5 mx-2 btn-danger" data-bs-toggle="modal" data-bs-target="#deleteClassModal">ลบข้อมูล</button></a> </td>
                </tr>
            </tbody>
        </table>
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
                                <div class="col-md-12 mt-2"><label class="labels">คอร์สไอดี</label><input type="text" class="form-control" placeholder="" value=""></div>
                                <div class="col-md-6 mt-2"><label class="labels">ชื่อคอร์ส</label><input type="text" class="form-control" placeholder="" value=""></div>
                                <div class="col-md-6 mt-2"><label class="labels">หน่วยกิต</label><input type="text" class="form-control" value="" placeholder=""></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-2"><label class="labels">Department ID</label><input type="text" class="form-control" placeholder="" value=""></div>
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
                                <div class="col-md-12 mt-2"><label class="labels">คอร์สไอดี</label><input type="text" class="form-control" placeholder="คอร์สไอดีเดิม" value=""></div>
                                <div class="col-md-6 mt-2"><label class="labels">ชื่อคอร์ส</label><input type="text" class="form-control" placeholder="ชื่อคอร์สเดิม" value=""></div>
                                <div class="col-md-6 mt-2"><label class="labels">หน่วยกิต</label><input type="text" class="form-control" value="" placeholder="หน่วยกิตเดิม"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-2"><label class="labels">Department ID</label><input type="text" class="form-control" placeholder="สาขาเดิม" value=""></div>
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

    <!-- เพิ่มรายละเอียดคลาส -->
    <div class="modal fade" id="insertClassModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เพิ่มรายละเอียดคลาส</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button> <!-- close button-->
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 mt-2"><label class="labels">คลาสไอดี</label><input type="text" class="form-control" placeholder="" value=""></div>
                                <div class="col-md-12 mt-2"><label class="labels">คอร์สไอดี</label><input type="text" class="form-control" placeholder="อิงจากตารางคอร์สดีเทล (FK)" value=""></div>
                                <div class="col-md-6 mt-2"><label class="labels">กรุ๊ป</label><input type="text" class="form-control" value="" placeholder=""></div>
                                <div class="col-md-6 mt-2"><label class="labels">ภาคการศึกษา</label><input type="text" class="form-control" placeholder="" value=""></div>
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
                                <div class="col-md-12 mt-2"><label class="labels">คลาสไอดี</label><input type="text" class="form-control" placeholder="คลาสไอดีเดิม" value=""></div>
                                <div class="col-md-12 mt-2"><label class="labels">คอร์สไอดี</label><input type="text" class="form-control" placeholder="แก้ไม่ได้ เป็น(PK) ของตารางคอร์สดีเทล" value="" disabled></div>
                                <div class="col-md-6 mt-2"><label class="labels">กรุ๊ป</label><input type="text" class="form-control" value="" placeholder="กรุ๊ปเดิม"></div>
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