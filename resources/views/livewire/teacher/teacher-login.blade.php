<div class="content login-wrapper">
    <div class="card w-100">
        <div class="card-body">
            <div class="row login-row">
                <div class="col-xl-6">
                    <div class="login-image-wrapper text-center">
                        <img class="login-image" src="{{ asset('assets/images/re_success.jpg') }}" alt="login">
                        <div class="line"></div>
                        <div class="text-muted" style="max-width: 100%; display: inline-block;">
                            Lưu ý: Thầy cô cần thay mật khẩu ngay sau khi đăng nhập lần đầu tiên 
                            để bảo mật tài khoản của mình.
                        </div>
                    </div>
                </div>
                

                <div class="col-xl-6">
                    <div>
                        @csrf
                        <div class="mb-3 text-center">
                            <div class="gap-1 mt-2 mb-4 d-inline-flex align-items-center justify-content-center">
                                <img src="{{ asset('assets/images/FITA.png') }}" class="h-64px" alt="">
                                <img src="{{ asset('assets/images/logoST.jpg') }}" class="h-64px" alt="">
                            </div>
                            <span class="d-block text-muted">Chào mừng bạn đến với</span>
                            <h5 class="mb-0 p-2">Hệ thống quản lý nhóm TTNN & KLTN</h5>
                            <span class="d-block text-muted">Trang dành cho giảng viên hướng dẫn</span>
                        </div>

                        <div class="mb-2 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5">
                            <label for="code" class="col-form-label">
                                Mã giảng viên <span class="required">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="ph-chalkboard-teacher"></i>
                                </span>
                                <input wire:model.defer="code" type="text" id="code" class="form-control">
                            </div>
                            @error('code')
                                <label class="validation-error-label text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5">
                            <label for="dob" class="col-form-label">
                                Mật khẩu <span class="required">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="ph-lock"></i>
                                </span>
                                <input wire:model.defer="password" type="password" id="password" class="form-control">
                            </div>
                            @error('password')
                                <label class="validation-error-label text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-2 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5">
                            <button wire:click="login" type="button" class="btn btn-primary">
                                Đăng nhập
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        window.addEventListener('open-plan-modal', () => {
            $('#modal-plan').modal('show')
        })
    </script>
@endscript
