<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create account · FoodCity</title>
    <link rel="stylesheet" href="{{ asset('css/storefront.css') }}">
</head>
<body class="admin-page">
    <main class="login-card">
        <a class="brand" href="{{ route('home') }}"><span class="brand-mark">F</span><span>food<span class="brand-city">city</span><small>GOOD FOOD. GOOD DAYS.</small></span></a>
        <span class="eyebrow">SAVE YOUR FAVOURITES</span>

        @if($errors->any())<div class="form-errors">{{ $errors->first() }}</div>@endif

        <form method="post" action="{{ route('register.store') }}">
            @csrf
            <label>Your name<input required name="name" value="{{ old('name') }}" autocomplete="name"></label>
            <label>Contact method
                <select id="verification-channel" name="channel" required>
                    <option value="email" @selected(old('channel', 'email') === 'email')>Email address</option>
                    <option value="phone" @selected(old('channel') === 'phone')>Phone number</option>
                </select>
            </label>
            <label id="contact-label">Email address<input required type="email" name="contact" value="{{ old('contact') }}" autocomplete="email" id="contact-input"></label>
            <label>Password<input required type="password" name="password" minlength="8" autocomplete="new-password"></label>
            <label>Confirm password<input required type="password" name="password_confirmation" minlength="8" autocomplete="new-password"></label>
            <button class="admin-primary">Create account</button>
        </form>

        <a class="back-link" href="{{ route('login') }}">Already have an account? Sign in</a>
    </main>
    <script>
        const channel = document.querySelector('#verification-channel');
        const contactLabel = document.querySelector('#contact-label');
        const contactInput = document.querySelector('#contact-input');
        channel?.addEventListener('change', () => {
            const phone = channel.value === 'phone';
            contactLabel.firstChild.textContent = phone ? 'Phone number (include country code)' : 'Email address';
            contactInput.type = phone ? 'tel' : 'email';
            contactInput.placeholder = phone ? '+94771234567' : '';
            contactInput.autocomplete = phone ? 'tel' : 'email';
        });
        channel?.dispatchEvent(new Event('change'));
    </script>
    <script src="{{ asset('js/password-toggle.js') }}" defer></script>
    @include('partials.footer')
</body>
</html>
