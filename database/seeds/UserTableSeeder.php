<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 1)->create();
        /*factory(App\User::class, 1)->create()->each(function ($u) {
        	$u->posts()->save(factory(App\Post::class)->make());
    	});*/

        //cnstructor usuario de renato de l 1al 6
    }
}
