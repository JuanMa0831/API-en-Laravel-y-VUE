<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use app\Models\Comuna;
use Dotenv\Validator;
use Illuminate\Auth\Events\Validated;
use illuminate\support\Facades\DB;
use Illuminate\Http\Request;

class ComunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
        'comu_nomb' => ['required', 'max:30', 'unique'],
        'muni_codi' => ['required', 'numeric', 'min:1']
    ]);

    if($validate->fails()){
        return response()->json([
            'msg' => 'Se produjo un error en la validación de la información.',
            'statuscode' => 404
        ]);
    }

        $comuna = new Comuna();
        $comuna->comu_nomb = $request->name;
        $comuna->muni_codi = $request->code;
        $comuna->save();
        return json_encode(['comuna'=>$comuna]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comuna= Comuna::find($id);
        $municipios = DB::table('tb_municipio')
        -> orderBy('muni_nomb')
        -> get();
        return json_encode(['comuna'=> $comuna, 'municipios'=> $municipios]);

        $comuna=Comuna::find($id);
        if (is_null($comuna)){
            return abort(404);
        }
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
        $validate = Validator::make($request->all(), ['comu_nomb' =>['required', 'max:30', 'unique'],
        'muni_codi'=>['required', 'numeric', 'min:1']
    ]);

    if($validate->failed()){
        return response()->json([
            'msg' => 'Se produjo un error en la validación de la información.',
            'statuscode' => 404
        ]);
    }
        $comuna= Comuna::find($id);
        $comuna->comu_nomb = $request->name;
        $comuna->muni_codi = $request->code;
        $comuna->save();
        return json_encode(['comuna'=>$comuna]);

        $comuna=Comuna::find($id);
        if (is_null($comuna)){
            return abort(404);
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
        $comuna= Comuna::find($id);
        $comuna->delete();
        $comunas = DB::table('comuna')
        -> join('tb_municipio', 'tb_comuna.muni_codi', '=', 'tb_municipio.muni_codi')
        -> select('tb_comuna.*', 'tb_municipio.muni_nomb')
        -> get();
        return json_encode(['comunas'=> $comunas, 'Success'=> true]);

        $comuna=Comuna::find($id);
        if (is_null($comuna)){
            return abort(404);
        }
    }
}
