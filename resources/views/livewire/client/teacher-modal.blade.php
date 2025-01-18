<div class="modal fade" id="teachersModal" tabindex="-1" aria-labelledby="teachersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="teachersModalLabel">Danh sách giảng viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="accordion" id="accordionTeachers">
                    @foreach ($teachers as $teacher)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#teacher{{ $teacher->id }}" aria-expanded="false"
                                    aria-controls="teacher{{ $teacher->id }}">
                                    GVHD: {{ $teacher->name }} - {{ $teacher->code }}
                                </button>
                            </h2>
                            <div id="teacher{{ $teacher->id }}" class="accordion-collapse collapse"
                                data-bs-parent="#accordionTeachers">
                                <div class="accordion-body">
                                    <div class="row mb-1 align-items-center">
                                        <div class="col-3 fw-bold text-muted">Email:</div>
                                        <div class="col">{{ $teacher->email }}</div>
                                    </div>
                                    <div class="row mb-1 align-items-center">
                                        <div class="col-3 fw-bold text-muted">Số điện thoại:
                                        </div>
                                        <div class="col">{{ $teacher->phone }}</div>
                                    </div>
                                    <div class="row mb-1 align-items-center">
                                        <div class="col-3 fw-bold text-muted">Hướng nghiên
                                            cứu:</div>
                                        <div class="col">{{ $teacher->topic }}</div>
                                    </div>
                                    <div class="row mb-1 align-items-center">
                                        <div class="col-3 fw-bold text-muted">Mô tả:</div>
                                        <div class="col">{{ $teacher->description }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
