<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitiethoadon extends Model
{
    use HasFactory;

    protected $table = 'table_chitiethoadon';
    protected $primarykey= 'id';
    public $timestamps = true;
    // protected $dateFormat = 'h:m:s';
    protected $fillable = [
        'id_hoadon', 'ten', 'soluong', 'gia',
    ];

    public function Hoadon()
    {
        return $this->belongsTo(Hoadon::class);
    }

}
