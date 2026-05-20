<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\Morceau;
use App\Models\Album;
use Illuminate\Http\Request;

class MorceauController extends Controller
{
  // CREER
  public function creer(){
    return view(
      'morceau.creer', 
      [
        'albums' => Album::orderBy('id', 'desc')->get() // for bonus
      ]
    );
  }
  public function enregistrerCreation(Request $request){
    Morceau::create($request->all());
    return redirect()->route('index');
  }

  // MODIFIER
  public function modifier($id){
    return view(
      'morceau.modifier', 
      [
        'morceau' => Morceau::findOrFail($id),
        'albums' => Album::orderBy('id', 'desc')->get() // for bonus
      ]
    );
  }
  public function enregistrerModifications(Request $request, $id){
    Morceau::findOrFail($id)->update($request->all());

    return redirect()->route('index');
  }

  // SUPPRIMER
  public function supprimer($id)
  {
    Morceau::destroy($id);
    
    return redirect()->route('index');
  }
}