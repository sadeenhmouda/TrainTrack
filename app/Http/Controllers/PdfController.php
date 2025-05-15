<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function download()
    {
        $wizardData = session('wizard_data');

        if (!$wizardData) {
            return redirect('/traintrack/summaryresults')->with('error', 'No data available for PDF export.');
        }

        return Pdf::loadView('pdf', [
            'user' => $wizardData['user'] ?? [],
            'position' => $wizardData['recommended_position'] ?? [],
            'companies' => $wizardData['matching_companies'] ?? []
        ])->download('TrainTrack_Result.pdf');
    }
}
