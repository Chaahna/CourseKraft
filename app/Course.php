<?php
// CourseKraft Project - Michael Parent - COMP 370
// Course.php

namespace App;

class Course {

    private string $courseName;
    private Professor $instructingProfessor;
    private Department $department;
    private CoreqCourse $coreqCourses;


    public function __construct($name) {
        $this->courseName = $name;
    }

    public function getCourse() {
        return array(
            "Course" => $courseName,
            "Letter Grade" => $courseGrade
        );
    }

    public function setName(string $name) {
        $this->courseName = $name;
    }

    public function getName() {
        return $this->courseName;
    }

}