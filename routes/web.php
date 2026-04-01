<?php

use App\Models\News;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Route;

Route::get('/restaurants', function () {
    return response()->json(
        Restaurant::query()
        ->select(['slug', 'min_cost', 'thumbnail_card', 'location', 'title', 'city'])
        ->wherePublished(true)
        ->get()
        ->makeHidden([
            'rating',
            'working_time'
        ])
    );
});

Route::get('/restaurants/cities', function () {
    return response()->json(Restaurant::wherePublished(true)->where('city', '!=', 'null')->get(['city'])->collect()->unique('city')->pluck('city'));
});



Route::get('/restaurants/{restaurant}', function (string $restaurant) {
    return response()->json(Restaurant::with('meals')->published()->whereSlug($restaurant)->firstOrFail());
});

Route::get('/news', function () {
    return response()->json(News::wherePublished(true)->get());
});

Route::get('/news/{news}', function (string $news) {
    return response()->json(News::whereSlug($news)->published()->firstOrFail());
});
