<div class="row">
    <div class="col-md-9 col-12">
        <div class="card">
            <div class="card-header bold">
                <i class="ph-users"></i>
                Nhóm hướng dẫn thực tập nghề nghiệp
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <label for="max_student_group" class="col-form-label">
                            Số lượng nhóm hướng dẫn tối đa <span class="required">*</span>
                        </label>
                        <input wire:model.live="max_student_group" type="number" id="max_student_group" class="form-control">
                        @error('max_student_group')
                        <label id="error-max_student_group" class="validation-error-label text-danger"
                               for="max_student_group">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-3 col-12">
        <div class="card">
            <div class="card-header bold">
                <i class="ph-gear-six"></i>
                Hành động
            </div>
            <div class="card-body d-flex align-items-center gap-1">
                <button class="btn btn-primary" wire:click="submit"><i class="ph-floppy-disk"></i> Lưu</button>
                <a href="{{route('admin.teachers.index')}}" type="button" class="btn btn-warning"><i class="ph-arrow-counter-clockwise"></i> Trở lại</a>
            </div>
        </div>
    </div>
</div>
