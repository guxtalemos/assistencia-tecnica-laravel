@extends('layouts.main')

@section('title', 'Assistência Técnica - Equipamentos')

@section('content')

    <div id="search-container" class="col-md-12 text-center py-5 backend-search-bg">
        <h1 class="fw-bold mb-3">Controle de Ordens de Serviço</h1>
        <p class="text-muted mb-4">Busque por cliente, marca, tipo de equipamento ou status</p>
        <form action="/" method="GET" class="d-flex justify-content-center">
            <div class="input-group search-bar-box">
                <span class="input-group-text bg-white border-end-0 text-muted">
                    <ion-icon name="search-outline"></ion-icon>
                </span>
                <input type="text" id="search" name="search" class="form-control border-start-0 ps-0 shadow-none"
                    placeholder="Procurar cliente ou aparelho...">
            </div>
        </form>
    </div>

    <div id="equipments-container" class="col-md-12 my-5">
        @if ($search)
            <div class="mb-4">
                <h2 class="fw-bold text-dark m-0">Resultados da busca por: <span
                        class="fw-bold text-dark">{{ $search }}</span></h2>
            </div>
        @else
            <div>
                <p class="subtitle text-muted m-0">Acompanhe o status e atualizações dos aparelhos na oficina</p>
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center mb-4">

        </div>

        <div id="cards-container" class="row g-4">

            @foreach ($equipaments as $equipament)
                <div class="col-12 col-md-6 col-lg-3 d-flex">
                    <div class="card equipment-card shadow-sm border-0 w-100 d-flex flex-column">

                        <div class="card-img-wrapper">
                            @if ($equipament->imagem)
                                <img src="/img/equipaments/{{ $equipament->imagem }}" class="card-img-top"
                                    alt="{{ $equipament->tipo }}">
                            @else
                                <div
                                    class="img-placeholder d-flex align-items-center justify-content-center bg-light text-muted">
                                    <span>Sem Foto</span>
                                </div>
                            @endif

                            <span class="badge status-badge bg-dark">
                                {{ $equipament->status }}
                            </span>
                        </div>

                        <div class="card-body d-flex flex-column p-4">
                            <span class="text-primary text-uppercase fs-7 fw-bold mb-1">{{ $equipament->marca }} —
                                {{ $equipament->tipo }}</span>
                            <h5 class="card-title fw-bold text-dark mb-2">{{ $equipament->cliente }}</h5>

                            <p class="card-text text-muted flex-grow-1 fs-6">
                                <strong>Defeito:</strong> {{ $equipament->defeito }}
                            </p>

                            <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
                                <span
                                    class="text-muted fs-7">{{ $equipament->created_at ? $equipament->created_at->format('d/m/Y') : 'Sem data' }}</span>
                                <a href="/equipaments/{{ $equipament->id }}"
                                    class="btn btn-outline-primary btn-sm px-3 fw-medium">Gerenciar</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @if (count($equipaments) == 0 && $search)
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5">
                        Não encontrei nenhum resultado com a palavra "{{ $search }}"!
                        <a href="/" class="text-primary fw-bold">Ver todos</a>
                    </p>
                </div>
            @elseif (count($equipaments) == 0)
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5">Não há equipamentos cadastrados no momento.</p>
                </div>
            @endif
        </div>
    </div>

@endsection
