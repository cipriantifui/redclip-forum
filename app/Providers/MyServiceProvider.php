<?php


namespace App\Providers;


use App\Repositories\Post\PostRepository;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\PostComment\PostCommentRepository;
use App\Repositories\PostComment\PostCommentRepositoryInterface;
use App\Repositories\PostCommentLike\PostCommentLikeRepository;
use App\Repositories\PostCommentLike\PostCommentLikeRepositoryInterface;
use App\Repositories\PostVote\VoteRepository;
use App\Repositories\PostVote\VoteRepositoryInterface;
use App\Repositories\Topic\TopicRepository;
use App\Repositories\Topic\TopicRepositoryInterface;
use App\Repositories\Users\UserRepository;
use App\Repositories\Users\UserRepositoryInterface;
use App\Services\Auth\AuthService;
use App\Services\Auth\AuthServiceInterface;
use App\Services\Post\PostService;
use App\Services\Post\PostServiceInterface;
use App\Services\PostComment\PostCommentService;
use App\Services\PostComment\PostCommentServiceInterface;
use App\Services\PostCommentLike\PostCommentLikeService;
use App\Services\PostCommentLike\PostCommentLikeServiceInterface;
use App\Services\PostVote\VoteService;
use App\Services\PostVote\VoteServiceInterface;
use App\Services\Search\SearchService;
use App\Services\Search\SearchServiceInterface;
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

        $this->app->singleton(
            PostCommentServiceInterface::class,
            PostCommentService::class
        );

        $this->app->singleton(
            PostCommentRepositoryInterface::class,
            PostCommentRepository::class
        );

        $this->app->singleton(
            PostCommentLikeServiceInterface::class,
            PostCommentLikeService::class
        );

        $this->app->singleton(
            VoteServiceInterface::class,
            VoteService::class
        );

        $this->app->singleton(
            VoteRepositoryInterface::class,
            VoteRepository::class
        );

        $this->app->singleton(
            SearchServiceInterface::class,
            SearchService::class
        );
    }
}
