<?php

namespace App\Orchid\Layouts\ContestUsers;

use App\Models\ContestUser;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ContestUsersListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'users';

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
            TD::make('uid', __('ID'))
                ->cantHide(),
            TD::make('full_name', __('ФИО'))
                ->cantHide(),
            TD::make('phone', __('Телефон'))
                ->cantHide(),
            TD::make('email', __('e-mail'))
                ->cantHide(),
            TD::make('city', __('Город'))
                ->cantHide(),
            TD::make('restaurant', __('Ресторан'))
                ->cantHide()
                ->render(function (ContestUser $user) {
                    return $user->restaurant->title;
                }),
            TD::make('review', __('Отзыв'))
        ];
    }
}
