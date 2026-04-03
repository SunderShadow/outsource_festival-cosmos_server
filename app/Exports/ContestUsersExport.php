<?php

namespace App\Exports;

use App\Models\ContestUser;
use Maatwebsite\Excel\Concerns\FromCollection;

class ContestUsersExport implements FromCollection
{
    public function collection()
    {
        $users = ContestUser::with('restaurant')->get();
        $header = collect([['UID', 'ФИО', 'Телефон', 'E-mail', 'Город', 'Отзыв', 'Ресторан']]);
        $collectionUsers = $users->map(function (ContestUser $user) {
            $data = $user->toArray();
            $data['restaurant'] = $user->restaurant->title;
            unset($data['id'], $data['restaurant_id']);
            return $data;
        });

        return $header->concat($collectionUsers);
    }
}
