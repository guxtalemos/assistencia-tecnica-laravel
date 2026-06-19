@extends('layouts.main')

@section('title', 'Editando Manutenção')

@section('content')

    <div id="manutencao-create-container" class="col-md-8 offset-md-2 my-5">
        <div class="card shadow border-0 rounded-3">
            <div class="card-header bg-dark text-white p-4">
                <h1 class="fs-3 fw-bold mb-0">Editando Manutenção:
                    {{ $manutencao->equipamento->tipo . ' - ' . $manutencao->equipamento->marca }}</h1>
            </div>

            <div class="card-body p-4 p-md-5 bg-white">
                <form action="/manutencoes/update/{{ $manutencao->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-4">
                        <div class="form-group col-md-12">
                            <label for="equipamento_id" class="form-label fw-semibold text-secondary">Equipamento:</label>
                            <select name="equipamento_id" id="equipamento_id" class="form-select form-control-lg border-2 shadow-none" required>
                                <option value="">Selecione o Equipamento</option>
                                @foreach($equipamentos as $eq)
                                    <option value="{{ $eq->id }}" @selected($manutencao->equipamento_id == $eq->id)>
                                        {{ $eq->marca }} - {{ $eq->tipo }} (Cliente: {{ $eq->cliente }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="tecnico" class="form-label fw-semibold text-secondary">Técnico Responsável:</label>
                            <select name="tecnico" id="tecnico" class="form-select border-2 shadow-none" required>
                                <option value="">Selecione o Técnico</option>
                                @foreach($tecnicos as $tecnico)
                                    <option value="{{ $tecnico->name }}" @selected($manutencao->tecnico == $tecnico->name)>
                                        {{ $tecnico->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="data_entrada" class="form-label fw-semibold text-secondary">Data de Entrada:</label>
                            <input type="date" class="form-control border-2 shadow-none" id="data_entrada" name="data_entrada"
                                required value="{{ $manutencao->data_entrada }}">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="observacoes" class="form-label fw-semibold text-secondary">Observações:</label>
                            <textarea name="observacoes" id="observacoes" rows="4" class="form-control border-2 shadow-none"
                                placeholder="Descreva os serviços realizados, peças trocadas, etc...">{{ $manutencao->observacoes }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
                        <a href="/manutencoes" class="btn btn-light px-4 border-2">Cancelar</a>
                        <button type="submit" class="btn btn-primary px-5 fw-medium">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection