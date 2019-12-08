<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Product;
use App\Photo;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::where('quantity', '>' , '0')->orderBy('id', 'desc')->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:5|max:50',
            'description' => 'required|min:20|max:500',
            'quantity' => 'required|min:1|integer',
            'price' => 'required|integer|min:5',
            'image' => 'required|image',
        ];
        
        $this->validate($request, $rules);

        $data = $request->all()->except(['image']);

        $product = Product::create($data);

        if($file = $request->file('image')) {

            $filename = $file->getClientOriginalName();
            $file_extension = $file->getClientOriginalExtension();

            $file_to_store = time() .'_'.explode('.', $filename)[0].'_.'.$file_extension;

            if($file->move('images', $file_to_store)) {
                Photo::create(['filename' => $file_to_store,'photoable_id' => $product->id, 'photoable_type' => 'App\Product']);
            }
        } 
        return redirect('/admin/products')->withStatus('Product successfully created.');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $rules = [
            'name' => 'required|min:5|max:50',
            'description' => 'required|min:20|max:500',
            'quantity' => 'required|min:1|integer',
            'price' => 'required|integer|min:5',
        ];
        
        $this->validate($request, $rules);

        if($request->has('name')) {
            $product->name = $request->name;
        }
        if($request->has('description')) {
            $product->description = $request->description;
        }
        if($request->has('quantity')) {
            $product->quantity = $request->quantity;
        }
        if($request->has('price')) {
            $product->price = $request->price;
        }


        if($file = $request->file('image')) {

            $filename = $file->getClientOriginalName();
            $file_extension = $file->getClientOriginalExtension();

            $file_to_store = time() .'_'.explode('.', $filename)[0].'_.'.$file_extension;

            //  update filename to the new image.
            //  delete the old image from server
            
            $product_image = $product->image;
            if($product_image) {
                if(file_exists('images/' . $product_image->filename)) {
                    unlink('images/'.$product_image->filename);
                }
                $product_image->filename = $file_to_store;
                // create and upload the new image
                $file->move('images', $file_to_store);
            }
        }

        if($product->isDirty()) {
            $product->save();
            return redirect('/admin/products')->withStatus('Prodcut successfully updated.');
        }else {
            return redirect()->back()->withStatus('Nothing Changed.');
        }
    }

    public function destroy(Product $product)
    {
        $product_image = $product->image;
        if($product_image) {
            $product_image->delete();
            if(file_exists('images/' . $product_image->filename)) {
                unlink('images/'.$product_image->filename);
            }
        }
        $product->delete();
        return view('admin.products.index')->withStatus('Prodcut successfully deleted.');
    }
}
