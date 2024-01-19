<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
        ], [
            'email.required' => 'Esse campo é obrigatorio.',
            'email.email' => 'este campo tem que ser um email valido.',
            'password.required' => 'Esse campo nao pode ser vazio.',
            'password.min' => 'Esse campo tem que ter no minimo :min caracteres.'
        ]);

        $credential = $request->only('email', 'password');
        $autenticated = Auth::attempt($credential);

        if (!$autenticated) {
            return redirect()->route('login')->withErrors(['error' => 'email ou senha incorretos.']);
        }

        return redirect()->route('tasks.index')->with('success', 'logged in');
    }

    public function showRegistrationForm()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5',
        ], [
            'name.required' => 'O campo name é obrigatorio',
            'email.required' => 'Esse campo é obrigatorio.',
            'email.email' => 'este campo tem que ser um email valido.',
            'password.required' => 'Esse campo nao pode ser vazio.',
            'password.min' => 'Esse campo tem que ter no minimo :min caracteres.'
        ]);
        try {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);
        } catch (\Exception $e) {
            //use isso para lançar uma expection
            return redirect()->route('login')->with('error', 'algo deu errado tente novamente mais tarde');
        }

        return redirect()->route('login')->with('success', 'usuario criado');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

