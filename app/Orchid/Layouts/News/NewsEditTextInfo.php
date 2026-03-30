<?php

namespace App\Orchid\Layouts\News;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class NewsEditTextInfo extends Rows
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
            Input::make('news.title')->required()->title(__('Заголовок')),
            TextArea::make('news.excerpt')
                ->title(__('Отрывок'))
                ->help('Короткий текст на карточке новости')
                ->maxLength(255)
                ->rows(3)
                ->required()
        ];
    }
}
