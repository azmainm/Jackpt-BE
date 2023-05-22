<?php

namespace App\Providers;

use App\Domains\AnnualWheel\Repositories\AnnualWheelRepository;
use App\Domains\AnnualWheel\Repositories\RecurrentEventRepository;
use App\Domains\AnnualWheelEvent\Repositories\EventRepository;
use App\Domains\CapTable\Repositories\CapTableRepository;
use App\Domains\CapTable\Repositories\CapTableUserOwnerRepository;
use App\Domains\CapTableOwner\Repositories\CapTableOwnerRepository;
use App\Domains\Invitation\Repositories\InvitationRepository;
use App\Domains\Report\Reporsitories\ReportRepository;
use App\Domains\Subscriber\Repositories\SubscriberRepository;
use App\Domains\Transaction\Repositories\TransactionRepository;
use App\Domains\User\Repositories\UserRepository;
use App\Interfaces\AnnualWheelInterface;
use App\Interfaces\CapTableInterface;
use App\Interfaces\CapTableOwnerInterface;
use App\Interfaces\CapTableUserOwnerInterface;
use App\Interfaces\EventInterface;
use App\Interfaces\InvitationInterface;
use App\Interfaces\RecurrentEventInterface;
use App\Interfaces\ReportInterface;
use App\Interfaces\SubscriberInterface;
use App\Interfaces\TransactionInterface;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
