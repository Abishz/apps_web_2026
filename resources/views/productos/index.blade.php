@extends('layouts.app')

@section('title', 'Lista de Productos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-list-task"></i> Gestión de Productos</h2>
    <a href="{{ route('productos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nuevo Producto
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($productos as $item)
                    <tr>
                        <td>{{ $item['id'] }}</td>
                        <td class="fw-bold">{{ $item['nombre'] }}</td>
                        <td>${{ number_format($item['precio'], 2) }}</td>
                        <td><span class="badge bg-secondary">{{ $item['stock'] }} uds</span></td>
                        <td class="text-center">
                            <a href="{{ route('productos.show', $item['id']) }}" class="btn btn-sm btn-info text-white me-1">
                                <i class="bi bi-eye"></i> Ver
                            </a>
                            <a href="{{ route('productos.edit', $item['id']) }}" class="btn btn-sm btn-warning text-white me-1">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            <form action="{{ route('productos.destroy', $item['id']) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar producto?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No hay productos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection