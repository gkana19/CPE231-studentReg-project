<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\CourseDetail;
use App\Models\ClassDetail;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    function login () {
        return view('student.login');
    } 

    function myinfo() {
        $students = Student::all();
        return view('student.myinfo',compact('students'));
    }

    function welcome () {
        return view('student.welcome');
    }

    function regis() {
        $coursedetails = CourseDetail::all();
        $classdetails = ClassDetail::all();
        $registrations = Registration::where('StudentID',Auth::user()->student_licence_number)->get();
        return view('student.regis',compact('coursedetails','classdetails','registrations'));
    }

    function schedule() {
        return view('student.schedule');
    }
     
    function grading() {
        return view('student.grading');
    }

    // public function store(Request $request) {
    //     //send data to DB
    //     $data = array();
    //     $data["studentid"] = $request -> studentid;

    //     DB :: table('student') -> insert($data);
        
    //     return redirect() -> back -> with('success', "บันทึกข้อมูลเรียบร้อย");

    // }

    public function storeRegistration(Request $request) {
        // ตรวจสอบข้อมูล
       
        $request->validate([
           'ClassID' => 'required'
        ],
        [
            'ClassID.required'=>"กรุณาป้อนชื่อแผนกด้วยครับ",
        ]
        );

        // บันทึกข้อมูล

        // บันทึกแบบ eloquant
        

        
        $student_id = Auth::user()->student_licence_number;

        //dd($student_id,$student_classid);

        $registration = new Registration;
        $registration->ClassID = $request->ClassID;
        $registration->RegStatus = "Wait";
        $registration->StudentID = $student_id;
        $registration->save();
        
        return redirect()->back()->with('success', "บันทึกข้อมูลเรียบร้อย");
        

    }

    public function delete($ClassID){
        $classid=$ClassID;
        $delete=Registration::where('ClassID',$classid)->delete();
        return redirect()->back()->with('success', "ลบข้อมูลเรียบร้อย");
    }

    public function join(){
        // $coursedetails = CourseDetail::all('CousreID')->get();
        // $classdetails = ClassDetail::with('CousreID')->get();
        // $registrations = Registration::with('ClassID')->get();
        return view('student.regis',compact('coursedetails','classdetails','registrations'));
    }

    public function updated(Request $request,){
        
        $student_id = Auth::user()->student_licence_number;
        $update= Registration::where('StudentID',$student_id)->select('RegStatus')->get();
        // dd($update->"RegStatus" );
        $request->validate([
            'StudentID' => 'required',
            'ClassID' => 'required',
            'RegStatus' => 'required'
        ]);

        
                // foreach($request){
                //     $update
                // }
        

        // $registration = Registration::where('StudentID',$student_id);
        // $registration->RegStatus = "Confirmed";
        // $registration->updated();

        $update->toQuery()->update([
            'RegStatus' => 'Confirmed',
        ]);
        
        return redirect()->back()->with('success', "บันทึกข้อมูลเรียบร้อย");
    }
}
