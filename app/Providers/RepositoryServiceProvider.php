<?php
declare(strict_types=1);

namespace App\Providers;

use App\Contracts\TodoInterface;
use App\Repositories\TodoRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * 遅延ロード
     * @var bool
     */
    protected $defer = true;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TodoInterface::class, TodoRepository::class);
    }

    /**
     * 遅延ロードで提供されるサービス
     * @return array
     */
    public function provides(): array
    {
        return [
            TodoInterface::class,
        ];
    }
}
