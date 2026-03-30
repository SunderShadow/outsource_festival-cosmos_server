<?php

namespace App\Orchid\Screens\Restaurants;

use App\Models\Restaurant;
use App\Orchid\Layouts\Restaurants\RestaurantsEditImagesLayout;
use App\Orchid\Layouts\Restaurants\RestaurantsEditRatingInfo;
use App\Orchid\Layouts\Restaurants\RestaurantsEditTextInfo;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout as LayoutFacade;
use Orchid\Support\Facades\Toast;

class RestaurantsCreateScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Создать ресторан');
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Создать')
                ->method('create')
                ->icon('check-circle'),
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
            LayoutFacade::block(RestaurantsEditImagesLayout::class)
                ->title(__('Изображения'))
                ->description('Обновите изображения новости для телефонов и компьютеров'),
            LayoutFacade::block(RestaurantsEditTextInfo::class)
                ->title(__('Основная информация')),
            LayoutFacade::block(RestaurantsEditRatingInfo::class)
                ->title(__('Рейтинг'))
                ->description('Необязательно к заполнению')
        ];
    }

    public function create(Request $request)
    {
        $restaurant = Restaurant::create([
            // Thumbnail
            'thumbnail_mobile' => $request->input('restaurant.thumbnail_mobile'),
            'thumbnail_desktop' => $request->input('restaurant.thumbnail_desktop'),
            'thumbnail_card' => $request->input('restaurant.thumbnail_card'),

            // Main info
            'title' => $request->input('restaurant.title'),
            'phone' => $request->input('restaurant.phone'),
            'min_cost' => $request->input('restaurant.min_cost'),
            'location' => $request->input('restaurant.location'),
            'chef_name' => $request->input('restaurant.chef_name'),
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

        return redirect()->route('platform.restaurants.edit', ['restaurant' => $restaurant->id]);
    }
}
