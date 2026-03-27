<?php

namespace App\Orchid\Layouts\News;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Rows;

class NewsEditImagesLayout extends Rows
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
                Cropper::make('news.thumbnail_desktop')
                    ->title(__('Изображение для ПК'))
                    ->width(694)
                    ->height(982)
                    ->accept('image/*')
                    ->targetRelativeUrl(),
                Cropper::make('news.thumbnail_mobile')
                    ->title(__('Изображение - для телефонов'))
                    ->width(320)
                    ->height(286)
                    ->targetRelativeUrl()
            ])
        ];
    }
}
