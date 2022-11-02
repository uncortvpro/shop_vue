<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category\Category;
use App\Models\Category\CategoryBrand;
use App\Models\Category\CategoryCharacteristic;
use App\Models\Category\CategoryVariation;
use Illuminate\Http\Request;
use function response;
use function view;

class CategoryController extends Controller
{
    public function list()
    {
        $title_page = 'Categories';
        $categories = Category::orderByDesc('id')->get();

        return view('category.list', compact('title_page', 'categories'));
    }

    public function show(int $id)
    {
        $category = Category::find($id);
        $category_variations = CategoryVariation::where([['category_id',$id],['parent_variations',null]])->get();
        $title_page = 'Category';
        return view('category.show', compact('category', 'title_page', 'category_variations'));
    }

    public function action(int $id = 0)
    {
        $categories = Category::where('product_create', 0)->get();
        if ($id == 0) {
            $title_page = 'Create category';
            $form_href = '/category/create';
            $button_form = 'Create';
            return view('category.action', compact('title_page', 'form_href', 'categories', 'button_form'));
        } elseif ($id > 0) {
            $title_page = 'Edit category';
            $form_href = '/category/update/' . $id;
            $edit_category = Category::find($id);
            $button_form = 'Update';
            return view('category.action', compact('title_page', 'form_href', 'edit_category', 'categories', 'button_form'));
        }
    }

    public function create(ProductRequest $request)
    {

        $category = Category::create([
            'title' => $request->get('title'),
            'parent_category_id' => $request->get('parent_category_id'),
            'product_create' => $request->get('product_create') == 'on' ? 1 : 0,
            'status' => $request->get('status') == 'on' ? 1 : 0,
        ]);
        foreach ($request->get('characteristics') ?? [] as $item) {
            if ($item != '') {
                CategoryCharacteristic::create([
                    'title' => $item,
                    'category_id' => $category->id
                ]);
            }
        }
        foreach ($request->get('brands') ?? [] as $item) {
            if ($item != '') {
                CategoryBrand::create([
                    'title' => $item,
                    'category_id' => $category->id
                ]);
            }
        }
        return response()->redirectTo('/category/list');
    }

    public function update(Request $request, $id)
    {
        Category::where('id', $id)->update([
            'title' => $request->get('title'),
            'parent_category_id' => $request->get('parent_category_id'),
            'product_create' => $request->get('product_create') == 'on' ? 1 : 2,
            'status' => $request->get('status') == 'on' ? 1 : 2,
        ]);
        $category = Category::find($id);
        CategoryBrand::where('category_id', $id)->delete();
        CategoryCharacteristic::where('category_id', $id)->delete();
        foreach ($request->get('characteristics') ?? [] as $item) {
            if ($item != '') {
                CategoryCharacteristic::create([
                    'title' => $item,
                    'category_id' => $category->id
                ]);
            }
        }
        foreach ($request->get('brands') ?? [] as $item) {
            if ($item != '') {
                CategoryBrand::create([
                    'title' => $item,
                    'category_id' => $category->id
                ]);
            }
        }
        return response()->redirectTo('/category/list');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->categoryBrands()->delete();
        $category->categoryCharacteristics()->delete();
        $category->delete();
        return response()->redirectTo('/category/list');
    }
}
