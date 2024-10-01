<?php

namespace App;

enum itemCategory: string
{
    case Raw_Goods = 'Raw Goods';
    case Finish_Goods = 'Finish Goods';
    case WIP = 'WIP';



    // public function color(): string
    // {
    //     return match ($this) {
    //         self::High => 'badge-danger',
    //         self::Medium => 'badge-warning',
    //         self::Low => 'badge-success',
    //     };
    // }
    public static function values(): array
    {
        return array_column(self::cases(), 'value', 'name');
    }
}
