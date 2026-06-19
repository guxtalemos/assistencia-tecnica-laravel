<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Manutencao;
use App\Models\Equipament;
use App\Models\User;

class ManutencaoController extends Controller
{
    public function index()
    {
        $search = request('search');

        if ($search) {
            $manutencoes = Manutencao::with('equipamento')
                ->where('tecnico', 'like', '%' . $search . '%')
                ->orWhere('observacoes', 'like', '%' . $search . '%')
                ->get();    
        } else {
            $manutencoes = Manutencao::with('equipamento')->get();
        }

        return view('manutencoes.index', ['manutencoes' => $manutencoes, 'search' => $search]);
    }

    public function create()
    {
        $equipamentos = Equipament::all();
        $tecnicos = User::all(); 
        
        return view('manutencoes.create', ['equipamentos' => $equipamentos, 'tecnicos' => $tecnicos]);
    }

    public function store(Request $request)
    {
        $manutencao = new Manutencao();

        $manutencao->equipamento_id = $request->equipamento_id;
        $manutencao->tecnico = $request->tecnico;
        $manutencao->data_entrada = $request->data_entrada;
        $manutencao->observacoes = $request->observacoes;

        $manutencao->save();

        return redirect('/manutencoes')->with('msg', 'Manutenção registrada com sucesso!');
    }

    public function show($id)
    {
        $manutencao = Manutencao::with('equipamento')->findOrFail($id);

        return view('manutencoes.show', ['manutencao' => $manutencao]);
    }

    public function destroy($id)
    {
        Manutencao::findOrFail($id)->delete();

        return redirect('/manutencoes')->with('msg', 'Manutenção excluída com sucesso!');
    }

    public function edit($id)
    {
        $manutencao = Manutencao::findOrFail($id);
        
        // Buscamos equipamentos e técnicos novamente para popular os <select> na view de edição
        $equipamentos = Equipament::all();
        $tecnicos = User::all();

        return view('manutencoes.edit', ['manutencao' => $manutencao, 'equipamentos' => $equipamentos, 'tecnicos' => $tecnicos]);
    }

    public function update(Request $request)    
    {
        $data = $request->all();

        Manutencao::findOrFail($request->id)->update($data);

        return redirect('/manutencoes')->with('msg', 'Manutenção atualizada com sucesso!');
    }
}