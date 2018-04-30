<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          User::create([
            'name' => 'daniel',
            'email' => 'danielmboya12@gmail.com',
            'password' => bcrypt('12345678')
        ]);
    }
}
