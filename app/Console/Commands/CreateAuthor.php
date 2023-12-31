<?php

namespace App\Console\Commands;

use App\Helpers\Connector;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CreateAuthor extends Command
{
    public function __construct(
        private Connector $connector
    )
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-author';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new author';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (! Cache::has('access_token')) {
            $this->info('You have to enter login credentials first.');
            $email = $this->ask('Email: ');
            $password = $this->secret('Password: ');

            $this->connector->getToken(data: [
                'email' => $email,
                'password' => $password
            ]);
        }

        $first_name = $this->ask('First name: ');
        $last_name = $this->ask('Last name: ');

        $birthday = $this->ask('Enter a date (DD.MM.YYYY):');
        while (!preg_match('/^\d{2}.\d{2}.\d{4}$/', $birthday)) {
            $this->error('Invalid date format. Please use DD.MM.YYYY format.');
            $birthday = $this->ask('Enter a date (DD.MM.YYYY):');
        }

        $biography = $this->ask('Biography: ');
        $gender = $this->choice('Gender: ', ['male', 'female']);
        $place_of_birth = $this->ask('Place of birth: ');

        $this->connector->connect('post', 'authors', data: [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'birthday' => $birthday,
            'biography' => $biography,
            'gender' => $gender,
            'place_of_birth' => $place_of_birth
        ]);

        $this->info('A new author was created.');
    }
}
