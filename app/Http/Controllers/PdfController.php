<?php
// CourseKraft Project - Michael Parent - COMP 370
// PdfController.php

namespace App\Http\Controllers;

use App\Services\TranscriptService;
use Illuminate\Http\Request;

include_once __DIR__ . '/../../Transcript.php';


class PdfController extends Controller
{

    public function dumpPdf($textLines)
    {      
        dump($textLines);
    }

    public function cleanPDF($text)
    {
        $textLines = explode(" ", $text);
        $textLines = explode(PHP_EOL, $text);

        // Clean Up PDF Lines, Removing Junk
        for ($index = 0; $index < count($textLines); $index++) {
            $textLines[$index] = preg_replace('/[\r\n\t\s]+/', ' ', $textLines[$index]);
        }

        return $textLines;
    }


    public function importPDF(Request $request, $type)
    {
        try {
            $parser = new \Smalot\PdfParser\Parser();
        
            $pdf = $parser->parseFile($request->file('pdf_file'));
            $text = $pdf->getText();
            $textLines = $this->cleanPDF($text);

            // If File is a Transcript (See: transcript.blade.php)
            if ($type == 'transcript') {
                $transcriptService = new TranscriptService();
                return view('transcript', ['transcriptData' => $transcriptService->createTranscript($textLines)]);
            }
        } catch (Exception $e) {
            $errorMessage = "An error occurred: " . $e->getMessage();
    
            // Redirect to the custom error page
            header("Location: error.php?message=" . urlencode($errorMessage));
            exit;
        }

    }
}
