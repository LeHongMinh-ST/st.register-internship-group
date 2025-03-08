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
                        <th>Số nhóm đã nhận</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($campaigns as $campaign)
                        <tr>
                            <td>{{ $loop->index + 1 + $campaigns->perPage() * ($campaigns->currentPage() - 1) }}</td>
                            <td>
                                <a href="{{ route('teacher.student-groups-campaign.show', $campaign->id) }}">
                                    {{ $campaign->name }}
                                </a>
                            </td>
                            <td>
                                {{ $campaign->official_groups_count ?? 0 }}
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
