<?php
// CourseKraft Project - Michael Parent - COMP 370
// CoursePlan.php

namespace App;

use App\Transcript;
use App\Course;

class CoursePlan {
    private Course $courses;
    private Transcript $transcript;
    private static $jsonData;
    private Timetable $plannedTimetable;

    private OfferedCourse $offeredCourses;

    public function __construct($courses, $transcript) {
        $this->courses = $courses;
        $this->transcript = $transcript;
        $jsonData = file_get_contents('database/offeredCourses.json');
        dump($jsonData);
    }

    public function Generate($numOfCourses, $preferedCourseTimes, $degreeType) {

    }

    private function FindCourseMatch($search) {
        foreach ($offeredCourses as $course) {

            if (in_array($search, $course.meetingDate) && !in_array($course.name, $plannedTimetable)) {
                // We found a match

            } else {
                // No Match or Course Already Added $plannedTimetable
            }
        }
    }
}