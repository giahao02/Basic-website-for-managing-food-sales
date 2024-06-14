<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hoadon extends Model
{
    use HasFactory;

    // class name and table name may be different!

    protected $table = 'table_hoadon';
    protected $primarykey= 'id';
    public $timestamps = true;
    // protected $dateFormat = 'h:m:s';
    protected $fillable = [
         'tenkhachhang', 'sdt', 'email', 'tongtieng',
    ];

    public function Chitiethoadon()
    {
        return $this->hasMany(Chitiethoadon::class);
    }
}
