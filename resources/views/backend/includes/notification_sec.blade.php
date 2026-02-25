<div class="relative md:block hidden">
    <button
        class="lg:h-[32px] lg:w-[32px] lg:bg-slate-100 lg:dark:bg-slate-900 dark:text-white text-slate-900 cursor-pointer rounded-full text-[20px] flex flex-col items-center justify-center"
        type="button" data-bs-toggle="dropdown" aria-expanded="false">

        <iconify-icon
            class="animate-tada text-slate-800 dark:text-white text-xl"
            icon="heroicons-outline:bell">
        </iconify-icon>

        {{-- ================= DATA PREP ================= --}}
        @php
            $user = auth()->user();

            $unreadCount = $user->unreadNotifications()->count();

            // unread first
            $unreadNotifications = $user->unreadNotifications()->latest()->get();
            $readNotifications   = $user->readNotifications()->latest()->get();

            $allNotifications = $unreadNotifications->concat($readNotifications);

            $initialNotifications   = $allNotifications->take(4);
            $remainingNotifications = $allNotifications->slice(4);
        @endphp

        {{-- bell count --}}
        @if ($unreadCount > 0)
            <span
                class="absolute -right-1 lg:top-0 -top-[6px] h-4 w-4 bg-red-500 text-[8px] font-semibold flex flex-col items-center justify-center rounded-full text-white z-[99]">
                {{ $unreadCount }}
            </span>
        @endif
    </button>

    <!-- ================= DROPDOWN ================= -->
    <div
        class="dropdown-menu z-10 hidden bg-white shadow w-[335px] dark:bg-slate-800 border dark:border-slate-700 !top-[23px] rounded-md overflow-hidden lrt:origin-top-right rtl:origin-top-left">

        <div class="flex items-center justify-between py-4 px-4">
            <h3 class="text-sm font-Inter font-medium text-slate-700 dark:text-white">
                Notifications
            </h3>

            <a href="javascript:void(0)"
               id="seeMoreBtn"
               class="text-xs font-Inter font-normal underline text-slate-500 dark:text-white">
                See More
            </a>
        </div>

        <div role="none" class="max-h-[320px] overflow-y-auto">

            {{-- ================= TOP 4 ================= --}}
            @forelse($initialNotifications as $notification)

                @php
                    $data     = $notification->data;
                    $payload  = $data['payload'] ?? [];
                    $isUnread = is_null($notification->read_at);

                    $title = match ($data['type'] ?? '') {
                        'booking_confirmed' => 'Booking Confirmed',
                        'new_booking'       => 'New Booking',
                        default             => 'Notification',
                    };
                @endphp

                <div
                    class="{{ $isUnread ? 'bg-slate-100 dark:bg-slate-700 dark:bg-opacity-70' : '' }} text-slate-800 block w-full px-4 py-2 text-sm relative notification-item">

                    <div class="flex ltr:text-left rtl:text-right">

                        <div class="flex-none ltr:mr-3 rtl:ml-3">
                            <div class="h-8 w-8 bg-white rounded-full">
                                <img src="/backend/images/all-img/user.png"
                                     class="border-white block w-full h-full object-cover rounded-full border">
                            </div>
                        </div>

                        <div class="flex-1">
                            <a href="{{ $payload['url'] ?? '#' }}"
                               class="notification-link text-slate-600 dark:text-slate-300 text-sm font-medium mb-1 before:w-full before:h-full before:absolute before:top-0 before:left-0"
                               data-id="{{ $notification->id }}">
                                {{ $title }}
                            </a>

                            <div class="text-slate-500 dark:text-slate-200 text-xs leading-4">
                                {{ $payload['message'] ?? '' }}
                            </div>

                            <div class="text-slate-400 dark:text-slate-400 text-xs mt-1">
                                {{ $notification->created_at->diffForHumans() }}
                            </div>
                        </div>

                        @if ($isUnread)
                            <div class="flex-0 unread-dot">
                                <span class="h-[10px] w-[10px] bg-danger-500 border border-white dark:border-slate-400 rounded-full inline-block"></span>
                            </div>
                        @endif

                    </div>
                </div>

            @empty
                <div class="text-center p-4 text-sm text-slate-500">
                    No notifications
                </div>
            @endforelse

            {{-- ================= REMAINING ================= --}}
            <div id="moreNotifications" class="hidden">

                @foreach ($remainingNotifications as $notification)

                    @php
                        $data     = $notification->data;
                        $payload  = $data['payload'] ?? [];
                        $isUnread = is_null($notification->read_at);

                        $title = match ($data['type'] ?? '') {
                            'booking_confirmed' => 'Booking Confirmed',
                            'new_booking'       => 'New Booking',
                            default             => 'Notification',
                        };
                    @endphp

                    <div
                        class="{{ $isUnread ? 'bg-slate-100 dark:bg-slate-700 dark:bg-opacity-70' : '' }} text-slate-800 block w-full px-4 py-2 text-sm relative notification-item">

                        <div class="flex ltr:text-left rtl:text-right">

                            <div class="flex-none ltr:mr-3 rtl:ml-3">
                                <div class="h-8 w-8 bg-white rounded-full">
                                    <img src="/backend/images/all-img/user.png"
                                         class="border-white block w-full h-full object-cover rounded-full border">
                                </div>
                            </div>

                            <div class="flex-1">
                                <a href="{{ $payload['url'] ?? '#' }}"
                                   class="notification-link text-slate-600 dark:text-slate-300 text-sm font-medium mb-1 before:w-full before:h-full before:absolute before:top-0 before:left-0"
                                   data-id="{{ $notification->id }}">
                                    {{ $title }}
                                </a>

                                <div class="text-slate-500 dark:text-slate-200 text-xs leading-4">
                                    {{ $payload['message'] ?? '' }}
                                </div>

                                <div class="text-slate-400 dark:text-slate-400 text-xs mt-1">
                                    {{ $notification->created_at->diffForHumans() }}
                                </div>
                            </div>

                            @if ($isUnread)
                                <div class="flex-0 unread-dot">
                                    <span class="h-[10px] w-[10px] bg-danger-500 border border-white dark:border-slate-400 rounded-full inline-block"></span>
                                </div>
                            @endif

                        </div>
                    </div>

                @endforeach
            </div>
        </div>

        {{-- footer --}}
        <div class="p-3 border-t text-center">
            <form method="POST" action="{{ route('notifications.markAllRead') }}">
                @csrf
                <button class="text-xs text-primary-600 hover:underline">
                    Mark all as read
                </button>
            </form>
        </div>
    </div>
</div>
