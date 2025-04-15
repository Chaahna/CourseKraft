<?php
// CourseKraft Project - Michael Parent - COMP 370
// Transcript.php

namespace App;

use App\AttendedCourse;

class Transcript {

    private $studentName;
    private $studentProgram;
    private $studentMajor;
    private $studentCourses = array();
    private $transcriptLines = array();
   

    public function __construct($transcript) {

        $this->transcriptLines = $transcript;       

    }

    public function parseCourses() {
        $transcriptLines = $this->transcriptLines;

        for ($index = 0; $index < count($transcriptLines); $index++) {
            switch ($transcriptLines[$index]) {

                case "TRANSFER CREDIT ACCEPTED BY INSTITUTION":
                    while($transcriptLines[$index + 1] != "INSTITUTION CREDIT") {

                        if ($transcriptLines[$index] == "Subject Course Title Grade Credit hours Quality points R") {

                            $index++;

                            while ($transcriptLines[$index] != "Attempt Hours Passed Hours Earned Hours GPA Hours Quality Points GPA") {

                                $unprocessedCourses[] = $transcriptLines[$index];
                                $index++;

                            }
                        }
                        $index++;
                    }
                    break;

                
                case "INSTITUTION CREDIT":
                    while ($transcriptLines[$index] != "COURSE(S) IN PROGRESS") {

                        if ($transcriptLines[$index] == "Subject Course Campus Level Title Grade Credit Hours Quality Points R") {

                            $index++;

                            while ($transcriptLines[$index] != "Term Totals (Credit) Attempt Hours Passed Hours Earned Hours GPA Hours Quality Points GPA") {

                                if ($transcriptLines[$index] != "") {
                                    $unprocessedCourses[] = $transcriptLines[$index];
                                }
                                $index++;

                            }
                        }
                        $index++;
                    }
                    break;


                case "Subject Course Campus Level Title Credit Hours":

                    while ($index < count($transcriptLines) - 1) {
                        $currentWord = $transcriptLines[$index];
        
                        if ($index + 1 < count($transcriptLines)) {
        
                            $nextWord = $transcriptLines[$index + 1];
        
                        }
        
                        $unprocessedCourses[] = $nextWord;

                        $index++;
                    }
                    break;

            }
        }


            foreach ($unprocessedCourses as $course) {
                
                $class_course = new AttendedCourse("unknown", "unknown");

            
                if (preg_match("/\b[A-Za-z]+ \d{3}/", $course, $match)) {
                    $class_course->setName(implode("", $match));
                }

                if (preg_match("/[ \t][ABCDFW][+-]? /", $course, $match)) {
                    $class_course->setGrade(trim(preg_replace('/[\n\r\t]+/', '', $match[0])));
                }

                $index = array_search($class_course->getName(), array_map(function($class_course) {
                    return $class_course->getName();
                }, $this->studentCourses));


                
                if ($index != false) {

                    $this->studentCourses[$index]->compareGrades($class_course->getGrade());

                } else {

                    $this->addCourse($class_course);

                }
            }

        }

    public function parseBio() {
        $transcriptLines = $this->transcriptLines;

        for ($index = 0; $index < count($transcriptLines); $index++) {
            switch ($transcriptLines[$index]) {

                case "Name":
                    $this->studentName = $transcriptLines[$index + 1];
                    break;

                case "Program":
                    $this->studentProgram = $transcriptLines[$index + 1];
                    break;

                case "Major":
                    $this->studentMajor = $transcriptLines[$index + 1];
                    break;

            }
        }
    }

    public function addCourse(Course $course) {
        array_push($this->studentCourses, $course);
    }

    public function getTranscriptData() {
        $transcriptData = [];

        // Add student bio data
        $transcriptData['studentName'] = $this->studentName ?? 'N/A';
        $transcriptData['studentProgram'] = $this->studentProgram ?? 'N/A';
        $transcriptData['studentMajor'] = $this->studentMajor ?? 'N/A';

        // Add student courses
        $transcriptData['courses'] = [];
        foreach ($this->studentCourses as $course) {
            $transcriptData['courses'][] = [
                'name' => $course->getName(),
                'grade' => $course->getGrade(),
                // Add more fields if needed
            ];
        }

        return $transcriptData;
    }
}