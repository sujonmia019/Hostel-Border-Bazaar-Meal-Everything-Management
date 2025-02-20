<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostelBazaar extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hostel_bazaars';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['hostel_id','user_id','amount','date'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function hostel(){
        return $this->belongsTo(Hostel::class,'hostel_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
