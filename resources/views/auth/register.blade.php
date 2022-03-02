@extends('layout.app')

@section('title')
    Register
@endsection

@section('content')
    <h1>
        Register
    </h1>

    <section class="container" style="width: 42%;">
        <form action="{{ route('register') }}" method="post" autocomplete="off">
            @csrf
            
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control @error('name') form-error @enderror" type="text" name="name" id="name" placeholder="Enter your name" value="{{ old('name') }}" />

                @error('name')
                    <div class="form-error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control @error('username') form-error @enderror" type="text" name="username" id="username" placeholder="Enter your username" value="{{ old('username') }}" />

                @error('username')
                    <div class="form-error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

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
                <label for="password_confirmation">Confirm password</label>
                <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password" />
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Register
                </button>
            </div>
        </form>
    </section>

@endsection
