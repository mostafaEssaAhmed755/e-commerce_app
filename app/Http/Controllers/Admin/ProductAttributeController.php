<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductAttributeController extends Controller
{
    public function loadAttributes()
    {
        $attributes = Attribute::all('id','name');

        return response()->json($attributes);
    }

    public function productAttributes(int $id)
    {
        $productAttributes = ProductAttribute::join('attributes', 'attributes.id', '=', 'product_attributes.attribute_id')
            ->join('attribute_values', 'attribute_values.id', '=', 'product_attributes.attribute_value_id')
            ->where('product_id', $id)
            ->get([ 'product_attributes.id',
                    'product_attributes.quantity',
                    'product_attributes.price',
                    'attributes.name As attributeName',
                    'attribute_values.value As attributeValueName']);

        return response()->json($productAttributes);
    }

    public function loadValues($id)
    {
        $attribute = Attribute::findOrFail($id);

        return response()->json($attribute->values);
    }

    public function addAttribute(Request $request, $id)
    {
        $productAttribute = ProductAttribute::where('attribute_id',$request->attribute_id)
            ->where('attribute_value_id', $request->attribute_value_id)
            ->where('product_id', $id)
            ->first();

        if ($productAttribute === null) {
            $productAttribute = ProductAttribute::create($request->data);

            if ($productAttribute) {
                return response()->json(['status' => 'success', 'message' => 'Product attribute added successfully.']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong while submitting product attribute.']);
            }
        } else {
            return response()->json(['status' => 'error' , 'message' => 'Product attribute already exists.']);

        }
    }

    public function deleteAttribute($id)
    {
        $productAttribute = ProductAttribute::findOrFail($id);
        $productAttribute->delete();

        return response()->json(['status' => 'success', 'message' => 'Product attribute deleted successfully.']);
    }
}
