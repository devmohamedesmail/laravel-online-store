<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class Category_controller extends Controller
{
    // categories_page
    public function categories_page()
    {

        try {
            $categories = Category::all();
            return view('admin.pages.categories.index', compact('categories'));
        } catch (\Exception $e) {
            return view('admin.404');
        }

       
    }

    public function add_category(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->parent_id = $request->parent_id;
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
        $image = $request->image;
            if ($image) {
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/category'), $image_name);
                $category->image = $image_name;
            }
        $category->save();
        return redirect()->back()->with('success',__('translate.added'));
    }



    // delete_category
    public function delete_category($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category Deleted Successfully');
    }






    //  edit category 
    public function edit_category($id)
    {
        $category = Category::find($id);
        $categories = Category::all();
        return view('admin.pages.categories.edit', compact('category', 'categories'));
    }



    // edit_category_confirmartion
    public function edit_category_confirmartion(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->parent_id = $request->parent_id;
        $category->name = $request->name;
        $category->description = $request->description;
        $image = $request->image;
            if ($image) {
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/category'), $image_name);
                $category->image = $image_name;
            }
        $category->save();
        return redirect()->back()->with('success',__('translate.updated'));
    }
}
