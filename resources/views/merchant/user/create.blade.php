@push('title')
    <title>User Create | GBSell - eCommerce Solution </title>
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/dropzone/min/dropzone.min.css">
@endpush
@extends('merchant.layout.app')
@section('content')
    <div class="content content-boxed">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Add User & Permission</h3>
                <div class="block-options">
                    <div class="block-options-item">
                        <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary"> <i class="fa fa-arrow-left"></i>
                            Back to List</a>
                    </div>
                </div>
            </div>

            <div id="cod_field" class="row justify-content-center mt-3">
                <div class="col-md-10 col-lg-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action=" {{ route('user.store') }} " method="POST">
                                @csrf
                                <div class="mb-2">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label class="form-label" for="permission">Permission</label>
                                    <select class="form-select" id="permission" name="permission">
                                        <option value="">Select Permission</option>
                                        <option value="2">Admin</option>
                                        <option value="3">Moderator</option>
                                        <option value="4">Editor</option>
                                    </select>
                                    @error('permission')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label class="form-label" for="password">Password</label>
                                    <div class="password-container d-flex">
                                        <input type="password" class="form-control password-input" id="password"
                                            name="password" placeholder="Password">
                                        <i class="fa fa-eye-slash toggle-password" id="togglePassword"></i>
                                    </div>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                                    <div class="password-container d-flex">
                                        <input type="password" class="form-control password-input"
                                            id="password_confirmation" name="password_confirmation"
                                            placeholder="Confirm Password">
                                        <i class="fa fa-eye-slash toggle-password" id="toggleConfirmPassword"></i>
                                    </div>
                                    @error('password_confirmation')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-alt-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('script')
    <Script>
        // Toggle Password Visibility for Redx Client Secret Field
        $('#togglePassword').on('click', function() {
            const redx_app_secretInput = $('#password');
            const icon = $(this);

            // Toggle the type attribute
            if (redx_app_secretInput.attr('type') === 'password') {
                redx_app_secretInput.attr('type', 'text');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                redx_app_secretInput.attr('type', 'password');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            }
        });

        // Toggle Password Visibility for Steadfast Client Secret Field
        $('#toggleConfirmPassword').on('click', function() {
            const steadfast_app_secretInput = $('#password_confirmation');
            const icon = $(this);

            // Toggle the type attribute
            if (steadfast_app_secretInput.attr('type') === 'password') {
                steadfast_app_secretInput.attr('type', 'text');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                steadfast_app_secretInput.attr('type', 'password');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            }
        });
    </Script>
@endpush
