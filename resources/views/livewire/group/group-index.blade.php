<div xmlns:livewire="http://www.w3.org/1999/html">
    <div class="card">
        <div class="py-3 card-header d-flex justify-content-between align-items-center">
            <div class="gap-2 d-flex">
                <div>
                    <input wire:model.live="search" type="text" class="form-control" placeholder="Tìm kiếm...">
                </div>
            </div>
            <div class="gap-2 d-flex">
                <div>
                    <button type="button" class="px-2 btn btn-success btn-icon" wire:click="export()">
                        <i class="px-1 ph-microsoft-excel-logo"></i><span>Export danh sách</span>
                    </button>
                    <button type="button" class="px-2 btn btn-light btn-icon" wire:click="$refresh">
                        <i class="px-1 ph-arrows-clockwise"></i><span>Tải lại</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="table-responsive-md">
            <table class="table fs-table">
                <thead>
                <tr class="table-light table-hover">
                    <th>Nhóm</th>
                    <th>Tên đề tài</th>
                    <th>Giáo viên hướng dẫn</th>
                    <th>Số lượng sinh viên</th>
                    <th>Ngày tạo</th>
                </tr>
                </thead>
                <tbody>
                @forelse($groups as $group)
                    <tr class="bold cursor-pointer"  data-bs-toggle="collapse" data-bs-target="#st{{$group->id}}">
                        <td>{{ $loop->index + 1 + $groups->perPage() * ($groups->currentPage() - 1) }}</td>
                        <td>{{ $group->topic ?: "Chưa có" }}</td>
                        <td>{{ $group->supervisor ?: "Chưa có" }}</td>
                        <td>{{ $group->students->count() }}</td>
                        <td>{{ $group->created_at->format('h:i d/m/Y') }}</td>
                    </tr>
                    <tr id="st{{$group->id}}" class="accordion-collapse collapse" wire:ignore.self>
                        <td colspan="6">
                            <livewire:group.group-member-index :group="$group"/>
                        </td>
                    </tr>

                @empty
                    <x-table-empty :colspan="6" />
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $groups->links('vendor.pagination.theme') }}
</div>

