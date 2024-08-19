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

        {{--        <div class="mb-3">--}}
        {{--            <div>Chọn thành viên cho nhóm, tối đã mỗi nhóm }} thành viên</div>--}}
        {{--        </div>--}}

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
                                        <input type="text" name="title" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-form-label col-lg-3">Giáo viên hướng dẫn mong muốn
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" name="teacher_name" class="form-control" >
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
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#always_open1">
                                    Accordion Item #1
                                </button>
                            </h2>
                            <div id="always_open1" class="accordion-collapse collapse ">
                                <div class="accordion-body">
                                    <form class="form-validate-jquery" action="#">
                                        <div class="mb-4">
                                            <!-- Maximum number -->
                                            <div class="row mb-3">
                                                <label class="col-form-label col-lg-3">Email <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="maximum_number" class="form-control" required
                                                           >
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-form-label col-lg-3">Số điện thoại <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="maximum_number" class="form-control" required
                                                           >
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-form-label col-lg-3">Số điện thoại phụ huynh<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="maximum_number" class="form-control" required
                                                           >
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-form-label col-lg-3">Tên công ty thực tập<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="maximum_number" class="form-control" required
                                                           >
                                                </div>
                                            </div>
                                            <!-- /maximum number -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#always_open2">
                                    Accordion Item #2
                                </button>
                            </h2>
                            <div id="always_open2" class="accordion-collapse collapse ">
                                <div class="accordion-body">
                                    <span class="fw-semibold">This is the second item's accordion body.</span> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#always_open3">
                                    Accordion Item #3
                                </button>
                            </h2>
                            <div id="always_open3" class="accordion-collapse collapse ">
                                <div class="accordion-body">
                                    <span class="fw-semibold">This is the third item's accordion body.</span> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /always open -->
            <!-- Collapsed atate -->
{{--            <div class="accordion" id="accordion_expanded">--}}
{{--                <div class="accordion-item">--}}
{{--                    <h2 class="accordion-header">--}}
{{--                        <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse"--}}
{{--                                data-bs-target="#expanded_item1">--}}
{{--                            Accordion Item #1--}}
{{--                        </button>--}}
{{--                    </h2>--}}
{{--                    <div id="expanded_item1" class="accordion-collapse collapse show"--}}
{{--                         data-bs-parent="#accordion_expanded">--}}
{{--                        <div class="accordion-body">--}}
{{--                            <span class="fw-semibold">This is the first item's accordion body.</span> It is shown by--}}
{{--                            default, until the collapse plugin adds the appropriate classes that we use to style each--}}
{{--                            element. These classes control the overall appearance, as well as the showing and hiding via--}}
{{--                            CSS transitions. You can modify any of this with custom CSS or overriding our default--}}
{{--                            variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>,--}}
{{--                            though the transition does limit overflow.--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="accordion-item">--}}
{{--                    <h2 class="accordion-header">--}}
{{--                        <button class="accordion-button fw-semibold collapsed" type="button" data-bs-toggle="collapse"--}}
{{--                                data-bs-target="#expanded_item2">--}}
{{--                            Accordion Item #2--}}
{{--                        </button>--}}
{{--                    </h2>--}}
{{--                    <div id="expanded_item2" class="accordion-collapse collapse" data-bs-parent="#accordion_expanded">--}}
{{--                        <div class="accordion-body">--}}
{{--                            <span class="fw-semibold">This is the second item's accordion body.</span> It is hidden by--}}
{{--                            default, until the collapse plugin adds the appropriate classes that we use to style each--}}
{{--                            element. These classes control the overall appearance, as well as the showing and hiding via--}}
{{--                            CSS transitions. You can modify any of this with custom CSS or overriding our default--}}
{{--                            variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>,--}}
{{--                            though the transition does limit overflow.--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="accordion-item">--}}
{{--                    <h2 class="accordion-header">--}}
{{--                        <button class="accordion-button fw-semibold collapsed" type="button" data-bs-toggle="collapse"--}}
{{--                                data-bs-target="#expanded_item3">--}}
{{--                            Accordion Item #3--}}
{{--                        </button>--}}
{{--                    </h2>--}}
{{--                    <div id="expanded_item3" class="accordion-collapse collapse" data-bs-parent="#accordion_expanded">--}}
{{--                        <div class="accordion-body">--}}
{{--                            <span class="fw-semibold">This is the third item's accordion body.</span> It is hidden by--}}
{{--                            default, until the collapse plugin adds the appropriate classes that we use to style each--}}
{{--                            element. These classes control the overall appearance, as well as the showing and hiding via--}}
{{--                            CSS transitions. You can modify any of this with custom CSS or overriding our default--}}
{{--                            variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>,--}}
{{--                            though the transition does limit overflow.--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!-- /collapsed state -->
            <!-- Form validation -->
            <!-- /form validation -->
        </div>
        <div class="mb-3 d-flex justify-content-end">
            <button wire:click="nextStep" class="btn btn-primary"><i class="ph-arrow-circle-right"></i> Tiếp tục
            </button>
        </div>
    </div>
</div>
