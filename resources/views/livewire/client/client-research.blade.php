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
                            {{--                            <span class="d-block text-muted">Chào mừng bạn đến với</span>--}}
                            <h5 class="mb-0">Tra cứu nhóm đăng ký nguyện vọng TTCN/KLTN</h5>
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

                        <div class="mb-2 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5">
                            <button wire:click="filterGroup()" type="button"
                                    class="btn btn-primary">
                                <i class="ph-magnifying-glass"></i>
                                Tra cứu
                            </button>
                        </div>
                        <div class="ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5 ">
                            <a href="{{route('internship.register', $campaignId)}}" class="text-primary"> <i class="ph-arrow-circle-left"></i>Đăng ký nhóm</a>
                        </div>
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
                                    <b>Học phần {{$this->student->course->name}} - {{$this->student->course->code}}</b>
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
                                                        Lớp: {{ $item->class }}
                                                    </button>
                                                </h2>
                                                <div id="st{{$item->code}}" class="accordion-collapse collapse show"
                                                     wire:ignore.self>
                                                    <div class="accordion-body">
                                                        <div>Email:
                                                            <b>{{ $item->groupStudent->email ?: "Chưa có" }}</b>
                                                        </div>
                                                        <div>Số điện thoại:
                                                            <b>{{ $item->groupStudent->phone ?: "Chưa có" }}</b>
                                                        </div>
                                                        <div>Số điện thoại phụ huynh:
                                                            <b>{{ $item->groupStudent->phone_family ?: "Chưa có" }}</b>
                                                        </div>
                                                        <div>Công ty thực tập:
                                                            <b>{{ $item->groupStudent->internship_company ?: "Chưa có" }}</b>
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
                                    <div>Tên GVHD: <b>{{ $group->supervisor ?: "Chưa có" }}</b></div>
                                </div>
                            </div>
                        </div>
                    @endif


                </div>
            </div>

        </div>
    </div>
</div>
