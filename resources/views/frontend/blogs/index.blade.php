@extends('frontend.layout')
<style>
    /* Blog Card Fix */

.blog-card {
    height: 100%;
    display: flex;
    flex-direction: column;
    border-radius: 16px;
    overflow: hidden;
    transition: 0.3s ease;
}

.blog-card:hover {
    transform: translateY(-5px);
}

.blog-card-img-wrapper {
    width: 100%;
    height: 220px; /* Fixed height */
    overflow: hidden;
}

.blog-card-img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Important */
    transition: 0.3s ease;
}

.blog-card:hover .blog-card-img {
    transform: scale(1.05);
}

.blog-card .p-4 {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.blog-excerpt {
    flex-grow: 1;
}
</style>
@section('content')
   <!-- 1. BLOG -->
   <section class="package-listing__banner">
    <div class="container">
        <div
            class="text-center justify-content-center package-listing__banner-content contact-us-banner align-items-center">
            <h1 class="h2 fw-bold text-white m-0">Blogs</h1>
            <p>24/7—call us anytime or send your request using the form below.</p>
        </div>
    </div>
</section>

<section class="section-padding-md blog-section">
    <div class="container">
        <div class="section__header">
            <div class="section__header-content">
                <h2 class="section__heading">Explore Saudi Arabia Through Our Stories</h2>
                <p class="section__description">Discover travel guides, hidden gems, cultural insights, and unforgettable experiences
                    across the Kingdom of Saudi Arabia.</p>
            </div>
        </div>
        <div class="row blog-cards-wrapper gy-4">

            @forelse($blogs as $blog)
                <div class="col-md-6 col-lg-4">
                    <div class="blog-card">

                        {{-- Image --}}
                        <div class="blog-card-img-wrapper">
                            <img
                                src="{{ $blog->thumb?->image_path
                                    ? asset('storage/'.$blog->thumb->image_path)
                                    : 'https://via.placeholder.com/800x500' }}"
                                class="blog-card-img"
                                alt="{{ $blog->translation?->title }}">
                        </div>

                        <div class="p-4">

                            {{-- Category --}}
                            @if($blog->category)
                                <div>
                                    <span class="badge category-badge">
                                        {{ $blog->category->translation?->name }}
                                    </span>
                                </div>
                            @endif

                            {{-- Title --}}
                            <h6 class="fw-600 blog-title mt-2">
                                <a class="text-decoration-none" href="{{ route('blogs.detail', $blog->slug) }}">
                                    {{ $blog->translation?->title }}
                                </a>
                            </h6>

                            {{-- Excerpt --}}
                            <p class="blog-excerpt mt-2">
                                {{ \Illuminate\Support\Str::limit(strip_tags($blog->translation?->content), 120) }}
                            </p>

                            {{-- Author & Date --}}
                            <div class="d-flex align-items-center gap-2 mt-3">

                                <div class="blog-details__user-avatar">
                                    <i class="fa-solid fa-circle-user"></i>
                                </div>

                                <span class="small">
                                    {{ $blog->user?->name ?? 'Admin' }}
                                </span>

                                <span class="dot"></span>

                                <span class="small">
                                    {{ $blog->published_at?->format('F d, Y') }}
                                </span>
                            </div>

                        </div>
                    </div>
                </div>

            @empty
                <div class="col-12 text-center">
                    <p>No blogs found.</p>
                </div>
            @endforelse

        </div>
    </div>
</section>

@endsection

