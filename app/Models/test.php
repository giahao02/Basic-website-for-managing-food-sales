<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class test extends Model
{
    use HasFactory;
    //one category has many foods
    protected $table = 'categories';
    protected $primarykey= 'id';
    public $timestamps = true;
    protected $fillable = ['name','description'];
    // relationship 1-n
    public function foods(){
        return $this->hasMany(Food::class);
    }

}
