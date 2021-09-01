@extends('admin.master')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <x-back-button />
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">{{ __('Update Profile') }}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <x-alert />
                    <form action="{{ route('admin.profile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="old_password">{{ __('Old Password') }}</label>
                                    <input id="old_password" name="old_password" class="form-control" type="text" value="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="new_password">{{ __('New Password') }}</label>
                                    <input id="new_password" name="new_password" class="form-control" type="text" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="new_password_confirmation">{{ __('New Password Again') }}</label>
                                    <input id="new_password_confirmation" name="new_password_confirmation" class="form-control" type="text" value="">
                                </div>
                            </div>
                        </div>

                        <div class="m-t-20 text-center">
                            <button type="submit" class="btn btn-primary submit-btn">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
