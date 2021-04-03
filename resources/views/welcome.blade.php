@extends('layouts.app')

@section('content')

            <div class="card">
                <div class="card-header">Users</div>

                <div class="card-body">
                    @foreach($users as $user)
                        {{$user->name}} @if($user->isActive()) Active @endif <br>
                    @endforeach
                </div>
            </div>
@endsection
