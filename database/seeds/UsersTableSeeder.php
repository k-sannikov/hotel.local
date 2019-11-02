<?php

use App\Models\User;
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
        factory(User::class, 1)->states('admin')->create();
        factory(User::class, 1)->states('user1')->create();
        factory(User::class, 1)->states('user2')->create();
    }
}
