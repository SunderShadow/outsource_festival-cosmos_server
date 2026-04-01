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
use Orchid\Support\Facades\Toast;

class CreateMealScreen extends Screen
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
        return __("Создать сет (Ресторан \"{$this->restaurant->title}\")");
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

            Button::make('Добавить')
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

    public function add(Request $request)
    {
        $meal = $this->restaurant->meals()->create([
            'thumbnail' => $request->input('meal.thumbnail'),
            'card_thumbnail' => $request->input('meal.card_thumbnail'),
            'name' => $request->input('meal.name'),
            'chef_name' => $request->input('meal.chef_name'),
            'cost' => $request->input('meal.cost'),
            'description' => $request->input('meal.description'),
        ]);

        Toast::success(__('Успешно создан сет'));
        return redirect()->route('platform.restaurants.meal.edit', ['restaurant' => $this->restaurant->id, 'meal' => $meal->id]);
    }
}
