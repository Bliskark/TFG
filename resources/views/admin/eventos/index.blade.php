@extends('layouts.app')

@section('title', 'Eventos')

@section('content')
    <div class="container">
        <h1 class="mb-4">Lista de Eventos</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.eventos.create') }}" class="btn btn-primary mb-3">Crear nuevo evento</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Efecto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($eventos as $evento)
                    <tr>
                        <td>{{ $evento->name }}</td>
                        <td>{{ $evento->tipo }}</td>
                        <td>{{ $evento->description }}</td>
                        <td>{{ $evento->efecto }}</td>
                        <td>
                            <a href="{{ route('admin.eventos.edit', $evento->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('admin.eventos.destroy', $evento->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este evento?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No hay eventos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
