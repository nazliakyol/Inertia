<?php

namespace App\Http\Middleware;

use App\Http\Resources\ThreadResource;
use App\Models\Thread;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
           'auth' => Auth()->user ? [
               'user' => [
                   'username' => Auth()->user->name,
               ],
           ]  : null,
            // only() comes from ThreadResource
            'latestThread' => ThreadResource::make(Thread::latest()->first()->only(['title', 'author.name'])),
        ]);
    }
}
