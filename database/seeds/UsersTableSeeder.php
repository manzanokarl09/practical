<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        User::truncate();

        $data = [
            [ "email" => "test@test.com", "password" => Hash::make('asdfasdf') ],
        ];

        User::insert($data);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
