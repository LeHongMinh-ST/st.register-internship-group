<div xmlns:livewire="http://www.w3.org/1999/html">
    <div class="card">
        <div class="py-3 card-header d-flex justify-content-between align-items-center">
            <div class="gap-2 d-flex">
            </div>
        </div>

        <div class="table-responsive-md">
            <table class="table fs-table table-hover table-scrollable">
                <thead>
                    <tr class="table-light">
                        <th class="w-16px">Nhóm</th>
                        <th>Tên đề tài</th>
                        <th>Bộ môn quản lý</th>
                        <th>Số lượng sinh viên</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($groups as $group)
                        <tr class=" cursor-pointer">
                            <td data-bs-toggle="collapse" class="bold"
                            data-bs-target="#st{{$group->id}}">{{ $group->code }}</td>
                            <td data-bs-toggle="collapse" class="bold"
                            data-bs-target="#st{{$group->id}}">{{ $group->topic }}</td>
                            <td data-bs-toggle="collapse" class="bold"
                            data-bs-target="#st{{$group->id}}">{{ $group->department }}</td>
                            <td data-bs-toggle="collapse" class="bold"
                            data-bs-target="#st{{$group->id}}">{{ $group->students->count() }}</td>
                        </tr>
                        <tr id="st{{$group->id}}" class="accordion-collapse collapse" wire:ignore.self>
                            <td colspan="7">
                                <livewire:group.group-official-member-index :group="$group" wire:key="group-{{ $group->id }}"/>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <x-table-empty :colspan="4"/>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
