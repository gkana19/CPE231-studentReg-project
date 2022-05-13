@extends('layouts.default')
@section('title','Student | Registration')
@section('content')


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="/css/styleforTest.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
<script src="https://kit.fontawesome.com/b9d264c4ba.js" crossorigin="anonymous"></script>
<script src="/js/sidebarAppFortest.js"></script>
</head>

<body id="body-pd" class="bg-light">

    <header class="header shadow-sm" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" alt=""> </div>
    </header>
    <div class="l-navbar bg-dark" id="nav-bar">
        <nav class="nav">
            <div> <a href="{{route('home')}}" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">จัดการทะเบียนเรียน</span> </a>
                <div class="nav_list">
                    <a href="{{route('first')}}" class="nav_link"> <i class="fa-solid fa-house"></i> <span class="nav_name">หน้าแรก</span> </a>
                    <a href="{{route('myinfo')}}" class="nav_link "> <i class="fa-solid fa-address-card"></i> <span class="nav_name">ข้อมูลประวัตินักศึกษา</span> </a>
                    <a href="{{route('regis')}}" class="nav_link active"> <i class="fa-solid fa-book-open"></i> <span class="nav_name">ลงทะเบียนเรียน</span> </a>
                    <a href="{{route('schedule')}}" class="nav_link"> <i class="fa-solid fa-calendar ps-1"></i> <span class="nav_name">ตารางเรียน</span> </a>
                    <a href="{{route('grading')}}" class="nav_link"> <i class="fa-solid fa-graduation-cap"></i> <span class="nav_name">ผลการเรียน</span> </a>
                    <a href="{{route('about')}}" class="nav_link" target="_blanK"> <i class="fa fa-users"></i> <span class="nav_name">About us</span> </a>
                    <a href="{{route('login')}}" class="nav_link pt-4"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
                </div>
            </div>
        </nav>
    </div>

    <!--Container Main start-->


    <div class="height-100 bg-light">
        <div class="container">
            <div class="row mt-5 p-2">
                <div class="col-sm-12 mt-3 pt-3">
                    <h4> ลงทะเบียนเรียน </h4></button>
                </div>
            </div>
            <hr>
            <div class="row d-grid justify-content-center">
                <div class="container mt-3">

                    <div class="col-sm-12 justify-content-around shadow p-4 mb-4 bg-body rounded">
                        <div class="row ms-2">
                            <div class="col-md-6 p-2">
                                <b>รหัสนักศึกษา:</b> {{Auth::user()->students->StudentID}}
                            </div>
                            <div class="col-md-6 p-2">
                                <b>ชื่อ-นามสกุล:</b> {{Auth::user()->students->StudentName}}
                            </div>
                            <div class="col-md-6 p-2">
                                <b>E-mail:</b> {{Auth::user()->students->Email}}
                            </div>
                            <div class="col-md-6 p-2">
                                <b>สถานะ:</b>
                                @if (Auth::user()->students->Status == "Normal")
                                <font color="green">Normal</font>
                                @elseif (Auth::user()->students->Status == "Normal")
                                <font color="green">Normal</font>
                                @endif
                            </div>
                        </div>


                    </div>
                </div>

                <!-- table -->
                <!-- Striped  -->
                <table class="table table-striped shadow-lg text-center">
                    <thead class="table table-dark">
                        <th>ลำดับ</th>
                        <th>รหัสวิชา</th>
                        <th>ชื่อวิชา</th>
                        <th>หน่วยกิต</th>
                        <th>กลุ่ม</th>
                        <th>แก้ไข</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php($i=1)
                        @foreach($registrations as $row)
                        <tr>
                        <tr>
                            <th>{{$i++}}</th>
                            <td>{{$row->classdetails->courseDetails->CourseID}}</td>
                            <td>{{$row->classdetails->courseDetails->CourseName}}</td>
                            <td>{{$row->classdetails->courseDetails->Credit}}</td>
                            <td>{{$row->classdetails->Section}}</td>

                            <form action="{{route('student.destroy', $row->ClassID)}}" method="post">
                                @csrf
                                @method('PUT')

                                <td><a href="{{url('/service/delete/'.$row->ClassID)}}" class="btn btn-warning">ลบ</a></td>
                            </form>
                        </tr>

                        @endforeach
                    </tbody>
                </table>

                <!-- button -->
                <div class="row text-center">
                    <div class="col-sm-2">
                        <a href="#insertModal"><button id="insertButton" class="btn btn-success mt-2 p-2 px-3" data-bs-toggle="modal" data-bs-target="#insertModal">เลือกวิชา</button></a>
                    </div>
                    <div class="col-sm-8">
                    </div>
                    <form action="{{route('updatedRegistration',$row->ClassID)}}" method="POST">
                        @csrf
                        
                        <div class="col-sm-2">
                            <a href="{{url('/service/update/')}}"><button id="editButton" class="btn  btn-secondary mt-2 p-2 px-3">ยืนยัน</button></a>
                        </div>
                    </form>
                </div>


            </div>
        </div>
        <!--Container Main end-->


        <!-- Insert Modal -->
        <div class="modal fade" id="insertModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">เลือกวิชา</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button> <!-- close button-->
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped shadow-sm text-center mt-3">
                            <thead class="table table-dark">
                                <tr>
                                    <th>เลือก</th>
                                    <th>ลำดับ</th>
                                    <th>รหัสวิชา</th>
                                    <th>ชื่อวิชา</th>
                                    <th>หน่วยกิต</th>
                                    <th>กลุ่ม</th>
                                    <th>ห้องเรียน</th>
                                    <th>เวลาเรียน</th>
                                    <th>อาจารย์</th>
                                </tr>
                            </thead>
                            <tbody>

                                <form action="{{route('addRegistration')}}" method="POST">
                                    @csrf
                                    @php($i=1)
                                    @foreach($coursedetails as $row)
                                    @foreach($row->classdetail as $dataclass)
                                    @foreach($dataclass->schedules as $dataschedules)
                                    @php($ClassID=1)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="ClassID" value="{{$dataschedules->ClassID}}">
                                                <label class="form-check-label" for="ClassID">
                                                </label>
                                            </div>
                                        </td>
                                        <th>{{$i++}}</th>
                                        <td>{{$row->CourseID}}</td>
                                        <td>{{$row->CourseName}}</td>
                                        <td>{{$row->Credit}}</td>
                                        <td>{{$dataclass->Section}}</td>
                                        <td>{{$dataschedules->Room}}</td>
                                        <td>{{$dataschedules->Weekday}}.{{$dataschedules->Time}}</td>
                                        <td>{{$dataschedules->teachers->TeacherName}}</td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    <button type="submit" class="btn btn-outline-dark btn-sm">เลือก</button>
                                </form>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Select Modal -->
        <form action="" method="">
            <div class="modal fade" id="selectModal" } tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">เลือกกลุ่มเรียน</h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button> <!-- close button-->
                        </div>
                        <div class="modal-body">
                            <div class="container bg-light p-1 shadow-sm">
                                <div class="row ms-2">
                                    <div class="col-md-6 p-2">
                                        <b>รหัสวิชา:</b> {{$row->CourseID}}
                                    </div>
                                    <div class="col-md-6 p-2">
                                        <b>หน่วยกิต: 3</b>
                                    </div>
                                    <div class="col-md-8 p-2">
                                        <b>ชื่อวิชา:</b> GEN คนดี ร่วมสร้างความดี
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped shadow-sm text-center mt-3">
                                <thead class="table table-dark">
                                    <tr>
                                        <th>เลือก</th>
                                        <th>กลุ่ม</th>
                                        <th>จำนวนคงเหลือ</th>
                                        <th>ห้องเรียน</th>
                                        <th>เวลาเรียน</th>
                                        <th>อาจารย์</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach($classdetails as $row)
                                    <tr>
                                        <td><button type="button" class="btn btn-outline-dark btn-sm">เลือก</button></td>
                                    </tr>
                                    @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal">
            <div class="modal-dialog modal-sm modal-dialog-centered">
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