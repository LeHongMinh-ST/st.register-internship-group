<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\Teacher;
use Carbon\Carbon;

class TeacherDataImport implements ToCollection, WithHeadingRow
{
    public function __construct()
    {

    }

    public const START_ROW = 3;
    public const HEADER_INDEX = 2;

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        DB::beginTransaction();
        try {
            foreach ($collection as $row) {
                if (empty($row['ma_giang_vien']) || empty($row['ten_giang_vien'])) {
                    continue;
                }
                $teacher = Teacher::query()->where('code', $row['ma_giang_vien'])->first();

                $dataTeacher = [
                    'code' => $row['ma_giang_vien'], 
                    'name' => $row['ten_giang_vien'], 
                    'topic' => $row['huong_de_tai'] ?? null,
                    'description' => $row['mo_ta'] ?? null,
                    'status' => 'accept',
                    'department' => $row['bo_mon'],
                    'dob' => Carbon::createFromFormat('d/m/Y', $row['ngay_sinh'])->format('Y-m-d'),
                ];

                if (!empty($row['email'])) {
                    $dataTeacher['email'] = $row['email'] ?? null;
                }

                if (!empty($row['so_dien_thoai'])) {
                    $dataTeacher['phone'] = $row['so_dien_thoai'] ?? null;
                }

                if (!$teacher) {
                    Teacher::create($dataTeacher);
                    $dataTeacher['password'] = bcrypt('Fita@2005');
                } else {
                    if (!$teacher->password) {
                        $dataTeacher['password'] = bcrypt('Fita@2005'); // Chỉ đặt mật khẩu nếu chưa có
                    }
                    $teacher->update($dataTeacher);
                }
            }

            DB::commit(); 
        } catch (\Exception $e) {
            DB::rollBack(); 
            Log::error('Error import teacher', [
                'message' => $e->getMessage(),
            ]);
            throw $e; 
        }
    }

    // public function startRow(): int
    // {
    //     return self::START_ROW;
    // }

    // public function headingRow(): int
    // {
    //     return self::HEADER_INDEX;
    // }
}
