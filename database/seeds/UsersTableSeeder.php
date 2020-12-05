<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Role::create(['name' => 'admin', 'description' => 'Admin']);
		Role::create(['name' => 'verifikator', 'description' => 'Verifikator']);
		Role::create(['name' => 'peserta', 'description' => 'Peserta']);

		User::create([
            'name'    => 'Admin',
            'username'=> 'admin',
            'email'   => 'admin@gmail.com',
            'password'=> Hash::make('admin'),
        ])->assignRole('admin');
    }
}
