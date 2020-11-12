<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Color;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $colors = Color::get();
        
            return DataTables::of($colors)->make(true);
        }

        return view('admins.colors');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:250'
        ]);

        $color = Color::create($request->all());

        if ($color) {
            return response()->json([
                'status' => 200, 
                'message' => 'Success'
            ]);
        } else {
            return response()->json([
                'status' => 400, 
                'message' => 'Failed'
            ]);
        }
    }

    public function edit($id)
    {
        $color = Color::findOrFail($id);

        return $color;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:250'
        ]);

        $color = Color::findOrFail($id);

        $color->name = $request->name;
        $result = $color->save();

        if ($result) {
            return response()->json([
                'status' => 200, 
                'message' => 'Success'
            ]);
        } else {
            return response()->json([
                'status' => 400, 
                'message' => 'Failed'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $color = Color::findOrFail($id);

        $result = $color->delete();

        if ($result) {
            return response()->json([
                'status' => 200, 
                'message' => 'Success'
            ]);
        } else {
            return response()->json([
                'status' => 400, 
                'message' => 'Failed'
            ]);
        }
    }
}
