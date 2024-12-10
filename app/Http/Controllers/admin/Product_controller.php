<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use App\Models\Attribute;
use App\Models\Variation;
use Illuminate\Http\Request;
use App\Models\AttributeType;
use App\Models\AttributeValue;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;

class Product_controller extends Controller
{
    // add_product_page
    public function add_product_page()
    {
        return view('admin.pages.products.index');
    }
    // show products page
    public function show_products_page()
    {
        return view('admin.pages.products.show');
    }



    // add_product
    public function add_product(StoreProductRequest $request)
    {

        $product = new Product();
        $product->category_id = $request->category;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->long_description = $request->long_description;

        $image = $request->file('image');
        if ($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
            $product->image = $imageName;
        }



        $gallery = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $name = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/products'), $name);
                $gallery[] = $name;
            }
            $product->gallery = $gallery;
        }

        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->featured = $request->featured;
        $product->type = $request->type;


        // $product->save();
        dd($request);

        // if ($request->type !== 'simple') {

           
        //     if (!empty($request->attribute_name) && count($request->attribute_name) > 0) {
        //         foreach ($request->attribute_name as $index => $name) {
        //             $attribute = new Attribute();
        //             $attribute->product_id = $product->id;
        //             $attribute->name = $name;
        //             $attribute->save();

        //             // Ensure that attribute_values is set for this index
        //             if (!empty($request->attribute_values[$index])) {
        //                 foreach (explode(',', $request->attribute_values[$index]) as $value) {
        //                     $attributeValues = new AttributeValue();
        //                     $attributeValues->attribute_id = $attribute->id;
        //                     $attributeValues->value = $value;
        //                     $attributeValues->save();
        //                 }
        //             }
        //         }
        //     }

            
        //     if (!empty($request->attribute_values) && count($request->attribute_values) > 0) {
        //         $combinations = $this->generateCombinations($request->attribute_values);
        //         foreach ($combinations as $combination) {
        //             $variation = new Variation();
        //             $variation->product_id = $product->id;
        //             $variation->name = implode(' | ', $combination);
        //             $variation->value = implode(' | ', $combination);
        //             $variation->price = $request->price_variant[0] ?? $request->price; // Use variant price or fallback to regular price
        //             $variation->sale_price = $request->sale_price_variant[0] ?? null;
        //             $variation->stock = $request->stock_variant[0] ?? 0;
        //             $variation->save();

        //             // Handle image upload for product variation
        //             if ($request->hasFile('image_variant')) {
        //                 $imagePath = $request->file('image_variant')[0]->store('product_variations');
        //                 $variation->image = $imagePath;
        //                 $variation->save();
        //             }
        //         }
        //     }
        // }



        return redirect()->back();
    }


    // Helper function to generate combinations from attribute values
    private function generateCombinations($attributeValues)
    {
        $values = [];
        foreach ($attributeValues as $value) {
            $values[] = explode(',', $value);
        }
        return $this->cartesianProduct($values);
    }



    private function cartesianProduct($arrays)
    {
        return array_reduce($arrays, function ($a, $b) {
            return array_merge(...array_map(function ($x) use ($b) {
                return array_map(function ($y) use ($x) {
                    return array_merge((array)$x, (array)$y);
                }, $b);
            }, $a));
        }, [[]]);
    }
}
