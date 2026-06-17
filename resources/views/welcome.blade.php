@extends('layouts.main')

@section('title', 'Assistência Técnica - Equipamentos')

@section('content')

<div id="search-container" class="col-md-12 text-center py-5 backend-search-bg">
    <h1 class="fw-bold mb-3">Controle de Ordens de Serviço</h1>
    <p class="text-muted mb-4">Busque por cliente, marca, tipo de equipamento ou status</p>
    <form action="/" method="GET" class="d-flex justify-content-center">
        <div class="input-group search-bar-box">
            <span class="input-group-text bg-white border-end-0 text-muted">
                O
            </span>
            <input type="text" id="search" name="search" class="form-control border-start-0 ps-0 shadow-none" placeholder="Procurar cliente ou aparelho...">
        </div>
    </form>
</div>

<div id="equipments-container" class="col-md-12 my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark m-0">Equipamentos em Manutenção</h2>
            <p class="subtitle text-muted m-0">Acompanhe o status e atualizações dos aparelhos na oficina</p>
        </div>
        @auth
        <a href="/equipaments/create" class="btn btn-primary px-4 fw-medium">Novo Registro</a>
        @endauth
    </div>

    <div id="cards-container" class="row g-4">
        @if(count($equipaments) == 0)
            <div class="col-12 text-center py-5">
                <p class="text-muted fs-5">Nenhum equipamento encontrado no sistema.</p>
            </div>
        @endif

        @foreach($equipaments as $equipament)
        <div class="col-12 col-md-6 col-lg-3 d-flex">
            <div class="card equipment-card shadow-sm border-0 w-100 d-flex flex-column">
                
                <div class="card-img-wrapper">
                    @if($equipament->imagem)
                        <img src="/img/equipaments/{{ $equipament->imagem }}" class="card-img-top" alt="{{ $equipament->tipo }}">
                    @else
                        <div class="img-placeholder d-flex align-items-center justify-content-center bg-light text-muted">
                            <span>Sem Foto</span>
                        </div>
                    @endif
                    
                    <span class="badge status-badge bg-dark">
                        {{ $equipament->status }}
                    </span>
                </div>

                <div class="card-body d-flex flex-column p-4">
                    <span class="text-primary text-uppercase fs-7 fw-bold mb-1">{{ $equipament->marca }} — {{ $equipament->tipo }}</span>
                    <h5 class="card-title fw-bold text-dark mb-2">{{ $equipament->cliente }}</h5>
                    
                    <p class="card-text text-muted flex-grow-1 fs-6">
                        <strong>Defeito:</strong> {{ Str::limit($equipament->defeito, 60) }}
                    </p>
                    
                    <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
                        <span class="text-muted fs-7">{{ $equipament->created_at ? $equipament->created_at->format('d/m/Y') : 'Sem data' }}</span>
                        <a href="/equipaments/{{ $equipament->id }}" class="btn btn-outline-primary btn-sm px-3 fw-medium">Gerenciar</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection