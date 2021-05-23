<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\calificaciones_periodo;
use Illuminate\Http\Request;

class calificaciones_periodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $calificaciones_periodo = calificaciones_periodo::where('calificacionA', 'LIKE', "%$keyword%")
                ->orWhere('calificacionB', 'LIKE', "%$keyword%")
                ->orWhere('promedio', 'LIKE', "%$keyword%")
                ->orWhere('faltas', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $calificaciones_periodo = calificaciones_periodo::latest()->paginate($perPage);
        }

        return view('calificaciones_periodo.index', compact('calificaciones_periodo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('calificaciones_periodo.create');
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

        calificaciones_periodo::create($requestData);

        return redirect('calificaciones_periodo')->with('flash_message', 'calificaciones_periodo added!');
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
        $calificaciones_periodo = calificaciones_periodo::findOrFail($id);

        return view('calificaciones_periodo.show', compact('calificaciones_periodo'));
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
        $calificaciones_periodo = calificaciones_periodo::findOrFail($id);

        return view('calificaciones_periodo.edit', compact('calificaciones_periodo'));
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

        $calificaciones_periodo = calificaciones_periodo::findOrFail($id);
        $calificaciones_periodo->update($requestData);

        return redirect('calificaciones_periodo')->with('flash_message', 'calificaciones_periodo updated!');
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
        calificaciones_periodo::destroy($id);

        return redirect('calificaciones_periodo')->with('flash_message', 'calificaciones_periodo deleted!');
    }
}
