<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTagsRequest;
use App\Http\Requests\EditTagsRequest;
use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tags.index')->with('tags', Tag::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagsRequest $request)
    {
        Tag::create(['name' => $request->name]);
        session()->flash('success', 'Tag criada com sucesso!');
        return redirect(route('tags.index'));
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
    public function edit(Tag $tag)
    {
        return view('tags.edit')->with('tags', $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditTagsRequest $request, Tag $tag)
    {
        $tag->update([
            'name' => $request->name
        ]);
        session()->flash('success', 'Tag atualizada com sucesso!');
        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::withTrashed()->where('id', $id)->firstOrFail();

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
