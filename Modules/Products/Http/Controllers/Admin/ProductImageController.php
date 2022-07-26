<?php

namespace Modules\Products\Http\Controllers\Admin;

use Modules\Products\Contracts\ProductContract;
use App\Http\Controllers\Controller;
use Modules\Products\Entities\ProductImage;
use Illuminate\Http\Request;
use Modules\Core\Traits\UploadAble;
use Illuminate\Http\UploadedFile;

class ProductImageController extends Controller
{
    use UploadAble;

    protected $productRepository;

    public function __construct(ProductContract $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function upload(Request $request, $id)
    {
        $product = $this->productRepository->findProductById($id);

        if ($request->has('image') && ($request->image instanceof UploadedFile)) {
            $image = $this->uploadOne($request->image, 'products');

            $productImage = new ProductImage([
                'full' => $image
            ]);

            $product->images()->save($productImage);
        }

        return response()->json(['status' => 'success']);
    }

    public function delete($id)
    {
        $image = ProductImage::findOrFail($id);

        if ($image->full != null) {
            $this->deleteOne($image->full);
        }

        $image->delete();

        return redirect()->back();

    }
}
