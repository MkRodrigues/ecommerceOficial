<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTagsRequest;
use App\Http\Requests\EditTagsRequest;
use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{

    public function index()
    {
        return view('tags.index')->with('tags', Tag::all());
    }


    public function create()
    {
        return view('tags.create');
    }

    public function store(CreateTagsRequest $request)
    {
        Tag::create(['name' => $request->name]);
        session()->flash('success', 'Tag criada com sucesso!');
        return redirect(route('tags.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit')->with('tags', $tag);
    }

    public function update(EditTagsRequest $request, Tag $tag)
    {
        $tag->update([
            'name' => $request->name
        ]);
        session()->flash('success', 'Tag atualizada com sucesso!');
        return redirect(route('tags.index'));
    }

    public function destroy($id)
    {
        $tag = Tag::withTrashed()->where('id', $id)->firstOrFail();
        $product = $tag->products()->count();
        if ($product > 0) {
            session()->flash('error', 'Esta tag possui (' . $product . ') produto(s) em uso e portanto não pode ser excluída!');
            return redirect()->back();
        }
        if ($tag->trashed()) {
            $tag->forceDelete();
            session()->flash('success', 'Tag apagada com sucesso!');
        } else {

            $tag->delete();
            session()->flash('success', 'Tag enviada para lixeira com sucesso!');
        }
        return redirect()->back();
    }

    public function trashed()
    {
        return view('tags.index')->with('tags', Tag::onlyTrashed()->get());
    }

    public function restore($id)
    {
        $tag = Tag::onlyTrashed()->where('id', $id)->firstOrFail();
        $tag->restore();
        session()->flash('success', 'Tag restaurada com sucesso!');
        return redirect()->back();
    }
}
