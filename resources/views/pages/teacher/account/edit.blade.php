<x-layouts.teacher-layout>
    <x-slot name="teacherHeader">
        <div class="shadow page-header page-header-light">
            <div class="page-header-content d-lg-flex">
                <div class="d-flex">
                    <h4 class="mb-0 page-title">
                        Tài khoản - <span class="fw-normal">Thông tin & Cập nhật</span>
                    </h4>
                </div>

            </div>

            <div class="page-header-content d-lg-flex border-top">
                <div class="d-flex">
                    <div class="py-2 breadcrumb">
                        <a href="" class="breadcrumb-item"><i class="ph-house"></i></a>
                        <a href="" class="breadcrumb-item active">Tài khoản</a>
                    </div>
                    <a href="#breadcrumb_elements" class="p-0 border-transparent btn btn-light align-self-center collapsed d-lg-none rounded-pill ms-auto" data-bs-toggle="collapse">
                        <i class="m-1 ph-caret-down collapsible-indicator ph-sm"></i>
                    </a>
                </div>

            </div>
        </div>
    </x-slot>
    <div class="content">
        <livewire:teacher.account.account-update/>
    </div>
</x-layouts.teacher-layout>