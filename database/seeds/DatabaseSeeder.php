<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        factory(App\User::class, 10)->create()->each(function($user){

            //$user->posts()->save(factory(App\Post::class)->make());
            $user->save();
        });

        $user = new User([        'name' => 'test',
            'email' => 'test@test.com',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => str_random(10),
            'is_active'=>1,
            'role_id'=>1,]);
        $user->save();

        // $this->call(UsersTableSeeder::class);
    }
}
