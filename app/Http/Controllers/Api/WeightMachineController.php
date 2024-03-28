<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WeightMachine;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WeightMachineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => WeightMachine::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            WeightMachine::create($request->all());

            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'Data Added Successfully'
            ]);
        } catch (\Exception $e) {
            Log::info($e);
            DB::rollback();
            return response()->json([
                'status' => 203,
                'message' => 'Some thing went wrong'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'status' => 200,
            'data' => WeightMachine::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
