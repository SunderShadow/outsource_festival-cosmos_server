<?php

namespace App\Orchid\Layouts\News;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class NewsSocialLinksLayout extends Rows
{
    // TODO: extract to enum
    const array Links = [
        ['name' => 'Telegram', 'type' => 'telegram'],
        ['name' => 'Instagram', 'type' => 'instagram'],
        ['name' => 'Facebook', 'type' => 'facebook'],
        ['name' => 'LinkedIn', 'type' => 'linkedin'],
        ['name' => 'Tik-Tok', 'type' => 'tiktok'],
    ];

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
        $socialList = [];

        $existTypes = array_keys($this->query['social_links']);
        foreach (self::Links as $link) {
            if (!in_array($link['type'], $existTypes)) {
                $socialList[] = Button::make($link['name'])
                    ->method('addSocialLink', ['type' => $link['type']])
                    ->icon('bs.' . $link['type']);
            }
        }

        $layout = [];

        if (count($socialList)) {
            $layout[] = DropDown::make('Добавить')
                ->icon('bs.link')
                ->list($socialList);
        }

        foreach ($this->query['social_links'] as $type => $socialLink) {
            $layout[] = Group::make([
                Input::make('news.social_links.' . $type)->title($type),
                Button::make('Удалить')
                    ->method('removeSocialLink', ['type' => $type])
            ]);
        }

        return $layout;
    }
}
