<?php

namespace App\Imports;

use App\Enums\StudentAttributesEnum;
use App\Models\Course;
use App\Models\GroupOfficial;
use App\Models\Student;
use App\Models\StudentGroupOfficial;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class GroupStudentOfficalImport implements ToCollection, WithStartRow, WithHeadingRow
{

    public function __construct(private int|string $campaignId)
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
                $student = Student::query()
                    ->where('code', $row['ma_sinh_vien'])
                    ->where('campaign_id', $this->campaignId)->first();

                if (!$student) {
                    Log::error('student offical import not found ' . $row['ma_sinh_vien']);
                    continue;
                }

                $group = GroupOfficial::query()
                    ->where('code', $row['nhom'])
                    ->where('campaign_id', $this->campaignId)
                    ->first();

                $teacher = Teacher::query()->where('code', $row['ma_gv'])->first();


                $dataTeacher = [
                    'code' => $row['ma_gv'],
                    'name' => $row['phan_cong_giao_vien_huong_dan'],
                ];

                if (!empty($row['email_cua_giao_vien_huong_dan'])) {
                    $dataTeacher['email'] = $row['email_cua_giao_vien_huong_dan'];
                }

                if (!empty($row['so_dien_thoai_cua_giao_vien_huong_dan'])) {
                    $dataTeacher['phone'] = $row['so_dien_thoai_cua_giao_vien_huong_dan'];
                }

                if (!$teacher) {
                    $teacher = Teacher::create($dataTeacher);
                } else {
                    Teacher::where('id', $teacher->id)->update($dataTeacher);
                }


                if (!$group) {
                    $group = GroupOfficial::create([
                        'code' => $row['nhom'],
                        'campaign_id' => $this->campaignId,
                        'department' => $row['bo_mon_quan_ly'],
                        'teacher_id' => $teacher->id,
                        'supervisor' => $row['giao_vien_huong_dan_da_nhan_sinh_vien'],
                        'topic' => $row['de_tai_thuc_tap']
                    ]);
                } else {
                    GroupOfficial::where('id', $group->id)->update([
                        'code' => $row['nhom'],
                        'campaign_id' => $this->campaignId,
                        'department' => $row['bo_mon_quan_ly'],
                        'teacher_id' => $teacher->id,
                        'supervisor' => $row['giao_vien_huong_dan_da_nhan_sinh_vien'],
                        'topic' => $row['de_tai_thuc_tap']
                    ]);
                }


                Student::query()->where('id', $student->id)->update([
                    'group_official_id' => $group->id,
                ]);

                $countStudent = $group->students()->count();

                StudentGroupOfficial::query()->updateOrCreate([
                    'student_id' => $student->id,
                ], [
                    'student_id' => $student->id,
                    'internship_company' => $row['cong_ty_thuc_tap'],
                    'email' => $row['email'],
                    'phone_family' => $row['so_dien_thoai_phu_huynh'],
                    'phone' => $row['so_dien_thoai'],
                    'supervisor_company' => $row['ho_ten_can_bo_huong_dan_tai_co_so_thuc_tap'],
                    'supervisor_company_email' => $row['email_cua_can_bo_huong_dan_tai_co_so_thuc_tap'],
                    'supervisor_company_phone' => $row['so_dien_thoai_cua_can_bo_huong_dan_tai_co_so_thuc_tap'],
                    'is_captain' => $countStudent == 1,
                ]);


            }
            DB::commit();
        } catch (\Exception $e) {
            Log::error('Error import student group official', [
                'message' => $e->getMessage(),
            ]);
            DB::rollBack();
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
