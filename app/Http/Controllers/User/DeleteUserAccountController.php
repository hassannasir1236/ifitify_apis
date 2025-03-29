<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DeleteUserAccountController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if (is_null(auth()->user()->deleted_at)) {
            auth()->user()->delete();
            auth()->logout(true);
            
            return [
                'message' => 'Your Account has been deleted'
            ];
           
        }
        return [
            'message' => 'Your Account has been deleted'
        ];
    }
}
