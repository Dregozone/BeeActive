@extends('layout.app')

@section('title')
    Profile
@endsection

@section('content')
    <h1>
        Profile
    </h1>

    <section class="container">
        

        {{-- 
            Display username, email, current weight/size stats & current goal
            Allow changing of email, password
        --}}
        <div style="display: flex; align-items: flex-start; justify-content: space-around;">
            <section class="info">
                <table class="info">
                    <tr>
                        <th>Username</th>
                        <td>{{ $user["username"] }}</td>
                        <td rowspan="6" style="width: 50%;">Img.</td>
                    </tr>
                    
                    <tr>
                        <th>Name</th>
                        <td>{{ $user["name"] }}</td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>{{ $user["email"] }}</td>
                    </tr>

                    <form action="{{ route('profile') }}" method="post" autocomplete="off">
                        @csrf 

                        <tr>
                            <th><label for="password">Password</label></th>
                            <td><input type="password" class="form-control" id="password" name="password" placeholder="Reset password" autocomplete="off" /></td>
                        </tr>
                        <tr>
                            <th><label for="password_confirm">Confirm password</label></th>
                            <td><input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirm password" autocomplete="off" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" class="btn btn-primary" value="Reset" aria-label="Reset password" /></td>
                        </tr>
                    </form>

                </table>
            </section>

            <section class="goals">
                <table class="goals">
                    <tr>
                        <th>Current height</th>
                        <td></td>
                        <td>{{-- spacer --}}</td>
                        <td>{{-- spacer --}}</td>
                    </tr>

                    <tr>
                        <th>Current weight</th>
                        <td></td>

                        <th>Goal weight</th>
                        <td></td>
                    </tr>

                    <tr>
                        <th>Other size measurements</th>
                        <td>To be implemented...</td>
                        <td>{{-- spacer --}}</td>
                        <td>{{-- spacer --}}</td>
                    </tr>

                    <tr>
                        <th>Current deadline</th>
                        <td></td>
                        <th>Days to deadline</th>
                        <td></td>
                    </tr>
                </table>
            </section>
        </div>

    </section>
@endsection
