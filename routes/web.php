<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TranscriptController;
use App\Http\Controllers\PreferencesController;

// Home Page
Route::get('/', function () {
    return view('home');
});
//


// About Page
Route::get('/about', function () {
    return view('about');
});
//

// Upload Transcript Page
Route::get('/upload_transcript', function () {
    return view('upload_transcript');
});
//

// Timetable Page
Route::post('/timetable', [CourseController::class, 'showCourse'])->name('timetable.show');
//


// Manual Transcript Page
Route::get('/enter_transcript', function () {
    return view('enter_transcript');
});
//


// Timetable Preferences
Route::post('/preferences', [PreferencesController::class, 'submit'])->name('submit.transcript');
Route::get('/preferences', function() {
    return view('preferences');
})->name('preferences');
//

Route::post('/timetable', [CourseController::class, 'submit'])->name('submit.preferences');



// Upload Transcript Page (Button)
Route::post('/parse-pdf/{type}', [PdfController::class, 'importPDF'])->name('import.pdf');
//