<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::create([
            'name'=>'Admin',
            'guard_name'=>'web'
        ]);
        Role::create([
            'name'=>'Petugas Pendaftaran',
            'guard_name'=>'web'
        ]);
        Role::create([
            'name'=>'Petugas Loket',
            'guard_name'=>'web'
        ]);
        Role::create([
            'name'=>'Koordinator Pelayanan',
            'guard_name'=>'web'
        ]);
        Role::create([
            'name'=>'Petugas survey',
            'guard_name'=>'web'
        ]);
        Role::create([
            'name'=>'Kasi Pelayanan Umum',
            'guard_name'=>'web'
        ]);
        Role::create([
            'name'=>'Kasi Pemberdayaan Masyarakat',
            'guard_name'=>'web'
        ]);
        Role::create([
            'name'=>'Kasi Tata Pemerintahan',
            'guard_name'=>'web'
        ]);
        Role::create([
            'name'=>'Kepala Distrik',
            'guard_name'=>'web'
        ]);


    }
}
