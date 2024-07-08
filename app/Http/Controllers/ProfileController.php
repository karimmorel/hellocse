<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function list(Request $request): JsonResponse
    {
        // Hide status if not authenticated or if user doesn't have read access
        if (!Auth::guard('sanctum')->check() || false === Auth::guard('sanctum')->user()->tokenCan('read')) {
            return response()->json(Profile::where('status', 1)->get()->makeHidden('status'));
        }

        return response()->json(Profile::where('status', 1)->get());
    }
}
