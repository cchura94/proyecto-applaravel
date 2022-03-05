<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // registrar 2 usuarios 
        $u1 = new User;
        $u1->name = "admin";
        $u1->email = "admin@mail.com";
        $u1->password = bcrypt("admin54321");
        $u1->save();

        $u2 = new User;
        $u2->name = "user";
        $u2->email = "user@mail.com";
        $u2->password = bcrypt("user54321");
        $u2->save();
    }
}
