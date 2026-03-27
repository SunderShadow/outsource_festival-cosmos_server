<?php

use App\Models\News;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Route;

Route::get('/restaurants', function () {
    return response()->json(Restaurant::wherePublished(true)->get());
});

Route::get('/restaurants/search/{query}', function (string $query) {
    return response()->json(Restaurant::wherePublished(true)->whereLike('title', "%$query%")->get());
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
