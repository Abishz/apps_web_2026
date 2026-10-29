@extends('layouts.app')

@section('title', 'Detalle del Producto')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white fw-bold">
                <i class="bi bi-info-circle"></i> Detalle del Producto
            </div>
            <div class="card-body">
                <h3 class="card-title text-primary">{{ $producto['nombre'] }}</h3>
                <hr>
                <p><strong>ID:</strong> {{ $producto['id'] }}</p>
                <p><strong>Precio:</strong> ${{ number_format($producto['precio'], 2) }}</p>
                <p><strong>Stock disponible:</strong> <span class="badge bg-success">{{ $producto['stock'] }} unidades</span></p>
                <p><strong>Descripción:</strong> {{ $producto['descripcion'] ?? 'Sin descripción disponible.' }}</p>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('productos.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Volver a la Lista
                </a>
                <a href="{{ route('productos.edit', $producto['id']) }}" class="btn btn-warning text-white">
                    <i class="bi bi-pencil"></i> Editar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection