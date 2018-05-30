<?php

namespace App\Http\Controllers;

use App\Http\Resources\Malfunction as MalfunctionResource;
use App\Malfunction;
use Illuminate\Http\Request;

class MalfunctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get malfunctions
        $malfunctions = Malfunction::orderBy('created_at', 'desc')->paginate(5);

        // Return collection of malfunctions as a resource
        return MalfunctionResource::collection($malfunctions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Log::info($request->all());
        $malfunction = $request->isMethod('put') ? malfunction::findOrFail($request->malfunction_id) : new malfunction();

        $malfunction->id = $request->input('malfunction_id');
        $malfunction->title = $request->input('title');
        $malfunction->body = $request->input('body');
        $malfunction->summary = $request->input('summary');
        $malfunction->location = $request->input('location');
        $malfunction->lng = $request->input('lng');
        $malfunction->lat = $request->input('lat');

        if ($malfunction->save()) {
            return new malfunctionResource($malfunction);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get malfunction
        $malfunction = Malfunction::findOrFail($id);

        // Return single malfunction as a resource
        return new MalfunctionResource($malfunction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get malfunction
        $malfunction = Malfunction::findOrFail($id);

        if ($malfunction->delete()) {
            return new MalfunctionResource($malfunction);
        }
    }
}
