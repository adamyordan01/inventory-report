<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderby('created_at', 'DESC');

        // jika terdpat request pencarian maka masuk kedalam statement ini
        if (request()->q != '') {
            $categories = Category::where('category_name', 'LIKE', '%' . request()->q . '%');
        }
        // kemudian load datanya kedalam view
        $categories = $categories->paginate(10);


        return view('categories.index', [
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
            'category_code' => 'required|string|max:10',
            'category_name' => 'required|string'
        ]);

        Category::create($request->except('_token'));

        return redirect()->route('category.index')->with(['success' => 'Kategori berhasil ditambahkan.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return view('categories.edit', [
            'category' => $category,
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
        $this->validate($request, [
            'category_code' => 'required|string|max:10',
            'category_name' => 'required|string',
        ]);

        $category = Category::find($id);

        $category->update([
            'category_code' => $request->category_code,
            'category_name' => $request->category_name
        ]);

        return redirect()->route('category.index')->with(['success' => 'Kategori Barang Berhasil Diubah.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
