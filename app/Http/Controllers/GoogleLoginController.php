<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class GoogleLoginController extends Controller
{
    public function handle(Request $request)
    {
        // ✅ Parse JSON payload
        $payload = json_decode($request->getContent(), true);
        $token = $payload['credential'] ?? null;

        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Missing credential'
            ], 400);
        }

        // ✅ Verify token with Google
        $response = Http::get('https://oauth2.googleapis.com/tokeninfo', [
            'id_token' => $token,
        ]);

        if (!$response->ok()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid token'
            ], 401);
        }

        $googleData = $response->json();

        // ✅ Create or update user in database
        $user = User::updateOrCreate(
            ['email' => $googleData['email']],
            [
                'full_name' => $googleData['name'] ?? 'No Name', // ✅ fixed field
                'google_id' => $googleData['sub'],
                'avatar' => $googleData['picture'] ?? null,
            ]
        );

        Auth::login($user);

        // ✅ Store data in session
        session([
            'fullName' => $user->full_name,
            'email' => $user->email,
            'avatar' => $user->avatar,
        ]);

        // ✅ Success response
        return response()->json([
            'success' => true,
            'message' => 'Google login successful',
            'redirect_url' => '/profile'
        ]);
    }
}
