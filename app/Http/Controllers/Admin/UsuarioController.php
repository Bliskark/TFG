<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Equipo;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
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
     * Lista todos los usuarios excepto los admin, y muestra eventos
     */
    public function index()
    {
        $this->authorizeAdmin();

        $usuarios = Usuario::where('rol', '!=', 'admin')->get();
        $eventos  = Evento::orderBy('created_at', 'desc')->get();

        return view('admin.usuarios.index', compact('usuarios', 'eventos'));
    }

    /**
     * Muestra el formulario de creación de usuario
     */
    public function create()
    {
        $this->authorizeAdmin();
        return view('admin.usuarios.create');
    }

    /**
     * Almacena un nuevo usuario
     */
 public function store(Request $request)
{
    $this->authorizeAdmin();

    $data = $request->validate([
        'email'                 => 'required|email|unique:usuarios,email',
        'password'              => 'required|string|min:6|confirmed',
        'rol'                   => 'required|in:admin,lider,alto_mando,campeon,user',
        'victories'             => 'required|integer|min:0',
        'defeats'               => 'required|integer|min:0',
        'streak'                => 'required|integer|min:0',
    ]);

    // Hashear la contraseña
    $data['password'] = bcrypt($data['password']);

    Usuario::create($data);

    return redirect()->route('admin.usuarios.index')
                     ->with('success', 'Usuario creado correctamente.');
}

    /**
     * Muestra el formulario de edición de usuario
     */
    public function edit($id)
    {
        $this->authorizeAdmin();

        $usuario = Usuario::findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    /**
     * Actualiza un usuario
     */
    public function update(Request $request, $id)
    {
        $this->authorizeAdmin();

        $usuario = Usuario::findOrFail($id);

        $data = $request->validate([
            'email'                 => "required|email|unique:usuarios,email,{$id}",
            'rol'                   => 'required|in:admin,lider,alto_mando,campeon,user',
            'password'              => 'nullable|string|min:8|confirmed',
            'victories'             => 'required|integer|min:0',
            'defeats'               => 'required|integer|min:0',
            'streak'                => 'required|integer|min:0',
        ]);

        // Si envían nueva contraseña, háshala
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $usuario->update($data);

        return redirect()->route('admin.usuarios.index')
                         ->with('success', 'Usuario actualizado.');
    }

    /**
     * Muestra el equipo del usuario
     */
    public function equipo($id)
    {
        $this->authorizeAdmin();

        $usuario = Usuario::findOrFail($id);
        $equipo  = $usuario->equipo;

        $pokemons = collect(
            Http::get('https://pokeapi.co/api/v2/pokemon?limit=1010')->json()['results']
        )->map(fn($p) => [
            'name' => $p['name'],
            'id'   => (int) last(explode('/', rtrim($p['url'], '/')))
        ])->toArray();

        return view('admin.usuarios.equipo', compact('usuario', 'equipo', 'pokemons'));
    }

    /**
     * Muestra el formulario para editar el equipo del usuario
     */
    public function editEquipo($id)
    {
        $this->authorizeAdmin();

        $usuario = Usuario::findOrFail($id);
        $equipo  = $usuario->equipo;

        $pokemons = collect(
            Http::get('https://pokeapi.co/api/v2/pokemon?limit=1010')
                ->json()['results']
        )->map(fn($p) => [
            'name' => $p['name'],
            'id'   => (int) last(explode('/', rtrim($p['url'], '/')))
        ])->toArray();

        return view('admin.usuarios.equipo_edit', compact('usuario', 'equipo', 'pokemons'));
    }

    /**
     * Procesa la actualización del equipo del usuario
     */
    public function updateEquipo(Request $request, $id)
    {
        $this->authorizeAdmin();

        $usuario = Usuario::findOrFail($id);
        $data = ['usuario_id' => $usuario->id];

        for ($i = 1; $i <= 6; $i++) {
            $pokeName = $request->input("pokemon{$i}_name");

            if ($pokeName) {
                try {
                    $poke = Http::get("https://pokeapi.co/api/v2/pokemon/{$pokeName}")->json();
                    $baseHP = collect($poke['stats'])->firstWhere('stat.name', 'hp')['base_stat'];
                    $level  = (int) $request->input("level{$i}");
                    $hp     = floor(((2 * $baseHP * $level) / 100) + $level + 10);

                    $data["pokemon{$i}_id"] = $poke['id'];
                    $data["level{$i}"]      = $level;
                    $data["hp{$i}"]         = $hp;
                } catch (\Exception $e) {
                    continue;
                }
            } else {
                // Si no se seleccionó Pokémon, vacía el slot
                $data["pokemon{$i}_id"] = null;
                $data["level{$i}"]      = null;
                $data["hp{$i}"]         = null;
            }
        }

        Equipo::updateOrCreate(['usuario_id' => $usuario->id], $data);

        return redirect()->route('admin.usuarios.equipo', $usuario->id)
                         ->with('success', 'Equipo actualizado correctamente.');
    }
    public function destroy($id)
{
    $this->authorizeAdmin();

    $usuario = Usuario::findOrFail($id);
    $usuario->delete();

    return redirect()->route('admin.usuarios.index')
                     ->with('success', 'Usuario eliminado correctamente.');
}
}
