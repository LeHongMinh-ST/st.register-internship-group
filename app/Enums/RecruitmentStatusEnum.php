<?php

namespace App\Enums;

enum RecruitmentStatusEnum: string
{
    case Open = 'open';       
    case Closed = 'closed';  

    /**
     * Get the description of the status.
     */
    public function description(): string
    {
        return match ($this) {
            self::Open => 'Đang tuyển dụng',
            self::Closed => 'Đã ngừng tuyển dụng',
        };
    }
}
