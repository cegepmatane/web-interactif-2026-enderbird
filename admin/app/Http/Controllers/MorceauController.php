<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\Morceau;
use App\Models\Album;
use Illuminate\Http\Request;

class MorceauController extends Controller
{
  public function create()
  {
    return view(
      'morceau.create', 
      [
        'albums' => Album::orderBy('id', 'desc')->get() // for bonus
      ]
    );
  }

  public function store(Request $request)
  {
    Morceau::create($request->all());
    return redirect()->route('index');
  }

  public function edit($id)
  {
    return view(
      'morceau.edit', 
      [
        'morceau' => Morceau::findOrFail($id),
        'albums' => Album::orderBy('id', 'desc')->get() // for bonus
      ]
    );
  }

  public function update(Request $request, $id)
  {
    Morceau::findOrFail($id)->update($request->all());

    return redirect()->route('index');
  }

  public function delete($id)
  {
    Morceau::destroy($id);
    
    return redirect()->route('index');
  }
}