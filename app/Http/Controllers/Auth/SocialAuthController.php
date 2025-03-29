<?php

namespace App\Http\Controllers\Auth;

use App\Actions\User\GetUserByEmailAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\SocialAuthRequest;
use App\Models\User;
use Illuminate\Support\Str;
use Google\Client;

class SocialAuthController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        SocialAuthRequest $request,
        GetUserByEmailAction $getUserByEmailAction
    ) {

        $validated = $request->validated();

        $provider = $validated['provider'];
        $token = $validated['token'];

        switch ($provider) {
            case 'google':
                $userSocial = $this->verifyGoogleToken($token);
                break;
            case 'apple':
                $userSocial = $this->verifyAppleToken($token);
                break;
            default:
                return response()->json(['error' => 'Provider not supported'], 422);
        }

        if (!$userSocial) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        $user = User::firstOrCreate(
            ['email' => $userSocial['email']],
            [
                'password' => bcrypt(Str::random(24)),
                "first_name"=> $userSocial['given_name'],
                'last_name' => $userSocial['family_name']
            ]
        );

        $loginToken = $user->createToken('authToken')->plainTextToken;

        return response()->json(['token' => $loginToken], 200);
    }


    private function verifyGoogleToken($token) : array | null
    {
        $client = new Client(['client_id' => env('GOOGLE_CLIENT_ID')]);
        $payload = $client->verifyIdToken($token);

        if ($payload) {
            return ['name' => $payload['name'], 'email' => $payload['email']];
        }
        return null;

    }

    private function verifyAppleToken($token) : array | null
    {
        $client = new Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]);
        $payload = $client->verifyIdToken($token);

        if ($payload) {
            return ['name' => $payload['name'], 'email' => $payload['email']];
        }
        return null;

    }
}
