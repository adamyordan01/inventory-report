<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductStockLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['category'])->orderby('created_at', 'DESC');
        
        $categories = Category::get();

        if (request()->q != '') {
            $products = Product::where('product_name', 'LIKE', '%' . request()->q . '%');
        }

        $products = $products->paginate(10);


        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_code' => 'required|string|max:10',
            'product_name' => 'required|string',
            'category_id' => 'required',
            'stock' => 'required|numeric',
            'year' => 'required|numeric|min:4|max:4',
        ]);

        if ($request->act == "add") {
            $product = new Product;
            $product->product_code = $request->product_code;
            $product->product_name = $request->product_name;
            $product->category_id = $request->category_id;
            $product->stock = $request->stock;
            $product->year = $request->year;
            $product->save();
            
            $log = new ProductStockLog;
            $log->product_id = $product->id;
            $log->quantity = $product->stock;
            $log->annotation = $request->annotation;
            $log->user_id = Auth::id();
            $log->save();
        }
        //  elseif ($request->act == "edit") {
        //     $product = new Product;
        //     $oldRecord = Product::findOrFail($product->id);
        //     if ($oldRecord->stock == $product->stock) {
        //         return true;
        //     } elseif ($oldRecord->stock < $product->stock) {
        //         $log = new ProductStockLog;
        //         $log->product_id = $product->id;
        //         $log->quantity = $product->stock;
        //         $log->annotation = $request->annotation;
        //         $log->save();
        //     } elseif ($oldRecord->stock > $product->stock) {
        //         $log = new ProductStockLog;
        //         $log->product_id = $product->id;
        //         $log->quantity = $product->stock;
        //         $log->annotation = $request->annotation;
        //         $log->save();
        //     }
        // }
        return redirect()->back()->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        $stockLog = ProductStockLog::where('product_id', $product->id)->get();
        return view('products.show', [
            'stockLog' => $stockLog,
            'product' => $product
        ]);
    }

    public function print($id)
    {
        $product = Product::find($id);

        $stockLog = ProductStockLog::where('product_id', $product->id)->get();
        return view('products.print', [
            'stockLog' => $stockLog,
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // $product = new Product;
            
        // $oldRecord = Product::find($id);
        // $new = 20;
        // // $result = $oldRecord->stock;

        // dd($oldRecord->stock);
        $product = Product::findOrFail($id);
        $categories = Category::get();
        // $stockLog = ProductStockLog::findOrFail($id);

        return view('products.edit', [
            'product' => $product,
            'categories' => $categories,
            // 'stockLog' => $stockLog,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function save(Request $request, $id)
    {
        $this->validate($request, [
            'product_name' => 'required|string',
            'category_id' => 'required',
            'stock' => 'required|numeric',
        ]);

        if ($request->act == "add") {
            $product = new Product;
            $product->product_name = $request->product_name;
            $product->category_id = $request->category_id;
            $product->stock = $request->stock;
            $product->save();
            
            $log = new ProductStockLog;
            $log->product_id = $product->id;
            $log->quantity = $product->stock;
            $log->annotation = $request->annotation;
            $log->save();
        } elseif ($request->act == "edit") {
            $product = new Product;
            
            $oldRecord = Product::find($id);
            if ($oldRecord->stock == $request->stock) {
                return redirect()->route('product.index')->with('success', 'Barang berhasil diubah.');
            } elseif ($oldRecord->stock < $request->stock) {
                // ambil id berdasarkan produk yang akan di ubah
                $product = Product::find($id);
                // $product->product_name = $request->product_name;
                // $product->category_id = $request->category_id;
                // $product->stock = $request->stock;
                // $product->save();
                // proses insert product stocklog
                $log = new ProductStockLog;
                $log->product_id = $product->id;
                $log->quantity = abs($product->stock - $request->stock);
                $log->annotation = $request->annotation;
                $log->user_id = Auth::id();
                // dd($log);
                $log->save();

                // proses update product
                $product->update([
                    'product_code' => $request->product_code,
                    'product_name' => $request->product_name,
                    'category_id' => $request->category_id,
                    'stock' => $request->stock,
                    'year' => $request->year,
                ]);
                // dd($product);

                
            } elseif ($oldRecord->stock > $request->stock) {
                $product = Product::find($id);
                // $product->product_name = $request->product_name;
                // $product->category_id = $request->category_id;
                // $product->stock = $request->stock;
                // $product->save();
                $log = new ProductStockLog;
                $log->product_id = $product->id;
                $log->quantity = abs($request->stock - $product->stock);
                $log->annotation = $request->annotation;
                $log->user_id = Auth::id();
                // dd($log);
                $log->save();

                $product->update([
                    'product_code' => $request->product_code,
                    'product_name' => $request->product_name,
                    'category_id' => $request->category_id,
                    'stock' => $request->stock,
                    'year' => $request->year,
                ]);
                // dd($product);
                
                
            }
        }
        return redirect()->route('product.index')->with('success', 'Barang berhasil diubah.');
    }
}
