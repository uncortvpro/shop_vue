<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $guarded = false;
    public function categoryCharacteristics(){
        return $this->hasMany(CategoryCharacteristic::class,'category_id','id');
    }
    public function categoryBrands(){
        return $this->hasMany(CategoryBrand::class,'category_id','id');
    }
    public function categoryParent(){
        return $this->hasOne(self::class,'id','parent_category_id');
    }


}
