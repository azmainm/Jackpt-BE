<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class UserProfileController extends Controller
{
    /**
     * Get the authenticated User.
     */
    public function userProfile(): JsonResponse
    {
        return $this->success(data: ['data' => auth()->user()]);
    }
}
