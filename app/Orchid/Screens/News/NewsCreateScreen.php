<?php

namespace App\Orchid\Screens\News;

use App\Models\News;
use App\Orchid\Layouts\News\NewsEditImagesLayout;
use App\Orchid\Layouts\News\NewsEditTextInfo;
use App\Orchid\Layouts\News\NewsSocialLinksLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout as LayoutFacade;
use Orchid\Support\Facades\Toast;

class NewsCreateScreen extends Screen
{
    public $social_links = null;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'social_links' => $this->social_links ?? $news->social_links ?? []
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Создать новость');
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Создать')
                ->method('create')
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
            LayoutFacade::block(NewsEditImagesLayout::class)
                ->title(__('Изображения'))
                ->description('Обновите изображения новости для телефонов и компьютеров'),
            LayoutFacade::block(NewsEditTextInfo::class)
                ->title(__('Текст'))
                ->description('Быстрая информация для карточки'),
            LayoutFacade::rows([
                Quill::make('news.body')
                    ->title(__('Содержание'))
                    ->required(),
            ])
        ];
    }

    public function create(Request $request)
    {
        $thumbnailMobile = $request->input('news.thumbnail_mobile');
        $thumbnailDesktop = $request->input('news.thumbnail_desktop');
        $title = $request->input('news.title');
        $excerpt = $request->input('news.excerpt');
        $body = $request->input('news.body');

        $news = News::create([
            'thumbnail_mobile' => $thumbnailMobile,
            'thumbnail_desktop' => $thumbnailDesktop,
            'title' => $title,
            'excerpt' => $excerpt,
            'body' => $body,
        ]);

        Toast::success('Создана новость');

        return redirect()->route('platform.news.edit', ['news' => $news->id]);
    }

    public function addSocialLink(string $type)
    {
        $this->social_links[$type] = '';
    }

    public function removeSocialLink(string $type)
    {
        unset($this->social_links[$type]);
    }
}
