<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    // class name and table name may be different!
    protected $table = 'food';
    protected $primarykey= 'id';
    public $timestamps = true;
    // protected $dateFormat = 'h:m:s';
    protected $fillable = ['name','count','description','image_path','category_id', 'gia'];
    // a food belongs to a category, find FOREIGN KEY category_id in table food cornect to primary key id in table category
    public function category(){
        return $this->belongsTo(Category::class);
    }

}
