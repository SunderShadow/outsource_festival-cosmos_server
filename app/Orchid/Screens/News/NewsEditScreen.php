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
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout as LayoutFacade;
use Orchid\Support\Facades\Toast;

class NewsEditScreen extends Screen
{
    /**
     * @var News
     */
    public $news;

    public $social_links = null;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(News $news): iterable
    {
        return [
            'news' => $news,
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
        return __('Редактировать новость');
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make($this->news->published ? 'В архив' : 'Опубликовать')
                ->method($this->news->published ? 'toArchive' : 'publish')
                ->icon($this->news->published ? 'box-arrow-down' : 'box-arrow-up'),
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
                ->description('Обновите изображения новости для телефонов и компьютеров')
                ->commands([
                    Button::make('Сохранить')
                        ->icon('check-circle')
                        ->type(Color::BASIC)
                        ->method('saveImages')
                ]),
            LayoutFacade::block(NewsEditTextInfo::class)
                ->title(__('Текст'))
                ->description('Быстрая информация для карточки')
                ->commands([
                    Button::make('Сохранить')
                        ->icon('check-circle')
                        ->type(Color::BASIC)
                        ->method('saveText')
                ]),
            LayoutFacade::block(NewsSocialLinksLayout::class)
                ->title(__('Социальные сети'))
                ->commands([
                    Button::make('Сохранить')
                        ->icon('check-circle')
                        ->type(Color::BASIC)
                        ->method('saveSocialLinks')
                ]),
            LayoutFacade::rows([
                Quill::make('news.body')
                    ->title(__('Содержание'))
                    ->required(),
                Button::make('Сохранить')
                    ->icon('check-circle')
                    ->type(Color::BASIC)
                    ->method('saveDescription')
            ])
        ];
    }

    public function publish()
    {
        $this->news->update([
            'published' => true
        ]);
        Toast::success('Опубликовано');
    }

    public function toArchive() {
        $this->news->update([
            'published' => false
        ]);
        Toast::success('В архиве');
    }

    public function saveImages(Request $request)
    {
        $this->news->update([
            'thumbnail_desktop' => $request->input('news.thumbnail_desktop'),
            'thumbnail_mobile' => $request->input('news.thumbnail_mobile')
        ]);

        Toast::success('Изображения сохранены');
    }

    public function saveText(Request $request)
    {
        $this->news->update([
            'title' => $request->input('news.title'),
            'excerpt' => $request->input('news.excerpt')
        ]);

        Toast::success('Текст сохранен');
    }

    public function saveDescription(Request $request)
    {
        $this->news->update([
            'body' => $request->input('news.body')
        ]);

        Toast::success('Описание сохранено');
    }

    public function addSocialLink(string $type)
    {
        $this->social_links[$type] = '';
    }

    public function removeSocialLink(string $type)
    {
         unset($this->social_links[$type]);
    }

    public function saveSocialLinks(Request $request)
    {
        $this->news->update([
            'social_links' => $request->input('news.social_links'),
        ]);

        Toast::success('Текст сохранен');
    }
}
