<?php

namespace App\Exports;

use App\Models\Topic;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ExportTopicList implements FromView, ShouldAutoSize, WithStyles
{
    public function __construct(private $campaignId) {}

    public function view(): View
    {
        return view('exports.topic-list', [
            'topics' => Topic::with('teacher')
                ->where('campaign_id', $this->campaignId)
                ->join('teachers', 'topics.teacher_id', '=', 'teachers.id')
                ->orderBy('teachers.department', 'asc')
                ->orderByRaw("SUBSTRING_INDEX(teachers.name, ' ', -1) ASC")
                ->orderBy('teachers.name', 'asc')
                ->select('topics.*')
                ->get()
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        // 1. Style header
        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => '000000'],
                'size'  => 12,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color'    => ['rgb' => 'f2f2f2'], // nền xám nhạt
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // 2. Border toàn bảng
        $sheet->getStyle('A1:' . $highestColumn . $highestRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color'       => ['argb' => '000000'],
                ],
            ],
        ]);

        // 3. Căn giữa cột STT
        $sheet->getStyle('A2:A' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // 4. Căn giữa cột Bộ môn
        $sheet->getStyle('D2:D' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // 5. Wrap text cho cột Mô tả
        $sheet->getStyle('E2:E' . $highestRow)->getAlignment()->setWrapText(true);

        // 6. Wrap text cho cột Tên đề tài
        $sheet->getStyle('B2:B' . $highestRow)->getAlignment()->setWrapText(true);
        return [];
    }
}
