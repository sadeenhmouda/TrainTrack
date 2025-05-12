<?php
use Illuminate\Support\Facades\Route;use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
});

Route::get('/traintrack/start', function () {
    return view('traintrack');
})->name('traintrack.start'); // step0
 
Route::get('/traintrack', function () {
    return view('traintrack');
})->name('traintrack');  // step1

Route::get('/traintrack/subject', function () {
    return view('subject');
})->name('traintrack.subject');  // step2


Route::get('/traintrack/subject2', function () {
    return view('subject2');
})->name('traintrack.subject2'); // step2/2

                  // step3
use App\Http\Controllers\WizardController;

Route::post('/wizard/save-subject-categories', [WizardController::class, 'saveSubjectCategories'])->name('wizard.save.subjects');

Route::get('/traintrack/technical', function () {
    return view('technical');  
})->name('traintrack.technical');
 // Step 3



Route::get('/traintrack/nontechnical', function () {
    return view('nontechnical');
})->name('traintrack.nontechnical'); // step4

Route::get('/traintrack/advancepreferences', function () {
    return view('advancepreferences');
})->name('traintrack.advancepreferences');
// step5

Route::get('/traintrack/summaryresults', function () {
    return view('summaryresults'); 
})->name('traintrack.summaryresults');
 // step6
 
 Route::get('/fallback', function () {
    return view('fallback');
})->name('traintrack.fallback');

Route::get('/traintrack/popup', function () {
    return view('popup');
})->name('traintrack.popup');

Route::get('/traintrack/fallback/improve', function () {
    return view('fallbackimporve');
})->name('traintrack.fallback.improve');



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
