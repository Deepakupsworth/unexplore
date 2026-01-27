<div class="user-profile__details user-profile__box p-3">

    <div class="user-profile__details-content">

        {{-- HEADER --}}
        <div class="user-profile__details-header white-bg p-3">
            <p class="p-large fw-600 mb-1">Profile</p>
            <p class="text-light2">Update your avatar and personal information</p>
        </div>

        {{-- PROFILE FORM --}}
        <form method="POST"
              action="{{ route('user.profile.update') }}"
              enctype="multipart/form-data">
            @csrf

            <div class="user-profile__details-body white-bg p-3">

                {{-- PERSONAL INFO --}}
                <div class="user-profile__details-form user-profile__box p-3 white-bg">
                    <p class="fw-600 mb-1">Personal Information</p>
                    <p class="text-light2 p-small">
                        Update your personal details and contact information
                    </p>

                    <div class="mt-4">
                        <div class="row">

                            <div class="col-sm-6">
                                <label class="form-label">First Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="first_name"
                                       value="{{ $user->first_name }}">
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label">Last Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="last_name"
                                       value="{{ $user->last_name }}">
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label">Email Address</label>
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
                                <label class="form-label">Phone Number</label>
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

                    <p class="p-large fw-600 mb-1">Profile Picture</p>
                    <p class="text-light2 p-small">Update your avatar</p>

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
                            Upload new photo
                        </div>

                        {{-- DELETE --}}
                        @if($profileImage)
                        <div class="user-profile__upload-btn text-danger"
                             onclick="deleteProfileImage()"
                             style="cursor:pointer;">
                            <i class="fa-solid fa-trash-can"></i>
                            Remove
                        </div>
                        @endif
                    </div>

                    <span class="text-light2 p-micro">
                        JPG, PNG. Max size 2MB.
                    </span>
                </div>

                {{-- SAVE --}}
                <div class="mt-3">
                    <button class="btn btn-primary rounded-pill">
                        Save Changes
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
