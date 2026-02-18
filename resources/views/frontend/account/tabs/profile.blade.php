<div class="user-profile__details user-profile__box p-3">

    <div class="user-profile__details-content">

        {{-- HEADER --}}
        <div class="user-profile__details-header white-bg p-3">
            <p class="p-large fw-600 mb-1">{{ __('account.profile') }}</p>
            <p class="text-light2">{{ __('account.profile_desc') }} </p>
        </div>

        {{-- PROFILE FORM --}}
        <form method="POST"
              action="{{ route('user.profile.update') }}"
              enctype="multipart/form-data">
            @csrf

            <div class="user-profile__details-body white-bg p-3">

                {{-- PERSONAL INFO --}}
                <div class="user-profile__details-form user-profile__box p-3 white-bg">
                    <p class="fw-600 mb-1">{{ __('account.personal_information') }}</p>
                    <p class="text-light2 p-small">
                        {{ __('account.personal_information_desc') }}
                    </p>

                    <div class="mt-4">
                        <div class="row">

                            <div class="col-sm-6">
                                <label class="form-label">{{ __('account.first_name') }}</label>
                                <input type="text"
                                       class="form-control"
                                       name="first_name"
                                       value="{{ $user->first_name }}">
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label">{{ __('account.last_name') }}</label>
                                <input type="text"
                                       class="form-control"
                                       name="last_name"
                                       value="{{ $user->last_name }}">
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label">{{ __('account.email_address') }}</label>
                                <div class="input-group custom-input-group mb-3">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>
                                    <input type="text"
                                           class="form-control"
                                           value="{{ $user->email }}"
                                           readonly>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label">{{ __('account.phone_number') }}</label>
                                <input type="text"
                                       class="form-control"
                                       name="phone"
                                       value="{{ $user->phone ?? '' }}">
                            </div>

                        </div>
                    </div>
                </div>

                {{-- AVATAR --}}
                <div class="user-profile__details-avatar user-profile__box p-3 white-bg"
                     data-profile-avatar>

                    <p class="p-large fw-600 mb-1">{{ __('account.profile_picture') }}</p>
                    <p class="text-light2 p-small">{{ __('account.profile_picture_desc') }}</p>

                    <div class="user-profile__avatar my-4">
                        <img data-profile-preview
                             src="{{ $profileImage
                                ? asset('storage/'.$profileImage->image_path)
                                : asset('frontend/assets/user.jpeg') }}"
                             class="rounded-circle"
                             alt="User">
                    </div>

                    <div class="d-flex gap-2">

                        {{-- UPLOAD --}}
                        <div class="user-profile__upload-btn"
                             data-upload-btn
                             style="cursor:pointer;">
                            <input type="file"
                                   data-upload-input
                                   accept="image/*"
                                   hidden>
                            <i class="fa-solid fa-arrow-up-from-bracket"></i>
                            {{ __('account.upload_new_photo') }}
                        </div>

                        {{-- DELETE --}}
                        @if($profileImage)
                        <div class="user-profile__upload-btn text-danger"
                             onclick="deleteProfileImage()"
                             style="cursor:pointer;">
                            <i class="fa-solid fa-trash-can"></i>
                            {{ __('account.remove') }}
                        </div>
                        @endif
                    </div>

                    <span class="text-light2 p-micro">
                        {{ __('account.image_hint') }}
                    </span>
                </div>

            </div>
            {{-- SAVE --}}
            <div class="mt-3 d-flex justify-content-end">
                <button class="btn btn-primary rounded-pill">
                    {{ __('account.save_changes') }}
                </button>
            </div>
        </form>
    </div>
</div>
