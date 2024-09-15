<div class="row">
    <div class="col-md-9 col-12">
        <div class="card">
            <div class="card-header bold">
                <i class="ph-info"></i>
                Thông tin chung
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <label for="name" class="col-form-label">
                            Tên <span class="required">*</span>
                        </label>
                        <input wire:model.live="name" type="text" id="name" class="form-control">
                        @error('name')
                        <label id="error-name" class="validation-error-label text-danger"
                               for="name">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bold">
                <i class="ph-clock"></i>
                Thời gian
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="title" class="col-form-label">
                            Ngày bắt đầu <span class="required">*</span>
                        </label>
                        <div class="input-group">
                           <span class="input-group-text">
												<i class="ph-calendar"></i>
											</span>
                            <input wire:model="start" type="text" id="startDate" value="{{ $this->start }}"
                                   class="form-control datepicker-basic datepicker-input">
                        </div>
                        @error('startDate')
                        <label id="error-username" class="validation-error-label text-danger"
                               for="username">{{ $message }}</label>
                        @enderror

                    </div>
                    <div class="col-12 col-md-6 ">
                        <label for="title" class="col-form-label">
                            Ngày kết thúc <span class="required">*</span>
                        </label>
                        <div class="input-group">
                           <span class="input-group-text">
												<i class="ph-calendar"></i>
											</span>
                            <input wire:model="end" type="text" id="endDate" value="{{ $this->end }}"
                                   class="form-control datepicker-basic datepicker-input ">
                        </div>
                        @error('endDate')
                        <label id="error-username" class="validation-error-label text-danger"
                               for="username">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bold">
                <i class="ph-clock"></i>
                Thời gian chỉnh sửa nhóm chính thức
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-12 col-md-6 ">
                        <label for="title" class="col-form-label">
                            Ngày kết thúc <span class="required">*</span>
                        </label>
                        <div class="input-group">
                           <span class="input-group-text">
												<i class="ph-calendar"></i>
											</span>
                            <input wire:model="official_end" type="text" id="officialEndDate" value="{{ $this->official_end }}"
                                   class="form-control datepicker-basic datepicker-input ">
                        </div>
                        @error('official_end')
                        <label id="error-username" class="validation-error-label text-danger"
                               for="username">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bold">
                <i class="ph-user"></i>
                Thành viên nhóm
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <label for="max_student_group" class="col-form-label">
                            Số lượng thành viên tối đa <span class="required">*</span>
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
                <a href="{{route('admin.campaigns.index')}}" type="button" class="btn btn-warning"><i class="ph-arrow-counter-clockwise"></i> Trở lại</a>
            </div>
        </div>
    </div>
</div>

@script
<script>
    $(document).ready(function () {
        const dpBasicElementStartDate = document.querySelector('#startDate');
        if (dpBasicElementStartDate) {
            new Datepicker(dpBasicElementStartDate, {
                container: '.content-inner',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                format: 'dd/mm/yyyy',
                weekStart: 1,
                language: 'vi',
            });
            dpBasicElementStartDate.addEventListener('changeDate', function (event) {
                const selectedDate = new Date(event.detail.date);
                const formattedDate = formatDateToString(selectedDate);
                Livewire.dispatch('update-start-date', { value: formattedDate })
            });
        }


        const dpBasicElementEndDate = document.querySelector('#endDate');
        if (dpBasicElementStartDate) {
            new Datepicker(dpBasicElementEndDate, {
                container: '.content-inner',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                format: 'dd/mm/yyyy',
                weekStart: 1,
                language: 'vi',
            });
            dpBasicElementEndDate.addEventListener('changeDate', function (event) {
                const selectedDate = new Date(event.detail.date);
                const formattedDate = formatDateToString(selectedDate);
                Livewire.dispatch('update-end-date', { value: formattedDate })
            });
        }


        const dpBasicElementOfficialEndDate = document.querySelector('#officialEndDate');
        if (dpBasicElementOfficialEndDate) {
            new Datepicker(dpBasicElementOfficialEndDate, {
                container: '.content-inner',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                format: 'dd/mm/yyyy',
                weekStart: 1,
                language: 'vi',
            });
            dpBasicElementOfficialEndDate.addEventListener('changeDate', function (event) {
                const selectedDate = new Date(event.detail.date);
                const formattedDate = formatDateToString(selectedDate);
                Livewire.dispatch('update-official-end-date', { value: formattedDate })
            });
        }


    });
</script>
@endscript
