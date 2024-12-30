<div xmlns:livewire="http://www.w3.org/1999/html">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-9 col-12">
                    <h6 class="fw-semibold">Quản lý thực tập nghề nghiệp</h6>
                    <p class="mb-3"><b>Số nhóm sinh viên tối đa GVHD được nhận</b>: 8</p>
                </div>
                <div class="col-md-3 col-12 d-flex justify-content-end gap-2">
                    <a href="{{route('admin.teachers.edit')}}" type="button" class="btn btn-primary d-block" style="height: max-content"><i class="ph-note-pencil"></i> Chỉnh sửa</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="py-3 card-header d-flex justify-content-between align-items-center">
            <div class="gap-2 d-flex">
                <div>
                    <input wire:model.live="search" type="text" name="q" 
                                        class="form-control" 
                                        placeholder="Tìm kiếm..."
                                        id="user-search-input">
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
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Hướng đề tài</th>
                        <th>Mô tả</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teachers as $teacher)
                        <tr>
                            <td data-bs-toggle="collapse" class="bold" data-bs-target="#st{{ $teacher->id }}">
                                {{ $loop->index + 1 + $teachers->perPage() * ($teachers->currentPage() - 1) }}
                            </td>
                            <td data-bs-toggle="collapse" class="bold" data-bs-target="#st{{ $teacher->id }}">
                                {{ $teacher->code ?: 'Chưa có' }}
                            </td>
                            <td data-bs-toggle="collapse" class="bold" data-bs-target="#st{{ $teacher->id }}">
                                {{ $teacher->name ?: 'Chưa có' }}
                            </td>
                            <td data-bs-toggle="collapse" class="bold" data-bs-target="#st{{ $teacher->id }}">
                                {{ $teacher->email ?: 'Chưa có' }}
                            </td>
                            <td data-bs-toggle="collapse" class="bold" data-bs-target="#st{{ $teacher->id }}">
                                {{ $teacher->phone ?: 'Chưa có' }}
                            </td>
                            <td data-bs-toggle="collapse" class="bold" data-bs-target="#st{{ $teacher->id }}">
                                {{ $teacher->topic ?: 'Chưa có' }}
                            </td>
                            <td data-bs-toggle="collapse" class="bold" data-bs-target="#st{{ $teacher->id }}">
                                {{ $teacher->description ?: 'Chưa có' }}
                            </td>
                        </tr>
                    @empty
                        <x-table-empty :colspan="7" />
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
    </script>
@endscript
