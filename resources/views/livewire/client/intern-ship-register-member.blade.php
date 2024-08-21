<div class="row login-row">
    <div class="col-12">
        <div class="mb-3 text-center">
            <div class="gap-1 mt-2 mb-4 d-inline-flex align-items-center justify-content-center">
                <img src="{{asset('assets/images/FITA.png')}}" class="h-64px" alt="">
                <img src="{{asset('assets/images/logoST.jpg')}}" class="h-64px" alt="">
            </div>
            {{--                            <span class="d-block text-muted">Chào mừng bạn đến với</span>--}}
            <h5 class="mb-0">Đăng ký nhóm TTCN/KLTN</h5>
        </div>

        <div class="mb-3">
            <div class="bold mb-2">Nhóm sinh viên: {{ $student->name }} - Mã sinh viên: {{ $student->code }} - Lớp: {{ $student->code }}</div>
            <div class="mb-2">Đăng ký học phần <b>{{ $student->course->name }}</b> - <b>{{ $student->course->code }}</b> </div>
            <div class="mb-2">
                Số thành lượng thành viên trong nhóm: {{ count($studentChecked) + 1}} (Tối đa {{$countMember}} thành viên)
            </div>
        </div>

        <div class="card">
            <div class="py-3 card-header d-flex justify-content-between align-items-center">
                <div class="gap-2 d-flex align-items-center justify-content-between">
                    <div>
                        <input wire:model.live="search" type="text" class="form-control" placeholder="Tìm kiếm...">
                    </div>
                    <div>
                        Tìm, chọn thành viên vào nhóm (nếu có)
                    </div>
                </div>
            </div>
            <div class="table-student table-responsive-md table-scrollable">
                <table class="table fs-table ">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Họ và tên</th>
                        <th>Mã sinh viên</th>
                        <th>Lớp</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($students as $student)
                        <tr class="@if(in_array($student->code, $studentChecked) ) table-light @endif">
                            <td>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" @if(($countMember == count($studentChecked) + 1) && !in_array($student->code, $studentChecked) ) disabled @endif :key="{{$student->id}}"
                                            wire:click="clickCheckBox({{$student->code}})" @if(in_array($student->code, $studentChecked) ) checked @endif   value="{{$student->code}}" id="{{$student->code}}"
                                           class="cursor-pointer">
                                    <label class="ms-2" for="{{$student->code}}"></label>
                                </div>
                            </td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->code }}</td>
                            <td>{{ $student->class }}</td>
                        </tr>
                    @empty
                        <x-table-empty :colspan="8"/>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mb-3 d-flex justify-content-between">
           <button wire:click="preStep" class="btn btn-warning"><i class="ph-arrow-circle-left"></i> Quay lại</button>
           <button wire:click="nextStep" class="btn btn-primary"><i class="ph-arrow-circle-right"></i> Tiếp tục</button>
        </div>
    </div>
</div>
