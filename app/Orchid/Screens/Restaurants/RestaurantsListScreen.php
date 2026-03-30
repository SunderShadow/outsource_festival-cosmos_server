<?php

namespace App\Orchid\Screens\Restaurants;

use App\Models\Restaurant;
use App\Orchid\Layouts\Restaurants\RestaurantsListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class RestaurantsListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'restaurants' => Restaurant::paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Рестораны');
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Добавить')
                ->route('platform.restaurants.create')
                ->icon('bs.plus-circle'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            RestaurantsListLayout::class,
        ];
    }

    public function toArchive($id) {
        $news = Restaurant::whereId($id)->first();
        $news->update(['published' => false]);
        Toast::success("Ресторан \"{$news->title}\" в архиве");
    }

    public function publish($id) {
        $news = Restaurant::whereId($id)->first();
        $news->update(['published' => true]);
        Toast::success("Ресторан \"{$news->title}\" опубликован");
    }

    public function delete($id) {
        $news = Restaurant::whereId($id)->first();
        $news->delete();
        Toast::success("Ресторан \"{$news->title}\" удален");
    }
}
