<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WizardController extends Controller
{
    // 👣 STEP 3 View
    public function showTechnicalSkills()
    {
        return view('technical');
    }

    // 👣 STEP 2 Save subject categories into session
    public function saveSubjectCategories(Request $request)
    {
        // Get the selected category IDs from the form input
        $categoryIds = $request->input('category_ids'); // e.g. [11, 13, 17]

        // Save them into Laravel session
        session(['selected_category_ids' => $categoryIds]);

        // Redirect to Step 3: Technical Skills page
        return redirect()->route('traintrack.technical');
    }
}

