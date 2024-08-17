@php
    use App\Enums\StepRegisterEnum;
@endphp
<div class="content login-wrapper">
    <div class="card">
        <div class="card-body">
            @if($step == StepRegisterEnum::StepOne)
                <div class="row login-row" wire:transition>
                    <div class="col-xl-6">
                        <div class="login-image-wrapper">
                            <img class="login-image" src="{{ asset('assets/images/login.png') }}" alt="login">
                            <div class="line"></div>
                            <div class="login-note text-muted">
                                Lưu ý: Nếu bạn chưa có tài khoản xin vui lòng liên hệ với quản lý hoặc cán bộ quản lý hệ
                                thống
                                để thiết lập tài khoản
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-6">
                        <div>
                            @csrf

                            <div class="mb-3 text-center">
                                <div class="gap-1 mt-2 mb-4 d-inline-flex align-items-center justify-content-center">
                                    <img src="{{ asset('assets/images/VNUA.png') }}" class="h-64px" alt="">
                                    <img src="{{asset('assets/images/FITA.png')}}" class="h-64px" alt="">
                                    <img src="{{asset('assets/images/logoST.jpg')}}" class="h-64px" alt="">
                                </div>
                                {{--                            <span class="d-block text-muted">Chào mừng bạn đến với</span>--}}
                                <h5 class="mb-0">Đăng ký nhóm thực tập chuyên ngành </h5>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mã sinh viên</label>
                                <div class="form-control-feedback form-control-feedback-start">
                                    <input type="text" class="form-control" placeholder="Tên tài khoản" name="username"
                                           id="username" value="{{ old('username') }}"/>
                                    <div class="form-control-feedback-icon">
                                        <i class="ph-user-circle text-muted"></i>
                                    </div>
                                    @error('username')
                                    <label id="error-username" class="validation-error-label"
                                           for="username">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ngày sinh</label>
                                <div class="form-control-feedback form-control-feedback-start">
                                    <input type="password" class="form-control" placeholder="•••••••••••" id="password"
                                           name="password" value="{{ old('password') }}"/>
                                    <div class="form-control-feedback-icon">
                                        <i class="ph-lock text-muted"></i>
                                    </div>
                                    @error('password')
                                    <label id="error-password" class="validation-error-label"
                                           for="password">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <button wire:click="nextStepTwo()" type="button"
                                        class="btn btn-primary">
                                    <i class="ph-telegram-logo"></i>
                                    Đăng ký
                                </button>
                                <button type="button" class="btn btn-success">
                                    <i class="ph-magnifying-glass"></i>
                                    Tra cứu nhóm
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
            @if($step == StepRegisterEnum::StepTwo)
                <div class="row login-row" wire:transition>
{{--                    <div class="col-xl-6">--}}
{{--                        <div class="login-image-wrapper">--}}
{{--                            <img class="login-image" src="{{ asset('assets/images/login.png') }}" alt="login">--}}
{{--                            <div class="line"></div>--}}
{{--                            <div class="login-note text-muted">--}}
{{--                                Lưu ý: Nếu bạn chưa có tài khoản xin vui lòng liên hệ với quản lý hoặc cán bộ quản lý hệ--}}
{{--                                thống--}}
{{--                                để thiết lập tài khoản--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                    <div class="col-xl-6">--}}
{{--                        <form action="{{ route('handleLogin') }}" class="login-form" method="POST">--}}
{{--                            @csrf--}}

{{--                            <div class="mb-3 text-center">--}}
{{--                                <div class="gap-1 mt-2 mb-4 d-inline-flex align-items-center justify-content-center">--}}
{{--                                    <img src="{{ asset('assets/images/VNUA.png') }}" class="h-64px" alt="">--}}
{{--                                    <img src="{{asset('assets/images/FITA.png')}}" class="h-64px" alt="">--}}
{{--                                    <img src="{{asset('assets/images/logoST.jpg')}}" class="h-64px" alt="">--}}
{{--                                </div>--}}
{{--                                --}}{{--                            <span class="d-block text-muted">Chào mừng bạn đến với</span>--}}
{{--                                <h5 class="mb-0">Đăng ký nhóm thực tập chuyên ngành </h5>--}}
{{--                            </div>--}}

{{--                            <div class="mb-3">--}}
{{--                                <label class="form-label">Mã sinh viên</label>--}}
{{--                                <div class="form-control-feedback form-control-feedback-start">--}}
{{--                                    <input type="text" class="form-control" placeholder="Tên tài khoản" name="username"--}}
{{--                                           id="username" value="{{ old('username') }}"/>--}}
{{--                                    <div class="form-control-feedback-icon">--}}
{{--                                        <i class="ph-user-circle text-muted"></i>--}}
{{--                                    </div>--}}
{{--                                    @error('username')--}}
{{--                                    <label id="error-username" class="validation-error-label"--}}
{{--                                           for="username">{{ $message }}</label>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="mb-3">--}}
{{--                                <label class="form-label">Ngày sinh</label>--}}
{{--                                <div class="form-control-feedback form-control-feedback-start">--}}
{{--                                    <input type="password" class="form-control" placeholder="•••••••••••" id="password"--}}
{{--                                           name="password" value="{{ old('password') }}"/>--}}
{{--                                    <div class="form-control-feedback-icon">--}}
{{--                                        <i class="ph-lock text-muted"></i>--}}
{{--                                    </div>--}}
{{--                                    @error('password')--}}
{{--                                    <label id="error-password" class="validation-error-label"--}}
{{--                                           for="password">{{ $message }}</label>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="mb-3">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    <i class="ph-telegram-logo"></i>--}}
{{--                                    Đăng ký--}}
{{--                                </button>--}}
{{--                                <button type="submit" class="btn btn-success">--}}
{{--                                    <i class="ph-magnifying-glass"></i>--}}
{{--                                    Tra cứu nhóm--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                            @error('message')--}}
{{--                            <label id="message-error" class="text-center validation-error-label w-100"--}}
{{--                                   for="basic">{{ $message }}</label>--}}
{{--                            @enderror--}}
{{--                            --}}{{--                            <div class="mb-3 text-center text-muted content-divider"> --}}
{{--                            --}}{{--                                <span class="px-2">Hoặc đăng nhập với</span> --}}
{{--                            --}}{{--                            </div> --}}
{{--                            --}}{{--                            <div class="mb-3 text-center"> --}}
{{--                            --}}{{--                                <button type="button" class="btn btn-outline-primary btn-icon rounded-pill border-width-2"><i class="ph-google-logo"></i></button> --}}
{{--                            --}}{{--                            </div> --}}
{{--                            --}}{{--                            <div class="mb-3 text-center text-muted content-divider"> --}}
{{--                            --}}{{--                                <span class="px-2">Bạn chưa có tài khoản?</span> --}}
{{--                            --}}{{--                            </div> --}}
{{--                            --}}{{--                            <div class="mb-3"> --}}
{{--                            --}}{{--                                <a href="#" class="btn btn-light w-100">Đăng ký</a> --}}
{{--                            --}}{{--                            </div> --}}
{{--                        </form>--}}
{{--                    </div>--}}
                </div>
            @endif

        </div>
    </div>
</div>
