@extends('frontend.layout')

@section('title', 'User Dashboard')

@section('content')

<div class="container py-5">
    <h2>Welcome, {{ auth()->user()->first_name }} 👋</h2>

    <p>You are logged in as a user.</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-danger">Logout</button>
    </form>
</div>

@endsection
