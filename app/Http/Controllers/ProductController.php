<?php

namespace App\Http\Controllers;

use App\Models\Category\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function list(){
        $title_page = 'Products';
        $products = Product::all();
        return view('product.list', compact('products','title_page'));
    }
    public function action(int $id = 0){
        $categories = Category::where('product_create', '!=', 0)->get();
        if ($id == 0) {
            $title_page = 'Create product';
            $form_href = '/product/create';
            $button_form = 'Create';
            return view('product.action', compact('title_page', 'form_href', 'categories', 'button_form'));
        } elseif ($id > 0) {
            $title_page = 'Edit product';
            $form_href = '/product/update/' . $id;
            $edit_product = Product::find($id);
            $button_form = 'Update';
            return view('product.action', compact('title_page', 'form_href', 'edit_product', 'categories', 'button_form'));
        }
    }
    public function create(Request $request){
        dd($request->all());
    }
}
