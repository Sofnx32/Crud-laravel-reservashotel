<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Cliente;


class ReservasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservas = Reserva::with('cliente')->latest()->get();
        return view('reservas.index', compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        return view('reservas.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'habitacion'     => 'required|string|max:50',
            'precio'         => 'required|numeric|min:0',
            'tipo'           => 'required|string|max:50',
            'fecha_entrada'  => 'required|date|before_or_equal:fecha_salida',
            'fecha_salida'   => 'required|date|after_or_equal:fecha_entrada',
            'estado'         => 'required|in:pendiente,confirmada,cancelada,completada',
            'cliente_id'     => 'required|exists:clientes,id',
        ]);

        Reserva::create($request->only([
            'habitacion', 'precio', 'disponible', 'tipo',
            'fecha_entrada', 'fecha_salida', 'estado', 'cliente_id'
        ]) + ['disponible' => $request->has('disponible')]);

        return redirect()->route('reservas.index')->with('success', 'Reserva creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        return view('reservas.show', compact('reserva'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserva $reserva)
    {
        $clientes = Cliente::all();
        return view('reservas.edit', compact('reserva', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserva $reserva)
    {
        $request->validate([
            'habitacion'     => 'required|string|max:50',
            'precio'         => 'required|numeric|min:0',
            'tipo'           => 'required|string|max:50',
            'fecha_entrada'  => 'required|date|before_or_equal:fecha_salida',
            'fecha_salida'   => 'required|date|after_or_equal:fecha_entrada',
            'estado'         => 'required|in:pendiente,confirmada,cancelada,completada',
            'cliente_id'     => 'required|exists:clientes,id',
        ]);

        $reserva->update($request->only([
            'habitacion', 'precio', 'tipo',
            'fecha_entrada', 'fecha_salida', 'estado', 'cliente_id'
        ]) + ['disponible' => $request->has('disponible')]);

        return redirect()->route('reservas.index')->with('success', 'Reserva actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        $reserva->delete();
        return redirect()->route('reservas.index')->with('success', 'Reserva eliminada.');
    }
}
