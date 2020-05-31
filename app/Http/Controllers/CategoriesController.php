<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\EditCategoryRequest;

class CategoriesController extends Controller
{

    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categories.index')->with('categories', Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        Category::create(['name' => $request->name]);
        session()->flash('success', 'Categoria criada com Sucesso!');
        return redirect(route('categories.index'));
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
    public function edit(Category $category)
    {
        return view('categories.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditCategoryRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->name
        ]);
        session()->flash('success', 'Categoria atualizada com sucesso!');
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::withTrashed()->where('id', $id)->firstOrFail();

        if ($category->trashed()) {
            $category->forceDelete();
            session()->flash('success', 'Categoria apagada com sucesso!');
        } else {

            $category->delete();
            session()->flash('success', 'Categoria enviado para lixeira com sucesso!');
        }
        return redirect()->back();
    }

    public function trashed()
    {
        return view('categories.index')->with('categories', Category::onlyTrashed()->get());
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->where('id', $id)->firstOrFail();
        $category->restore();
        session()->flash('success', 'Produto restaurado com sucesso!');
        return redirect()->back();
    }
}
