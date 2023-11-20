@extends('layouts.admin')

@section('title')
    Edit Profile
@endsection
@push('css')

@endpush
@section('header_title')
    Edit Profile
@endsection

@section('content')
   <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Update Password</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('password.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="" class="form-label text-primary">Current Password 
                        @error('current_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </label>
                    <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label text-primary">New Password 
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </label>
                    <input id="password" name="password" type="password" class="form-control" autocomplete="new-password">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label text-primary">Confirm New Password 
                        @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
                </div>
                <div class="mb-3 d-flex">
                    <button type="submit" class="btn btn-primary">Save</button>
                    @if (session('status') === 'password-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600"
                        >{{ __('Saved.') }}</p>
                    @endif
                </div>
                </form>
            </div>
        </div>
    </div>
   </div>
@endsection
@push('js')

@endpush

