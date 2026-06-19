@extends('layouts.main')

@section('title', 'Cadastrar Manutenção - Assistência Técnica')

@section('content')

    <div id="equipment-create-container" class="col-md-8 offset-md-2 my-5">
        <div class="card shadow border-0 rounded-3">
            <div class="card-header bg-dark text-white p-4">
                <h1 class="fs-3 fw-bold mb-0">Cadastrar Nova Manutenção</h1>
                <p class="text-white-50 small mb-0">Insira os dados iniciais obtidos no balcão de atendimento para gerar a
                    Ordem de Serviço.</p>
            </div>

            <div class="card-body p-4 p-md-5 bg-white">
                <form action="/manutencoes" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4">

                        <div class="form-group col-md-6">
                            <label for="equipamento_id" class="form-label fw-semibold text-secondary">Equipamento:</label>
                            <select name="equipamento_id" id="equipamento_id" class="form-select border-2 shadow-none"
                                required>
                                <option value="">Selecione o Equipamento</option>
                                @foreach ($equipamentos as $eq)
                                    <option value="{{ $eq->id }}">{{ $eq->marca }} - {{ $eq->tipo }}
                                        (Cliente:{{ $eq->cliente }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="tecnico" class="form-label fw-semibold text-secondary">Técnico Responsável:</label>
                            <select name="tecnico" id="tecnico" class="form-select border-2 shadow-none" required>
                                <option value="">Selecione o Técnico</option>
                                @foreach ($tecnicos as $tecnico)
                                    <option value="{{ $tecnico->name }}">{{ $tecnico->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="marca" class="form-label fw-semibold text-secondary">Marca / Fabricante:</label>
                            <input type="text" class="form-control border-2 shadow-none" id="marca" name="marca"
                                placeholder="Ex: Samsung, Lenovo, Sony" required>
                        </div>



                        <div class="form-group col-md-6">
                            <label for="imagem" class="form-label fw-semibold text-secondary">Foto do Aparelho (Estado de
                                entrada):</label>
                            <input type="file" class="form-control border-2 shadow-none" id="imagem" name="imagem">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="defeito" class="form-label fw-semibold text-secondary">Defeito Relatado:</label>
                            <textarea name="defeito" id="defeito" rows="4" class="form-control border-2 shadow-none"
                                placeholder="Descreva detalhadamente o problema informado pelo cliente..." required></textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
                        <a href="/" class="btn btn-light px-4 border-2">Cancelar</a>
                        <button type="submit" class="btn btn-primary px-5 fw-medium">Registrar Entrada</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
