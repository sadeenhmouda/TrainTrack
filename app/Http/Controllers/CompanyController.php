<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CompanyController extends Controller
{
    public function show($id)
    {
        $response = Http::withoutVerifying()->get("https://train-track-backend.onrender.com/company/$id");

        if (!$response->ok()) {
            abort(404, 'Company not found');
        }

        $company = $response->json()['company'];

        return view('traintrack.companydetails', compact('company'));
    }
}
