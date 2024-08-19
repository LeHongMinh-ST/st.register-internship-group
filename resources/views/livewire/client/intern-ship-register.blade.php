@php
    use App\Enums\StepRegisterEnum;
@endphp
<div class="content login-wrapper">
    <div class="card w-100">
        <div class="card-body">
            @if($step == StepRegisterEnum::StepOne)
                <div class="row login-row" wire:transition>
                    <div class="col-xl-6">
                        <div class="login-image-wrapper">
                            <img class="login-image" src="{{ asset('assets/images/login.png') }}" alt="login">
                            <div class="line"></div>

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

                            <div class="mb-2 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5">
                                <label for="code" class="col-form-label">
                                    Mã sinh viên <span class="required">*</span>
                                </label>
                                <input wire:model.live="code" type="text" id="name" value="{{ $code }}"
                                       class="form-control">
                                @error('code')
                                <label id="error-code" class="validation-error-label text-danger"
                                       for="code">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="mb-3 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5">
                                <label for="dob" class="col-form-label">
                                    Ngày sinh <span class="required">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ph-calendar"></i>
                                    </span>
                                    <input wire:model="dob" type="text" id="dob" value="{{ $this->dob }}"
                                           class="form-control datepicker-basic datepicker-input">
                                </div>

                                @error('dob')
                                <label id="error-dob" class="validation-error-label text-danger"
                                       for="dob">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="mb-3 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5">
                                <button wire:click="nextStepTwo()" type="button"
                                        class="btn btn-primary">
                                    <i class="ph-arrow-circle-right"></i>
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
                <livewire:client.intern-ship-register-member :code="$code" :dob="$dob" :campaignId="$campaignId"
                                                             :studentChecked="$studentChecked"/>
            @endif
            @if($step == StepRegisterEnum::StepThree)
                <livewire:client.intern-ship-register-info :code="$code" :dob="$dob" :campaignId="$campaignId"
                                                           :studentChecked="$studentChecked"/>
            @endif
            @if($step == StepRegisterEnum::StepFour)
                <livewire:client.intern-ship-register-success />
            @endif
        </div>
    </div>
</div>

@script
<script>
    $(document).ready(function () {
        const dpBasicElementStartDate = document.querySelector('#dob');
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
                Livewire.dispatch('update-dob', {
                    value: formattedDate
                })
            });
        }


    });
</script>
@endscript
