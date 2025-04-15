<?php
// CourseKraft Project - Michael Parent - COMP 370
// Timetable.php

namespace app;

use App\Room;

class Timetable {

    private string $semester;
    private OfferedCourse $plannedCourses;
    private $offeredCourses;

    public function __construct($semester) {
        $plannedCourses;

        SetSemester($semester);
    }

    function SetSemester($semester) {
        $this->semester = $semester;
    }

    function GetSemester() {
        return $semester;
    }

    function GetCourses() {
        $offeredCourses = $plannedCourses.getOfferedCourses();
    }

    function AddCourse($offeredCourse) {
        array_push($plannedCourses, $offeredCourse);
    }

    function Generate() {
        
    }
}