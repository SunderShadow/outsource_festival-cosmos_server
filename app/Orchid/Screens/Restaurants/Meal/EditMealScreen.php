<?php

namespace App\Orchid\Screens\Restaurants\Meal;

use App\Models\Meal;
use App\Models\Restaurant;
use App\Orchid\Layouts\Restaurants\Meal\MealEditDescription;
use App\Orchid\Layouts\Restaurants\Meal\MealEditImageLayout;
use App\Orchid\Layouts\Restaurants\Meal\MealEditTextLayout;
use App\Orchid\Layouts\Restaurants\RestaurantNavigation;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Toast;

class EditMealScreen extends Screen
{
    /** @var Restaurant */
    public $restaurant;

    /** @var Meal */
    public $meal;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Restaurant $restaurant, Meal $meal): iterable
    {
        return [
            'restaurant' => $restaurant,
            'meal' => $meal
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __("Редактировать сет (Ресторан \"{$this->restaurant->title}\")");
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('К сетам')
                ->route('platform.restaurants.meal', ['restaurant' => $this->restaurant])
                ->icon('arrow-left'),

            Button::make('Сохранить')
                ->method('add')
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
            \Orchid\Support\Facades\Layout::columns([
                MealEditImageLayout::class,
                MealEditTextLayout::class,
            ]),
            MealEditDescription::class
        ];
    }

    public function add(Request $request): void
    {
        $this->meal->update([
            'thumbnail' => $request->input('meal.thumbnail'),
            'name' => $request->input('meal.name'),
            'chef_name' => $request->input('meal.chef_name'),
            'card_thumbnail' => $request->input('meal.card_thumbnail'),
            'cost' => $request->input('meal.cost'),
            'description' => $request->input('meal.description'),
        ]);

        Toast::success(__('Успешно создан сет'));
    }
}
