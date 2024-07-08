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

    public function create(StoreProfileRequest $request): JsonResponse
    {
        $request->validate($request->rules());
        $profile = Profile::create($request->validated());
        $profile->updateProfileImage($request->file('image'));

        return response()->json($profile, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $rules = array_intersect_key((new StoreProfileRequest())->rules(), $request->all());
        $request->validate($rules);
        $profile = Profile::findOrFail($id);
        $profile->update($request->all());

        if ($request->file('image')) {
            $profile->updateProfileImage($request->file('image'));
        }

        return response()->json($profile);
    }

    public function delete(Request $request, int $id): JsonResponse
    {
        $profile = Profile::findOrFail($id);
        $profile->deleteProfileImage();
        $profile->delete();

        return response()->json(null, 204);
    }
}
