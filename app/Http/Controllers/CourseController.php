<?php
// CourseKraft Project - Michael Parent - COMP 370
// CourseController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OfferedCourse;

class CourseController extends Controller
{  
    private $offeredCourses = array();


    public function showCourse()
    {
        $courseData = [
            'subject' => 'COMP',
            'courseNumber' => '150',
            'sequenceNumber' => 'AB1',
            'courseTitle' => 'Introduction to Programming',
            'subjectDescription' => 'Computer Science',
            'profName' => 'Milan Tofiloski',
            'meetBegin' => '1510',
            'meetEnd' => '1850',
            'building' => 'ABD',
            'room' => '204',
            'meetingDays' => ['monday']
        ];

        return view('timetable', compact('courseData'));
        
    }

    public function submit(Request $request)
    {
        $previousData = $request->session()->get("transcript");
        $request->merge($previousData);

        // dang
        $blacklist = array();

        foreach ($request->courses as $course) {
            array_push($blacklist, $course["name"]);
        }

        //

        $this->GetOfferedCourses();
        $matchedCourses = $this->GetOfferedCourse($blacklist, $request->course_quantity, $request->concentration, $request->course_day);

        return view('timetable', compact('matchedCourses'));
    }

    // This is janky
    public function GetOfferedCourse($blacklist, $numberOfCourses, $concentration, $preferedTimes) {

        $matched_courses = array();

        switch ($concentration) {
            case "bsc_compsci":
                $required_courses_db = "../database/bsc_compsci.json";
                break;
            default:
                $required_courses_db = "../database/bsc_compsci.json";
        }

        $json = file_get_contents($required_courses_db);
        $json_data = json_decode($json, true);

        for ($i = 0; $i < $numberOfCourses; $i++) {

            foreach ($this->offeredCourses as $current_offered_course) {

                $current_offered_fullname = $current_offered_course->subject . " " . $current_offered_course->courseNumber;

                // If current offered course is not in blacklist (has NOT already taken / Not already discovered)
                if (! in_array($current_offered_fullname, $blacklist)) {
                    
                    foreach ($json_data['courses'] as $current_required_course) {
                        if ($current_required_course['Code'] == $current_offered_fullname) {

                            if ($preferedTimes != null) {
                                foreach ($current_offered_course->meetingDays as $meeting_day) {
                                    if (in_array($meeting_day, $preferedTimes)) {
                                        //dump($current_offered_course);
                                        array_push($matched_courses, $current_offered_course);
                                        array_push($blacklist, $current_offered_fullname);
                                    }
                                }
                            } else {
                                //dump($current_offered_course);
                                array_push($matched_courses, $current_offered_course);
                                array_push($blacklist, $current_offered_fullname);
                            }
                        }
                    }
                }
            }
        }
        return $matched_courses;

    }
    //


    public function GetOfferedCourses() {

        $json = file_get_contents('../database/offeredCourses.json');
        $json_data = json_decode($json, true);
       
        foreach($json_data['data'] as $course) {

            $current_course = new OfferedCourse();
            $current_course->subject = $course['subject'];
            $current_course->courseNumber = $course['courseNumber'];
            $current_course->sequenceNumber = $course['sequenceNumber'];
            $current_course->courseTitle = $course['courseTitle'];

            $current_course->subjectDescription = $course['subjectDescription'];
      
            foreach ($course['faculty'] as $professor) {

                $current_course->profName = $professor['displayName'];

            }

            foreach ($course['meetingsFaculty'] as $meeting) {

                $current_course->meetBegin = ($meeting['meetingTime']['beginTime'] != null) ? $meeting['meetingTime']['beginTime'] : "N/A";
                $current_course->meetEnd = ($meeting['meetingTime']['endTime'] != null) ? $meeting['meetingTime']['endTime'] : "N/A";

                $current_course->building = ($meeting['meetingTime']['building'] != null) ? $meeting['meetingTime']['building'] : "N/A";
                $current_course->room = ($meeting['meetingTime']['room'] != null) ? $meeting['meetingTime']['room'] : "N/A";

                
                $day_array = array(
                    "sunday",
                    "monday",
                    "tuesday",
                    "wednesday",
                    "thursday",
                    "friday",
                    "saturday"
                );

                foreach ($day_array as $day) {

                    switch ($meeting['meetingTime'][$day]) {
                        case True:
                            array_push($current_course->meetingDays, $day);
                    }
                }
                    
            }

            array_push($this->offeredCourses, $current_course);

        }

        return $this->offeredCourses;
    }
}