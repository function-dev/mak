@extends('layouts.app')

@section('content')
    <div class="auth">
        <div class="container">
            <div class="auth-body">
                <form method="POST" class="auth-form" action="{{ route('login') }}">
                    @csrf
                    <div class="auth__group">
                        <label class="label" for="email">E-mail</label>
                        <input id="email" type="email" class="input @error('email') error-input @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span role="alert">Произошла ошибка. Проверьте логин</span>
                        @enderror
                    </div>
                    <div class="auth__group">
                        <label class="label" for="password">Пароль</label>
                        <input id="password" type="password" class="input @error('password') error-input @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span role="alert">Произошла ошибка. Проверьте пароль</span>
                        @enderror
                    </div>
                    <div class="auth-actions">
                        <button class="btn auth-btn" type="submit">Войти</button>
                        <div class="auth__remember">
                            <input class="auth__remember-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="auth__remember-label" for="remember">Запомнить меня</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
