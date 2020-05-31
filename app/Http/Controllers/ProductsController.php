<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Tag;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('VerifyCategoriesCount')->only(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index')->with('products', Product::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        // Armazena na variável image(Faz uma requisiçao pra imagem inserida no input, e salva ela na pasta storage/public/products)
        $image = $request->image->store('products');
        $product = Product::create($request->all());

        // Pega a o campo de imagem via requisição e armazena o valor vindo de $image dentro da classe Produto
        $product->image = $image;
        $product->save();

        // Se Tags forem selecionadas na criação do produto: 
        if ($request->tags) {
            // Chama a função de relacionamento "tags", definida na Model, e faz uma inserção attach na tabela Tags
            $product->tags()->attach($request->tags);
        }


        session()->flash('success', 'Produto criado com sucesso!');
        return redirect(route('products.index'));
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
    public function edit(Product $product)
    {
        return view('products.edit')->with('products', $product)->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditProductRequest $request, Product $product)
    {
        $product->update([
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
            'discount' => $request->discount,
            'description' => $request->description,
            'category_id' => $request->category_id
        ]);

        // Identifica o produto com a Tag pela função Tag definida na model de Tags, e sincroniza com o que vem de requisição
        if ($request->tags) {
            $product->tags()->sync($request->tags);
        }

        // Se uma nova imagem for passada os requisitos abaixo serão cumpridos, se não, nada será feito mantendo a imagem atual
        if ($request->image) {
            // Exclui a imagem antiga
            Storage::delete($product->image);

            // Salva a imagem nova
            $image = $request->image->store('products');

            // Atualiza no banco a nova imagem
            $product->image = $image;

            // Salva no banco
            $product->save();
        }

        session()->flash('success', 'Produto atualizado com sucesso!');
        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Função withTrashed() retorna todos os itens no banco, inclusive os excluídos "SoftDelete"
        // A função Where é como no Banco de Dados "Select * from where condição"
        // FirstOrFail faz parte da função Where, e retorna o primeiro resultado ou caso dê erro retorna mensagem de erro de produto não encontrado

        // Procura todos os produtos deletados aonde o Id é igual à variável id no where
        $product = Product::withTrashed()->where('id', $id)->firstOrFail();

        // Se o produto já estiver no SOftDelete, ele será apagado definitivamente
        // Senão, será enviado para o SoftDelete
        // ForceDelete - Força que o produto já excluído seja excluído definitivamente
        // Ao ser excluído permanentemente, a imagem será excluída através da função storage::delete()

        if ($product->trashed()) {
            Storage::delete($product->image);
            $product->forceDelete();
            session()->flash('success', 'Produto apagado com sucesso!');
        } else {

            $product->delete();
            session()->flash('success', 'Produto enviado para lixeira com sucesso!');
        }
        // Retorna pra página aonde estava anteriormente
        return redirect()->back();
    }

    public function trashed()
    {
        return view('products.index')->with('products', Product::onlyTrashed()->get());
    }

    public function restore($id)
    {
        // Busca somente os dados que estiverem na lixeira onlyTrashed()
        $product = Product::onlyTrashed()->where('id', $id)->firstOrFail();
        $product->restore();
        session()->flash('success', 'Produto restaurado com sucesso!');
        return redirect()->back();
    }
}
