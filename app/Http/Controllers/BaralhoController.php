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

        $exploded = explode(',', $request->image);

        $decoded = base64_decode($exploded[1]);

        if(str_contains($exploded[0],'jpeg'))
            $extension = 'jpg';
        else
            $extension = 'png';

        $name = $request->input("name");
        $fileName = $name.'.'.$extension;

        $path = public_path().'/'.$fileName;

        file_put_contents($path, $decoded);

        $Card = Card::create([
            "name" => $request->input("name"),
            "valor" => $request->input("valor"),
            'image' => $fileName
        ]);

        $Card->save();
        return redirect()->back()->withSuccess('Nova carta Criada!');

    }

    public function update(Request $request, $id)
    {
        $thecard = Card::find($id);

        $exploded = explode(',', $request->image);
        $decoded = base64_decode($request->image);

        if(str_contains($exploded[0],'jpeg'))
            $extension = 'jpg';
        else
            $extension = 'png';

        $name = $thecard->name;
        $fileName = $name.'.'.$extension;
        $path = public_path().'/'.$fileName;
        file_put_contents($path, $decoded);

        $thecard->name = $request->name;
        $thecard->valor = $request->valor;
        $thecard->image = $fileName;


        $thecard->save();
        return redirect()->back()->with('message','Carta atualizada');
    }

    public function destroy($id)
    {
        //
    }
}
