<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Ibec\Acl\User::class, 1)->create();
//        factory(User::class, 1)->create();
        // $this->call(UsersTableSeeder::class);
    }
}
