@extends('layouts.app')

@section('content')
    <div class="auth">
        <div class="container">
            <div class="auth-body">
                <form method="POST" class="auth-form" action="{{ route('register') }}">
                    @csrf
                    <div class="auth__group">
                        <label class="label" for="name">Имя</label>
                        <input id="name" type="text" class="input @error('name') error-input @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    </div>
                    <div class="auth__group">
                        <label for="email" class="label">E-mail</label>
                        <input id="email" type="email" class="input @error('email') error-input @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                    <div class="auth__group">
                        <label for="password" class="label">Пароль</label>
                        <input id="password" type="password" class="input @error('password') error-input @enderror" name="password" required autocomplete="new-password">
                    </div>
                    <div class="auth__group">
                        <label for="password-confirm" class="label">Повторите пароль</label>
                        <input id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="auth-actions">
                        <button class="btn auth-btn" type="submit">Зарегистрироваться</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
