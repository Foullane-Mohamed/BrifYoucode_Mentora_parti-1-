<?php

namespace App\Providers;

use App\Repositories\CourseRepository;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Services\CourseService;
use App\Services\Interfaces\CourseServiceInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bindings pour les repositories
        $this->app->bind(CourseRepositoryInterface::class, CourseRepository::class);

        // Bindings pour les services
        $this->app->bind(CourseServiceInterface::class, CourseService::class);
    }

    public function boot(): void
    {
        //
    }
}
