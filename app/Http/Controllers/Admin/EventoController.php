<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    /**
     * Comprueba si el usuario logueado es admin
     */
    protected function authorizeAdmin()
    {
        if (!Auth::check() || Auth::user()->rol !== 'admin') {
            abort(403, 'Acceso no autorizado');
        }
    }

    /**
     * Lista todos los eventos ordenados por fecha de creación
     */
    public function index()
    {
        $this->authorizeAdmin();
        $eventos = Evento::orderBy('created_at', 'desc')->get();
        return view('admin.eventos.index', compact('eventos'));
    }

    /**
     * Muestra el formulario para crear un nuevo evento
     */
    public function create()
    {
        $this->authorizeAdmin();
        return view('admin.eventos.create');
    }

    /**
     * Almacena un nuevo evento
     */
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'tipo'        => 'nullable|string|max:100',
            'efecto'      => 'nullable|string|max:255',
        ]);

        Evento::create($data);

        return redirect()
            ->route('admin.eventos.index')
            ->with('success', 'Evento creado correctamente.');
    }

    /**
     * Muestra el formulario para editar un evento existente
     */
    public function edit($id)
    {
        $this->authorizeAdmin();

        $evento = Evento::findOrFail($id);
        return view('admin.eventos.edit', compact('evento'));
    }

    /**
     * Procesa la actualización de un evento
     */
    public function update(Request $request, $id)
    {
        $this->authorizeAdmin();

        $evento = Evento::findOrFail($id);

        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'tipo'        => 'nullable|string|max:100',
            'efecto'      => 'nullable|string|max:255',
        ]);

        $evento->update($data);

        return redirect()
            ->route('admin.eventos.index')
            ->with('success', 'Evento actualizado correctamente.');
    }

    /**
     * Elimina un evento
     */
    public function destroy($id)
    {
        $this->authorizeAdmin();

        $evento = Evento::findOrFail($id);
        $evento->delete();

        return redirect()
            ->route('admin.eventos.index')
            ->with('success', 'Evento eliminado correctamente.');
    }
}
