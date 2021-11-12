<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Http\Request;
use App\Http\Requests\PessoaRequest;
use Exception;
use Illuminate\Support\Facades\DB;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $pessoas = Pessoa::with('categoria')->orderBy('nome')->paginate(10);

            return response()->json([
                'success' => true,
                'data' => $pessoas
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PessoaRequest $request)
    {
        DB::beginTransaction();

        try {

            $pessoa = Pessoa::create([
                'nome' => $request->nome,
                'email' => $request->email,
                'categoria_id' => $request->categoria_id,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $pessoa
            ], 201);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pessoa  $pessoa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pessoa = Pessoa::with('categoria')->find($id);

        if (!isset($pessoa)) {
            return response()->json([
                'success' => true,
                'data' => null,
                'message' => 'Pessoa não encontrada.',
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $pessoa
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pessoa  $pessoa
     * @return \Illuminate\Http\Response
     */
    public function update(PessoaRequest $request, $id)
    {
        DB::beginTransaction();

        try {

            $pessoa = Pessoa::find($id);

            $pessoa->update([
                'nome' => $request->nome,
                'email' => $request->email,
                'categoria_id' => $request->categoria_id,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $pessoa
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pessoa  $pessoa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $pessoa = Pessoa::find($id);

            if (!isset($pessoa)) {
                return response()->json([
                    'success' => true,
                    'data' => null,
                    'message' => 'Pessoa não encontrada.',
                ]);
            }

            $pessoa->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => null
            ], 204);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ], 500);
        }
    }
}
