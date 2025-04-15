<?php
// CourseKraft Project - Michael Parent - COMP 370
// OfferedCourseService.php

namespace App\Services;

use App\OfferedCourse;

class OfferedCourseService {
    public function getOfferedCourses() {
        

        $json = file_get_contents('../database/offeredCourses.json');
        $json_data = json_decode($json, true);
    

        foreach($json_data['data'] as $course)
        {
            echo $course['subject'].' '.$course['courseNumber'].' '.$course['sequenceNumber'].'<br/>'; 
            echo $course['courseTitle'].'<br/>';
            echo 'Credits: '.$course['creditHours'].'<br/>';
            echo 'Department: '.$course['subjectDescription'].'<br/>';

            foreach ($course['faculty'] as $professor) 
            {
                echo 'Professor: '.$professor['displayName'].'<br/>';
                
            }
      
      
             $iterations = 0;
            foreach ($course['meetingsFaculty'] as $meeting) 
            {
                if ($iterations == 0)
                {
                    $meet_start = $meeting['meetingTime']['beginTime'];
                    $meet_end = $meeting['meetingTime']['endTime'];
                    echo 'Meeting Times: '.$meet_start.' to '.$meet_end.'<br/>';
                }
          
                $letterArr = array('U', 'M', 'T', 'W', 'R', 'F', 'S');
                $meetArray = array();
                array_push($meetArray,$sun = $meeting['meetingTime']['sunday']);
                array_push($meetArray,$mon = $meeting['meetingTime']['monday']);
                array_push($meetArray,$tue = $meeting['meetingTime']['tuesday']);
                array_push($meetArray,$wed = $meeting['meetingTime']['wednesday']);
                array_push($meetArray,$thur = $meeting['meetingTime']['thursday']);
                array_push($meetArray,$fri = $meeting['meetingTime']['friday']);
                array_push($meetArray,$sat = $meeting['meetingTime']['saturday']);
                $iterations+=1;
          
                for ($i = 0; $i < count($meetArray)-1; $i++)
                {
                    if ($meetArray[$i] == 1)
                    {
                        echo $letterArr[$i].' - '.$meeting['meetingTime']['building'].' '.$meeting['meetingTime']['room'].' '.$meeting['meetingTime']['startDate'].'<br/>';
                    }
                }
                
            }
      
            echo 'Instructional Method: '.$course['instructionalMethod'].'<br/>';
            echo '<br/>';
        }

    }
}