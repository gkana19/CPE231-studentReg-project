@extends('layouts.default')
@section('title','Student | information')
@section('content')
<br>
<br>
<div class="container rounded bg-white mt-2 mb-5 shadow-lg">
    <div class="pt-3">
        <h2>แบบฟอร์มแก้ไขข้อมูล</h2>
    </div>
    <hr>

    <form action="{{url('/admin/studentManage/update/'.$students->StudentID)}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6"><label class="labels">Student ID</label>
                @error('studentid')<span class="text-danger py-2">({{$message}})</span>@enderror
                <input type="text" class="form-control" placeholder="Student ID" value="{{$students->StudentID}}" name="studentid">
               
            </div>
            <div class="col-md-6"><label class="labels">Name</label>
                @error('StudentName')<span class="text-danger py-2">({{$message}})</span>@enderror
                <input type="text" name="StudentName" class="form-control" value="{{$students->StudentName}}" placeholder="Name">
               
            </div>
        </div>
        <div class="row">


            <div class="col-md-5"><label class="labels mt-2">DOB</label>
                @error('DOB')<span class="text-danger py-2">({{$message}})</span>@enderror
                <input type="date" name="DOB" class="form-control" placeholder="enter dob" value="{{$students->DOB}}">
            </div>

            <div class="col-md-7"><label class="labels mt-2">Address</label>
                @error('Address')<span class="text-danger py-2">({{$message}})</span>@enderror
                <input type="text" name="Address" class="form-control" value="{{$students->Address}}" placeholder="Address">
           
            </div>



            <div class="col-md-4"><label class="labels mt-2">Department</label>
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

            <div class="col-md-8"><label class="labels mt-2">Email</label>
                @error('Email')<span class="text-danger py-2">({{$message}})</span>@enderror
                <input type="email" name="Email" class="form-control" value="{{$students->Email}}" placeholder="Enter email">
            </div>

            <div class="col-md-4"><label class="labels mt-0">Phone</label>
                @error('Phone')<font size="2" class="text-danger py-0">({{$message}})</font>@enderror
                <input type="text" name="Phone" class="form-control" placeholder="Enter phone number" value="{{$students->Phone}}">
            </div>


            <div class="col-md-4"><label class="labels mt-0">Status</label>
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

            <div class="col-md-4"><label class="labels mt-0">
                    Sex </label>
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
            <div class="col-md-12">
                <label class="mt-2">Advisor</label>
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