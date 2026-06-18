<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Equipament;

class EquipamentController extends Controller
{
    public function index()
    {
        $search = request('search');

        if ($search) {
            $equipaments = Equipament::where([
                ('cliente', 'like', '%' . $search . '%')->orWhere('tipo', 'like', '%' . $search . '%')->orWhere('marca', 'like', '%' . $search . '%')->orWhere('status', 'like', '%' . $search . '%')
            ])->get();
        } else {
            $equipaments = Equipament::all();
        }

       return view('welcome', ['equipaments' => $equipaments, 'search' => $search]);
    }

    public function create()
    {
        return view('equipaments.create');
    }

    public function store(Request $request)
    {
        $equipament = new Equipament();

        $equipament->cliente = $request->cliente;
        $equipament->tipo = $request->tipo;
        $equipament->marca = $request->marca;
        $equipament->status = $request->status;
        $equipament->imagem = $request->imagem;
        $equipament->defeito = $request->defeito;

        // Upload da imagem
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requestImage = $request->imagem;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/equipaments'), $imageName);
            $equipament->imagem = $imageName;
        }

        $equipament->save();

        return redirect('/')->with('msg', 'Equipamento cadastrado com sucesso!');
    }

    public function show($id)
    {
        $equipament = Equipament::findOrFail($id);

        return view('equipaments.show', ['equipament' => $equipament]);
    }
}