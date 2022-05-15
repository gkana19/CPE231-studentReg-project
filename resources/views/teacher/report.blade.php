@extends('layouts.default')
@section('title','Teacher | report')
@section('content')
<link rel="icon" type="image/x-icon" href="/images/kmutt-logo.png">


<div class="height-100 bg-light" style="margin-right: 10px;">
    <div class="container">
        <div class="row mt-5 p-2">
            <div class="col-sm-12 mt-3 pt-3 justify-content-center">
                <h2><i class="fa fa-bar-chart"></i> รายงานสถิติ </h2>
            </div>
            <hr>

        </div>

            {{-- tab header --}}
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">สถิติเกรดแต่ละวิชา</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">แสดงเกรดเฉลี่ยทั้งหมด</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">เกรดเฉลี่ยของแต่ละภาควิชา</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact2" type="button" role="tab" aria-controls="contact2" aria-selected="false">จำนวนคนที่ได้เกรดเฉลี่ยแต่ละช่วง</button>
                </li>
            </ul>
            {{-- tab content --}}
                <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <table class="table table-striped shadow-sm text-center mt-2">
                        <h5 class="mt-3"><font color="black">ตารางแสดงสถิติของเกรดในแต่ละวิชา</font></h5>
                        <thead class="table table-dark">
                            <tr>
                                <th>รหัสวิชา</th>
                                <th>ชื่อวิชา</th>
                                <th>รหัสคลาส</th>
                                <th>Min</th>
                                <th>Max</th>
                                <th>Mean</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reportinfo as $row)
                            <tr>
                                <th>{{$row->CourseID}}</th>
                                <td>{{$row->CourseName}}</td>
                                <td>{{$row->ClassID}}</td>
                                <td>{{$reportavg->where('ClassID',$row->ClassID)->min('Grade')}}</td>
                                <td>{{$reportavg->where('ClassID',$row->ClassID)->max('Grade')}}</td>
                                <td>{{ROUND($reportavg->where('ClassID',$row->ClassID)->avg('Grade'),2)}}</td>
                            </tr>  
                            @endforeach
                        </tbody>
                    </table> 
                </div>

                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <table class="table table-striped shadow-sm text-center mt-2">
                        <h5 class="mt-3"><font color="black">ตารางแสดงเกรดเฉลี่ย</font></h5>
                        <thead class="table table-dark">
                            <tr>
                                <th>ลำดับ</th>
                                <th>รหัสนักศึกษา</th>
                                <th>ชื่อ</th>
                                <th>GPA</th>
                                <th>สถานะ</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reportstudent as $row)
                            <tr>
                                <th>{{$reportstudent->firstItem()+$loop->index}}</th>
                                <th>{{$row->StudentID}}</th>
                                <td>{{$row->Studentname}}</td>
                                <td>{{ROUND($reportavg->where('StudentID',$row->StudentID)->avg('Grade'),2)}}</td>
                                <td>@if( $reportavg->where('StudentID',$row->StudentID)->avg('Grade') > 2 )
                                    <font color="green">Normal</font>
                                    @else
                                    <font color="red">Probation</font>
                                    @endif
                                </td>                
                            </tr>  
                            @endforeach
                        </tbody>
                    </table>
                    {{$reportstudent->links()}}
                </div>

                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <table class="table table-striped shadow-sm text-center mt-2">
                        <h5 class="mt-3"><font color="black">ตารางแสดงเกรดเฉลี่ยของแต่ละภาควิชา</font></h5>
                        <thead class="table table-dark">
                            <tr>
                                <th>ภาควิชา</th>
                                <th>GPAX</th>
    
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reportjiew2 as $row)
                            <tr>
                                <th>{{$row->departmentname}}</th>
                                <td>{{ROUND($reportavg2->where('departmentID',$row->departmentID)->avg('Grade'),2)}}</td>
                            </tr>  
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="contact2" role="tabpanel" aria-labelledby="contact-tab">
                <table class="table table-striped shadow-sm text-center mt-2">
                    <h5 class="mt-3"><font color="black">ตารางแสดงสถิติจำนวนนักศึกษาของเกรดเฉลี่ยแต่ละช่วง</font></h5>
                    <thead class="table table-dark">
                        <tr>
                            <th>ช่วงของเกรด</th>
                            <th>จำนวน</th>
                        </tr>
                    </thead>                    
                    <tbody>
                        <?php
                            $range1 = 0;
                            $range2 = 0;
                            $range3 = 0;
                            $range4 = 0;
                            foreach($reportstudent2 as $row)
                                if (($registrations->where('StudentID',$row->StudentID)->avg('Grade'))> "0" and ($registrations->where('StudentID',$row->StudentID)->avg('Grade'))<="1"){
                                    $range1++;
                                }elseif ((($registrations->where('StudentID',$row->StudentID)->avg('Grade'))> "1" and ($registrations->where('StudentID',$row->StudentID)->avg('Grade'))<="2")) {
                                    $range2++;
                                }elseif ((($registrations->where('StudentID',$row->StudentID)->avg('Grade'))> "2" and ($registrations->where('StudentID',$row->StudentID)->avg('Grade'))<="3")) {
                                    $range3++;
                                }elseif ((($registrations->where('StudentID',$row->StudentID)->avg('Grade'))> "3" and ($registrations->where('StudentID',$row->StudentID)->avg('Grade'))<="4")) {
                                    $range4++;
                                };
                        ?>
                        <tr>
                            <th>0-1</th>
                            <td><?php echo $range1;?> คน</td>                            
                        </tr>
                        <tr>
                            <th>1-2</th>
                            <td><?php echo $range2;?> คน</td>
                        </tr>
                        <tr>
                            <th>2-3</th>
                            <td><?php echo $range3;?> คน</td>
                        </tr>
                        <tr>
                            <th>3-4</th>
                            <td><?php echo $range4;?> คน</td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div>        
                
    </div>
</div>