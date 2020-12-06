<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class BaralhoController extends Controller
{
    public function index()
    {
        $cards = Card::all();

        return response()->json([
            "cards" => $cards
        ]);
    }

    public function store(Request $request)
    {
        if($request->image){
            $name = $request->name;
            $extension = $request->image->extension();

            $fileName = "$name.$extension";
            $request->image->storeAs('cards', $fileName);

            $Card = Card::create([
                "name" => $request->input("name"),
                "valor" => $request->input("valor"),
                'image' => $fileName
            ]);

            $Card->save();
            return redirect()->back()->with('message','Nova carta Criada!');
        }

        else{
            return redirect()->back()->withErrors('Defina uma imagem para a carta!!');
        }

    }

    public function update(Request $request, $id)
    {
        $thecard = Card::find($id);

        $name = $request->name;
        $extension = $request->image->extension();

        $fileName = "$name.$extension";
        $request->image->storeAs('cards', $fileName);

        $thecard->name = $request->name;
        $thecard->valor = $request->valor;
        $thecard->image = $fileName;


        $thecard->save();
        return redirect()->back()->with('message','Carta atualizada');
    }

    public function destroy($id)
    {

        $thecard = Card::find($id);
        $thecard->delete();

        return redirect()->back()->with('message','Carta deletada');
    }
}
