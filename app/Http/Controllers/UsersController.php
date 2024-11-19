<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UsersController extends Controller {

    public function index(){
        return Inertia::render('Users/Index', [
            'users' => \App\Models\User::query()
                ->when(\Illuminate\Support\Facades\Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->paginate(10)
                ->withQueryString()
                ->through(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'can' => [
                            'edit' => Auth::user()->can('edit', $user),
                        ],
                    ];
                }),
            'filters' => \Illuminate\Support\Facades\Request::only(['search']),
            'can' => [
                'createUser' => Auth::user()->can('create', User::class)
            ],
        ]);
    }

    public function create(){
        return Inertia::render('Users/Create');
    }

    public function show(User $user) {
        return Inertia::render('Users/Show', [
            'user' => $user->only(['id', 'name', 'email', 'created_at']),
        ]);
    }

    public function store(User $user){
        // validate the request
        $attributes = \Illuminate\Support\Facades\Request::validate(
            [
                'name' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

        // create the user
        User::create($attributes);

        // redirect
        return redirect('/users');
    }

    public function edit(User $user){
        return Inertia::render('Users/Edit', [
            'user' => $user->only(['id', 'name', 'email']),
        ]);
    }

    public function update(User $user){
        // validate the request
        $attributes = \Illuminate\Support\Facades\Request::validate(
            [
                // removed required cause if not changed the old value will be used
                'name' => ['string'],
                'email' => ['email'],
                'password' => ['nullable', 'string'],
            ]);

        // edit the user
        if (isset($attributes['password'])) {
            $attributes['password'] = bcrypt($attributes['password']);
        } else {
            unset($attributes['password']);
        }

        $user->update($attributes);

        // redirect
        return redirect('/users');
    }
}
