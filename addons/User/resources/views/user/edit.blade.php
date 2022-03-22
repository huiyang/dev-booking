@extends('layouts.user-dashboard')

@php
    $formGroup = 'form-group';
    $formControl = 'form-control';
    $primaryButton = 'btn btn--black btn--md btn-primary';
@endphp

@section('content')
    <h2>Update Profile</h2>
    <form method="post">
        @csrf
        @method('patch')

        <div class="{{ $formGroup }}">
            <label>Name *</label>
            <input type="text" class="{{ $formControl }}" name="name" value="{{ old('name', $user->name) }}" id="" placeholder="" autocomplete="">
        </div>
        @if($errors->any())
            <p class="mt-2" style="color:red;">{{$errors->first('name')}}</p>
        @endif
        <button class="{{ $primaryButton }}">Save</button>
    </form>

    <h2 class="mt-5">Update Password</h2>
    <form action="{{ route('user.update_password') }}" method="post">
        @csrf

        <div class="{{ $formGroup }}">
            <label>Current Password *</label>
            <input type="password" class="{{ $formControl }}" name="current_password" id="" placeholder="" autocomplete="">
        </div>
        @if($errors->any())
            <p class="mt-2" style="color:red;">{{$errors->first('current_password')}}</p>
        @endif
        
        <div class="{{ $formGroup }}">
            <label>New Password *</label>
            <input type="password" class="{{ $formControl }}" name="new_password" id="" placeholder="" autocomplete="">
        </div>
        @if($errors->any())
            <p class="mt-2" style="color:red;">{{$errors->first('new_password')}}</p>
        @endif
        
        <div class="{{ $formGroup }}">
            <label>Confirm Password *</label>
            <input type="password" class="{{ $formControl }}" name="new_password_confirmation" id="" placeholder="" autocomplete="">
        </div>
        @if($errors->any())
            <p class="mt-2" style="color:red;">{{$errors->first('new_password_confirmation')}}</p>
        @endif
        <button class="{{ $primaryButton }}">Change Password</button>
    </form>
@endsection