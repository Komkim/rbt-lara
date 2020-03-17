<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        factory(\App\Author::class, 4)->create();
        factory(\App\News::class, 15)->create();
    }
}
