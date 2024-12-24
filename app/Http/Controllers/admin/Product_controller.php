<?php

namespace App\Http\Controllers\admin;

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
        return view('admin.pages.products.index');
    }
    // show products page
    public function show_products_page()
    {   
        $products = Product::all();
        return view('admin.pages.products.show',compact('products'));
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
            $product->gallery = $gallery;  // Assuming you want to store the gallery as a JSON array
        }

        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->featured = $request->featured;
        $product->type = $request->type;


        $product->save();
        if ($request->type === 'variations') {
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
    if ($request->type === 'variations') {
        // Get attribute names and values
        $attributeNames = $request->attribute_name;
        $attributeValues = $request->attribute_values;
        $prices = $request->price_variant;
        $salePrices = $request->sale_price_variant;
        $images = $request->image_variant;

        // Split attribute values by commas for multiple options
        $attributeCombinations = [];
        foreach ($attributeValues as $values) {
            $attributeCombinations[] = explode(',', $values);
        }

        // Generate all possible combinations of attributes
        $allCombinations = $this->generateCombinations($attributeCombinations);

        // Loop through each combination and create a variation
        foreach ($allCombinations as $combination) {
            // Combine attributes into one string for the variation name (e.g., 'Red | Small')
            $variationName = implode(' | ', $combination);

            // Find the corresponding prices, images, etc., for this combination
            // If a variation has a specific price, use it, else default to product price
            $priceIndex = count($combination) - 1; // Assumes price corresponds to the last attribute (e.g., for color/size combinations)
            $price = $prices[$priceIndex] ?? $product->price;
            $salePrice = $salePrices[$priceIndex] ?? $product->sale_price;
            $image = $images[$priceIndex] ?? null;

            // Create the variation
            $variation = new Variation();
            $variation->product_id = $product->id;
            $variation->variation_name = $variationName; // Save full combination
            $variation->price = $price;
            $variation->sale_price = $salePrice;
            $variation->sku = 'SKU' . time(); // Customize SKU generation if needed
            $variation->barcode = 'Barcode' . time(); // Customize Barcode generation if needed
            $variation->image = $image; // Save the image for this specific variation
            $variation->status = 'active'; // Assuming the default status is active
            $variation->save();
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
    public function update_product($id){
        $product = Product::findOrFail($id);
        return view('admin/pages.products.edit',compact('product'));
    }


    public function update_product_confirmation(Request $request,$id){
        $product = Product::findOrFail($id);

        $product->category_id = $request->category;
        $product->name = $request->name;
        $product->slug = $request->slug;
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
        return redirect()->back()->with('success',__('translate.updated'));
    }



    public function delete_product($id){
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('success',__('translate.deleted'));
    }
}
