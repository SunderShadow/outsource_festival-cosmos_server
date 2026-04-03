<?php

namespace App\Http\Controllers;

use App\Exports\ContestUsersExport;
use App\Http\Requests\UserContest\RegisterRequest;
use App\Models\ContestUser;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Excel;

class ContestUserController extends Controller
{
    /**
     * Register users by uid for contest
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        ContestUser::create($request->validated());
        return response()->json([
            'message' => 'Регистрация прошла успешно'
        ]);
    }

    public function getXML(Excel $excel)
    {
        return $excel->download(new ContestUsersExport(), 'users.xlsx');
    }
}
