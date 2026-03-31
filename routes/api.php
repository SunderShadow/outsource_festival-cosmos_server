<?php

use App\Http\Controllers\ContestUserController;
use App\Models\Restaurant;

Route::post('/contest/register', [ContestUserController::class, 'register']);
Route::get('/restaurants/id-names', function () {
    return Restaurant::all(['id', 'title']);
});

Route::get('/restaurants/id-names', function () {
    return response()->json(Restaurant::wherePublished(true)
        ->select(['id', 'title'])
        ->get()
        ->makeHidden([
            'rating',
            'working_time',
            'thumbnails'
        ])
    );
});

Route::get('/restaurants/search', function () {
    $requestBuilder = Restaurant::wherePublished(true);
    if (request()->get('title')) {
        $requestBuilder->where('title', 'like', '%' . request()->get('title') . '%');
    }

//    if (request()->get('cost')) {
//        $requestBuilder->where('cost', 'like', '%' . request()->get('cost') . '%');
//    }

    if (request()->get('city')) {
        $requestBuilder->where('city', request()->get('city'));
    }

    return response()->json($requestBuilder->get());
});
