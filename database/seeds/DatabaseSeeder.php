<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Author::class, 4)->create();
        factory(\App\News::class, 15)->create();
        // $this->call(UsersTableSeeder::class);
    }
}
