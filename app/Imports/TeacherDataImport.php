<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\Teacher;

class TeacherDataImport implements ToCollection, WithHeadingRow
{
    public function __construct()
    {

    }

    public const START_ROW = 2;
    public const HEADER_INDEX = 1;

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        DB::beginTransaction();
        try {
            foreach ($collection as $row) {
                $teacher = Teacher::query()->where('code', $row['ma_giang_vien'])->first();

                $dataTeacher = [
                    'code' => $row['ma_giang_vien'], 
                    'name' => $row['ten_giang_vien'], 
                ];

                if (!empty($row['email'])) {
                    $dataTeacher['email'] = $row['email'];
                }

                if (!empty($row['so_dien_thoai'])) {
                    $dataTeacher['phone'] = $row['so_dien_thoai'];
                }

                if (!empty($row['huong_de_tai'])) {
                    $dataTeacher['topic'] = $row['huong_de_tai'];
                }

                if (!empty($row['mo_ta'])) {
                    $dataTeacher['description'] = $row['mo_ta'];
                }

                if (!$teacher) {
                    Teacher::create($dataTeacher);
                } else {
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

    public function startRow(): int
    {
        return self::START_ROW;
    }

    public function headingRow(): int
    {
        return self::HEADER_INDEX;
    }
}
