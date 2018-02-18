<?php

namespace App\Console\Commands;

use App\Contracts\User\UserRoleInterface;
use App\Eloquent\Models\User as Model;
use Validator;

use Illuminate\Console\Command;

class AdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:new {email : email for backend login} {password : password for backend login}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new admin for backend CMS';

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
        $validator = Validator::make(
            [
                'email'    => $this->argument('email'),
                'password' => $this->argument('password')
            ], 
            [
                'email'    => 'required|email|unique:users',
                'password' => 'required|min:5',
            ]
        );

        if ($validator->fails()) {
            $this->info('Creation error!: ' . $validator->errors()->first());
            return false;
        }

        Model::firstOrCreate([
            'role'     => UserRoleInterface::SUPER_ADMIN,
            'name'     => 'admin',
            'email'    => $this->argument('email'),
            'password' => bcrypt($this->argument('password'))
        ]);
    }
}
