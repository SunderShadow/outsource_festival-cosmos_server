<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserContest\RegisterRequest;
use App\Models\ContestUsers;
use Illuminate\Http\JsonResponse;

class ContestUserController extends Controller
{
    /**
     * Register users by uid for contest
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        ContestUsers::create($request->validated());
        return response()->json([
            'message' => 'Регистрация прошла успешно'
        ]);
    }
}
