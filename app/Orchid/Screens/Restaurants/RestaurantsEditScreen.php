<?php

namespace App\Orchid\Screens\Restaurants;

use App\Models\Restaurant;
use App\Orchid\Layouts\Restaurants\RestaurantNavigation;
use App\Orchid\Layouts\Restaurants\RestaurantsEditImagesLayout;
use App\Orchid\Layouts\Restaurants\RestaurantsEditRatingInfo;
use App\Orchid\Layouts\Restaurants\RestaurantsEditTextInfo;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout as LayoutFacade;
use Orchid\Support\Facades\Toast;

class RestaurantsEditScreen extends Screen
{
    /** @var Restaurant */
    public $restaurant;

    /** @var string */
    public $subpath;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Restaurant $restaurant): iterable
    {
        return [
            'restaurant' => $restaurant
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Редактировать ресторан') . " \"{$this->restaurant->title}\"";
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {

        return [
            Button::make($this->restaurant->published ? 'В архив' : 'Опубликовать')
                ->method($this->restaurant->published ? 'toArchive' : 'publish')
                ->icon($this->restaurant->published ? 'box-arrow-down' : 'box-arrow-up'),
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
            LayoutFacade::block(RestaurantsEditImagesLayout::class)
                ->title(__('Изображения'))
                ->description('Обновите изображения новости для телефонов и компьютеров')
                ->commands([
                    Button::make('Сохранить')
                        ->icon('check-circle')
                        ->type(Color::BASIC)
                        ->method('saveImages')
                ]),
            LayoutFacade::block(RestaurantsEditTextInfo::class)
                ->title(__('Основная информация'))
                ->commands([
                    Button::make('Сохранить')
                        ->icon('check-circle')
                        ->type(Color::BASIC)
                        ->method('saveMainInfo')
                ]),
            LayoutFacade::block(RestaurantsEditRatingInfo::class)
                ->title(__('Рейтинг'))
                ->description('Необязательно к заполнению')
                ->commands([
                    Button::make('Сохранить')
                        ->icon('check-circle')
                        ->type(Color::BASIC)
                        ->method('saveRating')
                ]),
        ];
    }

    public function publish()
    {
        $this->restaurant->update([
            'published' => true
        ]);

        Toast::success('Опубликовано');
    }

    public function toArchive() {
        $this->restaurant->update([
            'published' => false
        ]);

        Toast::success('В архиве');
    }

    public function saveImages(Request $request)
    {
        $this->restaurant->update([
            // Thumbnail
            'thumbnail_mobile' => $request->input('restaurant.thumbnail_mobile'),
            'thumbnail_desktop' => $request->input('restaurant.thumbnail_desktop'),
            'thumbnail_card' => $request->input('restaurant.thumbnail_card'),
            'thumbnail_chef' => $request->input('restaurant.thumbnail_chef'),
        ]);

        Toast::success('Изображения сохранены');
    }

    public function saveMainInfo(Request $request)
    {
        $this->restaurant->update([
            // Main info
            'title' => $request->input('restaurant.title'),
            'phone' => $request->input('restaurant.phone'),
            'chef_name' => $request->input('restaurant.chef_name'),
            'min_cost' => $request->input('restaurant.min_cost'),
            'map_link' => $request->input('restaurant.map_link'),
            'location' => $request->input('restaurant.location'),
            'city' => $request->input('restaurant.city'),
            'external_website_link' => $request->input('restaurant.external_website_link'),
            'description' => $request->input('restaurant.description'),

            // Worktime
            'open_time' => $request->input('restaurant.open_time'),
            'close_time' => $request->input('restaurant.close_time'),
        ]);

        Toast::success('Основная информация сохранена');
    }

    public function saveRating(Request $request)
    {
        $this->restaurant->update([
            // Rating
            'rating_atmosphere' => $request->input('restaurant.rating_atmosphere'),
            'rating_taste' => $request->input('restaurant.rating_taste'),
            'rating_serving' => $request->input('restaurant.rating_serving'),
            'rating_service' => $request->input('restaurant.rating_service'),
        ]);

        Toast::success('Рейтинг сохранен');
    }
}
