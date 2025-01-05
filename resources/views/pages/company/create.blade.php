<x-admin-layout>
    @if (session('success'))
        <script>
            new Noty({
                type: 'success',
                layout: 'topRight',
                text: "{{ session('success') }}",
                timeout: 2000,
                progressBar: true,
                callbacks: {
                    onTemplate: function() {
                        this.barDom.innerHTML =
                            '<div class="noty_body" style="background: #188251; color: #ffffff;">' + this.options
                            .text + '</div>';
                        this.barDom.style.backgroundColor = 'transparent';
                    }
                }
            }).show();
        </script>
    @endif
    <x-slot name="header">
        <div class="shadow page-header page-header-light">
            <div class="page-header-content d-lg-flex">
                <div class="d-flex">
                    <h4 class="mb-0 page-title">
                        Công ty thực tập - <span class="fw-normal">Tạo mới</span>
                    </h4>
                </div>

            </div>

            <div class="page-header-content d-lg-flex border-top">
                <div class="d-flex">
                    <div class="py-2 breadcrumb">
                        <a href="{{ route('admin.dashboard') }}" class="breadcrumb-item"><i class="ph-house"></i></a>
                        <span class="breadcrumb-item active">Tạo mới</span>
                    </div>

                    <a href="#breadcrumb_elements"
                        class="p-0 border-transparent btn btn-light align-self-center collapsed d-lg-none rounded-pill ms-auto"
                        data-bs-toggle="collapse">
                        <i class="m-1 ph-caret-down collapsible-indicator ph-sm"></i>
                    </a>
                </div>

            </div>
        </div>
    </x-slot>
    <div class="content">
        <livewire:company.company-create />
    </div>
</x-admin-layout>
