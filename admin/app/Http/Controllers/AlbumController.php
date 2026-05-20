<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\Album;
use Illuminate\Http\Request;


class AlbumController extends Controller
{
  // AJOUTER
  public function creer(){ 
    return view('album.creer'); 
  }
  public function enregistrerCreation(Request $request){
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

  // MODIFIER
  public function modifier($id){
    return view('album.modifier', 
      [
        'album' => Album::findOrFail($id)
      ]
    );
  }
  public function enregistrerModifications(Request $request, $id){
    // Album::findOrFail($id)->update($request->all());

    Album::findOrFail($id)->update([
      'nom' => $request->nom,
      'artiste' => $request->artiste,
      'type' => $request->type
    ]);

    return redirect()->route('index');
  }

  // SUPPRIMER
  public function supprimer($id)
  {
    Album::destroy($id);

    return redirect()->route('index');
  }

}