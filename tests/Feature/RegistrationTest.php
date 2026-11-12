<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_register_with_email_and_log_in_again(): void
    {
        $this->post(route('register.store'), [
            'name' => 'Email Customer',
            'channel' => 'email',
            'contact' => 'customer@example.test',
            'password' => 'customer-password',
            'password_confirmation' => 'customer-password',
        ])->assertRedirect(route('home'));

        $user = User::where('email', 'customer@example.test')->firstOrFail();
        $this->assertNull($user->phone);
        $this->assertAuthenticatedAs($user);

        $this->post(route('logout'));
        $this->post(route('login.store'), [
            'identifier' => $user->email,
            'password' => 'customer-password',
        ])->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_customer_can_register_with_phone_only_and_log_in_again(): void
    {
        $this->post(route('register.store'), [
            'name' => 'Phone Customer',
            'channel' => 'phone',
            'contact' => '+94 77 123 4567',
            'password' => 'customer-password',
            'password_confirmation' => 'customer-password',
        ])->assertRedirect(route('home'));

        $user = User::where('phone', '+94771234567')->firstOrFail();
        $this->assertNull($user->email);
        $this->assertAuthenticatedAs($user);

        $this->post(route('logout'));
        $this->post(route('login.store'), [
            'identifier' => $user->phone,
            'password' => 'customer-password',
        ])->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);
    }
}
