<?php

namespace Database\Seeders\Permissions;

use App\Models\Permission\Resource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResoucesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Resource::create(['name' => 'Categorias']);
        $category->permissions()->create(['name' => 'visualizar_categorias']);
        $category->permissions()->create(['name' => 'visualizar_categoria']);
        $category->permissions()->create(['name' => 'deletar_categoria']);
        $category->permissions()->create(['name' => 'editar_categoria']);

        $company = Resource::create(['name' => 'Empresas']);
        $company->permissions()->create(['name' => 'visualizar_empresas']);
        $company->permissions()->create(['name' => 'visualizar_empresa']);
        $company->permissions()->create(['name' => 'deletar_empresa']);
        $company->permissions()->create(['name' => 'editar_empresa']);

    }
}
