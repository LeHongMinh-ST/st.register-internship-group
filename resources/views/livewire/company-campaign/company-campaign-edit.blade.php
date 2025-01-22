<div wire:ignore.self id="company-detail-{{ $companyId }}" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $company->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form wire:submit="update">
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Số lượng tuyển dụng </label>
                                <input wire:model.live="amount" type="number" class="form-control">
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label">Số lượng đã tuyển dụng</label>
                                <input wire:model.live="amountRecruited" type="number"  class="form-control">
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="row">
                            <div class="col">
                                <label class="form-label"> Yêu cầu </label>
                                <div wire:ignore>
                                    <textarea wire:model.live="jobDescription"
                                              id="content-{{ $companyId }}"
                                              class="form-control">
                                        {!! $jobDescription !!}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal"> Đóng </button>
                    <button type="submit" class="btn btn-primary"> Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>


@section('script_custom')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editors = {};

            function initializeEditor(textarea) {
                const id = textarea.id;

                // Khởi tạo CKEditor nếu chưa có
                if (!editors[id]) {
                    ClassicEditor
                        .create(textarea, {
                            toolbar: {
                                items: [
                                    'heading',
                                    '|',
                                    'bold',
                                    'italic',
                                    'bulletedList',
                                    'numberedList',
                                    '|',
                                    'undo',
                                    'redo'
                                ]
                            },
                        })
                        .then(editor => {
                            editors[id] = editor;

                            // Đồng bộ dữ liệu CKEditor với Livewire
                            editor.model.document.on('change:data', () => {
                                Livewire.emit('updateJobDescription', id.replace('content-', ''), editor.getData());
                            });

                            // Lắng nghe sự kiện để cập nhật nội dung CKEditor
                            Livewire.on(`contentUpdated-${id}`, jobDescription => {
                                editor.setData(jobDescription);
                            });
                        })
                        .catch(error => {
                            console.error(`CKEditor initialization failed for ${id}:`, error);
                        });
                }
            }

            // Xử lý khi modal được mở lại
            document.querySelectorAll('div[id^="company-detail-"]').forEach(modal => {
                modal.addEventListener('shown.bs.modal', () => {
                    const textarea = modal.querySelector('textarea[id^="content-"]');
                    if (textarea) {
                        initializeEditor(textarea);
                    }
                });

                modal.addEventListener('hidden.bs.modal', () => {
                    const textarea = modal.querySelector('textarea[id^="content-"]');
                    const id = textarea?.id;

                    // Hủy CKEditor khi modal đóng
                    if (id && editors[id]) {
                        editors[id].destroy().then(() => {
                            delete editors[id];
                        });
                    }
                });
            });
        });

    </script>
@endsection
