<?php

namespace App\Orchid\Layouts\Restaurants;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Rows;

class RestaurantsEditImagesLayout extends Rows
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
            Group::make([
                Cropper::make('restaurant.thumbnail_mobile')
                    ->title(__('Изображение - для телефонов'))
                    ->width(346)
                    ->height(472)
                    ->targetRelativeUrl(),
                Cropper::make('restaurant.thumbnail_card')
                    ->title(__('Изображение - для карточки'))
                    ->width(145)
                    ->height(154)
                    ->targetRelativeUrl()
            ]),
            Cropper::make('restaurant.thumbnail_desktop')
                ->title(__('Изображение для ПК'))
                ->width(617)
                ->height(793)
                ->accept('image/*')
                ->targetRelativeUrl(),
        ];
    }
}
