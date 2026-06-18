@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Meus Equipamentos</h1>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-equipaments-container">

        @if (count($equipaments) > 0)

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Qtd</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Equipamento</th>
                        <th scope="col">Defeito</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($equipaments as $equipament)
                        <tr>
                            <td scope="row">{{ $loop->index + 1 }}</td>
                            <td scope="row">{{ $equipament->cliente }}</a></td>
                            <td><a href="/equipaments/{{ $equipament->id }}">{{ $equipament->tipo }}</a></td>
                            <td scope="row">{{ $equipament->defeito }}</a></td>
                            <td>
                                <a href="/equipaments/edit/{{ $equipament->id }}" class="btn btn-info btn-edit"> <ion-icon
                                        name="create-outline"></ion-icon> Editar</a>
                                <form action="/equipaments/{{ $equipament->id }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este equipamento?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn"> <ion-icon
                                            name="trash-outline"></ion-icon> Deletar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Você ainda não tem equipamentos, <a href="/equipaments/create">Cadastrar Equipamento </a></p>
        @endif

    </div>

@endsection
