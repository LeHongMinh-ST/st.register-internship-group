<?php

namespace App\Imports;

use App\Enums\StudentAttributesEnum;
use App\Models\Course;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StudentCourseImport implements ToCollection, WithStartRow, WithHeadingRow
{
    public function __construct(private int|string $campaignId)
    {
    }

    public const START_ROW = 2;
    public const HEADER_INDEX = 1;

    /**
     * @param Collection $collection
     * @throws \Exception
     */
    public function collection(Collection $collection): void
    {
        DB::beginTransaction();
        try {
            foreach ($collection as $row) {
                $course = Course::query()->where(['code' => $row[StudentAttributesEnum::MA_HP_DANG_KY->value]])->first();
                if (!$course) {
                    $course = Course::create([
                        'code' => $row[StudentAttributesEnum::MA_HP_DANG_KY->value],
                        'name' => $row[StudentAttributesEnum::TEN_HP->value],
                    ]);
                }

                $student = Student::query()
                    ->where('code', $row[StudentAttributesEnum::MA_SV->value])
                    ->where('campaign_id', $this->campaignId)->first();

                if (!$student) {
                    Student::create([
                        'name' => $row[StudentAttributesEnum::HO_DEM->value] . ' ' . $row[StudentAttributesEnum::TEN->value],
                        'course_id' => $course->id,
                        'campaign_id' => $this->campaignId,
                        'code' => $row[StudentAttributesEnum::MA_SV->value],
                        'dob' => Carbon::createFromFormat('d/m/y',$row[StudentAttributesEnum::NGAY_SINH->value]),
                        'class' => $row[StudentAttributesEnum::LOP->value],
                        'credit' => $row[StudentAttributesEnum::SO_TIN_CHI->value],
                        'condition' => $row[StudentAttributesEnum::DIEU_KIEN_TRONG_DANH_MUC_CTDT->value],
                        'note' => $row[StudentAttributesEnum::GHI_CHU->value],
                    ]);
                }

            }
            DB::commit();
        } catch (\Exception $e) {
            Log::error('Error import student', [
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
