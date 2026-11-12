<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Contact FoodCity customer support.">
    <title>Contact Us · FoodCity</title>
    <link rel="stylesheet" href="{{ asset('css/storefront.css') }}">
</head>
<body>
    <header class="contact-header">
        <a class="brand" href="{{ route('home') }}" aria-label="FoodCity home"><span class="brand-mark">F</span><span>food<span class="brand-city">city</span><small>GOOD FOOD. GOOD DAYS.</small></span></a>
        <a class="text-link" href="{{ route('home') }}">Back to FoodCity <span aria-hidden="true">↗</span></a>
    </header>
    <main class="contact-page">
        <span class="eyebrow">WE’RE HERE TO HELP</span>
        <h1>Get in <em>touch.</em></h1>
        <p class="contact-intro">Questions about FoodCity? Call or message us, or visit our address.</p>
        <div class="contact-details">
            <section class="contact-detail-card">
                <span class="contact-detail-icon" aria-hidden="true">☎</span>
                <h2>Call or message</h2>
                <a href="tel:+94705858000">+94 70 585 8000</a>
                <a class="contact-secondary" href="https://wa.me/94705858000" target="_blank" rel="noopener noreferrer">Chat on WhatsApp ↗</a>
            </section>
            <section class="contact-detail-card">
                <span class="contact-detail-icon" aria-hidden="true">✉</span>
                <h2>Email</h2>
                <p class="contact-email">foodcity@.com</p>
            </section>
            <section class="contact-detail-card">
                <span class="contact-detail-icon" aria-hidden="true">⌖</span>
                <h2>Visit us</h2>
                <address>No. 44/B, Awissawella Road,<br>Kaluaggala, Labugama,<br>Haanwella 10650</address>
            </section>
        </div>
        <a class="button button-red contact-shop-link" href="{{ route('home') }}#products">Explore the shop <span aria-hidden="true">↗</span></a>
    </main>
</body>
</html>
