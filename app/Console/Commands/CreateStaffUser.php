<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateStaffUser extends Command
{
    protected $signature = 'chf:staff-create {--role=admin : Account role (admin or manager)}';
    protected $description = 'Create an administrator or manager account securely from the server terminal';

    public function handle(): int
    {
        $role = $this->option('role');
        if (!in_array($role, ['admin', 'manager'], true)) {
            $this->error('Role must be admin or manager.');
            return self::FAILURE;
        }

        $name = trim($this->ask('Staff member name'));
        $email = strtolower(trim($this->ask('Email address')));
        $password = (string) $this->secret('Password (at least 12 characters)');
        $confirmation = (string) $this->secret('Confirm password');

        if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || User::where('email', $email)->exists()) {
            $this->error('Enter a name and a valid email that is not already registered.');
            return self::FAILURE;
        }
        if (strlen($password) < 12 || !hash_equals($password, $confirmation)) {
            $this->error('Passwords must match and contain at least 12 characters.');
            return self::FAILURE;
        }

        User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password), 'role' => $role, 'is_active' => true]);
        $this->info("{$role} account created for {$email}.");

        return self::SUCCESS;
    }
}
