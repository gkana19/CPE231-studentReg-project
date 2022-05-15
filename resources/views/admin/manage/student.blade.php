@extends('layouts.default')
@section('title','Manage | student')
@section('content')


<div class="height-100 bg-light" style="margin-right: 10px;">
    <div class="container">
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

        <br>
        <br>
        <div class="d-flex bd-highlight">
            <div class=""><h1><i class="fa fa-address-card fa-xs"></i> จัดการข้อมูลนักศึกษา</h1></div>
            <div class="ms-auto p-2 bd-highlight"><font size = "5">จำนวนนักศึกษา <span>{{count($studentscount)}}</span> คน</font></div>
        </div>
        <hr>
        <div class="row d-flex">
            <div class="col-12 mt-2 d-flex justify-content-center">
                <a href="#insertModal"><button class="btn ms-sm-5 mx-2 btn-success" data-bs-toggle="modal" data-bs-target="#insertModal">เพิ่มข้อมูลนักศึกษา</button></a>
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

            <table class="table table-striped shadow-sm text-center mt-2" style="border-radius: 10px">
                <thead class="table table-dark">
                    <tr>
                        <th>รหัสนักศึกษา</th>
                        <th>ชื่อ-สกุล</th>
                        <th>ภาควิชา</th>
                        <th>อาจารย์ที่ปรึกษา</th>
                        <th>สถานะ</th>
                        <th>แก้ไข</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($studentsinfo as $row)
                    
                    <tr>
                        <th>{{$row->StudentID}}</th>
                        <td>{{$row->StudentName}}</td>
                        <td>{{$row->DepartmentName}}</td>
                        <td>{{$row->TeacherID}}</td>
                        <td>
                            @if ($row->Status == "Normal")
                            <font color="green">Normal</font>
                            @elseif ($row->Status == "Drop")
                            <font color="red">Drop</font>
                            @elseif ($row->Status == "Retire")
                            <font color="red">Retire</font>
                            @elseif ($row->Status == "Graduated")
                            <font color="Blue">Graduated</font>
                            @elseif ($row->Status == "1")
                            <font color="green">Normal</font>
                            @elseif ($row->Status == "2")
                            <font color="red">Drop</font>
                            @elseif ($row->Status == "3")
                            <font color="red">Retire</font>
                            @elseif ($row->Status == "4")
                            <font color="Blue">Graduated</font>
                            @endif
                        </td>
                        
                        <!-- <td><a href="#"><button class="btn ms-sm-5 mx-2 btn-info" data-bs-toggle="modal" data-bs-target="#editModal">แก้ไขข้อมูล</button></a> </td> -->
                        <td>
                            <a href="{{url('/admin/studentManage/edit/'.$row->StudentID)}}#" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editModal">แก้ไขข้อมูล</a>
                            <a href="{{url('/admin/studentManage/delete/'.$row->StudentID)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">ลบข้อมูล</a>
                        </td>
                        <!-- <td><button type="button" value="1" class="btn btn-primary editbtn btn-sm">Edit</button></td> -->
                        <!-- <td><a href="#"><button class="btn ms-sm-5 mx-2 btn-danger delete_student studentid" value="{{$row->StudentID}}" data-bs-toggle="modal" data-bs-target="#deleteModal">ลบข้อมูล</button></a> </td> -->


                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$studentsinfo->links()}}
        </div>
    </div>
</div>
<!--Container Main end-->

