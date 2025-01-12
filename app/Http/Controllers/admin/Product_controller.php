<?php

namespace App\Http\Controllers\admin;

use App\Models\Option;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Variation;
use Illuminate\Support\Str;
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
        try {
            return view('admin.pages.products.index');
        } catch (\Throwable $th) {
            return view('admin.404');
        }
    }
    // show products page
    public function show_products_page()
    {
        try {
            $products = Product::all();
            return view('admin.pages.products.show', compact('products'));
        } catch (\Throwable $th) {
            return view('admin.404');
        }
    }



    // add_product
    public function add_product(StoreProductRequest $request)
    {



        // dd($request);
        $product = new Product();
        $product->category_id = $request->category;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->long_description = $request->long_description;

        $image = $request->file('image');
        if ($image) {

            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
            $product->image = $imageName;
        }

        $gallery = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                // Generate a unique name for each gallery image
                $galleryImageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $galleryImageName);
                $gallery[] = $galleryImageName;
            }
            $product->gallery = $gallery;  // Assuming you want to store the gallery as a JSON array
        }

        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->featured = $request->featured;
        $product->type = $request->type;


        $product->save();
        if ($request->filled('type') && $request->type === 'variable') {
            $product->type = $request->type;
            if (count($request->attribute_name) > 0) {
                foreach ($request->attribute_name as $index => $name) {
                    $attribute = new Attribute();
                    $attribute->product_id = $product->id;
                    $attribute->name = $name;
                    $attribute->save();

                    // Ensure that attribute_values is set for this index
                    if (!empty($request->attribute_values[$index])) {
                        foreach (explode(',', $request->attribute_values[$index]) as $value) {
                            $attributeValues = new AttributeValue();
                            $attributeValues->attribute_id = $attribute->id;
                            $attributeValues->value = $value;
                            $attributeValues->save();
                        }
                    }
                }
            }
        } else {
            $product->type = 'simple';
        }

        // Handle variations if the product type is 'variations'
        if ($request->type === 'variable') {
            $attributeNames = $request->attribute_name;
            $attributeValues = $request->attribute_values;
            $prices = $request->price_variant;
            $salePrices = $request->sale_price_variant;
            $images = $request->file('image_variant'); // Access the image files

            $attributeCombinations = [];
            foreach ($attributeValues as $values) {
                $attributeCombinations[] = explode(',', $values);
            }

            $allCombinations = $this->generateCombinations($attributeCombinations);

            foreach ($allCombinations as $index => $combination) {
                $variationName = implode(' | ', $combination);

                // Handle image for this variation
                $imageName = null;
                if (isset($images[$index]) && $images[$index] instanceof \Illuminate\Http\UploadedFile) {
                    $uploadedImage = $images[$index];
                    $imageName = Str::uuid() . '.' . $uploadedImage->getClientOriginalExtension();
                    $uploadedImage->move(public_path('uploads'), $imageName);
                }

                // Create the variation
                $variation = new Variation();
                $variation->product_id = $product->id;
                $variation->variation_name = $variationName;
                $variation->price = $prices[$index] ?? $product->price;
                $variation->sale_price = $salePrices[$index] ?? $product->sale_price;
                $variation->sku = 'SKU' . time() . $index; // Unique SKU
                $variation->barcode = 'Barcode' . time() . $index; // Unique Barcode
                $variation->image = $imageName; // Save the image name
                $variation->status = 'active';
                $variation->save();
            }
        }



        // **Handling Product Options**
        if ($request->has('option_name') && count($request->option_name) > 0) {
            foreach ($request->option_name as $index => $optionName) {
                if (!empty($optionName)) { // Only store if option name is not empty
                    $option = new Option();
                    $option->product_id = $product->id;
                    $option->name = $optionName;
                    $option->price = $request->option_price[$index] ?? null;  // Default to null if not provided
                    $option->save();
                }
            }
        }


        return redirect()->back()->with('success', __('translate.added'));
    }


    // Helper function to generate combinations from attribute values
    private function generateCombinations(array $arrays)
    {
        $result = [];
        $this->combine([], $arrays, $result);
        return $result;
    }


    private function combine($prefix, $arrays, &$result)
    {
        if (empty($arrays)) {
            $result[] = $prefix;
            return;
        }
        foreach ($arrays[0] as $value) {
            $this->combine(array_merge($prefix, [$value]), array_slice($arrays, 1), $result);
        }
    }



    // update_product
    public function update_product($id)
    {

        try {

            $product = Product::with('attributes.values', 'variations', 'options')->findOrFail($id);
            return view('admin/pages.products.edit', compact('product'));
            
        } catch (\Throwable $th) {
            return view('admin.404');
        }
    }


    public function update_product_confirmation(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->category_id = $request->category;
        $product->name = $request->name;

        $product->description = $request->description;
        $product->long_description = $request->long_description;

        $image = $request->file('image');
        if ($image) {

            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
            $product->image = $imageName;
        }

        $gallery = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                // Generate a unique name for each gallery image
                $galleryImageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/products'), $galleryImageName);
                $gallery[] = $galleryImageName;
            }
            $product->gallery = $gallery;
        }

        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->featured = $request->featured;
        $product->type = $request->type;
        $product->save();



        // update options
        // **Handling Product Options**
       
    // Handle updating or adding options
    if ($request->has('option_name') && count($request->option_name) > 0) {
        // Loop through each option_name input
        foreach ($request->option_name as $index => $optionName) {
            if (!empty($optionName)) {
                // Check if an option already exists for this product
                $option = Option::where('product_id', $product->id)
                                ->where('id', $request->option_ids[$index] ?? null) // Check for the existing option ID (if any)
                                ->first();

                if ($option) {
                    // If the option exists, update it
                    $option->name = $optionName;
                    $option->price = $request->option_price[$index] ?? null;
                    $option->save();
                } else {
                    // If the option does not exist, create a new one
                    $newOption = new Option();
                    $newOption->product_id = $product->id;
                    $newOption->name = $optionName;
                    $newOption->price = $request->option_price[$index] ?? null;
                    $newOption->save();
                }
            }
        }
    }

        return redirect()->back()->with('success', __('translate.updated'));
    }



    public function delete_product($id)
    {

        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return redirect()->back()->with('success', __('translate.deleted'));
        } catch (\Throwable $th) {
            return view('admin.404');
        }
    }
}
