@php
    $ratingAverage = (float) ($product->reviews_avg_rating ?? 0);
    $myReview = auth()->check() ? $product->reviews->firstWhere('user_id', auth()->id()) : null;
@endphp
<div class="product-rating" aria-label="{{ $product->reviews_count ? number_format($ratingAverage, 1).' out of 5 stars' : 'No reviews yet' }}">
    @if($product->reviews_count)
        <span class="rating-stars" aria-hidden="true">{{ str_repeat('★', (int) round($ratingAverage)) }}{{ str_repeat('☆', 5 - (int) round($ratingAverage)) }}</span>
        <span>{{ number_format($ratingAverage, 1) }} <small>({{ $product->reviews_count }})</small></span>
    @else
        <span class="rating-empty">No reviews yet</span>
    @endif
</div>
<details class="review-panel">
    <summary>Reviews &amp; ratings · {{ $product->reviews_count }}</summary>
    <div class="review-content">
        <div class="review-list">
            @forelse($product->reviews->sortByDesc('created_at') as $review)
                <article class="review-item">
                    <div><strong>{{ $review->user->name }}</strong><span class="rating-stars" aria-label="{{ $review->rating }} out of 5 stars">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</span></div>
                    <small>{{ $review->created_at->format('M j, Y') }}</small>
                    @if($review->body)<p>{{ $review->body }}</p>@endif
                    @if($myReview?->id === $review->id)
                        <form method="post" action="{{ route('reviews.destroy', $review) }}">@csrf @method('delete')<button class="review-remove">Remove my review</button></form>
                    @endif
                </article>
            @empty
                <p class="rating-empty">Be the first to review this product.</p>
            @endforelse
        </div>
        @auth
            @unless(auth()->user()->isAdmin())
                <form class="review-form" method="post" action="{{ route('reviews.store', $product) }}">@csrf
                    <strong>{{ $myReview ? 'Update your review' : 'Write a review' }}</strong>
                    <label>Rating<select name="rating" required>@for($rating = 5; $rating >= 1; $rating--)<option value="{{ $rating }}" @selected(old('rating', $myReview?->rating ?? 5) == $rating)>{{ $rating }} {{ $rating === 1 ? 'star' : 'stars' }}</option>@endfor</select></label>
                    <label>Your review<textarea name="body" rows="3" maxlength="1200" placeholder="Share what you think (optional)">{{ old('body', $myReview?->body) }}</textarea></label>
                    <button class="review-submit">{{ $myReview ? 'Update review' : 'Post review' }}</button>
                </form>
            @else
                <p class="rating-empty">Reviews are available to customer accounts.</p>
            @endunless
        @else
            <a class="review-signin" href="{{ route('login', ['redirect' => url()->full()]) }}">Sign in to rate and review</a>
        @endauth
    </div>
</details>
