@extends('layout.layout')
@section('content')
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%;">
            <h2 class="text-center mb-4">Увійти</h2>
            <form method="POST" action = "{{route('user.login')}}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Електронна пошта</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>


                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Логін</button>
                </div>

                @if (session('error'))
                    <div class="alert alert-danger" style="margin-top: 10px">
                        {{ session('error') }}
                    </div>
                @endif
            </form>

            <hr class="my-4">
            <p class="text-center">Вже маєте акаунт? <a href="{{ route('register') }}">Створіть</a></p>
        </div>
    </div>
@endsection

