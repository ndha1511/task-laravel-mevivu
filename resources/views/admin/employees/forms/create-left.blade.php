<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin nhân viên') }}</h2>
        </div>
        <div class="row card-body">
            <!-- Username -->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Username') }}:</label>
                    <x-input name="username" :value="old('username')" :required="true" placeholder="{{ __('username') }}" />
                </div>
            </div>
            <!-- Email -->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Email') }}:</label>
                    <x-input-email name="email" :value="old('email')" :required="true"
                         />
                </div>
            </div>
            <!-- new password -->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mật khẩu') }}:</label>
                    <x-input-password name="password" :required="true" />
                </div>
            </div>
            <!-- new password confirmation-->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Xác nhận mật khẩu') }}:</label>
                    <x-input-password name="password_confirmation" :required="true"
                        data-parsley-equalto="input[name='password']"
                        data-parsley-equalto-message="{{ __('Mật khẩu không khớp.') }}" />
                </div>
            </div>
            <!-- Role -->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Roles') }}:</label>
                    <x-select name="role" :required="true">
                        <x-option value="" :title="__('Chọn roles')" />
                        @foreach ($role as $key => $value)
                            <x-option :value="$key" :title="__($value)" />
                        @endforeach
                    </x-select>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Gender') }}:</label>
                    <x-select name="gender" :required="true">
                        <x-option value="" :title="__('Chọn giới tính')" />
                        @foreach ($gender as $key => $value)
                            <x-option :value="$key" :title="__($value)" />
                        @endforeach
                    </x-select>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Date') }}:</label>
                    <x-input type="date" name="date" :value="old('date')" :required="true"
                         />
                </div>
            </div>
        </div>
    </div>
</div>