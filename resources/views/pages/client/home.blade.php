<x-client-layout>
    <div class="content d-flex justify-content-center align-items-center">

        <div class="content login-wrapper">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row login-row">
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
                                    <div
                                        class="gap-1 mt-2 mb-4 d-inline-flex align-items-center justify-content-center">
                                        <img src="{{asset('assets/images/FITA.png')}}" class="h-64px" alt="">
                                        <img src="{{asset('assets/images/logoST.jpg')}}" class="h-64px" alt="">
                                    </div>
                                    {{--                            <span class="d-block text-muted">Chào mừng bạn đến với</span>--}}
                                    <h5 class="mb-0">Đăng ký nguyện vọng TTCN/KLTN</h5>
                                </div>

                                <div class="mb-2 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5">
                                    @foreach($campaigns as $campaign)
                                        <a href="{{ route('internship.register', $campaign->id) }}">
                                            <div class="card">
                                                <div class="card-body p-2">
                                                    <div class="card-item">

                                                        <i class="ph-arrow-circle-right"></i> {{ $campaign->name }}
                                                    </div>

                                                </div>

                                            </div>
                                        </a>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</x-client-layout>
