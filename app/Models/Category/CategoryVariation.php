<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Model;

class CategoryVariation extends Model
{
    protected $table = 'category_variations';
    protected $guarded = false;
    public function children(){
        return $this->hasMany(self::class, 'parent_variations');
    }
}
