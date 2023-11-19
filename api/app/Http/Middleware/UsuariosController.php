<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Usuarios;
use \App\Models\Instalacionapp;

use \App\Models\Mycars;
use \App\Models\Mycarcalificaciones;
use \App\Models\Mycarsfavoritos;
use \App\Models\Publicaciones;
use \App\Models\Mycartags;

use \App\module;

use DB;
use Mail;


use App\Http\Controllers\Controller;
use JWTAuth;

class UsuariosController extends Controller
{
    /*
      *
      *   FUncTION BASE IMAGEN
    */
    public function reducir($foto, $WIDTH=350, $HEIGHT=350, $QUALITY=100 ) {
          $foto2 = str_replace("data:image/jpeg;base64,", "", $foto);
          $theme_image_little     = imagecreatefromstring(base64_decode($foto2));
          $org_w = imagesx($theme_image_little);
          $org_h = imagesy($theme_image_little);
          $image_little           = imagecreatetruecolor($WIDTH, $HEIGHT);
          imageinterlace($theme_image_little, true);
          imageinterlace($image_little, true);
          imagecopyresampled($image_little, $theme_image_little, 0, 0, 0, 0, $WIDTH, $HEIGHT, $org_w, $org_h);
          ob_start();
          imagejpeg($image_little, null, $QUALITY);
          $contents =  ob_get_contents();
          ob_end_clean();
          return "data:image/jpeg;base64,".base64_encode($contents);
          //return base64_encode($contents);
    }
    public function base64_to_png( $base64_string, $output_file ) {
          $foto = str_replace("data:image/jpeg;base64,", "", $base64_string);
          $ifp  = fopen( $output_file, "wb" ); 
          fwrite( $ifp, base64_decode( $foto) ); 
          fclose( $ifp ); 
          return($output_file);
          //file_put_contents($output_file,base64_decode($base64_string));
    }
    public function sessionactiva(Request $request){
        $data = $request->json()->all();
        return response()->json([
                'code' =>500,
            ],200);
    }
    public function loginemail(Request $request){
        $data = $request->json()->all();
        $cantidad = Usuarios::where('email',$data['email'])->count();         
        if($cantidad == 0){
            return response()->json([
                'email'=> $data['email'],
                'code'=>200                      
            ],200);
        }else{
            return response()->json([
                'code' =>201,
                'email'=> $data['email'],
                'msg'  =>'El email ya esta registrado'
            ],200);
        }
    }//fin function
    public function login1(Request $request){
        $data = $request->json()->all();
        $contar1 = Usuarios::where('email',    $data['usuario'])->where('clave', md5($data['clave']))->count();
        $contar2 = Usuarios::where('username', $data['usuario'])->where('clave', md5($data['clave']))->count();
              if($contar1!=0){
                    $code = 200;
                    $msg  = "Bienvenido";
                    $datos1 = Usuarios::where('email',    $data['usuario'])->where('clave', md5($data['clave']))->first();
                    $datos = $datos1->toArray();
        }else if($contar2!=0){
                    $code = 200;
                    $msg  = "Bienvenido";
                    $datos2 = Usuarios::where('username', $data['usuario'])->where('clave', md5($data['clave']))->first();
                    $datos = $datos2->toArray();
        }else{
                    $code = 201;
                    $msg  = "El Email/Usuario ó contraseña no valido";
                    $datos = array();
        }
        return response()->json([
                                'code'=>$code,
                                'msg'=>$msg,
                                'datos'=>$datos,                       
                              ],200);
    }//fin function

    public function actualizarpush(Request $request){
        $data = $request->json()->all();
        if(isset($data['u_push'])){
        $datos1 = Usuarios::find($data['u_push']);
            $datos1->push_token = $data['t_push']!=""?$data['t_push']:0;
            $datos1->push_platf = $data['p_push']!=""?$data['p_push']:0;
            $datos1->idioma     = $data['p_idio']!=""?$data['p_idio']:0;
            $datos1->save();
        }
        return response()->json([
                                'code'=>200                        
                              ],200);
    }//fin function

