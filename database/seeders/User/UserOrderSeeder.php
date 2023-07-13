<?php

namespace Database\Seeders\User;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        DB::table('users')->insert([
            'uuid' => "f5b2ad95-52c4-48b7-ae8e-c136796d3d63",
            'name' => "Payload Legado Pedido",
            'email' => "legadoPayload@terabyte.com.br",
            'password' => bcrypt("legado@tera2023"),
        ]);
    }
}
