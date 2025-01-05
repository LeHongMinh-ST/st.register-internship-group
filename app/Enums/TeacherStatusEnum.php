<?php

namespace App\Enums;

enum TeacherStatusEnum: string
{
    
    case Accept = 'accept';
    case Refuse = 'refuse';

    /**
     * Lấy mô tả cho trạng thái
     */
    public function description(): string
    {
        return match ($this) {
            self::Accept => 'Nhận lời',
            self::Refuse => 'Từ chối',
        };
    }

}
