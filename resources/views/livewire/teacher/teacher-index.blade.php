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
                        <th>Số điện thoại</th>
                        <th>Hướng đề tài</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
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
                                <a href="#" data-bs-toggle="modal" data-bs-target="#st{{ $teacher->id }}">
                                    {{ $teacher->name ?: 'Chưa có' }}
                                </a>
                            </td>
                            <td data-bs-toggle="collapse" class="bold" data-bs-target="#st{{ $teacher->id }}">
                                {{ $teacher->department ?: 'Chưa có' }}
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
                            <td data-bs-toggle="collapse" class="bold" data-bs-target="#st{{ $teacher->id }}">
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
                                    </div>
                                </div>
                            </td>
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
    {{-- @foreach($teachers as $teacher)
        <livewire:teacher.teacher-modal :id="$teacher->id"/>
    @endforeach --}}
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
