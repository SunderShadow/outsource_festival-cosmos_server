<?php

namespace App\Orchid\Screens\News;

use App\Models\News;
use App\Orchid\Layouts\News\NewsListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class NewsListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'news' => News::paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Новости');
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
                ->route('platform.news.create')
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
            NewsListLayout::class,
        ];
    }

    public function toArchive($id) {
        $news = News::whereId($id)->first();
        $news->update(['published' => false]);
        Toast::success("Новость \"{$news->title}\" в архиве");
    }

    public function publish($id) {
        $news = News::whereId($id)->first();
        $news->update(['published' => true]);
        Toast::success("Новость \"{$news->title}\" опубликована");
    }

    public function delete($id) {
        $news = News::whereId($id)->first();
        $news->delete();
        Toast::success("Новость \"{$news->title}\" удалена");
    }
}
