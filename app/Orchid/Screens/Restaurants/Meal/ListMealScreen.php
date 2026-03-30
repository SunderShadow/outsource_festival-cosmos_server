<?php

namespace App\Orchid\Screens\Restaurants\Meal;

use App\Models\Meal;
use App\Models\Restaurant;
use App\Orchid\Layouts\Restaurants\Meal\MealListLayout;
use App\Orchid\Layouts\Restaurants\RestaurantNavigation;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class ListMealScreen extends Screen
{
    /** @var Restaurant */
    public $restaurant;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Restaurant $restaurant): iterable
    {
        return [
            'restaurant' => $restaurant,
            'meals' => $restaurant->meals
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Cеты ресторана') . " \"{$this->restaurant->title}\"";
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Добавить')
                ->route('platform.restaurants.meal.create', ['restaurant' => $this->restaurant->id])
                ->icon('plus-circle'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            RestaurantNavigation::class,
            MealListLayout::class,
        ];
    }


    public function delete($id) {
        $meal = Meal::whereId($id)->first();
        $meal->delete();

        Toast::success("Сет \"{$meal->title}\" удален");
    }

    public function create(Request $request)
    {
        Restaurant::update([
            // Thumbnail
            'thumbnail_mobile' => $request->input('restaurant.thumbnail_mobile'),
            'thumbnail_desktop' => $request->input('restaurant.thumbnail_desktop'),

            // Main info
            'title' => $request->input('restaurant.title'),
            'phone' => $request->input('restaurant.phone'),
            'map_link' => $request->input('restaurant.map_link'),
            'external_website_link' => $request->input('restaurant.map_link'),
            'description' => $request->input('restaurant.description'),

            // Worktime
            'open_time' => $request->input('restaurant.open_time'),
            'close_time' => $request->input('restaurant.close_time'),

            // Rating
            'rating_atmosphere' => $request->input('restaurant.rating_atmosphere'),
            'rating_taste' => $request->input('restaurant.rating_taste'),
            'rating_serving' => $request->input('restaurant.rating_serving'),
            'rating_service' => $request->input('restaurant.rating_service'),
        ]);

        Toast::success('Создан ресторан');
    }
}