    public function instalacionapp(Request $request){
        $data   = $request->json()->all();
        $contar = Instalacionapp::where('registerid', $data['t_push'])->count();
        $token  = md5($data['t_push']);
        if($contar==0){
            $id_user =  DB::table('instalacionapp')->insertGetId(['plataforma'  => $data['p_push'],
                                                                  'registerid'  => $data['t_push'],
                                                                  'token'       => $token,
                                                                  'created'     => date('Y-m-d H:i:s'),
                                                                 ]
                                                                );
        }
        return response()->json([
                                'code'=>200,  
                                'token'=>$token                       
                              ],200);

    }

    public function loginregistro(Request $request){
        $data = $request->json()->all();
        if($data['clave']==""){
            $data['clave'] = 're_p98x_*mymotors_kil*1865CmmngfZaa1';    
        }
        if($data['tipo']=='1'){
           //GOOGLE
            $data['tiporegistro'] = 1;
        }else if($data['tipo']=='2'){
            //FACEBOOK
            $data['tiporegistro'] = 2;
        }else if($data['tipo']=='3'){
            //EMAIL
            $data['tiporegistro'] = 3;
        }else{
            //si session
            $data['tiporegistro'] = 0;
        }
        //TRABAJO DE USERNAME}//
        $explode_username = explode("@", $data['email']);
        $data['username'] = $explode_username[0];
        $contar_user      = Usuarios::where('username', $data['username'])->count();
        if($contar_user!=0){
            $data['username'] = $data['username']."".date('d');
            $contar_user2      = Usuarios::where('username', $data['username'])->count();
            if($contar_user2!=0){
                    $data['username'] = $data['username']."".date('m');

            }
        }
        $registroid = md5($data['clave']).md5($data['email']).md5(date('m-Y-d H:i:s a'));
        /////////////////////
        $contar = Usuarios::where('email', $data['email'])->count();
        if($contar==0){
                if(isset($data['fotourl'])){
                    if($data['fotourl']!=""){
                        $data['foto'] = base64_encode(
                                                    file_get_contents($data['fotourl'])
                                                    );    
                    }
                }else{
                    $data['fotourl'] = "";
                }
                if(isset($data['foto']) &&  $data['foto']!=""){
                    $img_reducir1 = $this->reducir($data['foto'], 1200, 1200, 100);
                    $imgpath1  = storage_path('imagenes')."/".$data['username'].date('Y-m-d-H-i-s')."_1.jpg";
                    $imgpath1_ = env('APP_URL_IMAGEN')."/".$data['username'].date('Y-m-d-H-i-s')."_1.jpg";
                    $this->base64_to_png($img_reducir1, $imgpath1);

                    $img_reducir2 = $this->reducir($data['foto'], 250, 250, 100);
                    $imgpath2  = storage_path('imagenes')."/".$data['username'].date('Y-m-d-H-i-s')."_2.jpg";
                    $imgpath2_ = env('APP_URL_IMAGEN')."/".$data['username'].date('Y-m-d-H-i-s')."_2.jpg";
                    $this->base64_to_png($img_reducir2, $imgpath2);

                    $thum1        = $this->reducir($data['foto'][0], 30, 30, 100);
                    $thumbnail1_  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_1.jpg";
                    $thumbnail1   = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_1.jpg";
                    $this->base64_to_png($thum1, $thumbnail1_);
                }else{
                    $theme_image_enc_little = "";
                    $imgpath1_ = "";
                    $imgpath2_ = "";
                    $thumbnail1 = "";
                }
                $id_user2 =  DB::table('mycars')->insertGetId(['razon_social'  => "",
                                                               'rif'           => "",
                                                               'role_id'       => $data['role_id'],
                                                               'mycartipo_id'  => "1",
                                                               'descripcion'   => "",
                                                               'representante' => $data['nombre'],
                                                               'telefono'      => "",
                                                               'email'         => $data['email'],

                                                               'latitud'       => "",
                                                               'longitud'      => "",
                                                               'pais'          => "",
                                                               'municipio'     => "",
                                                               'estado'        => "",
                                                               'foto1'         => $imgpath1_,
                                                               'thumbnail1'    => $thumbnail1,
                                                               'foto2'         => $imgpath2_,
                                                               'foto3'         => "",
                                                               'foto4'         => "",
                                                               'created'       => date('Y-m-d H:i:s'),
                                                               'modified'      => date('Y-m-d H:i:s')
                                                              ]
                                                            );

                $id_user =  DB::table('usuarios')->insertGetId(['nombre_apellido'     => $data['nombre']." ".$data['apellido'],
                                                                'nombres'             => $data['nombre'],
                                                                'apellidos'           => $data['apellido'],
                                                                'mycar_id'            => $id_user2,
                                                                'tiporegistro'        => $data['tiporegistro'],
                                                                'foto'                => $imgpath1_,
                                                                'thumbnail1'          => $thumbnail1,
                                                                'foto2'               => $imgpath2_,
                                                                'fotourl'             => $data['fotourl'],
                                                                'clave'               => md5($data['clave']),
                                                                'date'                => date('Y-m-d'),
                                                                'fechaingreso'        => date('Y-m-d'),
                                                                'username'            => $data['username'],
                                                                'email'               => $data['email'],
                                                                'ci'                  => 0,
                                                                'telefono'            => 0,
                                                                'role_id'             => $data['role_id'],
                                                                'verificado'          => 2,
                                                                'recuperar'           => 0,
                                                                'registroid'          => $registroid
                                                               ]
                                                            );
                
                $datos = Usuarios::find($id_user);
                $datos_update = Mycars::find($id_user2);
                $datos_update->usuario_id = $id_user;
                $datos_update->save();
        }else{
                $datos_1 = Usuarios::where('email', $data['email'])->get();
                $datos_2 = $datos_1->toArray();
                $datos   = Usuarios::find($datos_2[0]['id']);
        }    
        //EMAIL//
        /*$subject = 'Verifique su cuenta';
        $email = $data['email'];
        $link  =  env('APP_URL')."backend/Login/autentificar/".$registroid;
        $d = ['link' => env('APP_URL')."backend/Login/autentificar/".$registroid ];
        Mail::send('emails.autentificar', $d, function ($message) use ($subject, $email){
            $message->subject($subject);
            $message->to($email);
        });*/
        return response()->json([
                                    'msg'   => 'Los datos fueron guardados',
                                    'code'  => 200,
                                    'datos' => $datos,
                                ],200);
        
    }//fin function
    public function miperfil(Request $request){
        $data   = $request->json()->all();
        if($data['page']==1){
                $datos  = Mycars::with('usuarios')->with('mycartags')->with('mycartipos')->where('id', $data['mycarid'])->get(); 
                $array  = array('razon_social'  => "",
                               'rif'           => "",
                               'descripcion'   => "",
                               'representante' => "",
                               'telefono'      => "",
                               'email'         => "",
                               'latitud'       => "",
                               'longitud'      => "",
                               'pais'          => "",
                               'municipio'     => "",
                               'estado'      => "");
                $contar = 0;
                foreach ($datos as $key){$contar++;}
                if($contar==0){ $datos[0] = $array;}
                $servicios = "";
                if(isset($datos[0]['mycartags'])){
                  foreach ($datos[0]['mycartags'] as $key) {
                      $servicios .= $servicios=="#"?$key['denominacion']:" #".$key['denominacion'];
                  }
                }
                $datos2 = Mycarcalificaciones::with('usuarios')->where('mycar_id', $data['mycarid'])->where('activo', 1)->orderBy('created', 'desc')->get();
                //$data2 = Publicaciones::orderBy('created', 'desc')->paginate(15);
                $c1     = Mycarsfavoritos::where('mycar_id', $data['mycarid'])->count();
                $c1_1   = Mycarsfavoritos::where('usuario_id', $data['usuarioid'])->count();
                $c2     = Publicaciones::where('mycar_id', $data['mycarid'])->where('tipo', 2)->count();
                $contar=0;
                $puntaje = 0;
                $califico = 0;
                $favorito = 0;
                foreach ($datos2  as $key) {
                    $contar++;
                    $puntaje = $puntaje + $key['puntaje'];
                }
                if($puntaje!=0){
                    $calificacion = round($puntaje/$contar, 1);
                }else{
                    $calificacion = 0;    
                }
                $datos4 = Publicaciones::where('mycar_id', $data['mycarid'])->where('tipo', 2)->orderBy('created', 'desc')->paginate(9);
                return response()->json([
                        'datos'=>$datos,
                        'servicios'=>$servicios,
                        'seguidores'=>$c1,
                        'seguidos'=>$c1_1,
                        'post'=>$c2,
                        'postver'=>$datos4,
                        'calificacion'=>$calificacion,
                        'datos_calificacion'=>$datos2,
                        'page'=>$data['page'],
                        'code'=>200                      
                    ],200);
        }else{
                $datos4 = Publicaciones::where('mycar_id', $data['mycarid'])->where('tipo', 2)->orderBy('created', 'desc')->paginate(9);
                return response()->json([
                        'postver'=>$datos4,
                        'page'=>$data['page'],
                        'code'=>200  
                    ],200);
        }
    }
    public function miperfilupdate(Request $request){
        $data = $request->json()->all();
        //print_r($data);
        $mycartags = Mycartags::where('mycar_id', $data['mycarid'])->delete();
        $array     = explode("#", $data['datos']['servicios']);
        foreach ($array as $key) {
            if($key!=""){
                $id_user2 =  DB::table('mycartags')->insertGetId(['mycar_id'     => $data['mycarid'],
                                                                  'denominacion' => trim($key),
                                                                ]
                                                              );
            }
        }
        $datos1 = Mycars::find($data['mycarid']);
        if(isset($data['imagenes'][0])){
            $cantidad_caracteres = strlen($data['imagenes'][0]);
            if($cantidad_caracteres>150){
                $img_reducir1 = $this->reducir($data['imagenes'][0], 1200, 1200, 100);
                $imgpath1  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_1.jpg";
                $imgpath1_ = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_1.jpg";
                $this->base64_to_png($img_reducir1, $imgpath1);

                $img_reducir2 = $this->reducir($data['imagenes'][0], 250, 250, 100);
                $imgpath2  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_2.jpg";
                $imgpath2_ = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_2.jpg";
                $this->base64_to_png($img_reducir2, $imgpath2);

                $thum1        = $this->reducir($data['imagenes'][0], 30, 30, 100);
                $thumbnail1_  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_1.jpg";
                $thumbnail1   = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_1.jpg";
                $this->base64_to_png($thum1, $thumbnail1_);
            }else{
                $theme_image_enc_little = "";
                $imgpath1_ = "";
                $imgpath2_ = "";
            }
        }else{
            $theme_image_enc_little = "";
            $imgpath1_ = "";
            $imgpath2_ = "";
        }
        $datos1->razon_social  = $data['datos']['razon_social'];
        $datos1->descripcion   = $data['datos']['descripcion'];
        $datos1->telefono      = $data['datos']['telefono'];
        $datos1->email         = $data['datos']['email'];
        $datos1->latitud       = $data['datos']['latitud'];
        $datos1->longitud      = $data['datos']['longitud'];
        $datos1->pais          = $data['datos']['pais'];
        $datos1->municipio     = $data['datos']['municipio'];
        $datos1->estado        = $data['datos']['estado'];
        $datos1->tag           = $data['datos']['servicios'];
        if($imgpath1_!=""){
            $datos1->foto1         = $imgpath1_;
            $datos1->foto2         = $imgpath2_;
            $datos1->thumbnail1    = $thumbnail1;
        }
        $datos1->save();        
        $datos = Usuarios::find($data['usuarioid']);
        $datos->username         = $data['datos']['username'];
        $datos->nombre_apellido  = $data['datos']['razon_social'];
        $datos->tag              = $data['datos']['servicios'];
        if($imgpath1_!=""){
            $datos->foto             = $imgpath1_;
            $datos->foto2            = $imgpath2_;
            $datos1->thumbnail1    = $thumbnail1;
        }
        $datos->save();
        $datos_new = Usuarios::find($data['usuarioid']);
        return response()->json([
            'datos' =>$datos_new,
            'code'=>200                   
        ],200);
    }//fin function
    /*
    *   FUNCTION PARA VER EL PERFIL DEL USUARIO
    */
    public function perfilmycarcompartir(Request $request){
            $data   = $request->json()->all();
            $id_save =  DB::table('valoraciones')->insertGetId(['mycar_id'    => $data['mycarid'],
                                                                'usuario_id'  => isset($data['usuarioid'])?$data['usuarioid']:'0',
                                                                'tipo'        => 3,
                                                                'puntaje'     => 1,
                                                                'created'     => date('Y-m-d H:i:s'),
                                                               ]
                                                            );
            return response()->json([
                'code'=>200                   
            ],200);

    }
    /*
    *   FUNCTION PARA VER EL PERFIL DEL USUARIO
    */
    public function perfilmycar(Request $request){
            $data   = $request->json()->all();
            $d_u    = Usuarios::where('id', $data['usuariomycarid'])->first();
            $d_u2   = $d_u->toArray();
            //print_r($d_u2);
            $data['mycarid'] = $d_u2['mycar_id'];
            if($data['page']==1){
                    $datos  = Mycars::with('usuarios')->with('mycartags')->with('mycartipos')->where('id', $data['mycarid'])->get(); 
                    $array  = array('razon_social'  => "",
                                   'rif'           => "",
                                   'descripcion'   => "",
                                   'representante' => "",
                                   'telefono'      => "",
                                   'email'         => "",
                                   'latitud'       => "",
                                   'longitud'      => "",
                                   'pais'          => "",
                                   'municipio'     => "",
                                   'estado'      => "");
                    $contar = 0;
                    foreach ($datos as $key){$contar++;}
                    if($contar==0){ $datos[0] = $array;}
                    $servicios = "";
                    if(isset($datos[0]['mycartags'])){
                      foreach ($datos[0]['mycartags'] as $key) {
                          $servicios .= $servicios=="#"?$key['denominacion']:" #".$key['denominacion'];
                      }
                    }
                    $datos2 = Mycarcalificaciones::with('usuarios')->where('mycar_id', $data['mycarid'])->where('activo', 1)->orderBy('created', 'desc')->get();
                    $c1     = Mycarsfavoritos::where('mycar_id', $data['mycarid'])->count();
                    if(isset($data['usuarioid'])){
                        $c1_1   = Mycarsfavoritos::where('usuario_id',  $data['usuariomycarid'])->count();
                        $c3     = Mycarsfavoritos::where('mycar_id',  $data['mycarid'])->where('usuario_id', $data['usuarioid'])->get();
                    }else{
                        $c1_1 = 0;
                        $c3 = array();
                    }
                    $id_save =  DB::table('valoraciones')->insertGetId(['mycar_id'    => $data['mycarid'],
                                                                        'usuario_id'  => isset($data['usuarioid'])?$data['usuarioid']:'0',
                                                                        'tipo'        => 2,
                                                                        'puntaje'     => 1,
                                                                        'created'     => date('Y-m-d H:i:s'),
                                                                       ]
                                                                    );
                    $c2     = Publicaciones::where('mycar_id', $data['mycarid'])->where('tipo', 2)->count();
                    $favorito = 0;
                    //echo $data['mycarid']." - ".$data['usuarioid'];
                    foreach ($c3 as $key2) {
                         $favorito++;
                    }
                    $contar=0;
                    $puntaje = 0;
                    $califico = 0;
                    foreach ($datos2  as $key) {
                        $contar++;
                        $puntaje = $puntaje + $key['puntaje'];
                        if($key['usuario_id']==$data['usuarioid']){
                            $califico++;
                        }
                    }
                    if($puntaje!=0){
                        $calificacion = round($puntaje/$contar, 1);
                    }else{
                        $calificacion = 0;    
                    }
                    $datos4 = Publicaciones::where('mycar_id', $data['mycarid'])->where('tipo', 2)->orderBy('created', 'desc')->paginate(9);
                    return response()->json([
                            'datos'=>$datos,
                            'servicios'=>$servicios,
                            'seguidores'=>$c1,
                            'seguidos'=>$c1_1,
                            'post'=>$c2,
                            'postver'=>$datos4,
                            'calificacion'=>$calificacion,
                            'datos_calificacion'=>$datos2,
                            'califico'=>$califico,
                            'favorito'=>$favorito,
                            'page'=>$data['page'],
                            'code'=>200                      
                        ],200);
            }else{
                    $datos4 = Publicaciones::where('mycar_id', $data['mycarid'])->where('tipo', 2)->orderBy('created', 'desc')->paginate(9);
                    return response()->json([
                            'postver'=>$datos4,
                            'page'=>$data['page'],
                            'code'=>200                      
                        ],200);
            }
    }
    /*
    *
    *   FUNCTION AGREGAR CALIFICACIONES
    *
    *
    */
    public function perfilmycarsfavcalif(Request $request){
            $data = $request->json()->all();
            $d_u    = Usuarios::where('id', $data['usuariomycarid'])->first();
            $d_u2   = $d_u->toArray();
            $data['mycarid'] = $d_u2['mycar_id'];
            $id_user =  DB::table('mycarcalificaciones')->insertGetId(['mycar_id'    => $data['mycarid'],
                                                                       'usuario_id'  => $data['usuarioid'],
                                                                       'puntaje'     => $data['puntaje'],
                                                                       'descripcion' => $data['descripcion'],
                                                                       'created'     => date('Y-m-d H:i:s')
                                                                      ]
                                                                    );
            $id_save =  DB::table('valoraciones')->insertGetId(['mycar_id'    => $data['mycarid'],
                                                                'usuario_id'  => isset($data['usuarioid'])?$data['usuarioid']:'0',
                                                                'tipo'        => 7,
                                                                'puntaje'     => 1,
                                                                'created'     => date('Y-m-d H:i:s'),
                                                               ]
                                                            );
            return response()->json([
                'code'=>200                      
            ],200);
    }//fin function
    /*
    *
    *
    *
    *
    */
    public function loginrecuperar1(Request $request){
        $data = $request->json()->all();
        $cantidad = Usuarios::where('email',$data['email'])->count();         
        if($cantidad == 0){
                return response()->json([
                    'msg'=>"El email no se encuentra registrado",
                    'email'=>$data['email'],
                    'code'=>201
                ],200);
        }else{
                $datos = Usuarios::where('email',$data['email'])->first(); 
                //ENVIAR CODIGO DE RECUPERCACION
                $codigo_veri_a    = $datos->id*(date('d')*date('m')*date('i'));
                $codigo_veri_a   .= "123456789";
                $codigo_veri      = "";
                $charactersLength = strlen($codigo_veri_a);
                for ($i = 0; $i < 6; $i++) {
                    $codigo_veri .= $codigo_veri_a[rand(0, $charactersLength-1)];
                }
                //$codigo_veri = 123456;
                //UPDATE CODIGO
                    $datos1 = Usuarios::find($datos->id);
                    $datos1->codigo_recuperacion      =  $codigo_veri;
                    $data_email['datos']['nombres']   = $datos1->nombres;
                    $data_email['datos']['apellidos'] = $datos1->apellidos;
                    $datos1->save();
                //EMAIL//
                    $subject = 'Código de verificación';
                    $email   = $data['email'];
                    $mensaje = "Estimado/a ".$datos->nombres." ".$datos->apellidos." Para restablecer su contraseña, ingrese el siguiente código de verificación cuando se le indique: ".$codigo_veri;
                    $d = ['mensaje'=> $mensaje];
                    Mail::send('emails.recuperacion', $d, function ($message) use ($subject, $email){
                        $message->subject($subject);
                        $message->to($email);
                    });
                //FIN EMAIL//
                return response()->json([
                    'email'=>$data['email'],
                    'msg'=>'Código de verificación fue enviado a su correo',
                    'code'=>200                      
                ],200);
        }
    }//fin function
    public function loginrecuperar2(Request $request){
        $data = $request->json()->all();
        $cantidad = Usuarios::where('codigo_recuperacion',$data['codigo_recuperacion'])->count();         
        if($cantidad == 0){
            return response()->json([
                'codigo'=>$data['codigo_recuperacion'],
                'msg'=>"Él código no es válido.",
                'code'=>201
            ],200);
        }else{
            $datos = Usuarios::where('codigo_recuperacion',$data['codigo_recuperacion'])->first(); 
            return response()->json([
                'codigo'=>$data['codigo_recuperacion'],
                'code'=>200                      
            ],200);
        }
    }//fin function
    public function loginrecuperar3(Request $request){
            $data = $request->json()->all();
            $datos  = Usuarios::where('email',$data['email'])->first(); 
            $datos1 = Usuarios::find($datos->id);
            $datos1->clave = md5($data['clave']);
            $datos1->codigo_recuperacion = "";
            $datos1->save();
            return response()->json([
                    'msg'=>'La contraseña ha sido modificada con éxito',
                    'code'=>200                      
            ],200);
    }

}//Fin class
