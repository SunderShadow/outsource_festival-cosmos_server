<?php

namespace App\Orchid\Layouts\Restaurants;

use App\Models\News;
use App\Models\Restaurant;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class RestaurantsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'restaurants';

    protected function textNotFound(): string
    {
        return 'Рестораны не созданы';
    }

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title', __('Заголвок'))
                ->cantHide(),
            TD::make('phone', __('Телефон'))
                ->cantHide(),
            TD::make('published', __('Опубликовано'))
                ->sort()
                ->render(function (Restaurant $restaurant) {
                    return $restaurant->published ? __('Да') : __('Нет');
                }),
            TD::make('rating_atmosphere', __('Атомосфера'))
                ->sort(),
            TD::make('rating_taste', __('Вкус'))
                ->sort(),
            TD::make('rating_serving', __('Подача'))
                ->sort()
                ->defaultHidden(),
            TD::make('rating_service', __('Обслуживание'))
                ->sort()
                ->defaultHidden(),
            TD::make('actions', __('Действия'))
                ->width('100px')
                ->render(fn (Restaurant $restaurant) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Link::make(__('Редактировать'))
                            ->route('platform.restaurants.edit', $restaurant->id)
                            ->icon('bs.pencil'),
                        Button::make($restaurant->published ? 'В архив' : 'Опубликовать')
                            ->method($restaurant->published ? 'toArchive' : 'publish', ['id' =>  $restaurant->id])
                            ->icon($restaurant->published ? 'box-arrow-down' : 'box-arrow-up'),
                        Button::make(__('Удалить'))
                            ->confirm(__("Вы точно хотите удалить \"$restaurant->title\"?"))
                            ->method('delete', ['id' => $restaurant->id])
                            ->icon('bs.trash')
                    ])),
        ];
    }
}
