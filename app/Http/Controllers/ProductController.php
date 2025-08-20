<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::getAllProduct();
        return view('backend.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::get();
        $categories = Category::where('is_parent', 1)->get();
        return view('backend.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|string',
        'summary' => 'required|string',
        'description' => 'nullable|string',
        // 'photo.*' => 'required|image|mimes:jpeg,png,jpg,gif', // multiple files
        'photo'=>'required',
        'size' => 'nullable',
        'stock' => 'required|numeric',
        'cat_id' => 'required|exists:categories,id',
        'brand_id' => 'nullable|exists:brands,id',
        'child_cat_id' => 'nullable|exists:categories,id',
        'is_featured' => 'sometimes|in:1',
        'status' => 'required|in:active,inactive',
        'condition' => 'required|in:default,new,hot',
        'price' => 'required|numeric',
        'discount' => 'nullable|numeric',
    ]);

    // slug
    $slug = generateUniqueSlug($request->title, Product::class);
    $validatedData['slug'] = $slug;
    $validatedData['is_featured'] = $request->input('is_featured', 0);

    // size
    $validatedData['size'] = $request->has('size') 
        ? implode(',', $request->input('size')) 
        : '';

    $photoPaths = [];

    if ($request->hasFile('photo')) {
    $uploadPath = public_path('uploads');

    if (!File::exists($uploadPath)) {
        File::makeDirectory($uploadPath, 0777, true, true);
    }

    foreach ($request->file('photo') as $file) {
        $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $filePath = $uploadPath . '/' . $filename;

        // Create image resource
        $source = null;
        $ext = strtolower($file->getClientOriginalExtension());

        switch ($ext) {
            case 'jpg':
            case 'jpeg':
                $source = imagecreatefromjpeg($file->getPathname());
                break;
            case 'png':
                $source = imagecreatefrompng($file->getPathname());
                break;
            case 'gif':
                $source = imagecreatefromgif($file->getPathname());
                break;
            default:
                $file->move($uploadPath, $filename); // fallback
                $photoPaths[] = 'uploads/' . $filename;
                continue 2;
        }

        // ✅ Resize (max width 800px)
        $origWidth  = imagesx($source);
        $origHeight = imagesy($source);
        $maxWidth   = 800;

        if ($origWidth > $maxWidth) {
            $newWidth  = $maxWidth;
            $newHeight = intval($origHeight * $newWidth / $origWidth);

            $resized = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($resized, $source, 0, 0, 0, 0,
                $newWidth, $newHeight, $origWidth, $origHeight);

            imagedestroy($source);
            $source = $resized;
        }

        // ✅ Save & compress until file size < 200KB
        $maxSize = 200 * 1024; // 200KB
        $quality = 85; // start quality
        do {
            ob_start();
            if (in_array($ext, ['jpg', 'jpeg'])) {
                imagejpeg($source, null, $quality);
            } elseif ($ext === 'png') {
                // Convert quality (0-9) from 100-0
                $pngQuality = 9 - floor($quality / 10); // higher quality → lower compression
                imagepng($source, null, $pngQuality);
            } elseif ($ext === 'gif') {
                imagegif($source);
            }
            $imageData = ob_get_clean();

            $fileSize = strlen($imageData);

            if ($fileSize > $maxSize && $quality > 10) {
                $quality -= 5; // reduce quality step by step
            } else {
                file_put_contents($filePath, $imageData);
                break;
            }
        } while (true);

        imagedestroy($source);
        $photoPaths[] = 'uploads/' . $filename;
    }
}
    // save as comma-separated string
    $validatedData['photo'] = implode(',', $photoPaths);

    $product = Product::create($validatedData);

    $message = $product
        ? 'Product Successfully added'
        : 'Please try again!!';

    return redirect()->route('product.index')->with(
        $product ? 'success' : 'error',
        $message
    );
}
    // public function store(Request $request)
    // {
         
    //     $validatedData = $request->validate([
    //         'title' => 'required|string',
    //         'summary' => 'required|string',
    //         'description' => 'nullable|string',
    //         'photo' => 'required|string',
    //         'size' => 'nullable',
    //         'stock' => 'required|numeric',
    //         'cat_id' => 'required|exists:categories,id',
    //         'brand_id' => 'nullable|exists:brands,id',
    //         'child_cat_id' => 'nullable|exists:categories,id',
    //         'is_featured' => 'sometimes|in:1',
    //         'status' => 'required|in:active,inactive',
    //         'condition' => 'required|in:default,new,hot',
    //         'price' => 'required|numeric',
    //         'discount' => 'nullable|numeric',
    //     ]);

    //     $slug = generateUniqueSlug($request->title, Product::class);
    //     $validatedData['slug'] = $slug;
    //     $validatedData['is_featured'] = $request->input('is_featured', 0);

    //     if ($request->has('size')) {
    //         $validatedData['size'] = implode(',', $request->input('size'));
    //     } else {
    //         $validatedData['size'] = '';
    //     }
    //     $photos = explode(',', $request->input('photo')); 
    //     $validatedData['photo'] = json_encode($photos); 
    //     $product = Product::create($validatedData);

    //     $message = $product
    //         ? 'Product Successfully added'
    //         : 'Please try again!!';

    //     return redirect()->route('product.index')->with(
    //         $product ? 'success' : 'error',
    //         $message
    //     );
    // }

   public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $validatedData = $request->validate([
        'title' => 'required|string',
        'summary' => 'required|string',
        'description' => 'nullable|string',
        'photo' => 'nullable', // allow empty on update
        'size' => 'nullable',
        'stock' => 'required|numeric',
        'cat_id' => 'required|exists:categories,id',
        'child_cat_id' => 'nullable|exists:categories,id',
        'is_featured' => 'sometimes|in:1',
        'brand_id' => 'nullable|exists:brands,id',
        'status' => 'required|in:active,inactive',
        'condition' => 'required|in:default,new,hot',
        'price' => 'required|numeric',
        'discount' => 'nullable|numeric',
    ]);

    $validatedData['is_featured'] = $request->input('is_featured', 0);

    $validatedData['size'] = $request->has('size') 
        ? implode(',', $request->input('size')) 
        : '';

    $photoPaths = [];

    if ($request->hasFile('photo')) {
        $uploadPath = public_path('uploads');

        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0777, true, true);
        }

        foreach ($request->file('photo') as $file) {
            $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = $uploadPath . '/' . $filename;

            // ✅ Create image resource
            $ext = strtolower($file->getClientOriginalExtension());
            switch ($ext) {
                case 'jpg':
                case 'jpeg':
                    $source = imagecreatefromjpeg($file->getPathname());
                    break;
                case 'png':
                    $source = imagecreatefrompng($file->getPathname());
                    break;
                case 'gif':
                    $source = imagecreatefromgif($file->getPathname());
                    break;
                default:
                    $file->move($uploadPath, $filename);
                    $photoPaths[] = 'uploads/' . $filename;
                    continue 2;
            }

            // ✅ Resize (max width 800px)
            $origWidth  = imagesx($source);
            $origHeight = imagesy($source);
            $maxWidth   = 800;

            if ($origWidth > $maxWidth) {
                $newWidth  = $maxWidth;
                $newHeight = intval($origHeight * $newWidth / $origWidth);

                $resized = imagecreatetruecolor($newWidth, $newHeight);
                imagecopyresampled($resized, $source, 0, 0, 0, 0,
                    $newWidth, $newHeight, $origWidth, $origHeight);

                imagedestroy($source);
                $source = $resized;
            }

            // ✅ Compress until under 200KB
            $maxSize = 200 * 1024; // 200KB
            $quality = 85;

            do {
                ob_start();
                if (in_array($ext, ['jpg', 'jpeg'])) {
                    imagejpeg($source, null, $quality);
                } elseif ($ext === 'png') {
                    $pngQuality = 9 - floor($quality / 10);
                    imagepng($source, null, $pngQuality);
                } elseif ($ext === 'gif') {
                    imagegif($source);
                }
                $imageData = ob_get_clean();

                $fileSize = strlen($imageData);

                if ($fileSize > $maxSize && $quality > 10) {
                    $quality -= 5; // reduce quality step by step
                } else {
                    file_put_contents($filePath, $imageData);
                    break;
                }
            } while (true);

            imagedestroy($source);
            $photoPaths[] = 'uploads/' . $filename;
        }

        // Save as comma-separated string
        $validatedData['photo'] = implode(',', $photoPaths);
    }

    $status = $product->update($validatedData);

    $message = $status
        ? 'Product Successfully updated'
        : 'Please try again!!';

    return redirect()->route('product.index')->with(
        $status ? 'success' : 'error',
        $message
    );
}

