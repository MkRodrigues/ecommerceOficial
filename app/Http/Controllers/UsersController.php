<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProfileRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('users.index')->with('users', User::all());
    }

    public function changeAdmin(User $user)
    {
        // Se o usuário recebido em parâmetro for admin, será tranformado em usuário, senão o contrário
        if ($user->isAdmin()) {
            $user->role = 'user';
        } else {
            $user->role = 'admin';
        }
        $user->save();
        session()->flash('success', 'Usuário alterado com sucesso!');
        return redirect()->back();
    }

    // Possibilita que o usuário possa editar seu próprio perfil
    public function edit()
    {
        // Só passa para a view o Id do usuário que está autenticado, evitando que um usuário acesse o usuário de outro
        return view('users.edit')->with('user', auth()->user());
    }

    public function update(EditProfileRequest $request)
    {
        // Pega o usuário autenticado
        $user = auth()->user();
        $user->name = $request->name;

        if ($user->email != $request->email) {
            $user->email = $request->email;
            $user->email_verified_at = null;
        }

        if ($request->password) {
            // Transforma a senha atual em Hash
            $user->password = Hash::make($request->password);
        }

        $user->save();
        session()->flash('success', 'Usuário alterado com sucesso');
        return redirect()->back();
    }
}
