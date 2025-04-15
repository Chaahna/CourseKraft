<?php
// CourseKraft Project - Michael Parent - COMP 370
// OfferedCourse.php

namespace App;

use App\CourseSession;

class OfferedCourse extends PlannedCourse {


    //
    public string $subject;
    public string $courseNumber;
    public string $sequenceNumber;
    public string $courseTitle;
    public string $subjectDescription;
    public string $profName;
    public string $meetBegin;
    public string $meetEnd;
    public string $building;
    public string $room;
    //

    //
    public $meetingDays = array();
    //  


    public function getOfferedCourses() {

    }

}