<?php

namespace App\Orchid\Layouts\News;

use App\Models\News;
use App\Models\Restaurant;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class NewsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'news';

    protected function textNotFound(): string
    {
        return 'Новости не созданы';
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
            TD::make('published', __('Опубликовано'))
                ->sort()
                ->render(function (News $news) {
                    return $news->published ? __('Да') : __('Нет');
                }),
            TD::make('excerpt', __('Отрывок'))
                ->cantHide(),
            TD::make('actions', __('Действия'))
                ->width('100px')
                ->render(fn (News $news) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Link::make(__('Редактировать'))
                            ->route('platform.news.edit', $news->id)
                            ->icon('bs.pencil'),
                        Button::make($news->published ? 'В архив' : 'Опубликовать')
                            ->method($news->published ? 'toArchive' : 'publish', ['id' =>  $news->id])
                            ->icon($news->published ? 'box-arrow-down' : 'box-arrow-up'),
                        Button::make(__('Удалить'))
                            ->confirm(__("Вы точно хотите удалить \"$news->title\"?"))
                            ->method('delete', ['id' => $news->id])
                            ->icon('bs.trash')
                    ])),
        ];
    }
}
