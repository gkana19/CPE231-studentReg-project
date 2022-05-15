<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\CourseDetail;
use App\Models\ClassDetail;
use App\Models\Registration;
use App\Models\Department;
use App\Models\Schedule;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    function index() {
        return view('teacher.welcome');
    }

    function report() {
        $reportinfo = CourseDetail::Join('class_details', 'course_details.CourseID', '=', 'class_details.CourseID')
        ->select('course_details.CourseID', 'course_details.CourseName', 'class_details.ClassID', 'class_details.Section')
        ->paginate(5);
        $coursedetails = CourseDetail::all();
        $reportavg = Registration::where('RegStatus','Complete')
        ->select('registrations.ClassID', 'registrations.Grade', 'registrations.StudentID')
        ->get();
        $reportavg2 = Registration::join('students', 'registrations.StudentID', '=', 'students.StudentID')
        ->join('departments', 'students.departmentID', '=', 'departments.departmentID')
        ->where('RegStatus','Complete')
        ->select('registrations.ClassID', 'registrations.Grade', 'registrations.StudentID', 'departments.departmentID')
        ->get();

        $registrations = Registration::all();
        
        $reportstudent = Student::Join('registrations', 'students.StudentID', '=', 'registrations.StudentID')

        ->select('students.StudentID', 'students.StudentName')
        ->groupBy('students.StudentID' , 'students.StudentName')
        ->paginate(5);

        $reportstudent2 = Student::Join('registrations', 'students.StudentID', '=', 'registrations.StudentID')
        ->select('students.StudentID')
        ->groupBy('students.StudentID')
        ->get();
        

        $reportjiew2 = Student::Join('registrations','students.StudentID', '=', 'registrations.StudentID' )
        ->Join('departments', 'students.departmentID', '=', 'departments.departmentID')
        ->select('departments.departmentID','departments.departmentname')
        ->groupBy('departments.departmentID', 'departments.departmentname')
        ->get();
        
        return view('teacher.report', compact('reportinfo', 'registrations', 'reportavg', 'coursedetails','reportstudent','reportjiew2', 'reportavg2','reportstudent2'));

    }
}
