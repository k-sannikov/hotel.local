<?php

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Settings::class, 1)->states('room_4')->create();
        factory(Settings::class, 1)->states('room_2')->create();
        factory(Settings::class, 1)->states('room_vip')->create();
        factory(Settings::class, 1)->states('breakfast')->create();
        factory(Settings::class, 1)->states('dry_cleaning')->create();
        factory(Settings::class, 1)->states('yoshkin_Hedgehog')->create();
        factory(Settings::class, 1)->states('volga_cat')->create();
        factory(Settings::class, 1)->states('max_discount')->create();
        factory(Settings::class, 1)->states('min_discount')->create();
    }
}
