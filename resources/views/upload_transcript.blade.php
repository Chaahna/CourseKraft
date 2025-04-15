<!-- CourseKraft Project - Michael Parent - COMP 370 -->
<!-- upload_transcript.blade.php -->
<!DOCTYPE html>
@extends('layouts.app')
@section('title', 'Transcript Upload')
@section('content')
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Transcript Upload</h1>

    <form method="POST" action="{{ route('import.pdf', ['type' => 'transcript']) }}" enctype="multipart/form-data">
        @csrf

        <!-- Hidden input for the type parameter -->
        <input type="hidden" name="type" value="transcript">

        <div>
            <label for="pdf_file">Choose a PDF file:</label>
            <input type="file" name="pdf_file" id="pdf_file">
        </div>

        <!--
        <div>
            <input type="checkbox" id="dump_pdf" name="dump_pdf" value="1">
            <label for="dump_pdf">Include PDF Dump (Debug)</label>
        </div>
        -->
        <button type="submit">Upload</button>
        <p><a href="{{ url('enter_transcript')}}">Manual Entry?</a></p>


    </form>

    <div class="tutorial">
        <h2>How to Export Your UFV Transcript:</h2>
        <div class="step">
            <h3>Step 1: Access Your UFV Transcript</h3>
            <p>Click: <a href="https://apps.ban.ufv.ca/StudentSelfService/ssb/academicTranscript" target="_blank">Access UFV Transcript</a>.</p>
            <p>Ensure, "All Levels" and "Electronic Academic Record" is selected.</p>
            <img src="{{ asset('../../img/step_1.png') }}" alt="Step 1">
        </div>
        <div class="step">
            <h3>Step 2: Click 'Print'</h3>
            <p>Click the "Print" button located near the top right of the screen. (Do Not Use CTRL + P)</p>
            <img src="{{ asset('../../img/step_2.png') }}" alt="Step 2">
        </div>
        <div class="step">
            <h3>Step 3: Save as PDF</h3>
            <p>Once you've selected the "Print" button select the "Save as PDF" option for printer. (Do Not Use Print As PDF)</p>
            <img src="{{ asset('../../img/step_3.png') }}" alt="Step 3">
        </div>
        <div class="step">
            <h3>Step 4: Find and Upload</h3>
            <p>After printing, select the "Choose File" button above and select your file.</p>
        </div>
    </div>

</body>

</html>
@endsection