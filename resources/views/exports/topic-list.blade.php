@php use App\Common\Helpers @endphp
<table class="table">
    <thead>
        <tr class="table-light">
            <th>STT</th>
            <th>Tên hướng đề tài</th>
            <th>Giảng viên hướng dẫn</th>
            <th>Bộ môn</th>
            <th>Mô tả</th>
        </tr>
    </thead>
    <tbody>
        @php
            $index = 1;
        @endphp
        @foreach ($topics as $topic)
            <tr>
                <td>{{ $index }}</td>
                <td>{{ $topic->title }}</td>
                <td>{{ $topic->teacher->name }}</td>
                <td>{{ $topic->teacher->department }}</td>
                <td>{{ $topic->description }}</td>
            </tr>
            @php
                $index++;
            @endphp
        @endforeach
    </tbody>
</table>
