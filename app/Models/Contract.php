<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    const HOP_DONG_NHAN_LOP = 1;
    const HOP_DONG_KHAC = 2;
    protected $table = "contracts";
    protected $guarded = [];

    public function getTypeCustomAttribute($type)
    {
        switch ($type) {
            case self::HOP_DONG_NHAN_LOP:
                return "Hợp đồng nhận lớp";
                break;
            default:
                return "Hợp đồng khác";
                break;
        }
    }
    public function getStatusCustomAttribute($status)
    {
        if($status == ACTIVE) return  "<span class='badge rounded-pill badge-light-primary me-1'>Đang kích hoạt</span>";
        if($status == INACTIVE) return "<span class='badge rounded-pill badge-light-danger me-1'>Chưa kích hoạt</span>";
    }

    public function getCreatedAtCustomtribute($createdAt)
    {
        return Carbon::parse($createdAt)->format("d-m-Y H:i:s");
    }

}
