<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to Register New User';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user['name'] = $this->ask('Name of new user');
        $user['email'] = $this->ask('Email of new user');
        $user['password'] = $this->secret('Password of new user');

        $roleName = $this->choice('Which Role you like to choose?',['admin','vendor','user'],1);

        $role = Role::where('name',$roleName)->first();

        if(!$role){
            $this->error('Role not found');
            return -1;
        }

        $validator = Validator::make($user, [
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:'.User::class],
            'password' => ['required', Password::defaults()],
        ]);

        if($validator->fails()){
            foreach($validator->errors()->all() as $error){
                $this->error($error);
            }

            return -1;
        }

        DB::transaction(function () use ($user,$role) {
        $newUser = User::create($user);
        $newUser->roles()->attach($role->id);
        });

        $this->info('New User '.$user['email'].' created Successfully');
        return 0;
    }
}
