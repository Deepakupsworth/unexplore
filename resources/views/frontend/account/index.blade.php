@extends('frontend.layout')

@section('content')
    <section class="user-profile__section">
        <div class="container">
            <div class="user-profile__content d-flex gap-3">

                {{-- ================= LEFT MENU ================= --}}
                <div class="user-profile__menu p-3">
                    <ul class="nav list-unstyled m-0 p-0 d-flex flex-column gap-2">

                        <li>
                            <a href="javascript:void(0)" class="nav-link account-tab active" data-tab="dashboard">
                                <i class="fa-solid fa-house p-large"></i>
                                Dashboard
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)" class="nav-link account-tab" data-tab="profile">
                                <i class="fa-solid fa-circle-user p-large"></i>
                                Profile
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)" class="nav-link account-tab" data-tab="bookings">
                                <i class="fa-solid fa-calendar-check p-large"></i>
                                Bookings
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)" class="nav-link account-tab" data-tab="addresses">
                                <i class="fa-solid fa-location-dot p-large"></i>
                                Manage Address
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="nav-link account-tab" data-tab="travellers">
                                <i class="fa-solid fa-people-group p-large"></i>

                                Manage Traveller
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

                {{-- ================= RIGHT CONTENT ================= --}}
                <div class="w-100">
                    <div id="accountTabContent" class="user-profile__box">
                        {{-- AJAX CONTENT LOADS HERE --}}
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ================= ADD TRAVELLER MODAL ================= --}}

    @if ($_GET['tab'] == 'travellers')
        @include('frontend.account.partials.traveller_modal')

        @include('frontend.account.partials.view_traveller_modal')
    @endif

    {{-- ================= ADD ADDRESS MODAL ================= --}}

    @if ($_GET['tab'] == 'addresses')
        @include('frontend.account.partials.add_address_modal')
    @endif
@endsection

@push('scripts')
    <script>
        /* ================= LOAD TAB ================= */
        function loadAccountTab(tab) {

            document.querySelectorAll('.account-tab').forEach(el => {
                el.classList.remove('active');
                if (el.dataset.tab === tab) el.classList.add('active');
            });

            fetch(`/account/load?tab=${tab}`)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('accountTabContent').innerHTML = html;
                    history.pushState(null, '', `?tab=${tab}`);
                });
        }

        /* ================= CLICK HANDLER ================= */
        document.querySelectorAll('.account-tab').forEach(el => {
            el.addEventListener('click', () => loadAccountTab(el.dataset.tab));
        });

        /* ================= INITIAL LOAD ================= */
        document.addEventListener('DOMContentLoaded', () => {
            const tab = new URLSearchParams(window.location.search).get('tab') || 'dashboard';
            loadAccountTab(tab);
        });

        // /* ================= ADDRESS CRUD ================= */


        function deleteAddress(id) {
            if (!confirm('Delete this address?')) return;

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

            const method = id ? 'POST' : 'POST';

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
    </script>
    <script>
        /* ================= OPEN FILE DIALOG ================= */
        document.addEventListener('click', function(e) {

            const btn = e.target.closest('[data-upload-btn]');
            if (!btn) return;

            btn.querySelector('[data-upload-input]').click();
        });

        /* ================= UPLOAD IMAGE ================= */
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
                    } else {
                        alert('Upload failed');
                    }
                });
        });

        /* ================= DELETE IMAGE ================= */
        function deleteProfileImage() {

            if (!confirm('Remove profile image?')) return;

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
                            .src = '{{ asset('frontend/assets/user.jpeg') }}';
                    }
                });
        }
    </script>

    <script>
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
            if (!confirm('Delete traveller?')) return;
            fetch(`/account/travellers/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(() => location.reload());
        }
    </script>

    <script>
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
    document.addEventListener('DOMContentLoaded', function () {

        document.body.addEventListener('click', function (e) {
            const btn = e.target.closest('.user-bookings__view-details-btn');
            if (!btn) return;

            // -------- BASIC INFO --------
            bookingTitle.innerText = btn.dataset.title || '';
            bookingRoute.innerText = btn.dataset.route || '';
            bookingTotal.innerText = btn.dataset.total || '';
            bookingDate.innerText  = btn.dataset.date || '';
            thumbImage.src         = btn.dataset.thumb || '';

            // -------- RESET DRAWER --------
            const amenitiesBox = document.getElementById('drawerAmenities');
            amenitiesBox.innerHTML = '';

            // -------- SNAPSHOT DAYS --------
            const days = JSON.parse(btn.dataset.days || '[]');

            // -------- COLLECT ITEMS --------
            const items = [];
            days.forEach(day => {
                (day.items || []).forEach(item => {
                    items.push(item);
                });
            });

            // -------- GROUP BY TYPE --------
            const grouped = items.reduce((acc, item) => {
                acc[item.item_type] = acc[item.item_type] || [];
                acc[item.item_type].push(item);
                return acc;
            }, {});

            // -------- RENDER --------
            const labels = {
                hotel: count => `${count} Hotel Stays`,
                event: count => `${count} Activities`,
                todo:  count => `${count} Things To Do`,
                transport: count => `${count} Transports`,
            };

            Object.keys(grouped).forEach(type => {
                const p = document.createElement('p');
                p.innerText = labels[type]
                    ? labels[type](grouped[type].length)
                    : `${grouped[type].length} ${type}`;
                amenitiesBox.appendChild(p);
            });

        });

    });
    </script>

@endpush
