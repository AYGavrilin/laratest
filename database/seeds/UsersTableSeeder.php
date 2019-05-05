<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'     => 'Автор № 1',
                'email'    => 'autor1@mail.ru',
                'password' => bcrypt(123321),
            ],
            [
                'name'     => 'Автор № 2',
                'email'    => 'autor2@mail.ru',
                'password' => bcrypt(123321),
            ],
        ];

        DB::table('users')->insert($data);
    }
}
