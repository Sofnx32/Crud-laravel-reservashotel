<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::latest()->get();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|string|max:100',
            'apellido'  => 'required|string|max:100',
            'email'     => 'nullable|email|max:100|unique:clientes',
            'telefono'  => 'required|string|max:100',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // 2MB máx.
        ]);

        $data = $request->only(['nombre', 'apellido', 'email', 'telefono']);

        // Subir imagen si se proporciona
        if ($request->hasFile('foto')) {
            // Guarda en: storage/app/public/clientes/nombre_aleatorio.jpg
            $ruta = $request->file('foto')->store('clientes', 'public');
            $data['foto'] = $ruta;
        }

        Cliente::create($data);

        return redirect()->route('clientes.index')->with('success', 'Cliente registrado con éxito.');
    }

    public function show(Cliente $cliente)
    {
        $reservas = $cliente->reservas()->with('cliente')->get();
        return view('clientes.show', compact('cliente', 'reservas'));
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre'    => 'required|string|max:100',
            'apellido'  => 'required|string|max:100',
            'email'     => 'nullable|email|max:100|unique:clientes,email,' . $cliente->id,
            'telefono'  => 'required|string|max:100',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->only(['nombre', 'apellido', 'email', 'telefono']);

        // Si se sube una nueva foto
        if ($request->hasFile('foto')) {
            // Eliminar la foto anterior (si existe)
            if ($cliente->foto) {
                Storage::disk('public')->delete($cliente->foto);
            }
            // Guardar la nueva
            $ruta = $request->file('foto')->store('clientes', 'public');
            $data['foto'] = $ruta;
        }

        $cliente->update($data);

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado con éxito.');
    }

    public function destroy(Cliente $cliente)
    {
        // Eliminar la foto del cliente si existe
        if ($cliente->foto) {
            Storage::disk('public')->delete($cliente->foto);
        }

        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado.');
    }
}