<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category\CategoryCharacteristic;
use Illuminate\Http\Request;

class CharacteristicController extends Controller
{
    public function add(Request $request, int $category_id){
        $characteristic = CategoryCharacteristic::create([
            'title' => $request->get('title'),
            'category_id' => $category_id
        ]);
        return response()->redirectTo('/category/show/'.$category_id);
    }
    public function update(Request $request, $category_id, $characteristic_id){
        $characteristic = CategoryCharacteristic::find($characteristic_id);
        $characteristic->update(['title'=>$request->get('title')]);
        return response()->redirectTo('/category/show/'.$category_id);
    }
    public function delete($category_id, $characteristic_id){
        $characteristic = CategoryCharacteristic::find($characteristic_id);
        $characteristic->delete();
        return response()->redirectTo('/category/show/'.$category_id);

    }
}
