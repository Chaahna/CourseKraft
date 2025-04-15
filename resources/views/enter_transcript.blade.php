<!DOCTYPE html>
<html>
<!--- This is Broken AF, --->
<head>
    <title>Transcript</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        .form-input {
            width: calc(40%);
            padding: 5px;
            box-sizing: border-box;
        }
        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
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
            <td><input class="form-input" type="text" value="" name="studentName"></td>
            <td><input class="form-input" type="text" value="" name="studentProgram"></td>
            <td><input class="form-input" type="text" value="" name="studentMajor"></td>
        </tr>
    </table>

    <h2>Courses</h2>
    <table id="coursesTable">
        <tr>
            <th>Course Name</th>
            <th>Grade</th>
            <th>Action</th>
        </tr>
            <tr id=""> <!-- Added ID to each row -->
                <td><input class="form-input" type="text" value="" name=""></td>
                <td>
                    <select class="form-input" name="">
                        <option value="A+"     >A+</option>
                        <option value="A"      >A</option>
                        <option value="A-"     >A-</option>
                        <option value="B+"     >B+</option>
                        <option value="B"      >B</option>
                        <option value="B-"     >B-</option>
                        <option value="C+"     >C+</option>
                        <option value="C"      >C</option>
                        <option value="C-"     >C-</option>
                        <option value="D"      >D</option>
                        <option value="F"      >F</option>
                        <option value="unknown">unknown</option>
                        <option value="In Progress">In Progress</option>
                    </select>
                </td>
                <td>
                    <button class="btn-remove" onclick="removeCourse()">Delete</button> <!-- Changed class to btn-remove -->
                </td>
            </tr>
    </table>

    <button class="btn" onclick="addCourse()">Add Course</button>
    <button class="btn" onclick="saveAndSubmit()">Save and Submit</button>

    <form id="transcriptForm" method="POST" > <!-- Added form element -->
        @csrf
        <!-- Add any hidden fields you need for form submission -->
    </form>

    <script>
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
                    <option value="unknown" selected>unknown</option>
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
                        alert("Transcript saved successfully");
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