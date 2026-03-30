<?php

namespace App\Orchid\Layouts\Restaurants\Meal;

use App\Models\Meal;
use App\Models\News;
use App\Models\Restaurant;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class MealListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'meals';

    protected function textNotFound(): string
    {
        return 'Сеты не созданы';
    }

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', __('Заголвок'))
                ->cantHide(),
            TD::make('cost', __('Стоимость'))
                ->sort(),
            TD::make('actions', __('Действия'))
                ->width('100px')
                ->render(fn (Meal $meal) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Link::make(__('Редактировать'))
                            ->route('platform.restaurants.meal.edit', ['restaurant' => $this->query['restaurant'], 'meal' => $meal->id])
                            ->icon('bs.pencil'),
                        Button::make(__('Удалить'))
                            ->method('delete', ['id' => $meal->id])
                            ->icon('bs.trash')
                    ])),
        ];
    }
}
