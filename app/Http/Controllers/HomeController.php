<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function show()
    {
        // A função SortByDesc - filtrará os produtos por ordem decrescente pelo preco passado em parâmetro, pegando somente os 4 primeiros pela função take()
        return view('welcome')->with('products', Product::all()->sortByDesc('price')->take(4));
    }

    public function searchCategory(Category $category)
    {
        // Product::where('category_id', '=', '$category_id');
        // Retorna todos os produtos associados a categoria
        return view('store.search')->with('products', $category->products()->paginate(4))->with('title', $category->name);
    }

    public function searchTag(Tag $tag)
    {
        return view('store.search')->with('products', $tag->products()->paginate(4))->with('title', $tag->name);
    }

    public function showProduct(Product $product)
    {
        return view('store.product')->with('product', $product);
    }
}
