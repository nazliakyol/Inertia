<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use \App\Http\Controllers\Auth\LoginController;

// alternative way to use Inertia without rendering the view directly:
//Route::get('/', function () {
//    return inertia('Welcome');
//});

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    });


    Route::get('/', function () {
        return Inertia::render('Home');
    });

    Route::get('/users', function () {
        return Inertia::render('Users/Index', [
//      'time' => now()->toTimeString(),
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
    });

    Route::get('/users/create', function () {
        return Inertia::render('Users/Create');
    })->can('create', 'App\Models\User');

    Route::post('/users', function () {
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
    });

    // EDIT USER
    Route::get('/users/{user}/edit', function (User $user) {
        return Inertia::render('Users/Edit', [
            'user' => $user
        ]);
    })->can('edit', 'user');

    Route::post('/users/{user}/update', function (User $user) {
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
    });


    Route::get('/settings', function () {
//    sleep(2);
        return Inertia::render('Settings', []
        );
    });

});

