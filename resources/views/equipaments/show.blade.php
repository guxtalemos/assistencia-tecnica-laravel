@extends('layouts.main')

@section('title', 'Detalhes do Equipamento - ' . $equipament->cliente)

@section('content')

<div class="col-md-10 offset-md-1 my-5" id="equipment-show-container">
    <div class="row g-5">
        
        <div id="image-container" class="col-lg-6">
            @if($equipament->imagem)
                <img src="/img/equipaments/{{ $equipament->imagem }}" class="img-fluid rounded-3 shadow-sm equipment-detail-img" alt="{{ $equipament->tipo }}">
            @else
                <div class="detail-img-placeholder d-flex align-items-center justify-content-center bg-light text-muted rounded-3 shadow-sm">
                    <span class="fw-bold">Sem Foto Cadastrada</span>
                </div>
            @endif
        </div>
        
        <div id="info-container" class="col-lg-6 d-flex flex-column justify-content-between">
            <div>
                <span class="badge text-uppercase mb-2 px-3 py-2 dynamic-status-badge">
                    {{ $equipament->status }}
                </span>
                <h1 class="fw-bold text-dark mb-1">{{ $equipament->cliente }}</h1>
                <p class="text-primary fw-medium fs-5 mb-4">{{ $equipament->marca }} — {{ $equipament->tipo }}</p>
                
                <hr class="my-4">

                <div class="technical-info-box p-3 bg-light rounded-3 mb-4">
                    <p class="mb-2"><strong><i class="bi bi-calendar3"></i> Entrada no Sistema:</strong> {{ $equipament->created_at ? $equipament->created_at->format('d/m/Y H:i') : 'Não informada' }}</p>
                    <p class="mb-0"><strong><i class="bi bi-hash"></i> Ordem de Serviço OS:</strong> #{{ $equipament->id }}</p>
                </div>
            </div>

            <div class="action-buttons-wrapper d-flex gap-2">
                @auth
                    <a href="/equipaments/edit/{{ $equipament->id }}" class="btn btn-primary px-4 py-2 flex-grow-1 fw-medium">Editar Informações</a>
                    <form action="/equipaments/{{ $equipament->id }}" method="POST" class="flex-grow-1" onsubmit="return confirm('Tem certeza que deseja excluir esta O.S.?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100 py-2 fw-medium">Excluir Registro</button>
                    </form>
                @endauth
                @guest
                    <a href="/login" class="btn btn-secondary px-4 py-2 w-100 fw-medium">Entre para Alterar ou Excluir</a>
                @endguest
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4 p-md-5">
                    
                    <div id="description-container" class="mb-5">
                        <h3 class="fw-bold text-dark mb-3">Defeito Relatado:</h3>
                        <p class="text-muted leading-relaxed p-3 bg-light rounded-2 border-start border-4 border-primary">
                            {{ $equipament->defeito }}
                        </p>
                    </div>

                    <hr class="my-5">

                    <div id="manutencoes-container">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="fw-bold text-dark m-0">Histórico Técnico de Manutenções:</h3>
                            @auth
                                <a href="/manutencoes/create?equipament_id={{ $equipament->id }}" class="btn btn-sm btn-dark px-3">Adicionar Apontamento</a>
                            @endauth
                        </div>

                        @if($equipament->manutencoes && $equipament->manutencoes->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover custom-table align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Técnico Responsável:</th>
                                            <th>Data da Entrada:</th>
                                            <th>Observações Técnicas:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($equipament->manutencoes as $manutencao)
                                        <tr>
                                            <td class="fw-semibold text-dark">{{ $manutencao->tecnico }}</td>
                                            <td>{{ \Carbon\Carbon::parse($manutencao->data_entrada)->format('d/m/Y') }}</td>
                                            <td class="text-muted">{{ $manutencao->observacoes ?? 'Nenhuma observação adicionada.' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4 bg-light rounded-3">
                                <p class="text-muted m-0">Nenhuma manutenção ou intervenção técnica foi registrada para este aparelho ainda.</p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection