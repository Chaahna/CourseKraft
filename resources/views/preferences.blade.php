<!-- CourseKraft Project - Mason Paquette - COMP 370 -->
<!-- timetable.blade.php -->
<!DOCTYPE html>
@extends('layouts.app')
@section('title', 'Generate Timetable')
@section('content')
<html>
<head>
<meta charset="utf-8">
<link rel = "stylesheet" href="pacific.css">
<meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>      
    <main>
        <h1 style = "text-align:center;">Planning your upcoming semesters.</h1>
        <div>
            
            <p>
                In order to generate a customized course plan that will help you succeed in your academic goals, we require some
                additional information from you in order to ensure a high quality and accurate plan.

                Please fill out the following form, which will help our course generator better recognize your needs.

                <form id="preferencesForm" method="POST" action="{{ route('submit.preferences') }}" enctype="multipart/form-data">
                @csrf
                <label for="course_quantity">Select # Of Courses:</label>
                    <select id="course_quantity" name="course_quantity">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                    <br>

                    <label for="course_day[]">Select preferred class days.</label><br>

                    <input type='checkbox' name='course_day[]' value='sunday'>Sunday<br>
                    <input type='checkbox' name='course_day[]' value='monday'>Monday<br>
                    <input type='checkbox' name='course_day[]' value='tuesday'>Tuesday<br>
                    <input type='checkbox' name='course_day[]' value='wednesday'>Wednesday<br>
                    <input type='checkbox' name='course_day[]' value='thursday'>Thursday<br>
                    <input type='checkbox' name='course_day[]' value='friday'>Friday<br>
                    <input type='checkbox' name='course_day[]' value='saturday'>Saturday<br>

                    <label for="concentration">Select program concentration:</label><br>
                    <select name="concentration" id="concentration">

                        <optgroup label="Bachelor of Computer Information Systems">
                            <option disabled value="software">Software Development</option>
                            <option disabled value="sys_network">Systems and Networking</option>
                            <option disabled value="security">Security</option>
                        </optgroup>
                        <optgroup label="Bachelor of Computer Science">
                            <option value="sys_security">Systems and Security</option>
                            <option value="ai_datamining">Artificial Intelligence and Data Mining</option>
                            <option value="programming_software">Programming Languages and Software</option>
                        </optgroup>
                        <optgroup label="Bachelor of Business Administration">
                            <option disabled value="accounting">Accounting</option>
                            <option disabled value="finance">Finance</option>
                            <option disabled value="hr_manage">Human Resource Management</option>
                            <option disabled value="inter_busi">International Business</option>
                            <option disabled value="market">Marketing</option>
                        </optgroup>
                        <optgroup label="Certificate in Computer Information Systems">
                            <option disabled value="cert_network">Networking</option>
                            <option disabled value="cert_program">Programming</option>
                            <option disabled value="cert_security">Security</option>
                        </optgroup>
                    </select>
                    <br>

                    <br>
                    <button class="btn-green" onclick="saveAndSubmit()" id=submitButton>Generate Plan</button>

                </form>
            </p>

            <script>
            let formSubmitted = false;

            // Listen for form submission
            document.getElementById('transcriptForm').addEventListener('submit', function() {
                formSubmitted = true;
            });

            // Show confirmation message when leaving the page, except when form is submitted
            window.onbeforeunload = function() {
            if (!formSubmitted) {
                return "Are you sure you want to leave this page? Your changes will not be saved.";
            }
            };

            function saveAndSubmit() {
                var form = document.getElementById('preferencesForm');

                fetch("{{ route('submit.preferences') }}", {
                    method: "POST",
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        
                        // You can redirect or do something else here
                    } else {
                        throw new Error("Something went wrong");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Failed to save transcript");
                });
            }
            </script>

        </div>
    </main>

</body>
</html>
@endsection