public function deletePhoto(Request $request)
{
    $product = Product::findOrFail($request->product_id);

    $photos = explode(',', $product->photo);

    // Remove selected photo
    $photos = array_filter($photos, function ($photo) use ($request) {
        return $photo !== $request->photo;
    });

    // Delete file from storage/public if needed
    if (file_exists(public_path($request->photo))) {
        unlink(public_path($request->photo));
    }

    // Update DB with remaining photos
    $product->photo = implode(',', $photos);
    $product->save();

    return response()->json(['status' => 'success', 'photos' => $product->photo]);
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Implement if needed
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brands = Brand::get();
        $product = Product::findOrFail($id);
        $categories = Category::where('is_parent', 1)->get();
        $items = Product::where('id', $id)->get();

        return view('backend.product.edit', compact('product', 'brands', 'categories', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_old(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string',
            'summary' => 'required|string',
            'description' => 'nullable|string',
            'photo' => 'required|string',
            'size' => 'nullable',
            'stock' => 'required|numeric',
            'cat_id' => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'is_featured' => 'sometimes|in:1',
            'brand_id' => 'nullable|exists:brands,id',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:default,new,hot',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
        ]);

        $validatedData['is_featured'] = $request->input('is_featured', 0);

        if ($request->has('size')) {
            $validatedData['size'] = implode(',', $request->input('size'));
        } else {
            $validatedData['size'] = '';
        }
        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $file) {
                $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $filename);
                $photoPaths[] = 'uploads/' . $filename; // save relative path
            }
        }
        $validatedData['photo'] = $photoPaths;  
        $status = $product->update($validatedData);

        $message = $status
            ? 'Product Successfully updated'
            : 'Please try again!!';

        return redirect()->route('product.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $status = $product->delete();

        $message = $status
            ? 'Product successfully deleted'
            : 'Error while deleting product';

        return redirect()->route('product.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }
}
