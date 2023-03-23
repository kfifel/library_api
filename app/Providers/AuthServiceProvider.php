<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Collection;
use App\Models\Genre;
use App\Policies\BookPolicy;
use App\Policies\CollectionPolicy;
use App\Policies\GenrePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',

        Book::class => BookPolicy::class,
        Genre::class => GenrePolicy::class,
        Collection::class => CollectionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
