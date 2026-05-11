<?php

namespace App\Http\Controllers;

use App\Models\Morceau;
use App\Models\Album;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $albums = Album::with([
            'morceaux' => function ($query) {
                $query->orderBy('ordre');
            }
        ])->get();

        return view('admin.index', compact('albums'));
    }
    public function create()
    {
        $albums = Album::all();

        return view('admin.create', compact('albums'));
    }
    public function edit($id)
    {
        $morceau = Morceau::findOrFail($id);
        $albums = Album::all();

        return view('admin.edit', compact('morceau', 'albums'));
    }

    public function store(Request $request)
    {
        Morceau::create($request->all());
        return redirect('/admin');
    }
    public function update(Request $request, $id)
    {
        $morceau = Morceau::findOrFail($id);
        $morceau->update($request->all());
        return redirect('/admin');
    }
    public function destroy($id)
    {
        Morceau::destroy($id);
        return redirect('/admin');
    }
}