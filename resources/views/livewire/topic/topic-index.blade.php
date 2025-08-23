<div>
    <div class="card">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="d-flex gap-2">
                <div>
                    <input wire:model.live="search" type="text" class="form-control" placeholder="Tìm kiếm...">
                </div>
            </div>
        </div>

        <div class="table-responsive-md">
            <table class="table fs-table ">
                <thead>
                    <tr class="table-light">
                        <th>STT</th>
                        <th>Đợt đăng ký</th>
                        <th>Hạn nộp báo cáo</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($campaigns as $campaign)
                        <tr>
                            <td>{{ $loop->index + 1 + $campaigns->perPage() * ($campaigns->currentPage() - 1) }}</td>
                            <td>
                                <a href="{{ route('admin.topics.show', $campaign->id) }}">
                                    {{ $campaign->name }}
                                </a>
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($campaign->report_deadline)->format('d/m/Y') }}
                            </td>
                        </tr>
                    @empty
                        <x-table-empty :colspan="3" />
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $campaigns->links('vendor.pagination.theme') }}
</div>

