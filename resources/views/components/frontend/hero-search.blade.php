<style>
    /* ============================= */
    /* HERO SEARCH — FINAL PREMIUM   */
    /* ============================= */

    .hero-banner {
        position: relative;
    }

    /* Container */
    .hero-search-box {
        position: relative;
        width: 100%;
        max-width: 820px;
    }

    /* Glass Form */
    .hero-search-form {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        padding: 14px;
        border-radius: 60px;
        border: 1px solid rgba(255, 255, 255, 0.25);
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.25);
        transition: all 0.3s ease;
    }

    /* subtle hover lift */
    .hero-search-form:hover {
        transform: translateY(-1px);
        box-shadow: 0 14px 45px rgba(0, 0, 0, 0.35);
    }

    /* ============================= */
    /* INPUT + SELECT */
    /* ============================= */

    .hero-search-input,
    .hero-search-select {
        border-radius: 40px !important;
        background: rgba(255, 255, 255, 0.92) !important;
        border: none !important;
        height: 54px;
        font-weight: 500;
        padding-left: 18px;

    }

    /* focus state */
    .hero-search-input:focus,
    .hero-search-select:focus {
        box-shadow: 0 0 0 3px rgba(31, 143, 74, 0.15);
        background: #ffffff !important;
    }

    /* placeholder */
    .hero-search-input::placeholder {
        color: #7a7a7a;
        font-weight: 400;
    }

    /* ============================= */
    /* SEARCH BUTTON */
    /* ============================= */

    .hero-search-btn {
        border-radius: 40px !important;
        height: 54px;
        font-weight: 600;
        background: linear-gradient(135deg, #1f8f4a, #26a65b);
        border: none;
        color: #fff;
        transition: all 0.25s ease;
    }

    /* hover */
    .hero-search-btn:hover {
        background: linear-gradient(135deg, #167a3d, #1f8f4a);
        transform: translateY(-1px);
    }

    /* icon spacing */
    .hero-search-btn i {
        margin-right: 6px;
    }

    /* ============================= */
    /* HERO CONTENT ALIGNMENT */
    /* ============================= */

    .hero-banner__content {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    /* ============================= */
    /* MOBILE RESPONSIVE */
    /* ============================= */

    @media (max-width: 991px) {
        .hero-search-box {
            max-width: 100%;
        }
    }

    @media (max-width: 768px) {
        .hero-search-form {
            border-radius: 24px;
            padding: 12px;
        }

        .hero-search-input,
        .hero-search-select,
        .hero-search-btn {
            height: 48px;
            border-radius: 14px !important;
            font-size: 14px;
        }
    }

    @media (max-width: 576px) {
        .hero-search-form .row {
            gap: 10px;
        }

        .hero-search-box {
            margin-bottom: 24px;
        }
    }
</style>
<div class="hero-search-box">
    <form action="" method="GET" class="hero-search-form">
        <div class="row g-2 align-items-center">

            {{-- Category --}}
            <div class="col-md-3">
                <select name="type" class="form-select hero-search-select">
                    <option value="packages">Packages</option>
                    <option value="things">Things To Do</option>
                    <option value="events">Events</option>
                </select>
            </div>

            {{-- Keyword --}}
            <div class="col-md-6">
                <input type="text" name="keyword" class="form-control hero-search-input"
                    placeholder="Search destinations, experiences..." value="{{ request('keyword') }}">
            </div>

            {{-- Button --}}
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100 hero-search-btn">
                    <i class="fa fa-search"></i> Search
                </button>
            </div>

        </div>
    </form>
</div>
