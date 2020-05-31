<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Retorna o primeiro registro que encontrar com o parametro email
        $user = User::where('email', 'admin@admin.com')->first();

        // Se o usuário acima não for encontrado, será criado um usuário
        if (!$user) {
            User::create([
                'name' => 'Mikael Assis Silva',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin1234'),
                'role' => 'admin'
            ]);
        } else {
            // Se houver o usuário criado e este não for admin, será transformado em admin, se já estiver como admin, nada será feito
            if ($user->role != 'admin') {
                $user->role = 'admin';
                $user->save();
            }
        }
    }
}
