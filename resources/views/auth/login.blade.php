@extends('layout.app')

@section('title')
    Login
@endsection

@section('content')
    <h1>
        Login
    </h1>

    <section class="container">
        @if (session('status'))
            {{ session('status') }}
        @endif

        <form action="{{ route('login') }}" method="post" autocomplete="off">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control @error('email') form-error @enderror" type="email" name="email" id="email" placeholder="Enter your email address" value="{{ old('email') }}" />
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>

                @error('email')
                    <div class="form-error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control @error('password') form-error @enderror" type="password" name="password" id="password" placeholder="Password" />

                @error('password')
                    <div class="form-error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Login
                </button>
            </div>
        </form>
    </section>

@endsection
