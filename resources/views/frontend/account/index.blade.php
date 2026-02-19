@extends('frontend.layout')

@section('content')
    <section class="user-profile__banner">
        <div class="container">
            <div class="user-profile__banner-content text-center">
                <h1 class="text-white mb-3 h2">{{ __('account.user.profile') }}</h1>
                <div class="banner-breadcrumb rounded-pill d-flex align-items-center justify-content-center gap-3 p-small">
                    <a href="#" class="">
                        <i class="fa-solid fa-house"></i>
                        {{ __('account.home') }}
                    </a>
                    <span><i class="fa-solid fa-angles-right"></i></span>
                    <span class="active">{{ __('account.profile') }}</span>
                </div>
            </div>
        </div>
    </section>
    <section class="user-profile__section">
        <div class="container">
            <div class="user-profile__content d-flex gap-3">

                {{-- ================= LEFT MENU ================= --}}
                <div class="user-profile__menu p-3">
                    <ul class="nav list-unstyled m-0 p-0 d-flex flex-column gap-2">

                        <li>
                            <a href="javascript:void(0)" class="nav-link account-tab active" data-tab="dashboard">
                                <i class="fa-solid fa-house p-large"></i>
                                {{ __('account.dashboard') }}
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)" class="nav-link account-tab" data-tab="profile">
                                <i class="fa-solid fa-circle-user p-large"></i>
                                {{ __('account.profile') }}
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)" class="nav-link account-tab" data-tab="bookings">
                                <i class="fa-solid fa-calendar-check p-large"></i>
                                {{ __('account.bookings') }}
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)" class="nav-link account-tab" data-tab="addresses">
                                <i class="fa-solid fa-location-dot p-large"></i>
                                {{ __('account.manage_address') }}
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="nav-link account-tab" data-tab="travellers">
                                <i class="fa-solid fa-people-group p-large"></i>

                                {{ __('account.manage_traveller') }}
                            </a>
                        </li>

                        <!-- <li>
                                                        <a href="javascript:void(0)" class="nav-link account-tab" data-tab="wishlist">
                                                            <i class="fa-solid fa-heart p-large"></i>
                                                            Wishlist
                                                        </a>
                                                    </li> -->

                    </ul>
                </div>

                {{-- RIGHT CONTENT --}}
                <div class="w-100">
                    <div id="accountTabContent" class="user-profile__box">
                        {{-- AJAX CONTENT LOADS HERE --}}
                    </div>
                </div>

                {{-- ✅ KEEP MODALS HERE (OUTSIDE AJAX) --}}
                @include('frontend.account.partials.traveller_modal')
                @include('frontend.account.partials.view_traveller_modal')
                @include('frontend.account.partials.add_address_modal')


            </div>
        </div>
    </section>
    @include('frontend.account.partials.booking-drawer')
@endsection

