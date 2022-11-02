<?php

namespace App\Models;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $guarded = false;
    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }
}
