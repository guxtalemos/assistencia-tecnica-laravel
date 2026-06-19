@extends('layouts.main')

@section('title', 'Dashboard - Manutenções')

@section('content')

    <div class="col-md-10 offset-md-1 dashboard-title-container mt-4">
        <h1>Minhas Manutenções</h1>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-equipaments-container">

        @if (count($manutencoes) > 0)

            <table class="table mt-4">
                <thead>
                    <tr>
                        <th scope="col">Qtd</th>
                        <th scope="col">Técnico</th>
                        <th scope="col">Equipamento</th>
                        <th scope="col">Data de Entrada</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($manutencoes as $manutencao)
                        <tr>
                            <td scope="row">{{ $loop->index + 1 }}</td>
                            <td scope="row">{{ $manutencao->tecnico }}</td>
                            <td>

                                    {{ $manutencao->equipamento->marca ?? 'Marca' }} - {{ $manutencao->equipamento->tipo ?? 'Tipo' }}
                            </td>
                            <td scope="row">{{ \Carbon\Carbon::parse($manutencao->data_entrada)->format('d/m/Y') }}</td>
                            <td>
                                <a href="/manutencoes/edit/{{ $manutencao->id }}" class="btn btn-info btn-edit"> 
                                    <ion-icon name="create-outline"></ion-icon> Editar
                                </a>
                                <form action="/manutencoes/{{ $manutencao->id }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir esta manutenção?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn"> 
                                        <ion-icon name="trash-outline"></ion-icon> Deletar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="mt-4">Você ainda não tem manutenções cadastradas, <a href="/manutencoes/create">Cadastrar Manutenção </a></p>
        @endif

    </div>

@endsection