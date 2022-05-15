<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="/images/kmutt-logo.png">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title')</title>

    {{-- styles --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styleforTest.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    {{-- script --}}
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b9d264c4ba.js" crossorigin="anonymous"></script>
    <script src="/js/sidebarAppFortest.js"></script>
</head>


<body id="body-pd" class="bg-light">

    {{-- header --}}
    <header class="header shadow-sm" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        
        <!-- Dropdown button -->
        <div class="dropdown" style="margin-left: 80%">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-offset="5,10" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user"></i> {{ Auth::user()->name }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <div class="block px-4 py-2 text-sm text-gray-400">
                    {{ __('Manage Account') }}
                </div>
                
                @if (auth()->user()->role_id == 1)
                    <li><a class="dropdown-item px-4 py-2" href="{{ route('profile.show') }}">
                        <i class="fa fa-user"></i> {{ __('Profile') }}
                    </a></li>
                @endif
            
            <!-- Authentication -->
            <li><form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <a class="dropdown-item px-4 py-2" href="{{ route('logout') }}"
                            @click.prevent="$root.submit();">
                            <i class="fa fa-sign-out"></i> {{ __('Log Out') }}
                    </a>
                </form></li>
            </ul>
        </div>
        
    </header>

    {{-- sidebar --}}
    <div class="l-navbar bg-dark" id="nav-bar">
        <nav class="nav">
            <div> 
                {{-- <a class="nav_logo" href="{{route('home')}}"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">จัดการทะเบียนเรียน</span> </a> --}}
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <a class="nav_logo" href="{{ route('logout') }}"
                        @click.prevent="$root.submit();"> 
                        <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">จัดการทะเบียนเรียน</span> 
                    </a>
                </form>
                <div class="nav_list"> 
                    
                    {{-- Menu defaults --}}
                    <a href="{{route('first')}}" class="nav_link {{ Request::routeis('first') ? 'active' : '' }}"> <i class="fa-solid fa-house"></i> <span class="nav_name">หน้าแรก</span> </a> 

                    {{-- Menu for admin --}}
                    @if (auth()->user()->role_id == 1)
                    <a href="{{route('studentManage')}}" class="nav_link {{ Request::routeis('studentManage') ? 'active' : '' }}"> <i class="fa fa-address-card"></i> <span class="nav_name">จัดการข้อมูลนักศึกษา</span> </a>
                    <a href="{{route('teacherManage')}}" class="nav_link {{ Request::routeis('teacherManage') ? 'active' : '' }}"> <i class="fa fa-address-book"></i> <span class="nav_name">จัดการข้อมูลอาจารย์</span> </a>
                    <a href="{{route('courseManage')}}" class="nav_link {{ Request::routeis('courseManage') ? 'active' : '' }}"> <i class="fa fa-book"></i> <span class="nav_name">จัดการข้อมูลรายวิชา</span> </a>
                    <a href="{{route('sectionManage')}}" class="nav_link {{ Request::routeis('sectionManage') ? 'active' : '' }}"> <i class="fa fa-bars"></i> <span class="nav_name">จัดการข้อมูลห้องเรียน</span> </a>
                    <a href="{{route('scheduleManage')}}" class="nav_link {{ Request::routeis('scheduleManage') ? 'active' : '' }}"> <i class="fa fa-calendar"></i> <span class="nav_name">จัดการข้อมูลตารางสอน</span> </a>
                    <a href="{{route('t.report')}}" class="nav_link {{ Request::routeis('t.report') ? 'active' : '' }}"> <i class="fa fa-bar-chart"></i> <span class="nav_name">รายงานสถิติ</span> </a>
                    <a href="{{route('admin.dashboard')}}" class="nav_link {{ Request::routeis('admin.dashboard') ? 'active' : '' }}"> <i class="fa fa-tachometer"></i> <span class="nav_name">Dashboard</span> </a>
                    @endif

                    {{-- Menu for student --}}
                    @if (auth()->user()->role_id == 2)    
                        <a href="{{route('myinfo')}}" class="nav_link {{ Request::routeis('myinfo') ? 'active' : '' }}"> <i class="fa-solid fa-address-card"></i> <span class="nav_name">ข้อมูลประวัตินักศึกษา</span> </a> 
                        <a href="{{route('regis')}}" class="nav_link {{ Request::routeis('regis') ? 'active' : '' }}"> <i class="fa-solid fa-book-open"></i> <span class="nav_name">ลงทะเบียนเรียน</span> </a> 
                        <a href="{{route('schedule')}}" class="nav_link {{ Request::routeis('schedule') ? 'active' : '' }}"> <i class="fa-solid fa-calendar ps-1"></i> <span class="nav_name">ตารางเรียน</span> </a> 
                        <a href="{{route('grading')}}" class="nav_link {{ Request::routeis('grading') ? 'active' : '' }}"> <i class="fa-solid fa-graduation-cap"></i> <span class="nav_name">ผลการเรียน</span> </a> 
                    @endif
                    {{-- Menu for teacher --}}                    
                    @if (auth()->user()->role_id == 3)
                        <a href="{{route('courseManage')}}" class="nav_link {{ Request::routeis('courseManage') ? 'active' : '' }}"> <i class="fa fa-book"></i> <span class="nav_name">จัดการข้อมูลรายวิชา</span> </a>
                        <a href="{{route('sectionManage')}}" class="nav_link {{ Request::routeis('sectionManage') ? 'active' : '' }}"> <i class="fa fa-bars"></i> <span class="nav_name">จัดการข้อมูลห้องเรียน</span> </a>
                        <a href="{{route('scheduleManage')}}" class="nav_link {{ Request::routeis('scheduleManage') ? 'active' : '' }}"> <i class="fa fa-calendar"></i> <span class="nav_name">จัดการข้อมูลตารางสอน</span> </a>
                        <a href="{{route('t.report')}}" class="nav_link {{ Request::routeis('t.report') ? 'active' : '' }}"> <i class="fa fa-bar-chart"></i> <span class="nav_name">รายงานสถิติ</span> </a>
                    @endif
                    
                </div>
            </div>
        </nav>
    </div>

    <br>
    <br>

    {{-- footer --}}
    <footer style="margin-left: -100px;">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark text-white fixed-bottom">
        <div id="fake_footer" class="container d-grid justify-content-center">
            <p>King Mongkut's University of Techonology Thonburi (KMUTT) Student Registration</p> 
        <div>
        </nav>
    </footer>
    
</body>
</html>

<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
    </symbol>
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
</svg>