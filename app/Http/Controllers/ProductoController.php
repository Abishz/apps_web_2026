<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Datos simulados en sesión o memoria para la prueba
    private function getProductos()
    {
        return session('productos', [
            1 => ['id' => 1, 'nombre' => 'Laptop Dell', 'precio' => 12500.00, 'stock' => 10, 'descripcion' => 'Equipo de alto rendimiento'],
            2 => ['id' => 2, 'nombre' => 'Mouse Inalámbrico', 'precio' => 350.50, 'stock' => 25, 'descripcion' => 'Mouse ergonómico USB'],
            3 => ['id' => 3, 'nombre' => 'Teclado Mecánico', 'precio' => 890.00, 'stock' => 15, 'descripcion' => 'Teclado RGB switch azul']
        ]);
    }

    public function index()
    {
        $productos = $this->getProductos();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $productos = $this->getProductos();
        $nuevoId = count($productos) > 0 ? max(array_keys($productos)) + 1 : 1;

        $productos[$nuevoId] = [
            'id' => $nuevoId,
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'descripcion' => $request->descripcion,
        ];

        session(['productos' => $productos]);

        return redirect()->route('productos.index')->with('ok', 'Producto creado exitosamente.');
    }

    public function show($id)
    {
        $productos = $this->getProductos();
        $producto = $productos[$id] ?? null;

        if (!$producto) {
            return redirect()->route('productos.index')->with('error', 'Producto no encontrado');
        }

        return view('productos.show', compact('producto'));
    }

    public function edit($id)
    {
        $productos = $this->getProductos();
        $producto = $productos[$id] ?? null;

        if (!$producto) {
            return redirect()->route('productos.index');
        }

        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $productos = $this->getProductos();

        if (isset($productos[$id])) {
            $productos[$id] = [
                'id' => (int)$id,
                'nombre' => $request->nombre,
                'precio' => $request->precio,
                'stock' => $request->stock,
                'descripcion' => $request->descripcion,
            ];
            session(['productos' => $productos]);
        }

        return redirect()->route('productos.index')->with('ok', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $productos = $this->getProductos();
        unset($productos[$id]);
        session(['productos' => $productos]);

        return redirect()->route('productos.index')->with('ok', 'Producto eliminado.');
    }
}