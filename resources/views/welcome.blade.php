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
            <a href="#deals">Deals</a><a href="#categories">Categories</a><a href="#products">Products</a><a href="#about">About us</a>
        </nav>
        <form class="header-search search-wrap" action="/" method="get" role="search" autocomplete="off">
            @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
            <label class="sr-only" for="search">Search products</label>
            <input id="search" type="search" name="q" value="{{ request('q') }}" placeholder="Find your favourites">
            <button aria-label="Search">⌕</button>
            <div class="search-suggestions" id="search-suggestions" role="listbox" aria-label="Search suggestions" hidden></div>
        </form>
        <a href="#products" class="basket-link" aria-label="Browse products">♡ <span>Shop</span></a>
        @auth<a class="account-link" href="{{ route('wishlist.index') }}">Wishlist ({{ auth()->user()->wishlist()->count() }})</a>@if(auth()->user()->isAdmin())<a class="account-link" href="{{ route('admin.dashboard') }}">Admin</a>@endif<form method="post" action="{{ route('logout') }}">@csrf<button class="account-link account-button">Sign out</button></form>@else<a class="account-link" href="{{ route('login') }}">Sign in</a>@endauth
    </header>
    @if(session('success'))<div class="success-toast">{{ session('success') }} @auth<a href="{{ route('wishlist.index') }}">View wishlist ↗</a>@endauth</div>@endif

    <main id="top">
        <section class="hero" id="deals">
            <div class="hero-copy"><span class="eyebrow light">YOUR NEIGHBOURHOOD, ONLINE</span><h1>Good food.<br><em>Good days.</em></h1><p>Everyday favourites, little treats and the best of Sri Lanka — all in one happy place.</p><a class="button button-light" href="#products">Explore the shop <span>↘</span></a><div class="hero-note"><span class="hero-star">✳</span> A little more joy in every basket.</div></div>
            <div class="hero-art" aria-hidden="true"><div class="hero-image-space"></div><div class="sale-sticker"><small>MORE TO</small><strong>SMILE<br>ABOUT</strong><span>every day</span></div><div class="hero-orbit orbit-one"></div><div class="hero-orbit orbit-two"></div><span class="hero-sun">✳</span><span class="hero-caption">GOOD THINGS<br>GROW HERE</span></div>
            <div class="hero-bottom"><span>FOODCITY · SRI LANKA</span><span>FRESH IDEAS FOR EVERYDAY LIVING <b>✳</b></span></div>
        </section>

        <section class="ticker" aria-label="Our promise"><div>GOOD FOOD, GOOD MOOD <span>✳</span> EVERYDAY VALUE <span>✳</span> MADE FOR HOME <span>✳</span> GOOD FOOD, GOOD MOOD <span>✳</span> EVERYDAY VALUE <span>✳</span> MADE FOR HOME <span>✳</span></div></section>

        @if($deals->isNotEmpty())
        <section class="deals-section section-wrap">
            <div class="section-heading"><div><span class="eyebrow">A LITTLE SOMETHING EXTRA</span><h2>Deals to <em>love.</em></h2></div><a class="text-link" href="#products">Shop all products <span>↗</span></a></div>
            <div class="deal-grid">@foreach($deals as $deal)<article class="deal-card"><span class="deal-tag">GOOD DEAL</span><div class="image-space deal-image">@if($deal->image_path)<img src="{{ asset('storage/'.$deal->image_path) }}" alt="{{ $deal->name }}">@endif</div><div><small>{{ $deal->category->name }}</small><h3>{{ $deal->name }}</h3><p>{{ $deal->brand }} · {{ $deal->pack_size }}</p><strong>LKR {{ number_format($deal->price_lkr) }}</strong></div></article>@endforeach</div>
        </section>
        @else
        <section class="deals-section section-wrap">
            <div class="section-heading"><div><span class="eyebrow">GOOD THINGS, GREAT VALUE</span><h2>Everyday good <em>finds.</em></h2></div><a class="text-link" href="#products">Find your favourites <span>↗</span></a></div>
            <div class="deal-grid deal-placeholder-grid"><article class="deal-card"><span class="deal-tag">FRESH PICKS</span><div class="image-space deal-image"></div><div><small>Made for your pantry</small><h3>Everyday essentials</h3><p>Good value, right around the corner.</p></div></article><article class="deal-card"><span class="deal-tag">GOOD MOOD</span><div class="image-space deal-image"></div><div><small>A little treat</small><h3>Something delicious</h3><p>Find a new favourite today.</p></div></article><article class="deal-card"><span class="deal-tag">JUST FOR YOU</span><div class="image-space deal-image"></div><div><small>Shop the collection</small><h3>Good things await</h3><p>Your next happy basket starts here.</p></div></article></div>
        </section>
        @endif

        <section class="categories-section" id="categories"><div class="section-wrap"><div class="section-heading"><div><span class="eyebrow">A GOOD PLACE TO START</span><h2>Shop by <em>category.</em></h2></div><span class="heading-aside">Aisles full of everyday goodness.</span></div>
            <div class="category-grid">@foreach($categories as $category)<a class="category-card" href="{{ route('home', ['category' => $category->code]) }}"><div class="image-space category-image">@if($category->image_path)<img src="{{ asset('storage/'.$category->image_path) }}" alt="{{ $category->name }}">@else<span class="image-label">IMAGE SPACE</span>@endif<span class="category-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span></div><div class="category-info"><div><h3>{{ $category->name }}</h3><span>{{ $category->products_count }} good things to find</span></div><span class="round-arrow">↗</span></div></a>@endforeach</div>
        </div></section>

        <section class="products-section section-wrap" id="products"><div class="section-heading"><div><span class="eyebrow">THE EVERYDAY GOOD STUFF</span><h2>Good things, <em>in store.</em></h2></div><span class="heading-aside">{{ $products->total() }} products · Prices in LKR</span></div>
            <form class="catalog-filters" action="{{ route('home') }}#products" method="get">
    @if(request('q'))<input type="hidden" name="q" value="{{ request('q') }}">@endif
    @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
    <label class="catalog-filter"><span>Brand</span><select name="brand"><option value="">All brands</option>@foreach($brands as $brand)<option value="{{ $brand }}" @selected(request('brand') === $brand)>{{ $brand }}</option>@endforeach</select></label>
    <label class="catalog-filter"><span>Min price (LKR)</span><input type="number" min="0" name="min_price" value="{{ request('min_price') }}" placeholder="Any"></label>
    <label class="catalog-filter"><span>Max price (LKR)</span><input type="number" min="0" name="max_price" value="{{ request('max_price') }}" placeholder="Any"></label>
    <label class="catalog-filter"><span>Dietary</span><select name="dietary"><option value="">Any preference</option>@foreach($dietaryOptions as $option)<option value="{{ $option }}" @selected(request('dietary') === $option)>{{ $option }}</option>@endforeach</select></label>
    <button type="submit" class="filter-submit">Apply filters</button>
    @if(request()->hasAny(['brand', 'min_price', 'max_price', 'dietary']))<a class="filter-reset" href="{{ route('home', array_filter(['q' => request('q'), 'category' => request('category')])) }}#products">Clear</a>@endif
