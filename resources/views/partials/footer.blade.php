<footer class="site-footer">
    <div class="footer-main">
        <div class="footer-brand-block">
            <a class="brand footer-brand" href="{{ route('home') }}" aria-label="FoodCity home">
                <span class="brand-mark">F</span>
                <span>food<span class="brand-city">city</span><small>GOOD FOOD. GOOD DAYS.</small></span>
            </a>
            <p>Everyday favourites, little treats and the best of Sri Lanka — all in one happy place.</p>
        </div>

        <nav class="footer-links" aria-label="Footer navigation">
            <h2>Explore</h2>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('home') }}#products">Shop</a>
            <a href="{{ route('home') }}#about">About Us</a>
            <a href="{{ route('contact') }}">Contact Us</a>
        </nav>

        <div class="footer-support">
            <h2>Customer support</h2>
            <p>Need help with your account? Sign in to view your FoodCity account and saved items.</p>
            <a href="{{ auth()->check() ? route('wishlist.index') : route('login') }}">My Account <span aria-hidden="true">↗</span></a>
            <a class="footer-contact-link" href="tel:+94705858000">+94 70 585 8000</a>
            <address>No. 44/B, Awissawella Road,<br>Kaluaggala, Labugama,<br>Haanwella 10650</address>
            <div class="footer-socials" aria-label="Social media">
                <a class="footer-social-icon whatsapp-icon" href="https://wa.me/94705858000" target="_blank" rel="noopener noreferrer" aria-label="Chat with FoodCity on WhatsApp" data-tooltip="Chat with us on WhatsApp">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12.04 2C6.5 2 2 6.49 2 12.03c0 1.77.46 3.5 1.33 5.02L2 22l5.09-1.34a10 10 0 0 0 4.95 1.3h.01c5.54 0 10.04-4.49 10.04-10.03A9.97 9.97 0 0 0 12.04 2Z"/><path fill="#fff" d="M17.84 14.53c-.32-.16-1.89-.93-2.18-1.03-.29-.1-.5-.16-.71.16-.21.32-.82 1.03-1 1.24-.18.21-.37.24-.69.08-.32-.16-1.35-.5-2.57-1.6-.95-.84-1.59-1.88-1.78-2.2-.18-.32-.02-.49.14-.65.15-.14.32-.37.48-.56.16-.19.21-.32.32-.53.1-.21.05-.4-.03-.56-.08-.16-.71-1.72-.97-2.36-.26-.62-.52-.54-.71-.55h-.61c-.21 0-.56.08-.85.4-.29.32-1.11 1.08-1.11 2.64 0 1.56 1.14 3.07 1.3 3.28.16.21 2.24 3.42 5.43 4.8.76.33 1.36.52 1.83.67.77.24 1.47.21 2.02.13.62-.09 1.89-.77 2.15-1.51.26-.74.26-1.37.18-1.51-.08-.13-.29-.21-.61-.37Z"/></svg>
                </a>
                <span class="footer-social-icon facebook-icon" role="img" aria-label="Facebook">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M13.5 21v-8h2.7l.4-3.1h-3.1v-2c0-.9.3-1.5 1.6-1.5h1.7V3.6c-.3 0-1.3-.1-2.5-.1-2.5 0-4.2 1.5-4.2 4.3v2.1H7.3V13h2.8v8h3.4Z"/></svg>
                </span>
                <span class="footer-social-icon instagram-icon" role="img" aria-label="Instagram" title="Instagram">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3.5" y="3.5" width="17" height="17" rx="5" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="17.7" cy="6.7" r="1.2"/></svg>
                </span>
                <span class="footer-social-icon twitter-icon" role="img" aria-label="X / Twitter" title="X / Twitter">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18.9 3h2.8l-6.1 7 7.2 11h-5.6l-4.4-6.8L6.9 21H4.1l6.5-7.5L3.7 3h5.8l4 6.3L18.9 3Zm-1 16h1.6L8.6 4.9H6.9L17.9 19Z"/></svg>
                </span>
                <span class="footer-social-icon youtube-icon" role="img" aria-label="YouTube" title="YouTube">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M23 7.2a3 3 0 0 0-2.1-2.1C19 4.6 12 4.6 12 4.6s-7 0-8.9.5A3 3 0 0 0 1 7.2 31 31 0 0 0 .5 12a31 31 0 0 0 .5 4.8 3 3 0 0 0 2.1 2.1c1.9.5 8.9.5 8.9.5s7 0 8.9-.5a3 3 0 0 0 2.1-2.1 31 31 0 0 0 .5-4.8 31 31 0 0 0-.5-4.8ZM9.7 15.5v-7L15.8 12l-6.1 3.5Z"/></svg>
                </span>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <span>© {{ date('Y') }} FoodCity Sri Lanka. Made with a little extra love.</span>
        <a href="{{ route('home') }}#top">Back to top ↑</a>
    </div>
</footer>
