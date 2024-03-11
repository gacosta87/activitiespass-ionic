<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Configuraciones;
use \App\Models\Favoritetours;
use \App\module;


use DB;
use Mail;


use App\Http\Controllers\Controller;
use JWTAuth;

class FavoritoController extends Controller
{


	public function add(Request $request){
        $data = $request->json()->all();

        $id_ver =  DB::table('favorite_tours')->insertGetId(['user_id'  => $data['user_id'],
                                                                'tour_id' => $data['tour_id'],
                                                                'created' => date('Y-m-d H:i:s'),
                                                                ]
                                                            );


        return response()->json([
            'code'=>200                      
        ],200);
    }//fin function




    public function del(Request $request){
        $data = $request->json()->all();

        $id = Favoritetours::where('id', $data['id'])->delete();

        return response()->json([
            'code'=>200                      
        ],200);
    }//fin function



    public function lis(Request $request){
        $data = $request->json()->all();

        $list = Favoritetours::get();

        return response()->json([
            'code'=>200,
            'data'=>$list                      
        ],200);
    }//fin function



}
?>