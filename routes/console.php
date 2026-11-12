<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('foodcity:admin {email} {name?}', function (string $email, ?string $name = null) {
    $name ??= $this->ask('Administrator name');
    $password = $this->secret('Administrator password (minimum 8 characters)');

    if (strlen((string) $password) < 8) {
        $this->error('The password must contain at least 8 characters.');

        return 1;
    }

    $user = User::firstOrNew(['email' => $email]);
    $user->name = $name;
    $user->password = Hash::make($password);
    $user->role = 'admin';
    $user->save();
    $this->info("Administrator account ready for {$email}.");
})->purpose('Create or promote a FoodCity administrator account');
