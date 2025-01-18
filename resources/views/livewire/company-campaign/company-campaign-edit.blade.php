<div wire:ignore.self id="company-{{ $companyId }}" class="modal fade" tabindex="-1">
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
                                              id="content"
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
        const style = document.createElement('style');

        document.head.appendChild(style);

        document.addEventListener('DOMContentLoaded', function() {
            ClassicEditor
                .create(document.querySelector('#content'), {
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
                    editor.model.document.on('change:data', () => {
                    @this.set('content', editor.getData());
                    });

                    Livewire.on('contentUpdated', content => {
                        editor.setData(content);
                    });

                    window.editor = editor;
                })
                .catch(error => {
                    console.error('CKEditor initialization failed:', error);
                });
        });
    </script>
@endsection
