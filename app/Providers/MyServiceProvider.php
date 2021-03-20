<?php


namespace App\Providers;


use App\Repositories\Post\PostRepository;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Topic\TopicRepository;
use App\Repositories\Topic\TopicRepositoryInterface;
use App\Repositories\Users\UserRepository;
use App\Repositories\Users\UserRepositoryInterface;
use App\Services\Auth\AuthService;
use App\Services\Auth\AuthServiceInterface;
use App\Services\Post\PostService;
use App\Services\Post\PostServiceInterface;
use App\Services\Topic\TopicService;
use App\Services\Topic\TopicServiceInterface;
use App\Services\Users\UserService;
use App\Services\Users\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class MyServiceProvider extends ServiceProvider
{
    /**
     * Bind the interface to an implementation service class
     */
    public function register()
    {
        $this->app->singleton(
            UserServiceInterface::class,
            UserService::class
        );

        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->singleton(
            AuthServiceInterface::class,
            AuthService::class
        );

        $this->app->singleton(
            TopicServiceInterface::class,
            TopicService::class
        );

        $this->app->singleton(
            TopicRepositoryInterface::class,
            TopicRepository::class
        );

        $this->app->singleton(
            PostServiceInterface::class,
            PostService::class
        );

        $this->app->singleton(
            PostRepositoryInterface::class,
            PostRepository::class
        );
    }
}
