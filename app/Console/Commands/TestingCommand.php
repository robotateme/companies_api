<?php

namespace App\Console\Commands;

use App\Models\Activity;
use App\Repositories\Company\CompanyRepository;
use Illuminate\Console\Command;

class TestingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:testing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct(private readonly CompanyRepository $companyRepository)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        dd($this->companyRepository->searchByActivityTitle('З'));
    }
}
