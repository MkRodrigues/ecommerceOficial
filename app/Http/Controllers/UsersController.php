<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
}
