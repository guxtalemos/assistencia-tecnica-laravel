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
            $equipaments = Equipament::where('cliente', 'like', '%' . $search . '%')
            ->orWhere('tipo', 'like', '%' . $search . '%')
            ->orWhere('marca', 'like', '%' . $search . '%')
            ->orWhere('status', 'like', '%' . $search . '%')
            ->get();    
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
        $equipament->defeito = $request->defeito;

        // Upload da imagem
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requestImage = $request->imagem;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/equipaments'), $imageName);
            $equipament->imagem = $imageName;
        }

        $user = auth()->user();
        $equipament->user_id = $user->id;

        $equipament->save();

        return redirect('/')->with('msg', 'Equipamento cadastrado com sucesso!');
    }

    public function show($id)
    {
        $equipament = Equipament::findOrFail($id);

        return view('equipaments.show', ['equipament' => $equipament]);
    }

    public function dashboard()
    {
        $user = auth()->user();

        $equipaments = $user->equipaments;

        return view('equipaments.dashboard', ['equipaments' => $equipaments]);
    }

    public function destroy($id)
    {
        Equipament::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Equipamento excluído com sucesso!');
    }

    public function edit($id)
    {
        $equipament = Equipament::findOrFail($id);

        return view('equipaments.edit', ['equipament' => $equipament]);
    }

    public function update(Request $request)

    {
        Equipament::findOrFail($request->id)->update($request->all());

        return redirect('/')->with('msg', 'Equipamento atualizado com sucesso!');
    }

}