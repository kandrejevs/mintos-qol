<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mintos:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates user and api token for app';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $username = $this->ask('Username');
        $email = $this->ask('Email');
        $password = $this->secret('Password');
        $confirm = $this->secret('Confirm password');

        if ($password !== $confirm) {
            $this->error('Passwords does not match');
            return false;
        }

        $user = User::create([
            'name' => $username,
            'email' => $email,
            'password' => Hash::make($password),
            'api_token' => Str::random(60),
        ]);

        $this->info("API token: $user->api_token");
    }
}
