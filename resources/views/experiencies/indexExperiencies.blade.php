@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Usuari</th>
                    <th scope="col">Joc</th>
                    <th scope="col">Puntacio</th>
                    <th scope="col">Comentari</th>
                    <th scope="col" colspan="2" class="text-center">Accion</th>
                </tr>
                </thead>
                <tbody>
                @foreach($experiencies as $e)
                <tr>
                    <th scope="row">{{ $e->id }}</th>
                    <th scope="row">{{ $e->user }}</th>
                    <th scope="row">{{ $e->joc }}</th>
                    <th scope="row">{{ $e->puntuacio }}</th>
                    <th scope="row">{{ $e->comentari }}</th>
                    <td>
                        <a href="/experiencies/{{$e->id}}/editar"
                           class="btn btn-info btn-sm my-3">
                            Editar
                        </a>
                        <a href="/experiencies/{{$e->id}}/eliminar"
                           class="btn btn-danger btn-sm my-3">
                            Eliminar
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
