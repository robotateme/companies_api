<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\User;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\Company\Contracts\AbstractSearchCompanyInArea;
use App\Repositories\Company\Contracts\CompanyRepositoryInterface;
use App\Repositories\Company\SearchCompanyInAreaRepository;
use App\Repositories\Company\SearchCompanyRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AbstractSearchCompanyInArea::class, SearchCompanyInAreaRepository::class);
        $this->app->when(CompanyRepository::class)
            ->needs(Model::class)
            ->give(Company::class);
        $this->app->when(SearchCompanyInAreaRepository::class)
            ->needs(Model::class)
            ->give(Company::class);
        $this->app->when(SearchCompanyRepository::class)
            ->needs(Model::class)
            ->give(Company::class);
        $this->app->when(UserRepository::class)
            ->needs(Model::class)
            ->give(User::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
