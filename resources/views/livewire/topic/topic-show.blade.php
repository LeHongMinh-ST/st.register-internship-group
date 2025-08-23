<div xmlns:livewire="http://www.w3.org/1999/html">
    <div class="card">
        <div class="py-3 card-header d-flex justify-content-between align-items-center">
            <div class="d-flex gap-2">
                <div>
                    <input wire:model.live="search" type="text" class="form-control" placeholder="Tìm kiếm...">
                </div>
            </div>
            <div class="gap-2 d-flex">
                <div>
                    <button wire:loading wire:target="export" type="button" class="px-2 btn btn-success btn-icon">
                        <i class="px-1 ph-circle-notch spinner"></i><span>Export danh sách</span>
                    </button>
                    <button wire:loading.remove type="button" class="px-2 btn btn-success btn-icon"
                        wire:click="export()">
                        <i class="px-1 ph-microsoft-excel-logo"></i><span>Export danh sách</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="table-responsive-md">
            <table class="table fs-table table-hover table-scrollable">
                <thead>
                    <tr class="table-light">
                        <th width="5%">STT</th>
                        <th width="40%">Tên hướng đề tài</th>
                        <th width="20%">GVHD</th>
                        <th width="20%">Bộ môn</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($topics as $topic)
                        <tr class="cursor-pointer">
                            <td>{{ $loop->index + 1 + $topics->perPage() * ($topics->currentPage() - 1) }}</td>
                            <td data-bs-toggle="collapse" data-bs-target="#topic{{ $topic->id }}" class="bold">
                                {{ $topic->title }}
                            </td>
                            <td>{{ $topic->teacher->name }}</td>
                            <td>{{ $topic->teacher->department }}</td>
                        </tr>
                        <tr id="topic{{ $topic->id }}" class="accordion-collapse collapse" wire:ignore.self>
                            <td colspan="4">
                                <div class="p-3 bg-light border-start border-primary border-4 rounded">
                                    <strong>Mô tả hướng đề tài:</strong> <br>
                                    {{ $topic->description ?: 'Không có mô tả' }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <x-table-empty :colspan="5" />
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $topics->links('vendor.pagination.theme') }}
</div>
