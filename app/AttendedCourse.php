<?php
// CourseKraft Project - Michael Parent - COMP 370
// AttendedCourse.php

namespace App;

class AttendedCourse extends Course {
    private string $courseGrade;

    public function __construct($name, $grade) {
        $this->courseName = $name;
        $this->courseGrade = $grade;
    }

    public function setGrade(string $grade) {
        $this->courseGrade = $grade;
    }

    public function getGrade() {
        return $this->courseGrade;
    }

        // Used to Check if a Course Was Re-Attempted, Keep "Highest" Value Only.
        public function compareGrades(string $testGrade)
        {
    
            $gradeValues = array(
                "A+"    => 11,
                "A"     => 10,
                "A-"    =>  9,
                "B+"    =>  8,
                "B"     =>  7,
                "B-"    =>  6,
                "C+"    =>  5,
                "C"     =>  4,
                "C-"    =>  3,
                "D"     =>  2,
                "I"     =>  1,
                "W"     =>  0,
                "unknown" => -1,
                "In Progress" => -2
            );
    
    
            if ($gradeValues[$testGrade] > $gradeValues[$this->courseGrade]) {
                $this->courseGrade = $testGrade;
            }
        }
}