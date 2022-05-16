<?php

namespace App\Providers;

use App\Repository\AccountRepository;
use App\Repository\RuleRepository;
use App\Repository\TransactionManagerImpl;
use App\Repository\TransactionRepository;
use App\Services\AccountEmailSenderImpl;
use App\Services\AccountSmsSenderImpl;
use Illuminate\Support\ServiceProvider;
use UseCase\Account\AccountReader;
use UseCase\Account\AccountWriter;
use UseCase\Account\Service\AccountEmailSender;
use UseCase\Account\Service\AccountSmsSender;
use UseCase\Common\TransactionManager;
use UseCase\PointsRule\PointsRuleReader;
use UseCase\Transaction\TransactionReader;
use UseCase\Transaction\TransactionWriter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TransactionManager::class, TransactionManagerImpl::class);
        $this->app->singleton(PointsRuleReader::class, RuleRepository::class);
        $this->app->singleton(AccountReader::class, AccountRepository::class);
        $this->app->singleton(AccountWriter::class, AccountRepository::class);
        $this->app->singleton(AccountEmailSender::class, AccountEmailSenderImpl::class);
        $this->app->singleton(AccountSmsSender::class, AccountSmsSenderImpl::class);
        $this->app->singleton(TransactionReader::class, TransactionRepository::class);
        $this->app->singleton(TransactionWriter::class, TransactionRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
