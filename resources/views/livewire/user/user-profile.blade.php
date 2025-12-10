<div>
    <div class="row">
        <!-- Personal Information -->
        <div class="col-lg-6">
            <div class="form-box">
                <div class="form-title-wrap">
                    <h3 class="title">Personal Information</h3>
                </div>
                <div class="form-content">
                    @if (session()->has('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    <div class="user-profile-action d-flex align-items-center pb-4">
                    <div class="user-pro-img">
                        @if ($new_profile_pic)
                            <img src="{{ $new_profile_pic->temporaryUrl() }}" alt="user-image" class="rounded-circle" />
                        @elseif ($profile_pic)
                            <img src="{{ asset('storage/' . $profile_pic) }}" alt="user-image" class="rounded-circle" />
                        @else
                            <img src="{{ asset('guest/images/team1.html') }}" alt="user-image" class="rounded-circle" />
                        @endif
                    </div>
                    <div class="upload-btn-box">
                        <p class="pb-2 font-size-15 line-height-24">
                            Max file size is 5MB, Minimum dimension: 150x150 And Suitable files are .jpg & .png
                        </p>
                        <div class="file-upload-wrap file-upload-wrap-2">
                            <input type="file" wire:model="new_profile_pic" class="multi file-upload-input with-preview" maxlength="1" />
                            <span class="file-upload-text"><i class="la la-upload me-2"></i>Upload Image</span>
                        </div>
                        @error('new_profile_pic') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                    <div class="contact-form-action">
                        <form wire:submit.prevent="saveProfile">
                            <div class="row">
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">First Name</label>
                                        <div class="form-group">
                                            <span class="la la-user form-icon"></span>
                                            <input class="form-control" type="text" wire:model.defer="first_name" />
                                            @error('first_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">Last Name</label>
                                        <div class="form-group">
                                            <span class="la la-user form-icon"></span>
                                            <input class="form-control" type="text" wire:model.defer="last_name" />
                                            @error('last_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">Email Address</label>
                                        <div class="form-group">
                                            <span class="la la-envelope form-icon"></span>
                                            <input class="form-control" type="email" wire:model.defer="email" />
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">Phone number</label>
                                        <div class="form-group">
                                            <span class="la la-phone form-icon"></span>
                                            <input class="form-control" type="text" wire:model.defer="phone" />
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">Address</label>
                                        <div class="form-group">
                                            <span class="la la-map form-icon"></span>
                                            <input class="form-control" type="text" wire:model.defer="address" />
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="btn-box">
                                        <button class="theme-btn" type="submit">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Change Password -->
        <div class="col-lg-6">
            <div class="form-box">
                <div class="form-title-wrap">
                    <h3 class="title">Change Password</h3>
                </div>
                <div class="form-content">
                    @if (session()->has('password_message'))
                        <div class="alert alert-success">{{ session('password_message') }}</div>
                    @endif
                    <div class="contact-form-action">
                        <form wire:submit.prevent="changePassword">
                            <div class="row">
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">Current Password</label>
                                        <div class="form-group">
                                            <span class="la la-lock form-icon"></span>
                                            <input class="form-control" type="password"
                                                wire:model.defer="current_password" placeholder="current password"/>
                                            @error('current_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">New Password</label>
                                        <div class="form-group">
                                            <span class="la la-lock form-icon"></span>
                                            <input class="form-control" type="password"
                                                wire:model.defer="new_password" placeholder="new-password"/>
                                            @error('new_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">New Password Again</label>
                                        <div class="form-group">
                                            <span class="la la-lock form-icon"></span>
                                            <input class="form-control" type="password"
                                                wire:model.defer="new_password_confirmation" placeholder="confirm password"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="btn-box">
                                        <button class="theme-btn" type="submit">Change Password</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
