<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bills';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['hostel_id','bill_status_id','type','note','amount','bill_month','border_id'];


    public function billStatus(){
        return $this->belongsTo(BillStatus::class,'bill_status_id');
    }

    public function border(){
        return $this->belongsTo(User::class,'border_id');
    }
}
