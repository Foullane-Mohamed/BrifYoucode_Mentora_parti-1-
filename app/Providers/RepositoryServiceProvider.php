<?php

namespace App\Providers;

use App\Repositories\CourseRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TagRepository;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\TagRepositoryInterface;
use App\Services\CourseService;
use App\Services\CategoryService;
use App\Services\TagService;
use App\Services\Interfaces\CourseServiceInterface;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\Interfaces\TagServiceInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bindings pour les repositories
        $this->app->bind(CourseRepositoryInterface::class, CourseRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);

        // Bindings pour les services
        $this->app->bind(CourseServiceInterface::class, CourseService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(TagServiceInterface::class, TagService::class);
    }

    public function boot(): void
    {
        //
    }
}
