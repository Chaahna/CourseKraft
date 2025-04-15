<?php
// CourseKraft Project - Michael Parent - COMP 370
// TranscriptService.php

namespace App\Services;

use App\Transcript;

class TranscriptService {
    public function createTranscript(array $lines): array {

        $transcript = new Transcript($lines);

        $transcript->parseBio();
        $transcript->parseCourses();

        return $transcript->getTranscriptData();
    }
}