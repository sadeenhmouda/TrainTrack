<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\WizardController;

// ✅ Home Page
Route::get('/', function () {
    return view('home');
});

// ✅ Wizard Step 0: Start Page
Route::get('/traintrack/start', function () {
    session()->forget([
        'wizard_selections',
        'subject_categories',
        'technical_skills',
        'non_technical_skills',
        'advanced_preferences',
        'fallback_state'
    ]);
    return redirect()->route('traintrack');
})->name('traintrack.start');



// ✅ Wizard Step 1: Personal Info
Route::get('/traintrack', fn() => view('traintrack'))->name('traintrack');

// ✅ Wizard Step 2: Subject Categories
Route::get('/traintrack/subject', fn() => view('subject'))->name('traintrack.subject');

// ✅ Wizard Step 2.2: Subject Topics
Route::get('/traintrack/subject2', fn() => view('subject2'))->name('traintrack.subject2');

// ✅ Save selected subject categories (POST)
Route::post('/wizard/save-subject-categories', [WizardController::class, 'saveSubjectCategories'])->name('wizard.save.subjects');

// ✅ Wizard Step 3: Technical Skills
Route::get('/traintrack/technical', fn() => view('technical'))->name('traintrack.technical');

// ✅ Wizard Step 4: Non-Technical Skills
Route::get('/traintrack/nontechnical', fn() => view('nontechnical'))->name('traintrack.nontechnical');

// ✅ Wizard Step 5: Advanced Preferences
Route::get('/traintrack/advancepreferences', fn() => view('advancepreferences'))->name('traintrack.advancepreferences');

// ✅ Wizard Step 6: Summary & Results
Route::get('/traintrack/summaryresults', function () {
    $wizardData = [
        'user' => [
            'fullName' => session('fullName'),
            'gender' => session('gender'),
            'major' => session('major'),
        ],
        'recommended_position' => session('recommended_position'),
        'matching_companies' => session('matching_companies'),
    ];

    session(['wizard_data' => $wizardData]); // ✅ Store for PDF export
    return view('summaryresults');
})->name('traintrack.summaryresults');

// ✅ PDF Export Route
Route::get('/traintrack/pdf/download', [PdfController::class, 'download'])->name('traintrack.pdf.download');

// ✅ Fallback & Popup Views
Route::get('/fallback', fn() => view('fallback'))->name('traintrack.fallback');
Route::get('/traintrack/popup', fn() => view('popup'))->name('traintrack.popup');
Route::get('/traintrack/fallback/improve', fn() => view('fallbackimporve'))->name('traintrack.fallback.improve');

Route::get('/api/prerequisite-names', function (Request $request) {
    $type = $request->query('type');
 // Map readable types to DB values
    $map = [
        'subject' => 'Subject',
        'technical' => 'Technical Skill',
        'non-technical' => 'Non-Technical Skill',
    ];

    if (!isset($map[$type])) {
        return response()->json([], 400); // Bad Request
    }

    $results = DB::table('prerequisites')
        ->select('id', 'name') // 🔁 changed from prerequisite_name
        ->where('type', $map[$type]) // 🔁 changed from prerequisite_type
        ->get();

    return response()->json($results);
});
Route::get('/traintrack/position/{id}', function ($id) {
    return view('traintrack.position-details');
});

Route::get('/traintrack/selections', function () {
    return view('traintrack.selections');
});
