<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category\CategoryVariation;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    public function add(Request $request, int $category_id, int $variation_id = 0){

        $variation = CategoryVariation::create([
            'title' => $request->get('title'),
            'category_id' => $category_id,
            'parent_variations' => $variation_id == 0?null:$variation_id,
            'template' => $request->get('template')==''?'':$request->get('template')
        ]);
        return response()->redirectTo('/category/show/'.$category_id);
    }
    public function update( Request $request, int $category_id, int $variation_id){
        $variation = CategoryVariation::where('id',$variation_id)->update([
            'title' => $request->get('title'),
            'template' => $request->get('template')==''?'':$request->get('template')
        ]);
        return response()->redirectTo('/category/show/'.$category_id);
    }

    public function delete(int $category_id,int $variation_id){
        $variation = CategoryVariation::find($variation_id);
        for($i=0; $i<=-1;$i++){
            $this->deleteChildren($variation_id);
        }
        $variation->delete();
        return response()->redirectTo('/category/show/'.$category_id);
    }
    public function get(int $category_id,int $variation_id)
    {
        if($variation_id==0){
           $variations = CategoryVariation::where('category_id',$category_id)->get();
            $output = '';
            foreach ($variations as $variation) {
               $output .= '<input type="button" data-id="'.$variation->id.'" id="variation_btn" type="button" class="btn btn-warning mr-2 mb-2 variation_btn" value="'.$variation->title.'">';
            }
            return $output;
        }
    }
    public function getVariationById(int $variation_id){
        $variation = CategoryVariation::find($variation_id);
        return $variation;
    }
}
