<!-- CourseKraft Project - David Wiebe - COMP 370 -->
<!-- about.blade.php -->
<!DOCTYPE html>
@extends('layouts.app')
@section('title', 'About Us')
@section('content')
<html>
<head>
    <title>About Us</title>
    <style>

    </style>
</head>
<body>
    <img src="{{ asset('img/banner_2.png') }}" alt="Simple Course Kraft Logo">

    <h1>About Us</h1>

    <p>Course Kraft is an automated course repository and planner created by UFV students for UFV students. </p>
        
    <p>Our application aims to address limitations and provide improvements to the current course planning and registration process at UFV. Through our system, students can generate complete course plans based on their preferences and transcripts. A course plan generated with Course Kraft will display the fastest path to a selected degree under the constraints provided by the user, enabling students to save both time and money through efficient and accurate course plan generation. Our system also aims to provide valuable back-end statistics to help the UFV administration provide appropriate course offerings for future semesters.</p>
   
</body>

</html>
@endsection