@extends('layouts.default')
@section('title','Manage | course')
@section('content')

<br>
<br>

<div class="container mr-3">
    <button class="btn btn-secondary" onclick="history.back()">กลับ</button>
</div>
<div class="container rounded bg-white mt-2 mb-5 shadow-lg">
    <div class="pt-3">
        <h2>แบบฟอร์มแก้ไขข้อมูล</h2>
    </div>
<hr>
    
        <form action="{{url('/admin/courseManage/update/'.$coursedetails->CourseID)}}" method="POST">
            @csrf
        

            <div class="row d-flex">
                <div class="col-md-12 mt-2"><label class="labels">รหัสวิชา</label>
                    @error('CourseID')<span class="text-danger py-0">({{$message}})</span>@enderror
                    <input name="CourseID" type="text" class="form-control" placeholder="" value="{{$coursedetails->CourseID}}">
                </div>            
            
                <div class="col-md-12 mt-2"><label class="labels">ภาควิชา</label>
                    
                    @error('DepartmentID')<span class="text-danger py-0">({{$message}})</span>@enderror
                    
                    <select name="DepartmentID" class="form-select">
                        <option selected value="{{$coursedetails->DepartmentID}}">{{$coursedetails->DepartmentID}}</option>
                        @foreach($departments as $row)
                        <option value="{{$row->DepartmentID}}">{{$row->DepartmentName}}</option>
                        @endforeach
                    </select>
                </div>
                
            
                <div class="col-md-6 mt-2"><label class="labels">ชื่อวิชา</label>
                    @error('CourseName')<span class="text-danger py-0">({{$message}})</span>@enderror
                    <input name="CourseName" type="text" class="form-control" placeholder="" value="{{$coursedetails->CourseName}}">
                </div>
    
                <div class="col-md-6 mt-2"><label class="labels">หน่วยกิต</label>
                    @error('Credit')<span class="text-danger py-0">({{$message}})</span>@enderror
                    <input name="Credit" type="text" class="form-control" value="{{$coursedetails->Credit}}" placeholder="">
                </div>
                
                
                
                    <div class="d-flex justify-content-center">
                        <div class="py-3">
                            <input type="submit" value="Save Profile" class="btn btn-primary profile-button add_button">
                        </div>
                    </div>
                
                
            </div>           
            
        </form>
</div>