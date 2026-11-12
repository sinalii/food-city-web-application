<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#bb1824">
    <meta name="description" content="Good food, good prices and everyday essentials at FoodCity.">
    <title>FoodCity — Good food, good days</title>
    <link rel="stylesheet" href="{{ asset('css/storefront.css') }}">
</head>
<body>
    <div class="announcement">Fresh finds. Feel-good prices. <span>Made for every Sri Lankan home.</span></div>
    <header class="site-header">
        <a class="brand" href="#top" aria-label="FoodCity home"><span class="brand-mark">F</span><span>food<span class="brand-city">city</span><small>GOOD FOOD. GOOD DAYS.</small></span></a>
        <nav class="main-nav" aria-label="Main navigation">
            <a href="#deals">Deals</a><a href="#products">Products</a><a href="#about">About us</a>
        </nav>
        <a href="#products" class="basket-link" aria-label="Browse products">♡ <span>Shop</span></a>
        <button class="account-button" type="button" id="whatsapp-ask">WhatsApp us</button>
        @auth<a class="account-link" href="{{ route('wishlist.index') }}">Wishlist ({{ auth()->user()->wishlist()->count() }})</a>@if(auth()->user()->isAdmin())<a class="account-link" href="{{ route('admin.dashboard') }}">Admin</a>@endif<form method="post" action="{{ route('logout') }}">@csrf<button class="account-link account-button">Sign out</button></form>@else<a class="account-link" href="{{ route('login') }}">Sign in</a>@endauth
    </header>
    @if(session('success'))<div class="success-toast">{{ session('success') }} <a href="{{ route('wishlist.index') }}">View wishlist ↗</a></div>@endif

    <main id="top">
        <section class="hero">
            <div class="hero-copy"><span class="eyebrow light">YOUR NEIGHBOURHOOD, ONLINE</span><h1>Good food.<br><em>Good days.</em></h1><p>Everyday favourites, little treats and the best of Sri Lanka — all in one happy place.</p><a class="button button-light" href="#products">Explore the shop <span>↘</span></a><div class="hero-note"><span class="hero-star">✳</span> A little more joy in every basket.</div></div>
            <div class="hero-art" aria-hidden="true"><div class="hero-image-space"></div><div class="sale-sticker"><small>MORE TO</small><strong>SMILE<br>ABOUT</strong><span>every day</span></div><div class="hero-orbit orbit-one"></div><div class="hero-orbit orbit-two"></div><span class="hero-sun">✳</span><span class="hero-caption">GOOD THINGS<br>GROW HERE</span></div>
            <div class="hero-bottom"><span>FOODCITY · SRI LANKA</span><span>FRESH IDEAS FOR EVERYDAY LIVING <b>✳</b></span></div>
        </section>

        <section class="ticker" aria-label="Our promise"><div>GOOD FOOD, GOOD MOOD <span>✳</span> EVERYDAY VALUE <span>✳</span> MADE FOR HOME <span>✳</span> GOOD FOOD, GOOD MOOD <span>✳</span> EVERYDAY VALUE <span>✳</span> MADE FOR HOME <span>✳</span></div></section>

        @if($deals->isNotEmpty())
        <section class="deals-section section-wrap">
            <div class="section-heading" id="deals"><div><span class="eyebrow">A LITTLE SOMETHING EXTRA</span><h2>Deals to <em>love.</em></h2></div><a class="text-link" href="#products">Shop all products <span>↗</span></a></div>
            <div class="deal-grid">@foreach($deals as $deal)<article class="deal-card"><span class="deal-tag">GOOD DEAL</span><div class="image-space deal-image">@if($deal->image_path)<img src="{{ asset('storage/'.$deal->image_path) }}" alt="{{ $deal->name }}">@else<span class="image-label">IMAGE SPACE</span>@endif</div><div><h3>{{ $deal->name }}</h3><p>{{ $deal->brand }} · {{ $deal->pack_size }}</p><strong>LKR {{ number_format($deal->price_lkr) }}</strong></div></article>@endforeach</div>
        </section>
        @else
        <section class="deals-section section-wrap">
            <div class="section-heading" id="deals"><div><span class="eyebrow">GOOD THINGS, GREAT VALUE</span><h2>Everyday good <em>finds.</em></h2></div><a class="text-link" href="#products">Find your favourites <span>↗</span></a></div>
            <div class="deal-grid deal-placeholder-grid"><article class="deal-card"><span class="deal-tag">FRESH PICKS</span><div class="image-space deal-image"></div><div><small>Made for your pantry</small><h3>Everyday essentials</h3><p>Good value, right around the corner.</p></div></article><article class="deal-card"><span class="deal-tag">GOOD MOOD</span><div class="image-space deal-image"></div><div><small>A little treat</small><h3>Something delicious</h3><p>Find a new favourite today.</p></div></article><article class="deal-card"><span class="deal-tag">JUST FOR YOU</span><div class="image-space deal-image"></div><div><small>Shop the collection</small><h3>Good things await</h3><p>Your next happy basket starts here.</p></div></article></div>
        </section>
        @endif

        <section class="products-section section-wrap" id="products"><div class="section-heading"><div><span class="eyebrow">THE EVERYDAY GOOD STUFF</span><h2>Good things, <em>in store.</em></h2></div><span class="heading-aside">{{ $products->count() }} products · Prices in LKR</span></div>
            <form class="catalog-filters" action="{{ route('home') }}#products" method="get">
                @if(request('q'))<input type="hidden" name="q" value="{{ request('q') }}">@endif
                <label class="catalog-filter"><span>Brand</span><select name="brand"><option value="">All brands</option>@foreach($brands as $brand)<option value="{{ $brand }}" @selected(request('brand') === $brand)>{{ $brand }}</option>@endforeach</select></label>
                <label class="catalog-filter"><span>Min price (LKR)</span><input type="number" min="0" name="min_price" value="{{ request('min_price') }}" placeholder="Any"></label>
                <label class="catalog-filter"><span>Max price (LKR)</span><input type="number" min="0" name="max_price" value="{{ request('max_price') }}" placeholder="Any"></label>
                <label class="catalog-filter"><span>Dietary</span><select name="dietary"><option value="">Any preference</option>@foreach($dietaryOptions as $option)<option value="{{ $option }}" @selected(request('dietary') === $option)>{{ $option }}</option>@endforeach</select></label>
                <button type="submit" class="filter-submit">Apply filters</button>
                @if(request()->hasAny(['brand', 'min_price', 'max_price', 'dietary']))<a class="filter-reset" href="{{ route('home', array_filter(['q' => request('q')])) }}#products">Clear</a>@endif
            </form>
            <div class="product-toolbar"><span class="showing-count">{{ $products->count() }} products</span></div>
            @if($products->isNotEmpty())<div class="product-grid">@foreach($products as $product)<article class="product-card" id="product-{{ $product->id }}"><div class="product-image image-space">@if($product->image_path)<img src="{{ asset('storage/'.$product->image_path) }}" alt="{{ $product->name }}">@else<span class="image-label">IMAGE SPACE</span>@endif</div><div class="product-details"><span class="product-brand">{{ $product->brand }} <i>·</i> {{ $product->pack_size }}</span><h3>{{ $product->name }}</h3>@include('products.reviews', ['product' => $product])<div class="product-buy"><strong>LKR {{ number_format($product->price_lkr) }}</strong><button type="button" class="wishlist-button whatsapp-add" data-product="{{ $product->name }}" data-price="{{ $product->price_lkr }}" aria-label="Add {{ $product->name }} to WhatsApp order list" title="Add to WhatsApp order list">+</button></div></div></article>@endforeach</div>
            @else<div class="empty-state"><span>✳</span><h3>No products found just yet.</h3><p>Try another search or browse all the good things in store.</p><a href="{{ route('home') }}" class="button button-red">View all products</a></div>@endif
        </section>

        <section class="about-section" id="about"><div class="about-stamp">✳<br><small>SINCE<br>1983</small></div><div class="about-copy"><span class="eyebrow light">CLOSE TO HOME, CLOSE TO HEART</span><h2>Good food brings<br>us <em>together.</em></h2><p>From the everyday essentials to those little just-because treats, we’re here to make every day a little brighter for Sri Lankan families.</p><a href="#products" class="button button-light">Shop products <span>↗</span></a></div><div class="about-image image-space"><span class="image-label">IMAGE SPACE</span></div></section>
    </main>

    <footer class="site-footer"><a class="brand footer-brand" href="#top"><span class="brand-mark">F</span><span>food<span class="brand-city">city</span><small>GOOD FOOD. GOOD DAYS.</small></span></a><span class="footer-quote">“The best memories are made around the table.”</span><nav aria-label="Footer navigation"><a href="#deals">Deals</a><a href="#products">Products</a><a href="#about">About us</a></nav><div class="footer-bottom"><span>© {{ date('Y') }} FoodCity Sri Lanka. Made with a little extra love.</span><a href="#top">Back to top ↑</a></div></footer>
    <aside class="whatsapp-order" id="whatsapp-order" aria-label="WhatsApp shopping list"><strong>WhatsApp shopping list</strong><span id="whatsapp-count">No items added</span><button type="button" id="whatsapp-send">Send list on WhatsApp</button></aside>
    <button class="whatsapp-float" type="button" id="whatsapp-float" aria-label="Chat with FoodCity on WhatsApp" title="Chat with us on WhatsApp"><svg viewBox="0 0 32 32" aria-hidden="true"><path d="M16.02 3C8.86 3 3.04 8.76 3.04 15.86c0 2.28.61 4.5 1.77 6.45L3 29l6.92-1.8a13.1 13.1 0 0 0 6.1 1.51h.01c7.15 0 12.97-5.77 12.97-12.86A12.78 12.78 0 0 0 16.02 3Zm0 23.53c-1.9 0-3.76-.5-5.4-1.45l-.39-.23-4.1 1.07 1.1-3.96-.25-.4a10.65 10.65 0 0 1-1.64-5.7c0-5.9 4.8-10.7 10.69-10.7 2.85 0 5.53 1.11 7.54 3.13a10.55 10.55 0 0 1 3.13 7.51c0 5.9-4.8 10.7-10.68 10.7Zm5.87-8.02c-.32-.16-1.9-.94-2.19-1.05-.3-.1-.51-.16-.73.16-.22.33-.84 1.05-1.03 1.27-.19.22-.38.25-.7.08-.33-.16-1.38-.5-2.63-1.6-.97-.86-1.63-1.92-1.82-2.25-.19-.33-.02-.5.14-.66.14-.14.33-.38.49-.57.16-.19.22-.33.33-.55.1-.22.05-.41-.03-.57-.08-.17-.73-1.74-1-2.38-.26-.62-.53-.54-.73-.55h-.62c-.22 0-.57.08-.87.41-.3.32-1.14 1.1-1.14 2.68 0 1.58 1.17 3.1 1.33 3.3.16.21 2.3 3.5 5.57 4.9.78.34 1.39.54 1.86.7.78.25 1.49.22 2.05.13.63-.1 1.9-.77 2.16-1.52.27-.76.27-1.4.19-1.53-.08-.14-.3-.22-.62-.38Z"/></svg></button>
    <script>
        const whatsappPhone = @json(config('services.whatsapp.phone'));
        const orderList = new Map();
        const orderCount = document.querySelector('#whatsapp-count');

        const whatsappLink = (message) => {
            if (!whatsappPhone) {
                alert('WhatsApp ordering is not configured yet. Please contact the store.');
                return;
            }
            window.open(`https://wa.me/${String(whatsappPhone).replace(/\D/g, '')}?text=${encodeURIComponent(message)}`, '_blank', 'noopener');
        };

        document.querySelector('#whatsapp-ask')?.addEventListener('click', () => whatsappLink('Hello FoodCity! I have a question about your products.'));
        document.querySelector('#whatsapp-float')?.addEventListener('click', () => whatsappLink('Hello FoodCity! I have a question about your products.'));
        document.querySelectorAll('.whatsapp-add').forEach((button) => button.addEventListener('click', () => {
            const name = button.dataset.product;
            orderList.set(name, (orderList.get(name) || 0) + 1);
            orderCount.textContent = `${orderList.size} product${orderList.size === 1 ? '' : 's'} · ${[...orderList.values()].reduce((sum, quantity) => sum + quantity, 0)} item${[...orderList.values()].reduce((sum, quantity) => sum + quantity, 0) === 1 ? '' : 's'}`;
            document.querySelector('#whatsapp-order').classList.add('visible');
        }));
        document.querySelector('#whatsapp-send')?.addEventListener('click', () => {
            if (!orderList.size) return whatsappLink('Hello FoodCity! I would like to ask about your products.');
            const lines = [...orderList].map(([name, quantity]) => `• ${name} × ${quantity}`).join('\\n');
            whatsappLink(`Hello FoodCity! I would like to order:\\n${lines}\\nPlease confirm availability and total.`);
        });

    </script>
</body>
</html>