</form><div class="product-toolbar"><div class="filter-pills"><a class="filter-pill {{ !request('category') ? 'active' : '' }}" href="{{ route('home', request()->only('q')) }}">Everything</a>@foreach($categories as $category)<a class="filter-pill {{ request('category') === $category->code ? 'active' : '' }}" href="{{ route('home', array_merge(request()->only('q'), ['category' => $category->code])) }}">{{ $category->name }}</a>@endforeach</div><span class="showing-count">Showing {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }} of {{ $products->total() }}</span></div>
            @if($products->isNotEmpty())<div class="product-grid">@foreach($products as $product)<article class="product-card" id="product-{{ $product->id }}"><div class="product-image image-space">@if($product->image_path)<img src="{{ asset('storage/'.$product->image_path) }}" alt="{{ $product->name }}">@else<span class="image-label">IMAGE SPACE</span>@endif<span class="product-category">{{ $product->category->code }}</span></div><div class="product-details"><span class="product-brand">{{ $product->brand }} <i>·</i> {{ $product->pack_size }}</span><h3>{{ $product->name }}</h3>@include('products.reviews', ['product' => $product])<div class="product-buy"><strong>LKR {{ number_format($product->price_lkr) }}</strong>@auth<form method="post" action="{{ route('wishlist.add', $product) }}">@csrf<button type="submit" class="wishlist-button" aria-label="Add {{ $product->name }} to wishlist" title="Add to wishlist">♡</button></form>@else<a class="wishlist-button" href="{{ route('login', ['redirect' => url()->full()]) }}" aria-label="Sign in to save {{ $product->name }} to wishlist" title="Sign in to save">♡</a>@endauth</div></div></article>@endforeach</div>
            <div class="pagination">{{ $products->links() }}</div>
            @else<div class="empty-state"><span>✳</span><h3>No products found just yet.</h3><p>Try another search or browse all the good things in store.</p><a href="{{ route('home') }}" class="button button-red">View all products</a></div>@endif
        </section>

        <section class="about-section" id="about"><div class="about-stamp">✳<br><small>SINCE<br>1983</small></div><div class="about-copy"><span class="eyebrow light">CLOSE TO HOME, CLOSE TO HEART</span><h2>Good food brings<br>us <em>together.</em></h2><p>From the everyday essentials to those little just-because treats, we’re here to make every day a little brighter for Sri Lankan families.</p><a href="#categories" class="button button-light">A little more about us <span>↗</span></a></div><div class="about-image image-space"><span class="image-label">IMAGE SPACE</span></div></section>
    </main>

    @include('partials.footer')
<script>
const searchInput = document.querySelector('#search');
const suggestionBox = document.querySelector('#search-suggestions');
let suggestionTimer;
searchInput?.addEventListener('input', () => {
    clearTimeout(suggestionTimer);
    const term = searchInput.value.trim();
    if (term.length < 2) { suggestionBox.hidden = true; return; }
    suggestionTimer = setTimeout(async () => {
        try {
            const response = await fetch(`{{ route('search.suggestions') }}?q=${encodeURIComponent(term)}`);
            const data = await response.json();
            suggestionBox.replaceChildren();
            for (const category of data.categories) {
                const link = document.createElement('a'); link.className = 'suggestion-item'; link.href = category.url; link.textContent = category.name; suggestionBox.append(link);
            }
            for (const product of data.products) {
                const link = document.createElement('a'); link.className = 'suggestion-item'; link.href = product.url;
                const title = document.createElement('strong'); title.textContent = product.name;
                const detail = document.createElement('small'); detail.textContent = `${product.brand} · ${product.pack_size} · LKR ${product.price}`;
                link.append(title, detail); suggestionBox.append(link);
            }
            suggestionBox.hidden = suggestionBox.childElementCount === 0;
        } catch { suggestionBox.hidden = true; }
    }, 180);
});
document.addEventListener('click', (event) => { if (!event.target.closest('.search-wrap')) suggestionBox.hidden = true; });

</script>
</body>
</html>