<!-- edit Modal -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">แก้ไขข้อมูลนักศึกษา</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button> <!-- close button-->
            </div>
            <div class="modal-body">
                <div class="mt-2 col-md-12">
                    <div class="row">
                        <div class="mt-2 col-md-12"><label class="labels">รหัสนักศึกษา</label><input type="text" class="form-control" placeholder="id before" value=""></div>
                        <div class="mt-2 col-md-6"><label class="labels">ชื่อ-สกุล</label><input type="text" class="form-control" placeholder="first name before" value=""></div>
                        <div class="mt-2 col-md-6"><label class="labels">วัน/เดือน/ปีเกิด</label><input type="date" class="form-control" placeholder="dob before" value=""></div>
                    </div>
                    <div class="row">
                        <div class="mt-2 col-md-12"><label class="labels">Email</label><input type="email" class="form-control" placeholder="email before" value=""></div>
                        <div class="mt-2 col-md-12"><label class="labels">ภาควิชา</label><input type="text" class="form-control" placeholder="department before" value=""></div>
                        <div class="mt-2 col-md-12"><label class="labels">ที่อยู่</label><input type="text" class="form-control" placeholder="ddress before" value=""></div>
                        <div class="mt-2 col-md-12"><label class="labels">เบอร์</label><input type="text" class="form-control" placeholder="phone number before" value=""></div>
                        <div class="mt-2 col-md-12"><label class="labels">สถานะ</label><input type="text" class="form-control" placeholder="status before" value=""></div>
                        <div class="mt-2 col-md-12"><label class="labels">เพศ</label><input type="text" class="form-control" placeholder="Sex before" value=""></div>
                        <div class="mt-2 col-md-12"><label class="labels">อาจารย์ที่ปรึกษา</label><input type="text" class="form-control" placeholder="Advisor name before" value=""></div>
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
                <h5 class="modal-title">เพิ่มข้อมูลนักศึกษา</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button> <!-- close button-->
            </div>
            <div class="modal-body">
                <div class="mt-2 col-md-12">
                    <form action="{{route('studentManage_add')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mt-2 col-md-6"><label class="labels">รหัสนักศึกษา</label>
                                @error('studentid')<span class="text-danger py-2">({{$message}})</span>@enderror
                                <input type="text" class="form-control" placeholder="Student ID" value="{{old('studentid')}}" name="studentid">
                            </div>
                            <div class="mt-2 col-md-6"><label class="labels">ชื่อ-สกุล</label>
                                @error('StudentName')<span class="text-danger py-2">({{$message}})</span>@enderror
                                <input type="text" name="StudentName" class="form-control" value="{{old('StudentName')}}" placeholder="Name">
                            </div>
                        </div>
                        <div class="row">


                            <div class="mt-2 col-md-5"><label class="labels mt-2">วัน/เดือน/ปีเกิด</label>
                                @error('DOB')<span class="text-danger py-2">({{$message}})</span>@enderror
                                <input type="date" name="DOB" class="form-control" placeholder="enter dob" value="{{old('DOB')}}">
                            </div>

                            <div class="mt-2 col-md-7"><label class="labels mt-2">ที่อยู่</label>
                                @error('Address')<span class="text-danger py-2">({{$message}})</span>@enderror
                                <input type="text" name="Address" class="form-control" value="{{old('Address')}}" placeholder="Address">
                            </div>



                            <div class="mt-2 col-md-4"><label class="labels mt-2">ภาควิชา</label>
                                @error('DepartmentID')<font size="2" class="text-danger py-0">({{$message}})</font>@enderror
                                <div class="mb-3">
                                    <label class="" for="DepartmentID"></label>
                                    <select class="form-select" id="DepartmentID" name="DepartmentID">
                                        <option selected value="">Select department...</option>
                                        @foreach($departments as $row)
                                            <option value="{{$row->DepartmentID}}">{{$row->DepartmentName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mt-2 col-md-8"><label class="labels mt-2">Email</label>
                                @error('Email')<span class="text-danger py-2">({{$message}})</span>@enderror
                                <input type="email" name="Email" class="form-control" value="{{old('Email')}}" placeholder="Enter email">
                            </div>

                            <div class="mt-2 col-md-4"><label class="labels mt-0">เบอร์</label>
                                @error('Phone')<font size="2" class="text-danger py-0">({{$message}})</font>@enderror
                                <input type="text" name="Phone" class="form-control" placeholder="Enter phone number" value="{{old('Phone')}}">
                            </div>


                            <div class="mt-2 col-md-4"><label class="labels mt-0">สถานะ</label>
                                @error('Status')<font size="2" class="text-danger py-0">({{$message}})</font>@enderror
                                <div class="mb-2">
                                    <label class="" for="Status"></label>
                                    <select class="form-select" id="Status" name="Status">
                                        <option selected value="">Choose...</option>
                                        <option value="1">Normal</option>
                                        <option value="2">Drop</option>
                                        <option value="3">Retire</option>
                                        <option value="4">Graduated</option>
                                    </select>
                                </div>

                            </div>

                            <div class="mt-2 col-md-4"><label class="labels mt-0">เพศ</label>
                                @error('Sex')<span class="text-danger py-0">({{$message}})</span>@enderror
                                <div>
                                    <label class="" for="Sex"></label>
                                    <select class="form-select" id="Sex" name="Sex">
                                        <option selected value="">Choose...</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                        <option value="U">Undefined</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-2 col-md-12">
                                    <label class="mt-2">อาจารย์ที่ปรึกษา</label>
                                    <select class="form-select" aria-label="Default select example" name="TeacherID">
                                        <option value="" selected>Select Advisor</option>
                                        @foreach($teacherselect as $row)
                                            <option value="{{$row->TeacherID}}">{{$row->TeacherName}} : {{$row->DepartmentName}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="modal-footer mt-3">
                            <input type="submit" value="Save Profile" class="btn btn-primary profile-button add_button">
                        </div>
                    </form>
                </div>
            </div>


            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal">
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
                <td><a href="{{url('/admin/studentManage/delete/'.$row->StudentID)}}" class="btn btn-danger">ตกลง</a></td>
                </button>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


@section('script')
<script>
    $(document).ready(function() {
        $(document).on('click', '.add_student', function(e) {
            e.preventDefault();
            // console.log("hello");
            var data = {
                'studentid': $('.studentid').val(),
                'StudentName': $('.StudentName').val(),
                'DOB': $('.DOB').val(),
                'Address': $('.Address').val(),
                'DepartmentID': $('.DepartmentID').val(),
                'Email': $('.Email').val(),
                'Status': $('.Status').val(),
                'Sex': $('.Sex').val(),
            };
            console.log(data);
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/admin/studentManage/add",
                data: $('#addform').serialize(),
                success: function(response) {
                    console.log(response)
                    
                    $('#insertModal').modal('hide')
                    alert("Data save");
                    // location.reload();
                },
                error: function(error){
                    console.log(error);
                    alert("Data not save");
                }

            });

        });

        $(document).on('click', '.delete_student' ,function(e) {

            e.preventDefault();
            // console.log("hello");
            var data = {
                'studentid': $('.studentid').val(),
                
            };
            console.log(data);
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/admin/studentManage/",
                data: $('#addform').serialize(),
                success: function(response) {
                    console.log(response)
                    
                    $('#insertModal').modal('hide')
                    alert("Data save");
                    // location.reload();
                },
                error: function(error){
                    console.log(error);
                    alert("Data not save");
                }

            });
            
        })

    });
</script>
@endsection