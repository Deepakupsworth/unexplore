@extends('backend.layout')

@section('content')
    {{-- ================= HEADER ================= --}}

    <div class="mb-5">
        <ul class="flex items-center gap-2 text-sm">
            <li class="text-primary-500">
                <a href="{{ url('/admin/dashboard') }}">
                    <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                </a>
            </li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-700 font-medium">Translation</li>
        </ul>
    </div>

    {{-- ================= TABLE ================= --}}

    <div class="card">
        <header class="card-header flex justify-between items-center">
            <h4 class="card-title">Packages</h4>
           
        </header>
        <div class="card-body p-0 overflow-x-auto">
            

        <h3>Translation Groups</h3>

        <ul>
        @foreach($groups as $group)
            <li>
                <a href="{{ url('admin/translations/'.$group) }}">
                    {{ $group === 'common' ? 'Common Keys' : ucfirst($group) }}
                </a>
            </li>
        @endforeach
        </ul>

        </div>
    </div>

   
@endsection
