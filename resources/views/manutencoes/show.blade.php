@extends('layouts.main')

@section('title', 'Detalhes da Manutenção #' . $manutencao->id)

@section('content')

    <div class="col-md-10 offset-md-1 my-5" id="manutencao-show-container">
        <div class="row g-5">

            <div id="image-container" class="col-lg-6">
                @if ($manutencao->equipamento && $manutencao->equipamento->imagem)
                    <img src="/img/equipaments/{{ $manutencao->equipamento->imagem }}"
                        class="img-fluid rounded-3 shadow-sm equipment-detail-img" alt="{{ $manutencao->equipamento->tipo }}">
                @else
                    <div
                        class="detail-img-placeholder d-flex align-items-center justify-content-center bg-light text-muted rounded-3 shadow-sm">
                        <span class="fw-bold">Equipamento Sem Foto</span>
                    </div>
                @endif
            </div>

            <div id="info-container" class="col-lg-6 d-flex flex-column justify-content-between">
                <div>
                    <span class="badge text-uppercase mb-2 px-3 py-2 dynamic-status-badge">
                        {{ $manutencao->equipamento->status ?? 'Status Indefinido' }}
                    </span>
                    <h1 class="fw-bold text-dark mb-1">Manutenção OS #{{ $manutencao->id }}</h1>
                    <p class="text-primary fw-medium fs-5 mb-4">Técnico Responsável: {{ $manutencao->tecnico }}</p>

                    <hr class="my-4">

                    <div class="technical-info-box p-3 bg-light rounded-3 mb-4">
                        <p class="mb-2"><strong><i class="bi bi-calendar3"></i> Data de Entrada:</strong>
                            {{ \Carbon\Carbon::parse($manutencao->data_entrada)->format('d/m/Y') }}</p>
                        <p class="mb-0"><strong><i class="bi bi-person"></i> Cliente:</strong>
                            {{ $manutencao->equipamento->cliente ?? 'Não informado' }}</p>
                    </div>
                </div>

                <div class="action-buttons-wrapper d-flex gap-2">
                    @auth
                        <a href="/manutencoes/edit/{{ $manutencao->id }}"
                            class="btn btn-primary px-4 py-2 flex-grow-1 fw-medium">Editar Manutenção</a>
                        <form action="/manutencoes/{{ $manutencao->id }}" method="POST" class="flex-grow-1"
                            onsubmit="return confirm('Tem certeza que deseja excluir este registro de manutenção?')">
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
                            <h3 class="fw-bold text-dark mb-3">Observações Técnicas:</h3>
                            <p
                                class="text-muted leading-relaxed p-3 bg-light rounded-2 border-start border-4 border-primary">
                                {{ $manutencao->observacoes ?: 'Nenhuma observação técnica foi registrada para este apontamento.' }}
                            </p>
                        </div>

                        <hr class="my-5">

                        <div id="equipamento-info-container">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="fw-bold text-dark m-0">Dados do Equipamento Relacionado:</h3>
                                <a href="/equipaments/{{ $manutencao->equipamento_id }}"
                                    class="btn btn-sm btn-outline-dark px-3">Ver Equipamento Completo</a>
                            </div>

                            @if ($manutencao->equipamento)
                                <div class="table-responsive">
                                    <table class="table custom-table align-middle">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Marca / Tipo:</th>
                                                <th>Defeito Relatado Pelo Cliente:</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="fw-semibold text-dark">{{ $manutencao->equipamento->marca }} —
                                                    {{ $manutencao->equipamento->tipo }}</td>
                                                <td class="text-muted">{{ $manutencao->equipamento->defeito }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4 bg-light rounded-3">
                                    <p class="text-muted m-0">Informações do equipamento não
