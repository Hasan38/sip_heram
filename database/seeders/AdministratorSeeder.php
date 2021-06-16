<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $administrator = new \App\Models\User;
        $administrator->username = "administrator";
        $administrator->nip = "NIP0000000001";
        $administrator->phone= "082298026952";
        $administrator->name = "Site Administrator";
        $administrator->email = "admin@sip.com";
        $administrator->roles = "ADMIN";
        $administrator->password = \Hash::make("hasan");
        $administrator->avatar = "saat-ini-tidak-ada-file.png";
        $administrator->address = "BTN Matoa Sentani";
        $administrator->save();
        $this->command->info("User Admin berhasil diinsert");
        $administrator->assignRole('ADMIN');
    }
}
