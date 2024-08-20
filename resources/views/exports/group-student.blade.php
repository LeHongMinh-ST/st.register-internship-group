<table class="table">
    <thead>
    <tr class="table-light">
        <th>STT</th>
        <th>Nhóm</th>
        <th>Họ và tên</th>
        <th>Ngày sinh</th>
        <th>Mã sinh viên</th>
        <th>Lớp</th>
        <th>Mã học phần</th>
        <th>Tên học phần</th>
        <th>Đề tài thực tập</th>
        <th>Giáo viên hướng dẫn</th>
        <th>Công ty thực tập</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Số điện thoại phụ huynh</th>
    </tr>
    </thead>
    <tbody>
    @foreach($groups as $key => $group)
        @foreach($group->students as $student)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $key+ 1 }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ \Carbon\Carbon::make($student->dob)->format('d/m/Y') }}</td>
                <td>{{ $student->code }}</td>
                <td>{{ $student->class }}</td>
                <td>{{ $student->course->code }}</td>
                <td>{{ $student->course->name }}</td>
                <td>{{ $group->topic ?: "Chưa có" }}</td>
                <td>{{ $group->supervisor ?: "Chưa có" }}</td>
                <td>{{ $student->groupStudent->internship_company ?: 'Chưa có' }}</td>
                <td>{{ $student->groupStudent->email }}</td>
                <td>{{ $student->groupStudent->phone }}</td>
                <td>{{ $student->groupStudent->phone_family }}</td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>
