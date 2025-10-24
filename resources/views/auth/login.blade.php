
<form id="lang-form" action="" method="get">
    <select onchange="window.location.href=this.value;">
        <option value="{{ route('lang.switch', 'en') }}" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
        <option value="{{ route('lang.switch', 'de') }}" {{ app()->getLocale() == 'de' ? 'selected' : '' }}>Deutsch</option>
        <option value="{{ route('lang.switch', 'ar') }}" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>العربية</option>
    </select>
</form>


<h1>{{ __('Welcome') }}</h1>
<a href="#">{{ __('Login') }}</a>
<a href="#">{{ __('Register') }}</a>


<p>Current Locale: {{ App::getLocale() }}</p>
<p>Current Locale: {{ Session::get('locale') }}</p>
<h1>{{ __('Welcome') }}</h1>

<form method="POST" action="{{ route('login') }}">
    @csrf
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
@if($errors->any()) <div>{{ $errors->first() }}</div> @endif
