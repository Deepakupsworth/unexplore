<style>



/* ============================= */
/* SEARCH BOX POSITION */
/* ============================= */

.hero-search-box {
    position: relative;
    width: 100%;
    margin-bottom: 20px;
}

/* ============================= */
/* MAIN SEARCH WRAPPER */
/* ============================= */

.search-input-wrap {
    position: relative;
    display: flex;
    align-items: center;
    background: #f1f1f1;
    border-radius: 24px;
    padding: 8px;
    box-shadow: 0 12px 35px rgba(0,0,0,0.18);
    transition: all .25s ease;
}

.search-input-wrap:hover {
    box-shadow: 0 16px 45px rgba(0,0,0,0.22);
}

/* ============================= */
/* SEARCH ICON */
/* ============================= */

.search-icon {
    position: absolute;
    left: 22px;
    color: #8c8c8c;
    font-size: 18px;
}

/* ============================= */
/* INPUT FIELD */
/* ============================= */

.search-input-new {
    flex: 1;
    height: 36px;
    border: none;
    background: transparent;
    padding-left: 55px;
    padding-right: 20px;
    font-size: 18px;
    font-weight: 500;
    color: #555;
    outline: none;
}

.search-input-new::placeholder {
    color: #9a9a9a;
    font-weight: 500;
}

/* ============================= */
/* SEARCH BUTTON — THEME GREEN */
/* ============================= */

.search-btn-new {
    height: 46px;
    padding: 0 42px;
    border: none;
    border-radius: 50px;
    background: linear-gradient(135deg, #169754, #1fb86a);
    color: #fff;
    font-size: 18px;
    font-weight: 600;
    transition: all .25s ease;
}

.search-btn-new:hover {
    background: linear-gradient(135deg, #12824a, #169754);
    transform: translateY(-1px);
    box-shadow: 0 10px 25px rgba(22,151,84,0.35);
}

/* ============================= */
/* INPUT FOCUS BORDER */
/* ============================= */

.search-input-wrap:focus-within {
    box-shadow:
        0 12px 35px rgba(0,0,0,0.18),
        0 0 0 3px rgba(22,151,84,0.15);
}
/* ============================= */
/* RESPONSIVE */
/* ============================= */

@media (max-width: 768px) {

    .hero-banner__content {
        max-width: 100%;
    }

    .search-input-new {
        height: 48px;
        font-size: 14px;
    }

    .search-btn-new {
        height: 48px;
        padding: 0 22px;
        font-size: 14px;
    }

    .search-input-wrap {
        border-radius: 24px;
    }
}
</style>
<div class="hero-search-box">
    <form action="{{ route('packages.index') }}" method="GET" class="hero-search-form-new">

        <div class="search-input-wrap">

            <i class="fa fa-search search-icon"></i>

            <input required type="text" name="search" class="search-input-new" placeholder="Search destinations like AlUla, Riyadh..."
                value="{{ request('search') }}">

            <button type="submit" class="search-btn-new">
                Search
            </button>

        </div>

    </form>
</div>
