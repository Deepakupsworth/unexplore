@extends('backend.layout')

@section('content')

    {{-- Breadcrumb --}}
    <div class="mb-5">
        <ul class="flex items-center gap-2 text-sm">
            <li class="text-primary-500">
                <a href="{{ url('/admin/dashboard') }}">
                    <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                </a>
            </li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-700 font-medium">Company Details</li>
        </ul>
    </div>

    <div class="card">
        <header class="card-header flex justify-between items-center">
            <h4 class="card-title">Company Details</h4>

            @if($model && $model->id)
                <span class="badge bg-success-500 text-white">
                    Configured
                </span>
            @endif
        </header>

        <div class="card-body p-4">

            <form method="POST" action="{{ route('admin.company-details.save') }}">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Company Name --}}
                    <div class="fromGroup">
                        <label class="form-label">Company Name</label>
                        <input type="text"
                               name="company_name"
                               value="{{ old('company_name', $model->company_name) }}"
                               class="form-control"
                               required>
                    </div>

                    {{-- Email --}}
                    <div class="fromGroup">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email', $model->email) }}"
                               class="form-control">
                    </div>

                    {{-- Phone --}}
                    <div class="fromGroup">
                        <label class="form-label">Phone</label>
                        <input type="text"
                               name="phone"
                               value="{{ old('phone', $model->phone) }}"
                               class="form-control">
                    </div>

                    {{-- WhatsApp --}}
                    <div class="fromGroup">
                        <label class="form-label">WhatsApp</label>
                        <input type="text"
                               name="whatsapp"
                               value="{{ old('whatsapp', $model->whatsapp) }}"
                               class="form-control">
                    </div>

                    {{-- Address --}}
                    <div class="fromGroup md:col-span-2">
                        <label class="form-label">Address</label>
                        <input type="text"
                               name="address_line"
                               value="{{ old('address_line', $model->address_line) }}"
                               class="form-control">
                    </div>

                    {{-- City --}}
                    <div class="fromGroup">
                        <label class="form-label">City</label>
                        <input type="text"
                               name="city"
                               value="{{ old('city', $model->city) }}"
                               class="form-control">
                    </div>

                    {{-- Country --}}
                    <div class="fromGroup">
                        <label class="form-label">Country</label>
                        <input type="text"
                               name="country"
                               value="{{ old('country', $model->country) }}"
                               class="form-control">
                    </div>

                    {{-- Postal Code --}}
                    <div class="fromGroup">
                        <label class="form-label">Postal Code</label>
                        <input type="text"
                               name="postal_code"
                               value="{{ old('postal_code', $model->postal_code) }}"
                               class="form-control">
                    </div>

                    {{-- Working Days --}}
                    <div class="fromGroup">
                        <label class="form-label">Working Days</label>
                        <input type="text"
                               name="working_days"
                               value="{{ old('working_days', $model->working_days) }}"
                               class="form-control"
                               placeholder="Mon–Fri">
                    </div>

                    {{-- Working Hours --}}
                    <div class="fromGroup">
                        <label class="form-label">Working Hours</label>
                        <input type="text"
                               name="working_hours"
                               value="{{ old('working_hours', $model->working_hours) }}"
                               class="form-control"
                               placeholder="09:00 AM – 06:00 PM">
                    </div>

                </div>

                {{-- Social Links --}}
                <div class="mt-8 border-t pt-6">
                    <h5 class="font-medium text-slate-700 mb-4">
                        Social Links
                    </h5>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        {{-- Instagram --}}
                        <div class="fromGroup">
                            <label class="form-label">Instagram URL</label>
                            <input type="url"
                                   name="instagram_url"
                                   value="{{ old('instagram_url', $model->instagram_url) }}"
                                   class="form-control"
                                   placeholder="https://instagram.com/...">
                        </div>

                        {{-- Facebook --}}
                        <div class="fromGroup">
                            <label class="form-label">Facebook URL</label>
                            <input type="url"
                                   name="facebook_url"
                                   value="{{ old('facebook_url', $model->facebook_url) }}"
                                   class="form-control"
                                   placeholder="https://facebook.com/...">
                        </div>

                        {{-- Twitter --}}
                        <div class="fromGroup">
                            <label class="form-label">Twitter URL</label>
                            <input type="url"
                                   name="twitter_url"
                                   value="{{ old('twitter_url', $model->twitter_url) }}"
                                   class="form-control"
                                   placeholder="https://twitter.com/...">
                        </div>

                        <div class="fromGroup">
                            <label class="form-label">YouTube URL</label>
                            <input type="url"
                                   name="youtube_url"
                                   value="{{ old('youtube_url', $model->youtube_url) }}"
                                   class="form-control"
                                   placeholder="https://youtube.com/...">
                        </div>
                        <div class="fromGroup">
                            <label class="form-label">LinkedIn URL</label>
                            <input type="url"
                                   name="linkedin_url"
                                   value="{{ old('linkedin_url', $model->linkedin_url) }}"
                                   class="form-control"
                                   placeholder="https://linkedin.com/...">
                        </div>
                        <div class="fromGroup">
                            <label class="form-label">Threads URL</label>
                            <input type="url"
                                   name="threads_url"
                                   value="{{ old('threads_url', $model->threads_url) }}"
                                   class="form-control"
                                   placeholder="https://threads.net/...">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-8">
                    <button class="btn btn-dark">
                        Save Details
                    </button>
                </div>

            </form>

        </div>
    </div>

@endsection
