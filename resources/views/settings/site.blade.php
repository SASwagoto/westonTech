@extends('layouts.admin')

@section('title')
    Site Settings
@endsection
@push('css')
<style>
    .ImageView img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 1px solid#000;
        margin: 10px
    }
</style>
@endpush
@section('header_title')
    Site Settings
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <form action="{{route('settings.update', $data->id)}}" id="siteForm" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h5>{{__('messages.general.settings')}}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="appTitle">{{__('messages.app.title')}}</label>
                                <input type="text" name="app_title" id="" class="form-control" value="{{$data->app_title}}">
                            </div>
                            <div class="mb-3">
                                <label for="appTitle">{{__('messages.company.name')}}</label>
                                <input type="text" name="company_name" id="" class="form-control" value="{{$data->company_name}}">
                            </div>
                            <div class="mb-3">
                                <label for="appTitle">{{__('messages.company.email')}}</label>
                                <input type="email" name="company_email" id="" class="form-control" value="{{$data->company_email}}">
                            </div>
                            <div class="mb-3">
                                <label for="appTitle">{{__('messages.company.phone')}}</label>
                                <input type="text" name="company_phone" id="" class="form-control" value="{{$data->company_phone}}">
                            </div>
                            <div class="mb-3">
                                <label for="appTitle">{{__('messages.footer.title')}}</label>
                                <input type="text" name="footer_title" id="" class="form-control" value="{{$data->footer_title}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="siteLogo">{{__('messages.site.logo')}}</label>
                                        <div class="ImageView">
                                            @if ($data->app_logo)
                                            <img id="Logo_preview" src="{{ asset('storage/site/'.$data->app_logo) }}"
                                            alt="">
                                            @else
                                            <img id="Logo_preview" src="{{ asset('assets') }}/images/logo.png"
                                            alt="">
                                            @endif
                                            
                                        </div>
                                        <input type="file"
                                            onchange="document.getElementById('Logo_preview').src = window.URL.createObjectURL(this.files[0])"
                                            class="form-control" name="app_logo">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="siteLogo">{{__('messages.fav.icon')}}</label>
                                        <div class="ImageView">
                                            @if ($data->fav_icon)
                                            <img id="fav_icon_preview" src="{{ asset('storage/site/'.$data->fav_icon) }}"
                                            alt="">
                                            @else
                                            <img id="fav_icon_preview" src="{{ asset('assets') }}/images/logo.png"
                                            alt="">
                                            @endif
                                        </div>
                                        <input type="file"
                                            onchange="document.getElementById('fav_icon_preview').src = window.URL.createObjectURL(this.files[0])"
                                            class="form-control" name="fav_icon">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="appTitle">{{__('messages.about.us')}}</label>
                                <textarea rows="3" name="about_us" id="" class="form-control">{{$data->about_us}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="appTitle">{{__('messages.footer.url')}}</label>
                                <input type="text" name="footer_url" id="" class="form-control url-input" value="{{$data->footer_url}}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="address" class="form-label text-primary">Company Address</label>
                                <input type="text" name="address" id="address" class="form-control">
                            </div>
                        </div>
                    </div>
            
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>{{__('messages.social.profile.link')}}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="appTitle">{{__('messages.facebook.profile.url')}}</label>
                                <input type="text" name="fb_url" id="" class="form-control url-input" value="{{$data->fb_url}}">
                            </div>
                            <div class="mb-3">
                                <label for="appTitle">{{__('messages.linkedin.profile.url')}}</label>
                                <input type="text" name="linkedin_url" id="" class="form-control url-input" value="{{$data->twitter_url}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="appTitle">{{__('messages.twitter.profile.url')}}</label>
                                <input type="text" name="twitter_url" id="" class="form-control url-input" value="{{$data->linkedin_url}}">
                            </div>
                            <div class="mb-3">
                                <label for="appTitle">{{__('messages.instagram.profile.url')}}</label>
                                <input type="text" name="insta_url" id="" class="form-control url-input" value="{{$data->insta_url}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" id="submitButton" class="btn btn-primary">{{__('messages.update')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('js')
<script>
    $(document).ready(function () {
        $('#submitButton').click(function () {
            $('.url-input').each(function () {
                var userEnteredURL = $(this).val();
    
                if (userEnteredURL && !userEnteredURL.startsWith("https://")) {
                    // The input is missing "https://", so add it dynamically
                    var correctedURL = "https://" + userEnteredURL;
                    $(this).val(correctedURL); // Update the input value
                }
            });
    
            // Proceed with form submission
            $('#siteForm').submit(); // Submit the form
        });
    });
    </script>
@endpush