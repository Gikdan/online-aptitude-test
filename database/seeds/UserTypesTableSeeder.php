<?php

use Illuminate\Database\Seeder;
use App\Models\UserType;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          UserType::create([
            'name' => 'ADMIN'
        ]);
          UserType::create([
            'name' => 'APPLICANT'
        ]);
    }
}
