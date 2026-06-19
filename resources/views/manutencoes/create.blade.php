@extends('layouts.main')

@section('title', 'Cadastrar Manutenção - Assistência Técnica')

@section('content')

    <div id="equipment-create-container" class="col-md-8 offset-md-2 my-5">
        <div class="card shadow border-0 rounded-3">
            <div class="card-header bg-dark text-white p-4">
                <h1 class="fs-3 fw-bold mb-0">Cadastrar Nova Manutenção</h1>
                <p class="text-white-50 small mb-0">Insira os dados iniciais obtidos no balcão de atendimento para registro.
                </p>
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
                                    <option value="{{ $eq->id }}"> {{ $eq->tipo }} - {{ $eq->marca }}
                                        (Cliente: {{ $eq->cliente }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="data_entrada" class="form-label fw-semibold text-secondary">Data de Entrada:</label>
                            <input type="date" class="form-control border-2 shadow-none" id="data_entrada"
                                name="data_entrada" placeholder="Ex: Samsung, Lenovo, Sony" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="observacoes" class="form-label fw-semibold text-secondary">Observações:</label>
                            <textarea name="observacoes" id="observacoes" rows="4" class="form-control border-2 shadow-none"
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
