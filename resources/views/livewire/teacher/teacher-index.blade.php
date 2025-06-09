<div xmlns:livewire="http://www.w3.org/1999/html">
    <div class="card">
        <div class="py-3 card-header d-flex justify-content-between align-items-center">
            <div class="gap-2 d-flex">
                <div>
                    <input wire:model.live="search" type="text" name="q" class="form-control"
                        placeholder="Tìm kiếm..." id="user-search-input">
                </div>
            </div>

            <div class="gap-2 d-flex">
                <div>
                    <button type="button" class="px-2 btn btn-success btn-icon" wire:click="openImportTeacherModal()">
                        <i class="px-1 ph-microsoft-excel-logo"></i><span>Import danh sách</span>
                    </button>

                    <button type="button" class="px-2 btn btn-light btn-icon" wire:click="$refresh">
                        <i class="px-1 ph-arrows-clockwise"></i><span>Tải lại</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="table-responsive-md">
            <table class="table fs-table table-hover table-scrollable">
                <thead>
                    <tr class="table-light ">
                        <th class="w-10px">STT</th>
                        <th class="w-10px">Mã giảng viên</th>
                        <th>Tên giảng viên</th>
                        <th>Bộ môn</th>
                        <th>Email</th>
                        {{-- <th>Số điện thoại</th> --}}
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teachers as $teacher)
                        <tr>
                            <td class="bold">
                                {{ $loop->index + 1 + $teachers->perPage() * ($teachers->currentPage() - 1) }}
                            </td>
                            <td class="bold">
                                {{ $teacher->code ?: 'Chưa có' }}
                            </td>
                            <td class="bold">
                                <a href="#" wire:click="teacherDetail({{ $teacher->id }})" data-bs-toggle="modal"
                                    data-bs-target="#teacherModal{{ $teacher->id }}">
                                    {{ $teacher->name ?: 'Chưa có' }}
                                </a>
                            </td>
                            <td class="bold">
                                {{ $teacher->department ?: 'Chưa có' }}
                            </td>
                            <td class="bold">
                                {{ $teacher->email ?: 'Chưa có' }}
                            </td>
                            <td class="bold">
                                @if ($teacher->status === \App\Enums\TeacherStatusEnum::Refuse->value)
                                    <span class="badge bg-danger bg-opacity-20 text-danger">
                                        {{ \App\Enums\TeacherStatusEnum::Refuse->description() }}
                                    </span>
                                @elseif($teacher->status === \App\Enums\TeacherStatusEnum::Accept->value)
                                    <span class="badge bg-success bg-opacity-20 text-success">
                                        {{ \App\Enums\TeacherStatusEnum::Accept->description() }}
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <a href="#" class="text-body" data-bs-toggle="dropdown">
                                        <i class="ph-list"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <button type="button" wire:click="accept({{ $teacher->id }})"
                                            class="dropdown-item text-success">
                                            <i class="ph-check-circle me-2"></i>
                                            Nhận hướng dẫn
                                        </button>
                                        <button type="button" wire:click="refuse({{ $teacher->id }})"
                                            class="dropdown-item text-warning">
                                            <i class="ph-x-circle me-2"></i>
                                            Tạm dừng
                                        </button>
                                        <button type="button" wire:click="resetPassword({{ $teacher->id }})"
                                            class="dropdown-item text-primary">
                                            <i class="ph-lock me-2"></i>
                                            Đặt lại mật khẩu
                                        </button>
                                        <button type="button" wire:click="openDeleteModal({{ $teacher->id }})"
                                            class="dropdown-item text-danger">
                                            <i class="ph-trash me-2"></i>
                                            Xóa
                                        </button>
                                    </div>
                                </div>
                            </td>

                            <div wire:ignore.self class="modal fade" id="teacherModal{{ $teacher->id }}"
                                tabindex="-1" aria-labelledby="teacherModalLabel{{ $teacher->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="teacherModalLabel{{ $teacher->id }}">
                                                Thông tin chi tiết giảng viên
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($selectedTeacher && $selectedTeacher->id === $teacher->id)
                                                <div class="row mb-3">
                                                    <div class="col-md-4 fw-bold">Mã giảng viên:</div>
                                                    <div class="col-md-8">{{ $selectedTeacher->code }}</div>
                                                    <div class="col-md-4 fw-bold">Tên giảng viên:</div>
                                                    <div class="col-md-8">{{ $selectedTeacher->name }}</div>
                                                    <div class="col-md-4 fw-bold">Ngày sinh:</div>
                                                    <div class="col-md-8">
                                                        {{ \Carbon\Carbon::parse($selectedTeacher->dob)->format('d/m/Y') }}
                                                    </div>
                                                    <div class="col-md-4 fw-bold">Bộ môn:</div>
                                                    <div class="col-md-8">{{ $selectedTeacher->department }}</div>
                                                    <div class="col-md-4 fw-bold">Email:</div>
                                                    <div class="col-md-8">{{ $selectedTeacher->email }}</div>
                                                    <div class="col-md-4 fw-bold">Số điện thoại:</div>
                                                    <div class="col-md-8">{{ $selectedTeacher->phone }}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @empty
                        <x-table-empty :colspan="11" />
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $teachers->links('vendor.pagination.groups-official') }}
    <livewire:teacher.teacher-import />
</div>

@script
    <script>
        window.addEventListener('open-import-teacher-modal', () => {
            $('#model-import-group').modal('show')
        })


        window.addEventListener('close-import-teacher-modal', () => {
            $('#model-import-group').modal('hide')
        })

        window.addEventListener('openDeleteModal', () => {
            new swal({
                title: "Bạn có chắc chắn?",
                text: "Dữ liệu sau khi xóa không thể phục hồi!",
                showCancelButton: true,
                confirmButtonColor: "#FF7043",
                confirmButtonText: "Đồng ý!",
                cancelButtonText: "Đóng!"
            }).then((value) => {
                if (value.isConfirmed) {
                    Livewire.dispatch('deleteTeacher')
                }
            })
        })
    </script>
@endscript
