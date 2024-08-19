<div class="row login-row">
    <div class="col-12">
        <div class="mb-3 text-center">
            <div class="gap-1 mt-2 mb-4 d-inline-flex align-items-center justify-content-center">
                <img src="{{ asset('assets/images/VNUA.png') }}" class="h-64px" alt="">
                <img src="{{asset('assets/images/FITA.png')}}" class="h-64px" alt="">
                <img src="{{asset('assets/images/logoST.jpg')}}" class="h-64px" alt="">
            </div>
            {{--                            <span class="d-block text-muted">Chào mừng bạn đến với</span>--}}
            <h5 class="mb-0">Đăng ký nhóm thực tập chuyên ngành </h5>
        </div>

        <div class="">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Thông tin nhóm</h5>
                </div>

                <div class="card-body">
                    <form class="form-validate-jquery" action="#">
                        <div class="mb-4">
                            <!-- Maximum number -->
                            <div class="row mb-3">
                                <label class="col-form-label col-lg-3">Tên đề tài <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" wire:model.live="topic" class="form-control" required>
                                    @error('topic')
                                    <label id="error-topic" class="validation-error-label text-danger"
                                           for="topic">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-form-label col-lg-3">Giáo viên hướng dẫn mong muốn
                                </label>
                                <div class="col-lg-9">
                                    <input type="text" wire:model.live="supervisor"  class="form-control" >
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Always open -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Thông tin thành viên</h5>
                </div>

                <div class="card-body">
                    <div class="accordion" id="accordion_collapsed">
                        @foreach($students as $key => $student)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#st{{$student->code}}">
                                        {{$student->name}} - Mã sinh viên: {{ $student->code }}
                                    </button>
                                </h2>
                                <div id="st{{$student->code}}" class="accordion-collapse collapse show" wire:ignore.self>
                                    <div class="accordion-body">
                                        <form class="form-validate-jquery" action="#">
                                            <div class="mb-4">
                                                <!-- Maximum number -->
                                                <div class="row mb-3">
                                                    <label class="col-form-label col-lg-3">Email <span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input type="text" wire:model.live="dataStudent.{{$student->code}}.email" class="form-control" required>
                                                        @error('dataStudent.'.$student->code.'.email')
                                                        <label id="error-{{$student->code}}-email" class="validation-error-label text-danger"
                                                               for="email-{{$student->code}}">{{ $message }}</label>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-form-label col-lg-3">Số điện thoại <span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input type="text" wire:model.live="dataStudent.{{$student->code}}.phone" class="form-control" required>
                                                        @error('dataStudent.'.$student->code.'.phone')
                                                        <label id="error-{{$student->code}}-phone" class="validation-error-label text-danger"
                                                               for="phone-{{$student->code}}">{{ $message }}</label>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-form-label col-lg-3">Số điện thoại phụ huynh<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input type="text" wire:model.live="dataStudent.{{$student->code}}.phone_family"  class="form-control" required>
                                                        @error('dataStudent.'.$student->code.'.phone_family')
                                                        <label id="error-{{$student->code}}-phone_family" class="validation-error-label text-danger"
                                                               for="phone_family-{{$student->code}}">{{ $message }}</label>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-form-label col-lg-3">Tên công ty thực tập<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input type="text" wire:model.live="dataStudent.{{$student->code}}.internship_company"  class="form-control" required>
                                                        @error('dataStudent.'.$student->code.'.internship_company')
                                                        <label id="error-{{$student->code}}-internship_company" class="validation-error-label text-danger"
                                                               for="internship_company-{{$student->code}}">{{ $message }}</label>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- /maximum number -->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3 d-flex justify-content-between">
            <button wire:click="preStep" class="btn btn-warning"><i class="ph-arrow-circle-left"></i> Quay lại</button>
            <button wire:click="nextStepFinish" class="btn btn-primary"><i class="ph-arrow-circle-right"></i> Tiếp tục</button>
        </div>

    </div>
</div>
