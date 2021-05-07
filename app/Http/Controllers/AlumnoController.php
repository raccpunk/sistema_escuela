<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {
            $alumno = Alumno::where('foto:', 'LIKE', "%$keyword%")
                ->orWhere('apellido_paterno', 'LIKE', "%$keyword%")
                ->orWhere('apellido_materno', 'LIKE', "%$keyword%")
                ->orWhere('edad', 'LIKE', "%$keyword%")
                ->orWhere('curp', 'LIKE', "%$keyword%")
                ->orWhere('sexo', 'LIKE', "%$keyword%")
                ->orWhere('direccion', 'LIKE', "%$keyword%")
                ->orWhere('telefono', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('otros', 'LIKE', "%$keyword%")
                ->orWhere('talla_polo', 'LIKE', "%$keyword%")
                ->orWhere('beca', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $alumno = Alumno::latest()->paginate($perPage);
        }

        return view('alumno.index', compact('alumno'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('alumno.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();
                if ($request->hasFile('foto:')) {
            $requestData['foto:'] = $request->file('foto:')
                ->store('uploads', 'public');
        }

        Alumno::create($requestData);

        return redirect('alumno')->with('flash_message', 'Alumno added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $alumno = Alumno::findOrFail($id);

        return view('alumno.show', compact('alumno'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $alumno = Alumno::findOrFail($id);

        return view('alumno.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();
                if ($request->hasFile('foto:')) {
            $requestData['foto:'] = $request->file('foto:')
                ->store('uploads', 'public');
        }

        $alumno = Alumno::findOrFail($id);
        $alumno->update($requestData);

        return redirect('alumno')->with('flash_message', 'Alumno updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Alumno::destroy($id);

        return redirect('alumno')->with('flash_message', 'Alumno deleted!');
    }
}
