<!-- CourseKraft Project - Michael Parent - COMP 370 -->
<!-- transcript.blade.php -->
<!DOCTYPE html>
@extends('layouts.app')
@section('title', 'Transcript Upload')
@section('content')
<html>
<head>
    <title>Transcript</title>

</head>
<body>
    <h1>Transcript Data</h1>

    <h2>Student Information</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Program</th>
            <th>Major</th>
        </tr>
        <tr>
            <td><input class="form-input" type="text" value="{{ $transcriptData['studentName'] }}" name="studentName" readonly></td>
            <td><input class="form-input" type="text" value="{{ $transcriptData['studentProgram'] }}" name="studentProgram" readonly></td>
            <td><input class="form-input" type="text" value="{{ $transcriptData['studentMajor'] }}" name="studentMajor" readonly></td>
        </tr>
    </table>

    <h2>Courses</h2>
    <button class="btn" onclick="addCourse()">Add Course</button>
    <form id="transcriptForm" method="POST" action="{{ route('submit.transcript', ['type' => 'transcript']) }}" enctype="multipart/form-data">
        @csrf
    <table id="coursesTable">
        <tr>
            <th>Course Name</th>
            <th>Grade</th>
            <th>Action</th>
        </tr>
        @foreach($transcriptData['courses'] as $index => $course)
            <tr id="courseRow{{ $index }}"> <!-- Added ID to each row -->
                <td><input class="form-input" type="text" value="{{ $course['name'] }}" name="courses[{{ $index }}][name]" readonly></td>
                <td>
                    <select class="form-input" name="courses[{{ $index }}][grade]">
                        <option value="A+"      {{ $course['grade'] === 'A+'        ? 'selected' : '' }}>A+</option>
                        <option value="A"       {{ $course['grade'] === 'A'         ? 'selected' : '' }}>A</option>
                        <option value="A-"      {{ $course['grade'] === 'A-'        ? 'selected' : '' }}>A-</option>
                        <option value="B+"      {{ $course['grade'] === 'B+'        ? 'selected' : '' }}>B+</option>
                        <option value="B"       {{ $course['grade'] === 'B'         ? 'selected' : '' }}>B</option>
                        <option value="B-"      {{ $course['grade'] === 'B-'        ? 'selected' : '' }}>B-</option>
                        <option value="C+"      {{ $course['grade'] === 'C+'        ? 'selected' : '' }}>C+</option>
                        <option value="C"       {{ $course['grade'] === 'C'         ? 'selected' : '' }}>C</option>
                        <option value="C-"      {{ $course['grade'] === 'C-'        ? 'selected' : '' }}>C-</option>
                        <option value="D"       {{ $course['grade'] === 'D'         ? 'selected' : '' }}>D</option>
                        <option value="F"       {{ $course['grade'] === 'F'         ? 'selected' : '' }}>F</option>
                        <option value="unknown" {{ $course['grade'] === 'unknown'   ? 'selected' : '' }}>unknown</option>
                        <option value="In Progress">In Progress</option>
                    </select>
                </td>
                <td>
                    <button class="btn-red" onclick="removeCourse({{ $index }})">Delete</button>
                </td>
            </tr>
        @endforeach
    </table>

    <button class="btn-green" onclick="saveAndSubmit()" id="submitButton">Submit</button>
        <!-- Add any hidden fields you need for form submission -->
    </form>

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

        
        function addCourse() {
            var table = document.getElementById('coursesTable');
            var index = table.rows.length; // Include header row
            var newRow = table.insertRow(-1);
            newRow.id = 'courseRow' + index;

            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);

            cell1.innerHTML = '<input class="form-input" type="text" name="courses[' + index + '][name]">';
            cell2.innerHTML = `
                <select class="form-input" name="courses[${index}][grade]">
                    <option value="A+">A+</option>
                    <option value="A">A</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B">B</option>
                    <option value="B-">B-</option>
                    <option value="C+">C+</option>
                    <option value="C">C</option>
                    <option value="C-">C-</option>
                    <option value="D">D</option>
                    <option value="F">F</option>
                    <option value="Unknown" selected>Unknown</option>
                    <option value="In Progress" selected>In Progress</option>
                </select>
            `;
            cell3.innerHTML = '<button class="btn-remove" onclick="removeCourse(' + index + ')">Delete</button>';
        }

        function saveAndSubmit() {
            var table = document.getElementById('coursesTable');
            var isValid = true;

            // Check each row in the table
            for (var i = 1; i < table.rows.length; i++) {
                var nameInput = table.rows[i].querySelector('input[name^="courses["]');
                var gradeSelect = table.rows[i].querySelector('select[name^="courses["]');

                // Check if any input field is empty
                if (nameInput.value.trim() === '' || gradeSelect.value === 'unknown') {
                    isValid = false;
                    alert('Please fill out all fields and select a valid grade.');
                    break; // Exit loop early if any field is invalid
                }
            }

            // If all fields are valid, submit the form
            if (isValid) {

                var form = document.getElementById('transcriptForm');
                var formData = new FormData(form);

                // Add student information to formData
                var studentName = document.querySelector('input[name="studentName"]').value;
                var studentProgram = document.querySelector('input[name="studentProgram"]').value;
                var studentMajor = document.querySelector('input[name="studentMajor"]').value;
                formData.append('studentName', studentName);
                formData.append('studentProgram', studentProgram);
                formData.append('studentMajor', studentMajor);

                // Add courses data to formData
                for (var i = 1; i < table.rows.length; i++) {
                    var courseName = table.rows[i].querySelector('input[name^="courses["]').value;
                    var courseGrade = table.rows[i].querySelector('select[name^="courses["]').value;
                    formData.append('courses[' + i + '][name]', courseName);
                    formData.append('courses[' + i + '][grade]', courseGrade);
                }


                fetch("{{ route('submit.transcript') }}", {
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
        }


        function removeCourse(index) {
            var row = document.getElementById('courseRow' + index);
            row.parentNode.removeChild(row);
        }
    </script>
</body>
</html>
@endsection