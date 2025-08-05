<?php

namespace App\Console\Commands;

use App\DTOs\User\Input\UserRegistrationDto;
use App\Repositories\User\UserRepository;
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

    public function __construct(private readonly UserRepository $userRepository)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $dto = UserRegistrationDto::from([
            'name' => 'John Doe',
            'email' => fake()->safeEmail(),
            'password' => 'password',
        ])->hashPassword();

        dd($this->userRepository->createUser($dto));
    }
}
