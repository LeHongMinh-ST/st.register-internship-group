@php
    use App\Enums\StepRegisterEnum;
@endphp
<div class="content login-wrapper">
    <div class="card w-100">
        <div class="card-body">
            <div class="row login-row">
                <div class="col-xl-6">
                    <div>
                        @csrf

                        <div class="mb-3 text-center">
                            <div class="gap-1 mt-2 mb-4 d-inline-flex align-items-center justify-content-center">
                                <img src="{{asset('assets/images/FITA.png')}}" class="h-64px" alt="">
                                <img src="{{asset('assets/images/logoST.jpg')}}" class="h-64px" alt="">
                            </div>
                            <span class="d-block text-muted">Tra cứu thông tin</span>
                            <h5 class="mb-0 p-2">{{ $campaign->name }}</h5>
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
                        <div class="mb-2 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5">
                            <button wire:click="filterGroup()" type="button"
                                    class="btn btn-primary">
                                <i class="ph-magnifying-glass"></i>
                                Tra cứu
                            </button>
                            @if($group)
                                <button wire:click="resetData()" type="button"
                                        class="btn btn-warning">
                                    <i class="ph ph-arrow-clockwise"></i>
                                    Đặt lại
                                </button>
                            @endif

                        </div>
                        @if(!$campaign->isExpired())
                            <div class="ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5 ">
                                <a href="{{route('internship.register', $campaignId)}}" class="text-primary"> <i
                                        class="ph-arrow-circle-left"></i>Đăng ký nhóm</a>
                            </div>
                        @endif

                    </div>
                </div>

                <div class="col-xl-6">
                    @if(!$group)
                        <div class="login-image-wrapper">
                            <img class="login-image" src="{{ asset('assets/images/search.jpg') }}" alt="login">
                            <div class="line"></div>
                        </div>
                    @else
                        <div class="group-info">
                            <div class="card">
                                <div class="card-header">
                                    <div>Thông tin nhóm nguyện vọng TTCN/KLTN</div>
                                    <b>Học phần {{$this->student?->course?->name}}
                                        - {{$this->student?->course?->code}}</b>
                                    <div><b>Nhóm {{ $group->code }}</b></div>
                                </div>
                                <div class="card-body p-2">
                                    <div class="accordion" id="accordion_collapsed">
                                        @foreach($group->students as $item)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button fw-semibold" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#st{{$item->code}}">
                                                        {{$item->name}} - Mã sinh viên: {{ $item->code }} -
                                                        Lớp: {{ $item->class }}@if($item->studentGroupOfficial->is_captain) <span class="text-danger">*</span> @endif
                                                    </button>
                                                </h2>
                                                <div id="st{{$item->code}}" class="accordion-collapse @if(count($group->students) <= 1) show @endif collapse "
                                                     wire:ignore.self>
                                                    <div class="accordion-body">
                                                        <div>Email:
                                                            <b>{{ $item->studentGroupOfficial->email ?: "Chưa có" }}</b>
                                                        </div>
                                                        <div>Số điện thoại:
                                                            <b>{{ $item->studentGroupOfficial->phone ?: "Chưa có" }}</b>
                                                        </div>
                                                        <div>Số điện thoại phụ huynh:
                                                            <b>{{ $item->studentGroupOfficial->phone_family ?: "Chưa có" }}</b>
                                                        </div>

                                                        <div>Công ty thực tập:
                                                            <b>{{ $item->studentGroupOfficial->internship_company ?: "Chưa có" }}</b>
                                                        </div>
                                                        <div>Cán bộ hướng dẫn thực tập:
                                                            <b>{{ $item->studentGroupOfficial?->supervisor_company ?? "Chưa có" }}</b>
                                                        </div>
                                                        <div>Email Cán bộ hướng dẫn thực tập:
                                                            <b>{{ $item->studentGroupOfficial?->supervisor_company_email ?? "Chưa có" }}</b>
                                                        </div>
                                                        <div>SĐT Cán bộ hướng dẫn thực tập:
                                                            <b>{{ $item->studentGroupOfficial?->supervisor_company_phone ?? "Chưa có" }}</b>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    Thông tin đề tài và GVHD
                                </div>
                                <div class="card-body p-2">
                                    <div>Tên đề tài: <b>{{ $group->topic ?: "Chưa có" }}</b></div>
                                    <div>Giảng viên hướng dẫn: <b>{{ $group->teacher?->name ?: "Chưa có" }}</b></div>
                                    <div>Email Giảng viên hướng dẫn: <b>{{ $group->teacher?->email ?: "Chưa có" }}</b></div>
                                    <div>SĐT Giảng viên hướng dẫn: <b>{{ $group->teacher?->phone ?: "Chưa có" }}</b></div>
                                    <div>Bộ môn quản lý: <b>{{ $group->department ?: "Chưa có" }}</b></div>
                                </div>
                            </div>
                            @if( !$campaign->isEditOfficialExpired() && $this->student->studentGroupOfficial->is_captain)
                                <div class="mt-2">
                                    <button wire:loading class="btn btn-primary" wire:target="sendMailEdit">
                                        <i class="ph-circle-notch spinner"></i>
                                        Yêu cầu chỉnh sửa
                                    </button>

                                    <button wire:loading.remove class="btn btn-primary" wire:click="sendMailEdit">
                                        <i class="ph-paper-plane-tilt"></i>
                                        Yêu cầu chỉnh sửa
                                    </button>
                                </div>
                            @endif

                        </div>
                    @endif


                </div>
            </div>

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
