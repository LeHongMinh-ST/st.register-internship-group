<div>
    <div class="card">
        <div class="py-3 card-header d-flex justify-content-between align-items-center">
            <div class="gap-2 d-flex">
{{--                <div>--}}
{{--                    <input wire:model.live="search" type="text" class="form-control" placeholder="Tìm kiếm...">--}}
{{--                </div>--}}
            </div>
            <div class="gap-2 d-flex">
                <div>
                    <button type="button" class="px-2 btn btn-success btn-icon" wire:click="openModal">
                        <i class="px-1 ph-plus-minus"></i><span>Thay đổi</span>
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
                <tr class="table-light">
                    <th>STT</th>
                    <th>Tên công ty</th>
                    <th>Số lượng tuyển dụng </th>
                    <th>Số lượng đã tuyển dụng</th>
                    <th>Yêu cầu </th>
                </tr>
                </thead>
                <tbody>
                @forelse($companies as $company)
                    <tr>
                        <td>{{ $loop->index + 1 + $companies->perPage() * ($companies->currentPage() - 1) }}</td>
                        <td><a href="#" data-bs-toggle="modal" data-bs-target="#company-{{ $company->id }}">{{ $company->name }}</a></td>
                        <td>{{ $company->pivot->amount }}</td>
                        <td>{{ $company->pivot->amount_recruited }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($company->pivot->job_description, 200) }}</td>
                    </tr>
                @empty
                    <x-table-empty :colspan="5" />
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $companies->links('vendor.pagination.theme') }}
    <!-- Add New Modal -->
    <div wire:ignore.self id="model-import" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm Công ty vào Đợt Đăng Ký</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCompanyForm">
                        <div class="mb-3">
                            <label class="form-label">Chọn Công Ty</label>
                            <div class="border p-3 rounded">
                                @foreach($companies_all as $company)
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input"
                                               wire:click="toggleCompany({{ $company->id }})"
                                            {{ in_array($company->id, $selectedCompanies) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $company->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach($companies as $company)
        <livewire:company-campaign.company-campaign-edit :companyId="$company->id" />
    @endforeach

</div>

@script
<script>
    window.addEventListener('open-import-modal', () => {
        $('#model-import').modal('show')
    })

    window.addEventListener('close-import-modal', () => {
        $('#model-import').modal('hide')
    })

</script>
@endscript

