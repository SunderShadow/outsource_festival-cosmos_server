<?php

namespace App\Orchid\Layouts\Restaurants;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class RestaurantsEditTextInfo extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('restaurant.city')
                ->placeholder(__(''))
                ->title(__('Город')),
            Input::make('restaurant.title')
                ->placeholder(__(''))
                ->required()
                ->title(__('Название')),
            Input::make('restaurant.chef_name')
                ->title(__('Шеф-повар')),
            Input::make('restaurant.min_cost')
                ->title(__('Минимальный ценник')),
            Group::make([
                Input::make('restaurant.phone')
                    ->title(__('Телефон'))
                    ->maxLength(255),
                Input::make('restaurant.location')
                    ->title(__('Местоположение'))
                    ->maxLength(255),
            ]),
            Group::make([
                Input::make('restaurant.external_website_link')
                    ->title(__('Ссылка на внешний сайт')),
                Input::make('restaurant.map_link')
                    ->title(__('Ссылка на адрес на карте'))
                    ->maxLength(255),
            ]),
            Group::make([
                DateTimer::make('restaurant.open_time')
                    ->title(__('Открыто с'))
                    ->noCalendar()
                    ->enableTime()
                    ->format24hr()
                    ->format('H:i'),
                DateTimer::make('restaurant.close_time')
                    ->title(__('До'))
                    ->noCalendar()
                    ->enableTime()
                    ->format24hr()
                    ->format('H:i')
            ]),
            TextArea::make('restaurant.description')
                ->title(__('Описание'))
                ->rows(8)
        ];
    }
}
