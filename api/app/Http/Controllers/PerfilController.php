<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Usuarios;
use \App\Models\Mycarclientes;
use \App\Models\Mycarsposts;


use \App\module;


use DB;
use Mail;


use App\Http\Controllers\Controller;
use JWTAuth;

class PerfilController extends Controller
{
    
    public function listarperfil(Request $request){
        $data = $request->json()->all();
        $datos_usuarios = Usuarios::where('id', $data['usuarioid'])->get();  
        return response()->json([
            'datos_usuarios'=>$datos_usuarios,
            'code'=>200                      
        ],200);
    }//fin function

    public function guardarperfil(Request $request){
    $data   = $request->json()->all();
    $datos1 = Usuarios::find($data['usuarioid']);
    $datos1->nombres          = $data['nombre'];
    $datos1->apellidos        = $data['apellido'];
    $datos1->role_id          = $data['role_id'];
    if($data['clave']!=""){
        $datos1->clave  = md5($data['clave']);
    }
    $datos1->nombre_apellido  = $data['nombre']." ".$data['apellido'];
    $datos1->save();
    $datos_usuarios = Usuarios::where('id', $data['usuarioid'])->get();  
    return response()->json([
                              'msg'=>'Los datos fueron actualizados',
                              'datos_usuarios'=>$datos_usuarios,
                              'code'=>200                        
                            ],200);
  }//fin function


  public function misclientesproveedores(Request $request){
        $data = $request->json()->all();
        $datos = Mycarclientes::where('mycar_id', $data['mycarid'])->where('usuario_id', $data['usuarioid'])->where('tipo', $data['tipo'])->get();  
        return response()->json([
            'datos'=> $datos,
            'code'=>200                      
        ],200);
    }

    public function misclientesproveedoresadd(Request $request){
        $data = $request->json()->all();
        //'usuarioid':var1,
        //'mycarid':var2,
        //'nombre_apellido':var3.nombre_apellido,
        //'telefono':var3.telefono,
        //'email':var3.email,
        //'rubro':var3.rubro,
        //'tipo':var4,
        $id_user   =   DB::table('mycarclientes')->insertGetId(['nombre_apellido'     => $data['nombre_apellido'],
                                                                'mycar_id'            => $data['mycarid'],
                                                                'tipo'                => $data['tipo'],
                                                                'usuario_id'          => $data['usuarioid'],
                                                                'telefono'            => $data['telefono'],
                                                                'email'               => $data['email'],
                                                                'rubro'               => $data['rubro'],
                                                               ]
                                                            );
        return response()->json([
            'code'=>200,
            'msg'=>'Los datos fueron guardados'                      
        ],200);
    }

    public function misclientesproveedoresdelete(Request $request){
        $data = $request->json()->all();
        $deletedRows = Mycarclientes::where('id', $data['mycarclienteid'])->delete();
        return response()->json([
            'code'=>200,
            'msg'=>'Los datos fueron eliminados'                         
        ],200);
    }


    public function mycarspostsadd(Request $request){
        $data = $request->json()->all();
        $id_user =  DB::table('mycarsposts')->insertGetId([ 'mycar_id'    => $data['mycar_id'],
                                                       'descripcion' => $data['descripcion'],
                                                       'imagen1'     => $data['imagenes'][0],
                                                       'imagen2'     => $data['imagenes'][1],
                                                       'imagen3'     => $data['imagenes'][2],
                                                       'created'     => date('Y-m-d'),
                                                       'modified'    => date('Y-m-d')
                                                      ]
                                                    );
        return response()->json([
            'code'=>200,
            'msg'=>'Los datos fueron guardados'                         
        ],200);
    }

    public function mycarspostver(Request $request){
        $data = $request->json()->all();
        $datos = Mycarsposts::with('mycars')->where('id', $data['mycarspost_id'])->get();
        return response()->json([
            'code'=>200,
            'datos'=>$datos,
            'msg'=>'Los datos fueron guardados'                         
        ],200);
    }
 
 
 

}//Fin class
