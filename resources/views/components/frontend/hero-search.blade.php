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
        border-radius: 28px;
        padding: 8px;
        box-shadow: 0 14px 40px rgba(0, 0, 0, 0.18);
        transition: all .25s ease;
    }

    .search-input-wrap:hover {
        box-shadow: 0 18px 50px rgba(0, 0, 0, 0.24);
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
        height: 44px;
        border: none;
        background: transparent;
        padding-left: 55px;
        padding-right: 20px;
        font-size: 17px;
        font-weight: 500;
        color: #374151;
        outline: none;
    }

    .search-input-new::placeholder {
        color: #9ca3af;
        font-weight: 500;
    }

    /* ============================= */
    /* SEARCH BUTTON */
    /* ============================= */

    .search-btn-new {
        height: 48px;
        padding: 0 36px;
        border: none;
        border-radius: 50px;
        background: linear-gradient(135deg, #169754, #1fb86a);
        color: #fff;
        font-size: 17px;
        font-weight: 600;
        transition: all .25s ease;
        white-space: nowrap;
    }

    .search-btn-new:hover {
        background: linear-gradient(135deg, #12824a, #169754);
        transform: translateY(-1px);
        box-shadow: 0 12px 28px rgba(22, 151, 84, 0.35);
    }

    /* ============================= */
    /* PREMIUM DROPDOWN */
    /* ============================= */

    .city-suggestion-box {
        position: absolute;
        top: calc(100% + 10px);
        left: 0;
        right: 0;
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid #eef2f7;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.18);
        max-height: 280px;
        overflow-y: auto;
        z-index: 9999;
        padding: 6px 0;
    }

    /* each item */

    .city-suggestion-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 13px 18px;
        font-size: 15px;
        font-weight: 500;
        color: #111827;
        cursor: pointer;
        transition: all .18s ease;
    }

    /* hover */

    .city-suggestion-item:hover {
        background: #f8fafc;
    }

    /* scrollbar */

    .city-suggestion-box::-webkit-scrollbar {
        width: 6px;
    }

    .city-suggestion-box::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 10px;
    }

    /* ============================= */
    /* RESPONSIVE */
    /* ============================= */

    @media (max-width: 768px) {
        .search-input-new {
            height: 48px;
            font-size: 14px;
        }

        .search-btn-new {
            height: 48px;
            padding: 0 22px;
            font-size: 14px;
        }
    }
</style>

<div class="hero-search-box">
    <form action="{{ route('packages.index') }}" method="GET">

        <div class="search-input-wrap">

            <i class="fa fa-search search-icon"></i>

            <input required type="text" id="citySearchInput" name="search" class="search-input-new"
                placeholder="Search destinations like AlUla, Riyadh..." value="{{ request('search') }}"
                autocomplete="off">

            <div id="citySuggestionBox" class="city-suggestion-box d-none"></div>

            <button type="submit" class="search-btn-new">
                Search
            </button>

        </div>

    </form>
</div>

<script>
    const input = document.getElementById('citySearchInput');
    const box = document.getElementById('citySuggestionBox');
    const form = input.closest('form');

    let debounceTimer;

    // 🔥 fetch helper
    function fetchCities(query = '') {
        fetch('/cities/search?q=' + encodeURIComponent(query))
            .then(res => res.json())
            .then(renderCities)
            .catch(() => box.classList.add('d-none'));
    }

    // ✅ typing → only after 2 chars
    input.addEventListener('input', function () {
        const query = this.value.trim();

        clearTimeout(debounceTimer);

        if (query.length < 2) {
            box.classList.add('d-none');
            return;
        }

        debounceTimer = setTimeout(() => {
            fetchCities();
        }, 300);
    });

    // ✅ render
    function renderCities(cities) {
        if (!cities || !cities.length) {
            box.innerHTML = `<div class="city-suggestion-item">No destinations found</div>`;
            box.classList.remove('d-none');
            return;
        }

        box.innerHTML = cities.map(city => `
            <div class="city-suggestion-item"
                 data-name="${city.name}">
                <span>${city.name}</span>
            </div>
        `).join('');

        box.classList.remove('d-none');
    }

    // 🚀 ✅ CLICK → FILL + AUTO SUBMIT
    box.addEventListener('click', function (e) {
        const item = e.target.closest('.city-suggestion-item');
        if (!item) return;

        // fill input
        input.value = item.dataset.name;

        // hide dropdown
        box.classList.add('d-none');

        // 🔥 small delay for smooth UX
        setTimeout(() => {
            form.submit();
        }, 150);
    });

    // ✅ outside click
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.search-input-wrap')) {
            box.classList.add('d-none');
        }
    });
    </script>
