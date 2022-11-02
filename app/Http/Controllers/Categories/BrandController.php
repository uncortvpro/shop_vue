<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category\CategoryBrand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function add(Request $request, int $category_id){
        $brand = CategoryBrand::create([
            'title' => $request->get('title'),
            'category_id' => $category_id
        ]);
        return response()->redirectTo('/category/show/'.$category_id);
    }
    public function update(Request $request, $category_id, $brand_id){
        $brand = CategoryBrand::find($brand_id);
        $brand->update(['title'=>$request->get('title')]);
        return response()->redirectTo('/category/show/'.$category_id);
    }
    public function delete($category_id, $brand_id){
        $brand = CategoryBrand::find($brand_id);
        $brand->delete();
        return response()->redirectTo('/category/show/'.$category_id);

    }
}
