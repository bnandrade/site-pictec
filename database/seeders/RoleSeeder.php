<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = [
            'Super.Admin',
            'Gerenciar usuários',
            'Gerenciar permissões',
            'Gerenciar roles',
            'Gerenciar setores',
            'Gerenciar avisos',
        ];
        foreach ($roles as $role) {
            $p = Role::create(['name' => $role]);
        }
        $this->command->info('Roles padrões adicionadas com sucesso!');
    }
}
