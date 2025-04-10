@php
    $hour = now()->hour;
    if ($hour < 12) {
        $greeting = 'Chào buổi sáng';
        $icon = 'ph-sun text-warning'; 
    } elseif ($hour < 18) {
        $greeting = 'Chào buổi chiều';
        $icon = 'ph-cloud-sun text-primary'; 
    } else {
        $greeting = 'Chào buổi tối';
        $icon = 'ph-moon text-info'; 
    }
@endphp
<div class="row">
    <div class="col-md-9">
        <div class="card p-3 shadow-sm">
            <div class="d-flex align-items-center">
                <i class="{{ $icon }} me-2" style="font-size: 24px;"></i>
                <div>
                    <h5 class="fw-bold mb-1">{{ $greeting }}!</h5>
                    <p class="mb-0">Chúc bạn có một ngày làm việc hiệu quả, {{ $teacher->name }}.</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bold">
                <i class="ph-lock"></i>
                Thay đổi mật khẩu
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">
                        Nhập mật khẩu mới: <span class="text-danger">*</span>
                    </label>
                    <div>
                        <input wire:model.live="password" type="password" class="form-control">
                        @error('password')
                            <label class="text-danger mt-1">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label mt-1">
                        Nhập lại mật khẩu mới: <span class="text-danger">*</span>
                    </label>
                    <div>
                        <input wire:model.live="retypePassword" type="password" class="form-control">
                        @error('retypePassword')
                            <label class="text-danger mt-1">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header bold">
                <i class="ph-gear-six"></i>
                Hành động
            </div>
            <div class="card-body d-flex align-items-center gap-1">
                <button wire:click="changePassword" class="btn btn-primary w-100" type="submit">
                    <i class="ph-floppy-disk"></i>
                    &nbsp;Cập nhật
                </button>
            </div>
        </div>
    </div>
</div>


