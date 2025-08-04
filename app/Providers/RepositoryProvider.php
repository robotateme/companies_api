<?php

namespace App\Providers;

use App\Models\Company;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\Company\Contracts\AbstractSearchCompanyInArea;
use App\Repositories\Company\Contracts\CompanyRepositoryInterface;
use App\Repositories\Company\SearchCompanyInAreaRepository;
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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
