<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
  public function create()
  {
    return view('album.create');
  }

  public function store(Request $request)
  {
    $request->validate(
      ['nom' => 'required'],
      ['artiste' => 'required'],
      ['type' => 'required'],
      ['date_sortie' => 'required']
    );

    Album::create($request->all());
    // Album::create($request->only('nom'));

    return redirect()->route('index');
  }

  public function edit($id)
  {
    return view('album.edit', 
      [
        'album' => Album::findOrFail($id)
      ]
    );
  }

  public function update(Request $request, $id)
  {
    // Album::findOrFail($id)->update($request->all());

    Album::findOrFail($id)->update([
      'nom' => $request->nom,
      'artiste' => $request->artiste,
      'type' => $request->type
    ]);

    return redirect()->route('index');
  }

  public function delete($id)
  {
    Album::destroy($id);

    return redirect()->route('index');
  }

}