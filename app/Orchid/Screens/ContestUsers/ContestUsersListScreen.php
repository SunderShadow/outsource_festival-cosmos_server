<?php

namespace App\Orchid\Screens\ContestUsers;

use App\Models\ContestUser;
use App\Orchid\Layouts\ContestUsers\ContestUsersListLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;

class ContestUsersListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'users' => ContestUser::paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Рестораны');
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Выгрузка XML')
                ->route('contest-users.get-xml')
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
            ContestUsersListLayout::class,
        ];
    }

    public function getXML()
    {
        return response()->json(['da']);
    }
}
