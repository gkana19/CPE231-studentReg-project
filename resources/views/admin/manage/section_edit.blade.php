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
    <form action = "{{route('sectionEdit')}}"  method="POST">
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