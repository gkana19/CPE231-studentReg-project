<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\CourseDetail;
use App\Models\ClassDetail;
use App\Models\Registration;
use App\Models\Department;

use Illuminate\Http\Request;
use Illuminate\Support\facades\DB;
use Illuminate\Support\facades\Validator;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    function dashboard()
    {
        $users = User::all();
        return view('admin.users.dashboard', compact('users'));
    }

    function studentManage()
    {
        $studentsinfo = Student::Join('departments', 'students.DepartmentID', '=', 'departments.DepartmentID')
        ->select('students.*', 'departments.DepartmentName', 'departments.FacultyName')
        ->paginate(10);
        $studentscount = Student::Join('departments', 'students.DepartmentID', '=', 'departments.DepartmentID')
        ->select('students.*', 'departments.DepartmentName', 'departments.FacultyName')
        ->get();
        $departments = Department::all();
        $teacherselect = Teacher::Join('departments', 'teachers.DepartmentID', '=', 'departments.DepartmentID')
        ->select('teachers.TeacherID','teachers.TeacherName','teachers.DepartmentID','departments.DepartmentName')
        ->get();
        return view('admin.manage.student', compact('studentsinfo','departments','teacherselect','studentscount'));
    }

    function teacherManage()
    {
        $teachersinfo = Teacher::Join('departments', 'teachers.DepartmentID', '=', 'departments.DepartmentID')
        ->select('teachers.TeacherID', 'teachers.TeacherName', 'teachers.Email', 'departments.DepartmentName', 'departments.FacultyName')
        ->paginate(10);
        $teacherscount = Teacher::Join('departments', 'teachers.DepartmentID', '=', 'departments.DepartmentID')
        ->select('teachers.TeacherID', 'teachers.TeacherName', 'teachers.Email', 'departments.DepartmentName', 'departments.FacultyName')
        ->get();
        $departments = Department::all();
        return view('admin.manage.teacher', compact('teachersinfo','departments','teacherscount'));
    }

    function courseManage()
    {
        $courseinfo = CourseDetail::Join('departments', 'course_details.DepartmentID', '=', 'departments.DepartmentID')
            ->select('course_details.CourseID', 'course_details.CourseName', 'course_details.Credit', 'departments.DepartmentName', 'departments.FacultyName')
            ->paginate(5);
        $coursecount = CourseDetail::Join('departments', 'course_details.DepartmentID', '=', 'departments.DepartmentID')
        ->select('course_details.CourseID', 'course_details.CourseName', 'course_details.Credit', 'departments.DepartmentName', 'departments.FacultyName')
        ->get();   
        $classinfo = ClassDetail::Join('course_details', 'course_details.CourseID', '=', 'class_details.CourseID')
            ->select('course_details.CourseID', 'course_details.CourseName', 'class_details.ClassID', 'class_details.Section', 'class_details.Semester')
            ->get();
        $departments = Department::all();
        $registrations = Registration::all();
        return view('admin.manage.course', compact('courseinfo', 'classinfo','departments','coursecount'));
    }

    function scheduleManage() {

        return view('admin.manage.schedule');
    }


    public function studentManage_add(Request $request) 
    {
        $request->validate([
            'studentid' => 'required|unique:students',
            'StudentName' => 'required',
            'DOB' => 'required',
            'Address' => 'required',
            'DepartmentID' => 'required',
            'Email' => 'required',
            'Phone' => 'required',
            'Status' => 'required',
            'Sex' => 'required',
        ],
        [
            'studentid.required'=>"กรุณาป้อนรหัสนักศึกษาด้วยครับ",
            'studentid.unique'=>"รหัสนักศึกษานี้มีอยู่ในระบบแล้ว",
            'StudentName.required'=>"กรุณาป้อนชื่อนักศึกษาด้วยครับ",
            'DOB.required'=>"กรุณาป้อนวันเกิดด้วยครับ",
            'Address.required'=>"กรุณาป้อนที่อยู่ด้วยครับ",
            'DepartmentID.required'=>"กรุณาเลือกคณะด้วยครับ",
            'Email.required'=>"กรุณาระบุอีเมลด้วยครับ",
            'Phone.required'=>"กรุณาป้อนเบอร์ด้วยครับ",
            'Status.required'=>"กรุณาป้อนสถานภาพด้วยครับ",
            'Sex.required'=>"กรุณาระบุด้วยครับ",
        ]
        );
        // send data to DB
        $data = array();
        $data["studentid"] = $request -> studentid;
        $data["StudentName"] = $request -> StudentName;
        $data["DOB"] = $request -> DOB;
        $data["Address"] = $request -> Address;
        $data["DepartmentID"] = $request -> DepartmentID;
        $data["Email"] = $request -> Email;
        $data["Phone"] = $request -> Phone;
        $data["Status"] = $request -> Status;
        $data["Sex"] = $request -> Sex;
        $data["TeacherID"] = $request -> TeacherID;
        DB :: table('students') -> insert($data);

        return redirect()->back()->with('success', "บันทึกข้อมูลเรียบร้อย");
    }

    public function courseManage_add(Request $request) 
    {
        // dd($request);
        $request->validate(
            [                    
                'CourseID' => 'required|unique:course_details',
                'CourseName' => 'required',
                'DepartmentID' => 'required',
                'Credit' => 'required|integer',
            ],
            [
                'CourseID.required' => "กรุณาป้อนรหัสวิชาด้วยครับ",
                'CourseID.unique' => "รหัสนักวิชานี้มีอยู่ในระบบแล้ว",
                'CourseName.required' => "กรุณาป้อนชื่อวิชาด้วยครับ",
                'DepartmentID.required' => "กรุณาเลือกคณะด้วยครับ",
                'Credit.required' => "กรุณาหน่วยกิตด้วยครับ",
                'Credit.integer' => "กรุณากรอกตัวเลขจำนวนเต็ม"
            ]
        );
        // send data to DB
        $coursedetail= new CourseDetail;
        $coursedetail->CourseID = $request->CourseID;
        $coursedetail->CourseName = $request->CourseName;
        $coursedetail->DepartmentID = $request->DepartmentID;
        $coursedetail->Credit = $request->Credit;
        $coursedetail->save(); 

        return redirect()->back()->with('success', "บันทึกข้อมูลเรียบร้อย");
    }


    public function courseManage_delete($CourseID)
    {
        $select = $CourseID;

        $delete = CourseDetail::where('CourseID', $select)->delete();

        return redirect()->back()->with('delete', "ลบข้อมูลเรียบร้อย");

    }

    public function studentManage_edit($StudentID)
    {
        $select = $StudentID;
        $student = Student::where('StudentID', $select)->get();
        dd($student);

        return view('admin.manage.student', compact('student'));
    }


    public function studentManage_delete($StudentID)
    {
        $select = $StudentID;

        $delete = Student::where('StudentID', $select)->delete();
        return redirect()->back()->with('delete', "ลบข้อมูลเรียบร้อย");
    }


    function sectionManage()
    {
        $classinfo = ClassDetail::Join('course_details', 'course_details.CourseID', '=', 'class_details.CourseID')
            ->select('course_details.CourseID', 'course_details.CourseName', 'class_details.ClassID', 'class_details.Section', 'class_details.Semester')
            ->paginate(5);
        $registrations = Registration::all();
        $departments = Department::all();
        return view('admin.manage.section', compact('classinfo', 'registrations','departments'));
    }

    public function sectionAdd(Request $request)
    {
        $request->validate([
            'ClassID' => 'required|unique:class_details',
            'CourseID' => 'required',
            'Section' => 'required',
            'Semester' => 'required'
        ],
        [
            'ClassID.required'=>"กรุณาป้อนรหัสคลาสด้วยครับ",
            'ClassID.unique'=>"รหัสคลาสนี้มีอยู่ในระบบแล้ว",
            'CourseID.required'=>"กรุณาป้อนรหัสวิชาด้วยครับ",
            'Section.required'=>"กรุณาป้อนกลุ่มด้วยครับ",
            'Semester.required'=>"กรุณาป้อนภาคการศึกษาด้วยครับ",
        ]);
        $data2 = array();
        $data2["ClassID"] = $request -> ClassID;
        $data2["CourseID"] = $request -> CourseID;
        $data2["Section"] = $request -> Section;
        $data2["Semester"] = $request -> Semester;    
        DB :: table('class_details') -> insert($data2);
        return redirect() -> back() -> with('success', "บันทึกข้อมูลเรียบร้อย");
    }

    public function sectionDelete($ClassID)
    {
        $select=$ClassID;
        $delete=ClassDetail::where('ClassID',$select)->delete();
        return redirect()->back()->with('delete', "ลบข้อมูลเรียบร้อย");
    }

    public function teacherAdd(Request $request)
    {
        $request->validate([
            'TeacherID' => 'required|unique:students',
            'TeacherName' => 'required',
            'Address' => 'required',
            'DepartmentID' => 'required',
            'Email' => 'required',
            'Phone' => 'required',

        ],
        [
            'TeacherID.required'=>"กรุณาป้อนรหัสอาจารย์ด้วยครับ",
            'TeacherID.unique'=>"รหัสอาจารย์นี้มีอยู่ในระบบแล้ว",
            'TeacherName.required'=>"กรุณาป้อนชื่ออาจารย์ด้วยครับ",
            'Address.required'=>"กรุณาป้อนที่อยู่ด้วยครับ",
            'DepartmentID.required'=>"กรุณาเลือกคณะด้วยครับ",
            'Email.required'=>"กรุณาระบุอีเมลด้วยครับ",
            'Phone.required'=>"กรุณาป้อนเบอร์ด้วยครับ",

        ]);        

        $teacher = new Teacher;
        $teacher->TeacherID = $request->TeacherID;
        $teacher->TeacherName = $request->TeacherName;
        $teacher->Address = $request->Address;
        $teacher->Email = $request->Email;
        $teacher->Phone = $request->Phone;
        $teacher->DepartmentID = $request->DepartmentID;
        $teacher->save();
        return redirect()->back()->with('success', "บันทึกข้อมูลเรียบร้อย");
    }

    public function teacherDelete($TeacherID)
    {
        $select = $TeacherID;
        $delete = Teacher::where('TeacherID', $select)->delete();
        return redirect()->back()->with('delete', "ลบข้อมูลเรียบร้อย");
    }
}