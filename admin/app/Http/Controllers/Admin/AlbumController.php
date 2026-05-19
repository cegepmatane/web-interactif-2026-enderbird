<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
  public function create()
  {
    return view('admin.album.create');
  }

  public function store(Request $request)
  {
    $request->validate(['name' => 'required']);

    Album::create($request->only('name'));

    return redirect()->route('admin.index');
  }

  public function edit($id)
  {
    return view('admin.album.edit', 
      [
        'album' => Album::findOrFail($id)
      ]
    );
  }

  public function update(Request $request, $id)
  {
    Album::findOrFail($id)->update([
      'name' => $request->name
    ]);

    return redirect()->route('admin.index');
  }

  public function delete($id)
  {
    Album::destroy($id);

    return redirect()->route('admin.index');
  }

}