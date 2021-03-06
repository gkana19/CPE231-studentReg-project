<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassDetail extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'ClassID',
        'CourseID',
        'Section',
        'Semester'
    ];

    public function schedules(){
        return $this->hasMany(Schedule::class,'ClassID','ClassID');
    }

    public function courseDetails(){
        return $this->hasOne(CourseDetail::class,'CourseID','CourseID');
    }
}
