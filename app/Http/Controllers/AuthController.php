<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function loginForm(Request $request): View
    {
        $destination = $request->query('redirect');
        if (is_string($destination) && parse_url($destination, PHP_URL_HOST) === $request->getHost()) {
            $request->session()->put('url.intended', $destination);
        }

        return view('auth.login');
    }

    public function registerForm(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $channel = $request->input('channel');
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'channel' => ['required', 'in:email,phone'],
            'contact' => ['required', 'string', 'max:255', function (string $attribute, mixed $value, \Closure $fail) use ($channel): void {
                $contact = trim((string) $value);

                if ($channel === 'email' && ! filter_var($contact, FILTER_VALIDATE_EMAIL)) {
                    $fail('Enter a valid email address.');
                }

                if ($channel === 'phone') {
                    $phone = preg_replace('/[\s().-]+/', '', $contact);
                    if (! preg_match('/^\+[1-9]\d{7,14}$/', $phone)) {
                        $fail('Enter a valid phone number in international format, such as +94771234567.');
                    }
                }
            }],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $contact = trim($data['contact']);
        if ($channel === 'email') {
            $contact = mb_strtolower($contact);
            $contactColumn = 'email';
            $email = $contact;
            $phone = null;
        } else {
            $contact = preg_replace('/[\s().-]+/', '', $contact);
            $contactColumn = 'phone';
            $email = null;
            $phone = $contact;
        }

        if (User::query()->where($contactColumn, $contact)->exists()) {
            return back()->withErrors(['contact' => $channel === 'email' ? 'An account already uses this email address.' : 'An account already uses this phone number.'])->withInput($request->except('password', 'password_confirmation'));
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $email,
            'phone' => $phone,
            'password' => $data['password'],
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Your account is ready.');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate(['identifier' => ['required', 'string', 'max:255'], 'password' => ['required', 'string']]);
        $identifier = trim($credentials['identifier']);
        $field = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        if ($field === 'phone') {
            $identifier = preg_replace('/[\s().-]+/', '', $identifier);
        } else {
            $identifier = mb_strtolower($identifier);
        }
        $loginCredentials = [$field => $identifier, 'password' => $credentials['password']];

        if (! Auth::attempt($loginCredentials, $request->boolean('remember'))) {
            return back()->withErrors(['identifier' => 'Those sign-in details were not recognized.'])->onlyInput('identifier');
        }

        $request->session()->regenerate();

        return redirect()->intended(auth()->user()->isAdmin() ? route('admin.dashboard') : route('home'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
