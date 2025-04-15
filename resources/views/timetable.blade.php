<!DOCTYPE html>
@extends('layouts.app')
@section('title', 'Generated TimeTable')
@section('content')
<html>
<h1>Generated TimeTable</h1>
<table class="table">
    <thead>
        <tr>
            <th>Subject</th>
            <th>Course Number</th>
            <th>Sequence Number</th>
            <th>Course Title</th>
            <th>Subject Description</th>
            <th>Professor</th>
            <th>Meeting Days</th>
            <th>Meeting Time</th>
            <th>Location</th>
        </tr>
    </thead>
    <tbody>
        @foreach($matchedCourses as $course)
        <tr>
            <td>{{ $course->subject }}</td>
            <td>{{ $course->courseNumber }}</td>
            <td>{{ $course->sequenceNumber }}</td>
            <td>{{ $course->courseTitle }}</td>
            <td>{{ $course->subjectDescription }}</td>
            <td>{{ $course->profName }}</td>
            <td>
                @foreach($course->meetingDays as $day)
                    {{ ucfirst($day) }}
                    @if(!$loop->last)
                        ,
                    @endif
                @endforeach
            </td>
            <td>{{ $course->meetBegin }} - {{ $course->meetEnd }}</td>
            <td>{{ $course->building }} {{ $course->room }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
