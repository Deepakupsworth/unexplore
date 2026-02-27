@extends('frontend.layout')

@section('content')
<section class="blog-details__section">
    <div class="container">
        <div class="row gy-4">

            {{-- ================= LEFT ================= --}}
            <div class="col-lg-9">

                <div class="blog-details__header p-4">

                    <p class="blog-category-badge rounded-4 text-black fw-500 w-fit">
                        {{ $blog->category?->translation?->name }}
                    </p>

                    <h1 class="fw-600 text-white mt-3 mb-4 h3">
                        {{ $blog->translation?->title }}
                    </h1>

                    <div class="d-flex align-items-center gap-4">

                        <div class="d-flex align-items-center gap-2">
                            <div class="blog-details__user-avatar">
                                <i class="fa-solid fa-circle-user"></i>
                            </div>
                            <p class="text-white">
                                {{ $blog->user?->first_name ?? __('blog.admin') }}
                            </p>
                        </div>

                        <p class="text-white">
                            {{ optional($blog->published_at)->format('F d, Y') }}
                        </p>

                    </div>
                </div>

                {{-- IMAGE --}}
                <div class="mt-3 blog-details__img-wrapper">
                    <img width="100%"
                        class="img-fluid"
                        src="{{ $blog->thumb?->image_path ? asset('storage/'.$blog->thumb->image_path) : asset('frontend/assets/old-town.png') }}"
                        alt="{{ $blog->translation?->title }}"
                    >
                </div>

                {{-- CONTENT --}}
                <div class="blog-details__content">
                    {!! $blog->translation?->content !!}
                </div>

            </div>

            {{-- ================= RIGHT SIDEBAR ================= --}}
            <div class="col-lg-3">

                {{-- SEARCH --}}
                <div class="card pkg-details__pricing-card checkout-pricing-card py-4">
                    <div class="input-group package-listing__search-bar">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="{{ __('blog.search_placeholder') }}"
                        >
                        <button class="btn" type="button">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>

                {{-- ================= RECENT BLOGS ================= --}}
                <div class="card pkg-details__pricing-card checkout-pricing-card py-4 mt-3">
                    <p class="p-large package-listing__filter-title">
                        {{ __('blog.recent_blogs') }}
                    </p>

                    <div class="blog-details__recent-wrapper">

                        @forelse($recentBlogs as $recent)
                            <div class="blog-details__recent-blog-card">

                                <a href="{{ route('blogs.detail', $recent->slug) }}" class="fw-500">
                                    {{ \Illuminate\Support\Str::limit($recent->translation?->title, 60) }}
                                </a>

                                <p class="text-light3 p-small">
                                    {{ optional($recent->published_at)->format('d F Y') }}
                                </p>

                                @if(!$loop->last)
                                    <hr class="m-0 w-100">
                                @endif

                            </div>
                        @empty
                            <p class="text-muted">
                                {{ __('blog.no_recent_blogs') }}
                            </p>
                        @endforelse

                    </div>
                </div>

                {{-- HELP CARD --}}
                <div class="card pkg-details__pricing-card py-4 mt-3">
                    <p class="p-large">
                        {{ __('blog.help_text') }}
                    </p>
                    <button class="btn btn-outline-secondary rounded-pill fw-600 mt-3 pkg-details__get-more-help-btn">
                        {{ __('blog.get_more_help') }}
                    </button>
                </div>

                {{-- SHARE --}}
                <div class="py-4 mt-4">
                    <p>{{ __('blog.share') }}</p>

                    @php
                        $shareUrl = url()->current();
                        $shareTitle = $blog->translation?->title;
                    @endphp

                    <div class="mt-2 pkg-details__share-icons">

                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" class="flex-center">
                            <img src="{{ asset('frontend/assets/icons/facebook.svg') }}">
                        </a>

                        <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" target="_blank" class="flex-center">
                            <img src="{{ asset('frontend/assets/icons/x.svg') }}">
                        </a>

                        <a href="https://wa.me/?text={{ $shareTitle }} {{ $shareUrl }}" target="_blank" class="flex-center">
                            <img src="{{ asset('frontend/assets/icons/share.svg') }}">
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
