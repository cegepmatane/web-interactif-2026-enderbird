<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Morceau;
use App\Models\Album;
use Illuminate\Http\Request;

class MorceauController extends Controller
{
  public function create()
  {
    return view('admin.morceau.create', ['albums' => Album::all()]);
  }

  public function store(Request $request)
  {
    Morceau::create($request->all());
    return redirect()->route('admin.index');
  }

  public function edit($id)
  {
    return view(
      'admin.morceau.edit', 
      [
        'morceau' => Morceau::findOrFail($id),
        'albums' => Album::all()
      ]
    );
  }

  public function update(Request $request, $id)
  {
    Morceau::findOrFail($id)->update($request->all());

    return redirect()->route('admin.index');
  }

  public function delete($id)
  {
    Morceau::destroy($id);
    
    return redirect()->route('admin.index');
  }
}