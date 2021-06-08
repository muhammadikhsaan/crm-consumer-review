<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['name' => 'admin', 'nik'  => '11111111', 'privileges' => 'admin', 'password' => Hash::make('Ikhsan20'), 'UIC' => '', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'inputer', 'nik'  => '22222222', 'privileges' => 'inputer', 'password' => Hash::make('Ikhsan20'), 'UIC' => 'Consumer Marketing (CM)', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'verifikator', 'nik'  => '33333333', 'privileges' => 'verifikator', 'password' => Hash::make('Ikhsan20'), 'UIC' => '', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ]);

        DB::table('journey_list')->insert([
            ['journey' => 'Explore', 'UIC' => 'Consumer Marketing (CM)', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['journey' => 'Buy', 'UIC' => 'Consumer Marketing (CM)', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['journey' => 'Activate', 'UIC' => 'Regional Operation Center (ROC)', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['journey' => 'Use Indihome', 'UIC' => 'Access Management (RAM) & Regional Network Operation (RNO)', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['journey' => 'Use Internet', 'UIC' => 'Access Management (RAM) & Regional Network Operation (RNO)', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['journey' => 'Use Indihome TV', 'UIC' => 'Access Management (RAM) & Regional Network Operation (RNO)', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['journey' => 'Use Telepon', 'UIC' => 'Access Management (RAM) & Regional Network Operation (RNO)', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['journey' => 'Get Support', 'UIC' => 'Regional Operation Center (ROC)', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['journey' => 'Pay', 'UIC' => 'Payment Collection & Finance (PCF)', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['journey' => 'Terminate', 'UIC' => 'Customer Care (CC)', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        ]);
    }
}