@push('scripts')
    <script>
        /* =========================================================
           ACCOUNT TAB LOADER (PRODUCTION READY)
        ========================================================= */

        function loadAccountTab(tab) {

            // ✅ active menu highlight
            document.querySelectorAll('.account-tab').forEach(el => {
                el.classList.remove('active');
                if (el.dataset.tab === tab) {
                    el.classList.add('active');
                }
            });

            // ✅ show loader (optional but pro)
            const container = document.getElementById('accountTabContent');
            if (container) {
                container.innerHTML =
                    '<div class="text-center py-5">Loading...</div>';
            }

            // ✅ ajax load
            fetch(`/account/load?tab=${tab}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.text())
                .then(html => {
                    if (container) {
                        container.innerHTML = html;
                    }

                    // ✅ update URL without reload
                    history.pushState(null, '', `?tab=${tab}`);
                })
                .catch(() => {
                    if (container) {
                        container.innerHTML =
                            '<div class="text-danger text-center py-5">Failed to load</div>';
                    }
                });
        }


        /* =========================================================
           🔥 EVENT DELEGATION (CRITICAL FIX)
           Works after AJAX replace
        ========================================================= */

        document.addEventListener('click', function(e) {

            const tabEl = e.target.closest('.account-tab');
            if (!tabEl) return;

            e.preventDefault();
            loadAccountTab(tabEl.dataset.tab);
        });


        /* =========================================================
           INITIAL TAB LOAD
        ========================================================= */

        document.addEventListener('DOMContentLoaded', function() {

            const params = new URLSearchParams(window.location.search);
            const tab = params.get('tab') || 'dashboard';

            loadAccountTab(tab);
        });


        /* =========================================================
           ADDRESS CRUD
        ========================================================= */

        function deleteAddress(id) {
            if (!confirm("{{ __('account.delete_address_confirm') }}")) return;

            fetch(`/account/addresses/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(() => loadAccountTab('addresses'));
        }

        function viewAddress(id) {
            fetch(`/account/addresses/${id}`)
                .then(res => res.json())
                .then(data => {
                    alert(
                        `Address Title: ${data.address_title}\n\n` +
                        `${data.full_address}\n${data.city} - ${data.pin_code}`
                    );
                });
        }

        function editAddress(id) {
            fetch(`/account/addresses/${id}`)
                .then(res => res.json())
                .then(data => {

                    const form = document.getElementById('addressForm');

                    form.address_title.value = data.address_title;
                    form.city.value = data.city;
                    form.pin_code.value = data.pin_code;
                    form.full_address.value = data.full_address;
                    form.country.value = data.country;

                    form.dataset.id = id;

                    document.querySelector('#addAddressModal .modal-title')
                        .innerText = 'Edit Address';

                    bootstrap.Modal.getOrCreateInstance(
                        document.getElementById('addAddressModal')
                    ).show();
                });
        }

        function saveAddress() {

            const form = document.getElementById('addressForm');
            const id = form.dataset.id ?? '';

            const url = id ?
                `/account/addresses/${id}` :
                `/account/addresses`;

            const formData = new FormData(form);

            if (id) {
                formData.append('_method', 'PUT');
            }

            fetch(url, {
                method: 'POST',
                body: formData
            }).then(() => {

                form.reset();
                delete form.dataset.id;

                document.querySelector('#addAddressModal .modal-title')
                    .innerText = 'Add New Address';

                bootstrap.Modal.getInstance(
                    document.getElementById('addAddressModal')
                ).hide();

                loadAccountTab('addresses');
            });
        }


        /* =========================================================
           PROFILE IMAGE UPLOAD
        ========================================================= */

        document.addEventListener('click', function(e) {

            const btn = e.target.closest('[data-upload-btn]');
            if (!btn) return;

            btn.querySelector('[data-upload-input]').click();
        });

        document.addEventListener('change', function(e) {

            const input = e.target.closest('[data-upload-input]');
            if (!input) return;

            const file = input.files[0];
            if (!file) return;

            const formData = new FormData();
            formData.append('thumb', file);
            formData.append('_token', '{{ csrf_token() }}');

            fetch('{{ route('profile.image.upload') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        const reader = new FileReader();
                        reader.onload = e => {
                            document.querySelector('[data-profile-preview]').src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                        iziToast.success({
                            title: 'Success',
                            message: 'Profile image updated successfully.',
                            position: 'topRight',
                            timeout: 3000
                        });

                    }
                });
        });

        function deleteProfileImage() {

            if (!confirm("{{ __('account.remove_profile_image_confirm') }}")) return;

            fetch('{{ route('profile.image.delete') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        document.querySelector('[data-profile-preview]')
                            .src = '{{ asset('frontend/assets/user.png') }}';

                            iziToast.success({
                            title: 'Success',
                            message: 'Profile image delated successfully.',
                            position: 'topRight',
                            timeout: 3000
                        });
                    }
                });
        }


        /* =========================================================
           TRAVELLER CRUD
        ========================================================= */

        function saveTraveller() {
            const form = document.getElementById('travellerForm');
            const id = form.dataset.id ?? null;

            const data = new FormData(form);
            if (id) data.set('_method', 'PUT');

            fetch(id ? `/account/travellers/${id}` : `/account/travellers`, {
                method: 'POST',
                body: data
            }).then(() => location.reload());
        }

        function editTraveller(id) {
            fetch(`/account/travellers/${id}`)
                .then(res => res.json())
                .then(t => {
                    const f = document.getElementById('travellerForm');
                    Object.keys(t).forEach(k => f[k] && (f[k].value = t[k]));
                    f.dataset.id = id;

                    bootstrap.Modal.getOrCreateInstance(
                        document.getElementById('travellerModal')
                    ).show();
                });
        }

        function deleteTraveller(id) {
            if (!confirm("{{ __('account.remove_profile_image_confirm') }}")) return;

            fetch(`/account/travellers/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(() => location.reload());
        }

        function viewTraveller(id) {
            fetch(`/account/travellers/${id}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.json())
                .then(data => {

                    document.getElementById('tv-name').innerText =
                        data.first_name + ' ' + data.last_name;

                    document.getElementById('tv-type').innerText = data.type;
                    document.getElementById('tv-gender').innerText = data.gender;
                    document.getElementById('tv-dob').innerText = data.dob ?? '-';
                    document.getElementById('tv-age').innerText = data.age ?? '-';
                    document.getElementById('tv-country').innerText = data.country;
                    document.getElementById('tv-created').innerText = data.created_at;

                    new bootstrap.Modal(
                        document.getElementById('viewTravellerModal')
                    ).show();
                })
                .catch(() => alert('Unable to load traveller details'));
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.body.addEventListener('click', function(e) {

                const btn = e.target.closest('.user-bookings__view-details-btn');
                if (!btn) return;

                /* ================= BASIC INFO ================= */
                document.getElementById('drawerLabel').innerHTML = btn.dataset.label || '';
                document.getElementById('bookingTitle').innerText = btn.dataset.title || '';
                document.getElementById('bookingRoute').innerText = btn.dataset.route || '';
                document.getElementById('bookingTotal').innerText = btn.dataset.total || '';
                document.getElementById('bookingDate').innerText = btn.dataset.date || '';
                document.getElementById('thumbImage').src = btn.dataset.thumb || '';

                /* ================= BADGE COLOR ================= */
                let badgeClass = btn.dataset.badgeClass || '';
                const labelEl = document.getElementById('drawerLabel');

                labelEl.classList.forEach(cls => {
                    if (cls.startsWith('bg-') || cls.startsWith('text-')) {
                        labelEl.classList.remove(cls);
                    }
                });

                if (badgeClass.startsWith('bg-')) {
                    badgeClass = badgeClass.replace('bg-', 'text-');
                }

                if (badgeClass) {
                    labelEl.classList.add(badgeClass);
                }

                /* ================= PAYMENTS ================= */
                const icon = btn.dataset.currencyIcon || '';
                const paymentsRaw = btn.dataset.payments || '[]';

                let payments = [];
                try {
                    payments = JSON.parse(paymentsRaw);
                } catch (e) {
                    payments = [];
                }

                const paymentItems = payments.map(item => {

                    let methodLabel = formatLabel(item.payment_method) || '-';
                    let txnId = item.transaction_id ? '#' + item.transaction_id : '';

                    return `
                        <div class="d-flex gap-3 mb-2">
                            <img src="/frontend/assets/icons/drag-vertical.svg">
                            <div class="booking-details__item">
                                <span class="booking-details__item-title">{{ __('account.payment_type') }}</span>
                                <span class="fw-500 d-flex gap-3">
                                    <span class="text-black fw-600">:</span>
                                    ${methodLabel}
                                </span>
                            </div>
                        </div>

                        <div class="d-flex gap-3 mb-2">
                            <img src="/frontend/assets/icons/drag-vertical.svg">
                            <div class="booking-details__item">
                                <span class="booking-details__item-title">{{ __('account.transaction_id') }}</span>
                                <span class="fw-500 d-flex gap-3">
                                    <span class="text-black fw-600">:</span>
                                    ${txnId}
                                </span>
                            </div>
                        </div>
                    `;
                }).join('');

                document.getElementById('transactionItem').innerHTML = paymentItems;

                document.getElementById('bookingCurrencyIcon').innerHTML =
                    icon ? `<img src="${icon}">` : '';

                /* ================= ITINERARY ================= */
                const itineraryBox = document.getElementById('drawerItinerary');
                itineraryBox.innerHTML = '';

                let days = [];

                try {
                    days = JSON.parse(btn.dataset.days || '[]');
                } catch (e) {
                    days = [];
                }

                days.forEach(day => {

                    const dayWrapper = document.createElement('div');
                    dayWrapper.classList.add('mb-4');

                    /* ---------- DAY TITLE ---------- */
                    const dayTitle = document.createElement('h6');
                    dayTitle.classList.add('fw-600', 'mb-2');
                    dayTitle.innerText =
                        `Day ${day.day_number} - ${day.city_name || ''}`;

                    dayWrapper.appendChild(dayTitle);

                    /* ---------- ITEMS ---------- */
                    (day.items || []).forEach(item => {

                        const title = item.title || item.item_type || 'Item';
                        const imagePath = item.image_path || null;
                        const extraPrice = parseFloat(item.extra_price || 0);

                        const itemRow = document.createElement('div');
                        itemRow.classList.add(
                            'd-flex',
                            'align-items-center',
                            'gap-3',
                            'mb-2',
                            'p-2',
                            'bg-light',
                            'rounded'
                        );

                        /* IMAGE */
                        const img = document.createElement('img');
                        img.style.width = '50px';
                        img.style.height = '50px';
                        img.style.objectFit = 'cover';
                        img.style.borderRadius = '8px';

                        img.src = imagePath ?
                            `/storage/${imagePath}` :
                            '/frontend/assets/default.jpg';

                        /* INFO */
                        const info = document.createElement('div');

                        const titleDiv = document.createElement('div');
                        titleDiv.classList.add('fw-500');
                        titleDiv.innerText = title;

                        const timeDiv = document.createElement('div');
                        timeDiv.classList.add('small', 'text-muted');

                        console.log(item.start_time, item.end_time);

                        if (item.start_time && item.end_time) {

                            const start = safeFormatTime(item.start_time);
                            const end = safeFormatTime(item.end_time);

                            if (start && end) {
                                timeDiv.innerText = `${start} → ${end}`;
                            }
                        }


                        info.appendChild(titleDiv);
                        info.appendChild(timeDiv);

                        /* ✅ EXTRA PRICE */
                        if (extraPrice > 0) {
                            const priceDiv = document.createElement('div');
                            priceDiv.classList.add('small', 'text-success', 'fw-600');
                            priceDiv.innerText = `+ ${extraPrice.toFixed(2)}`;
                            info.appendChild(priceDiv);
                        }

                        itemRow.appendChild(img);
                        itemRow.appendChild(info);

                        dayWrapper.appendChild(itemRow);
                    });

                    itineraryBox.appendChild(dayWrapper);
                });

                /* ================= TIME FORMAT ================= */
                function safeFormatTime(timeString) {
                    if (!timeString) return '';

                    try {
                        let date;

                        // ✅ case 1: full ISO datetime
                        if (timeString.includes('T')) {
                            date = new Date(timeString);
                        }
                        // ✅ case 2: only time HH:mm:ss
                        else {
                            date = new Date(`1970-01-01T${timeString}`);
                        }

                        if (isNaN(date.getTime())) return '';

                        return date.toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit'
                        });

                    } catch (e) {
                        return '';
                    }
                }


            });

        });

        /* ================= LABEL FORMAT ================= */
        function formatLabel(value) {
            if (!value) return '-';

            return value
                .replace(/_/g, ' ')
                .replace(/\b\w/g, c => c.toUpperCase());
        }
    </script>
@endpush
