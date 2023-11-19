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
use \App\Models\Reservas;
use \App\Models\Reservasconfigs;
use \App\Models\Reservasferiados;
use \App\Models\Bloqueos;
use \App\Models\Promociones;
use \App\Models\Valoraciones;
use \App\Models\Puntomensajes;
use \App\module;

use DB;
use Mail;
use DateTime;

use App\Http\Controllers\Controller;
use JWTAuth;

class UsuariosController extends Controller
{
    
    public function reducir($foto="", $WIDTH=350, $HEIGHT=350, $QUALITY=100, $ruta="" ) {
          if($foto!=""){
              $foto2 = str_replace("data:image/jpeg;base64,", "", $foto);
              $theme_image_little    = @imagecreatefromstring(base64_decode($foto2));
              if($theme_image_little !== false) {
                    $org_w = imagesx($theme_image_little);
                    $org_h = imagesy($theme_image_little);
                    $image_little           = imagecreatetruecolor($WIDTH, $HEIGHT);
                    imageinterlace($theme_image_little, true);
                    imageinterlace($image_little, true);
                    imagecopyresampled($image_little, $theme_image_little, 0, 0, 0, 0, $WIDTH, $HEIGHT, $org_w, $org_h);
                    //ob_start();
                    //imagejpeg($image_little, null, $QUALITY);
                    imagewebp($image_little, $ruta, $QUALITY);
                    //$contents =  ob_get_contents();
                    //ob_end_clean();
              }else{
                 return "";
              }
              //return "data:image/jpeg;base64,".base64_encode($contents);
              return true;
          }else{
              return "";
          }
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
            if(isset($datos1->push_token)){
                        if($data['t_push']==null){$data['t_push']="0";}
                        if($data['p_push']==null){$data['p_push']="0";}
                        $datos1->push_token = $data['t_push']!=""?$data['t_push']:0;
                        $datos1->push_platf = $data['p_push']!=""?$data['p_push']:0;
                        $datos1->idioma     = $data['p_idio']!=""?$data['p_idio']:0;
                        if(isset($data['p_lta'])){
                          if($data['p_lta']!="0"){
                            $datos2 = Mycars::find($datos1->mycar_id);
                            if($datos2->latitud=='0' ||  $datos2->latitud==null){
                                $datos2->latitud  = $data['p_lta']!=""?$data['p_lta']:0;
                                $datos2->longitud = $data['p_lgn']!=""?$data['p_lgn']:0;
                                
                            }
                            $datos2->save();
                          }
                        }
                        $datos1->save();
            }
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

    
    public function calculaedad($fechanacimiento){
              list($ano,$mes,$dia) = explode("-",$fechanacimiento);
              $ano_diferencia  = date("Y") - $ano;
              $mes_diferencia = date("m") - $mes;
              $dia_diferencia   = (int)date("d") - (int)$dia;
              if ($dia_diferencia < 0 || $mes_diferencia < 0)
                $ano_diferencia--;
              return $ano_diferencia;
    }


    public function loginregistro(Request $request){
        $data = $request->json()->all();
        ///////////////////////FECHA DE NACIMIENTO
                  if(isset($data['fechanacimiento'])){
                            $edad = $this->calculaedad($data['fechanacimiento']);
                            if($edad<18){
                                  return response()->json([
                                      'code'=>202                        
                                  ],200);
                            }
                  }else{
                            $data['fechanacimiento'] = date("Y-m-d");
                  }
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
                  $registrado = 1;
                  if($contar==0){
                                        if(isset($data['fotourl'])){
                                            if($data['fotourl']!=""){
                                                $contents     = @file_get_contents($data['fotourl']);
                                                if($contents !== false) {
                                                  $data['foto'] = base64_encode($contents);   
                                                } 
                                            }
                                        }else{
                                            $data['fotourl'] = "";
                                        }
                                        
                                        if(isset($data['foto']) &&  $data['foto']!="" && !empty($data['foto'])){
                                            $cantidad_caracteres = strlen($data['foto']);
                                            if($cantidad_caracteres>150){
                                                
                                                $imgpath1  = storage_path('imagenes')."/".$data['username'].date('Y-m-d-H-i-s')."_1.webp";
                                                $imgpath1_ = env('APP_URL_IMAGEN')."/".$data['username'].date('Y-m-d-H-i-s')."_1.webp";
                                                $img_reducir1 = $this->reducir($data['foto'], 700, 700, 80, $imgpath1);
                                                //$this->base64_to_png($img_reducir1, $imgpath1);
                                                
                                                $imgpath2  = storage_path('imagenes')."/".$data['username'].date('Y-m-d-H-i-s')."_2.webp";
                                                $imgpath2_ = env('APP_URL_IMAGEN')."/".$data['username'].date('Y-m-d-H-i-s')."_2.webp";
                                                $img_reducir2 = $this->reducir($data['foto'], 170, 170, 80, $imgpath2);
                                                //$this->base64_to_png($img_reducir2, $imgpath2);
                                                
                                                $thumbnail1_  = storage_path('imagenes')."/".$data['username'].date('Y-m-d-H-i-s')."th_1.webp";
                                                $thumbnail1   = env('APP_URL_IMAGEN')."/".$data['username'].date('Y-m-d-H-i-s')."th_1.webp";
                                                $thum1        = $this->reducir($data['foto'], 100, 100, 80, $thumbnail1_);
                                                //$this->base64_to_png($thum1, $thumbnail1_);


                                                $foto_144_  = storage_path('imagenes')."/".$data['username'].date('Y-m-d-H-i-s')."th_144.webp";
                                                $foto_144   = env('APP_URL_IMAGEN')."/".$data['username'].date('Y-m-d-H-i-s')."th_144.webp";
                                                $reducir    = $this->reducir($data['foto'], 170, 170, 80, $foto_144_);

                                                $foto_35_  = storage_path('imagenes')."/".$data['username'].date('Y-m-d-H-i-s')."th_35.webp";
                                                $foto_35   = env('APP_URL_IMAGEN')."/".$data['username'].date('Y-m-d-H-i-s')."th_35.webp";
                                                $reducir    = $this->reducir($data['foto'], 50, 50, 80, $foto_35_);

                                                $foto_77_  = storage_path('imagenes')."/".$data['username'].date('Y-m-d-H-i-s')."th_77.webp";
                                                $foto_77   = env('APP_URL_IMAGEN')."/".$data['username'].date('Y-m-d-H-i-s')."th_77.webp";
                                                $reducir    = $this->reducir($data['foto'], 120, 120, 80, $foto_77_);

                                                $foto_62_  = storage_path('imagenes')."/".$data['username'].date('Y-m-d-H-i-s')."th_62.webp";
                                                $foto_62   = env('APP_URL_IMAGEN')."/".$data['username'].date('Y-m-d-H-i-s')."th_62.webp";
                                                $reducir    = $this->reducir($data['foto'], 100, 100, 80, $foto_62_);
                                            }
                                        }else{
                                            $theme_image_enc_little = "";
                                            $imgpath1_ = "";
                                            $imgpath2_ = "";
                                            $thumbnail1 = "";

                                            $foto_144 = "";
                                            $foto_35  = "";
                                            $foto_77  = "";
                                            $foto_62  = "";
                                        }
                                        if(!isset($data['nombre'])){
                                            $data['nombre'] = "";
                                        }
                                        if(!isset($data['apellido'])){
                                            $data['apellido'] = "";
                                        }
                                        $id_user2 =  DB::table('mycars')->insertGetId(['razon_social'    => "",
                                                                                       'rif'             => "",
                                                                                       'role_id'         => $data['role_id'],
                                                                                       'mycartipo_id'    => "1",
                                                                                       'descripcion'     => "",
                                                                                       'representante'   => $data['nombre'],
                                                                                       'telefono'        => "",
                                                                                       'email'           => $data['email'],                                                               
                                                                                       'latitud'         => "",
                                                                                       'longitud'        => "",
                                                                                       'pais'            => "",
                                                                                       'municipio'       => "",
                                                                                       'estado'          => "",
                                                                                       'foto1'           => $imgpath1_,
                                                                                       'thumbnail1'      => $thumbnail1,
                                                                                       'foto2'           => $imgpath2_,
                                                                                       'foto3'           => "",
                                                                                       'foto4'           => "",
                                                                                       'categoria_id'    => '',
                                                                                       'foto_144'        => $foto_144,
                                                                                       'foto_35'         => $foto_35,
                                                                                       'foto_77'         => $foto_77,
                                                                                       'foto_62'         => $foto_62,
                                                                                       'created'         => date('Y-m-d H:i:s'),
                                                                                       'modified'        => date('Y-m-d H:i:s')
                                                                                      ]
                                                                                    );

                                        $id_user =  DB::table('usuarios')->insertGetId(['nombre_apellido'     => $data['nombre']." ".$data['apellido'],
                                                                                        'nombres'             => $data['nombre'],
                                                                                        'apellidos'           => $data['apellido'],
                                                                                        'mycar_id'            => $id_user2,
                                                                                        'tiporegistro'        => $data['tiporegistro'],
                                                                                        'fechanacimiento'     => $data['fechanacimiento'],
                                                                                        'foto'                => $imgpath1_,
                                                                                        'thumbnail1'          => $thumbnail1,
                                                                                        'foto2'               => $imgpath2_,
                                                                                        'fotourl'             => $data['fotourl'],
                                                                                        'foto_144'            => $foto_144,
                                                                                        'foto_35'             => $foto_35,
                                                                                        'foto_77'             => $foto_77,
                                                                                        'foto_62'             => $foto_62,
                                                                                        'clave'               => md5($data['clave']),
                                                                                        'date'                => date('Y-m-d'),
                                                                                        'fechaingreso'        => date('Y-m-d'),
                                                                                        'username'            => $data['username'],
                                                                                        'email'               => $data['email'],
                                                                                        'ci'                  => 0,
                                                                                        'telefono'            => "",
                                                                                        'role_id'             => $data['role_id'],
                                                                                        'verificado'          => 2,
                                                                                        'recuperar'           => 0,
                                                                                        'registroid'          => $registroid
                                                                                       ]
                                                                                    );


                                        $id_punto =  DB::table('puntomensajes')->insertGetId([  'usuario_id'  => $id_user,
                                                                                                'tipo_punto'  => 5,
                                                                                                'punto'       => 100,
                                                                                                'accion'      => 1,
                                                                                                'created'     => date('Y-m-d H:i:s'),
                                                                                                'modified'    => date('Y-m-d H:i:s')
                                                                                            ]);
                                        
                                        $datos = Usuarios::find($id_user);
                                        $datos_update = Mycars::find($id_user2);
                                        $datos_update->usuario_id = $id_user;
                                        $datos_update->save();
                  }else{
                                        $datos_1 = Usuarios::where('email', $data['email'])->get();
                                        $datos_2 = $datos_1->toArray();
                                        $datos   = Usuarios::find($datos_2[0]['id']);
                                        $registrado = 2;
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
                                              'registrado'=>$registrado
                                          ],200);
        
    }//fin function
    
    public function perfilregistrocompletar(Request $request){
        $data   = $request->json()->all();
        $datos  = Usuarios::find($data['usuarioid']);
        $datos1 = Mycars::find($datos->mycar_id);
              if(isset($data["datos"]["categoria_id"])){
                $datos1->categoria_id = $data["datos"]["categoria_id"]=='1'?'Ninguna':$data["datos"]["categoria_id"];
                $contar_puntos = Puntomensajes::where('usuario_id', $data['usuarioid'])->where('tipo_punto', '9')->where('activo', '1')->count();
                if($contar_puntos==0){
                    $id_punto =  DB::table('puntomensajes')->insertGetId(['usuario_id'  => $data['usuarioid'],
                                                                          'tipo_punto'  => 9,
                                                                          'punto'       => 20,
                                                                          'accion'      => 1,
                                                                          'created'     => date('Y-m-d H:i:s'),
                                                                          'modified'    => date('Y-m-d H:i:s')
                                                                      ]);
                }


        }else if(isset($data["datos"]["razon_social"])){
                $datos->nombre_apellido = $data["datos"]["razon_social"];
                $datos1->razon_social   = $data["datos"]["razon_social"];

                $contar_puntos = Puntomensajes::where('usuario_id', $data['usuarioid'])->where('tipo_punto', '10')->where('activo', '1')->count();
                if($contar_puntos==0){
                    $id_punto =  DB::table('puntomensajes')->insertGetId(['usuario_id'  => $data['usuarioid'],
                                                                          'tipo_punto'  => 10,
                                                                          'punto'       => 20,
                                                                          'accion'      => 1,
                                                                          'created'     => date('Y-m-d H:i:s'),
                                                                          'modified'    => date('Y-m-d H:i:s')
                                                                      ]);
                }

        }else if(isset($data["datos"]["descripcion"])){
                $datos1->descripcion    = $data["datos"]["descripcion"];

                $contar_puntos = Puntomensajes::where('usuario_id', $data['usuarioid'])->where('tipo_punto', '11')->where('activo', '1')->count();
                if($contar_puntos==0){
                    $id_punto =  DB::table('puntomensajes')->insertGetId(['usuario_id'  => $data['usuarioid'],
                                                                          'tipo_punto'  => 11,
                                                                          'punto'       => 20,
                                                                          'accion'      => 1,
                                                                          'created'     => date('Y-m-d H:i:s'),
                                                                          'modified'    => date('Y-m-d H:i:s')
                                                                      ]);
                }
        }
        $datos1->save();
        $datos->save();      
        return response()->json([
                        'code'=>200  
                    ],200);
    }

//VERIFICACIONES DE IDENTIDAD
        public function perfilverificar1(Request $request){
            $data   = $request->json()->all();
            $datos  = Usuarios::find($data['usuarioid']);
            $datos->verificacion_1      = "2";
            $datos->verificacion_1_pais = $data["datos"]["pais_id"];
            $datos->save();      
            return response()->json([
                            'code'=>200  
                        ],200);
        }
        public function perfilverificar2(Request $request){
            $data = $request->json()->all();
            $datos1 = Usuarios::find($data['usuarioid']);
            //ENVIAR CODIGO DE RECUPERCACION
            $codigo_veri_a    = $datos1->id*(date('d')*date('m')*date('i'));
            $codigo_veri_a   .= "123456789";
            $codigo_veri      = "";
            $charactersLength = strlen($codigo_veri_a);
            for ($i = 0; $i < 6; $i++) {
                $codigo_veri .= $codigo_veri_a[rand(0, $charactersLength-1)];
            }
            //UPDATE CODIGO
                $datos1->verificacion_2_codigo    = $codigo_veri;
                $datos1->save();
            //EMAIL//
                $subject  = 'Código de verificación';
                $email    = $datos1->email;
                $mensaje  = "Estimado/a ".$datos1->nombre_apellido." Para verificar su identidad, ingrese el siguiente código de verificación cuando se le indique:";
                $mensaje2 = $codigo_veri;
                $d = ['mensaje'=> $mensaje, 'mensaje2'=>$mensaje2];
                Mail::send('emails.recuperacion', $d, function ($message) use ($subject, $email){
                    $message->subject($subject);
                    $message->to($email);
                });
            //FIN EMAIL//
            return response()->json([
                'msg'=>'Código de verificación fue enviado a su correo',
                'code'=>200                      
            ],200);
        }//fin function
        public function perfilverificar2_1(Request $request){
            $data = $request->json()->all();
            $cantidad = Usuarios::where('id', $data['usuarioid'])->where('verificacion_2_codigo',$data["datos"]['codigo_recuperacion'])->count();         
            if($cantidad == 0){
                return response()->json([
                    'msg'=>"Él código no es válido.",
                    'code'=>201
                ],200);
            }else{
                $datos  = Usuarios::find($data['usuarioid']);
                $datos->verificacion_2      = "2";
                $datos->save();      
                return response()->json([
                    'code'=>200                      
                ],200);
            }
        }//fin function
        public function perfilverificar3(Request $request){
            $data = $request->json()->all();
            if(isset($data['imagenes'][0])){
                $cantidad_caracteres = strlen($data['imagenes'][0]);
                if($cantidad_caracteres>150){
                    
                    $imgpath1  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_1.webp";
                    $imgpath1_ = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_1.webp";
                    $img_reducir1 = $this->reducir($data['imagenes'][0], 1200, 1200, 100, $imgpath1);
                    //$this->base64_to_png($img_reducir1, $imgpath1);

                    
                    $imgpath2  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_2.webp";
                    $imgpath2_ = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_2.webp";
                    $img_reducir2 = $this->reducir($data['imagenes'][0], 170, 170, 80, $imgpath2);
                    //$this->base64_to_png($img_reducir2, $imgpath2);

                    
                    $thumbnail1_  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_1.webp";
                    $thumbnail1   = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_1.webp";
                    $thum1        = $this->reducir($data['imagenes'][0], 100, 100, 80, $thumbnail1_);
                    //$this->base64_to_png($thum1, $thumbnail1_);
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
            $datos = Usuarios::find($data['usuarioid']);
            if($imgpath1_!=""){
                $datos->verificacion_3      = "2";
                $datos->verificacion_3_ruta  = $imgpath1_;
            }
            $datos->save();
            return response()->json([
                'code'=>200                   
            ],200);
        }//fin function
        public function perfilverificar4(Request $request){
            $data = $request->json()->all();
            if(isset($data['imagenes'][0])){
                $cantidad_caracteres = strlen($data['imagenes'][0]);
                if($cantidad_caracteres>150){
                    $imgpath1  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_1.webp";
                    $imgpath1_ = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_1.webp";
                    $img_reducir1 = $this->reducir($data['imagenes'][0], 1200, 1200, 100, $imgpath1);
                    //$this->base64_to_png($img_reducir1, $imgpath1);

                    
                    $imgpath2  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_2.webp";
                    $imgpath2_ = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_2.webp";
                    $img_reducir2 = $this->reducir($data['imagenes'][0], 170, 170, 80, $imgpath2);
                    //$this->base64_to_png($img_reducir2, $imgpath2);

                    
                    $thumbnail1_  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_1.webp";
                    $thumbnail1   = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_1.webp";
                    $thum1        = $this->reducir($data['imagenes'][0], 100, 100, 80, $thumbnail1_);
                    //$this->base64_to_png($thum1, $thumbnail1_);
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
            $datos = Usuarios::find($data['usuarioid']);
            if($imgpath1_!=""){
                $datos->verificacion_4       = "2";
                $datos->verificacion_4_date  = date('Y-m-d');
                $datos->verificacion_4_ruta  = $imgpath1_;
            }
            $datos->save();
            return response()->json([
                'code'=>200                   
            ],200);
        }//fin function
        public function perfilverificar5(Request $request){
            $data = $request->json()->all();
            if(isset($data['imagenes'][0])){
                $cantidad_caracteres = strlen($data['imagenes'][0]);
                if($cantidad_caracteres>150){
                    $imgpath1  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_1.webp";
                    $imgpath1_ = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_1.webp";
                    $img_reducir1 = $this->reducir($data['imagenes'][0], 1200, 1200, 100, $imgpath1);
                    //$this->base64_to_png($img_reducir1, $imgpath1);

                    
                    $imgpath2  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_2.webp";
                    $imgpath2_ = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_2.webp";
                    $img_reducir2 = $this->reducir($data['imagenes'][0], 170, 170, 80, $imgpath2);
                    //$this->base64_to_png($img_reducir2, $imgpath2);

                    
                    $thumbnail1_  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_1.webp";
                    $thumbnail1   = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_1.webp";
                    $thum1        = $this->reducir($data['imagenes'][0], 100, 100, 80, $thumbnail1_);
                    //$this->base64_to_png($thum1, $thumbnail1_);
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
            $datos = Usuarios::find($data['usuarioid']);
            if($imgpath1_!=""){
                $datos->verificacion_5      = "2";
                $datos->verificacion_5_ruta  = $imgpath1_;
            }
            $datos->save();
            return response()->json([
                'code'=>200                   
            ],200);
        }//fin function
//FIN DE VERIFICACIONES DE IDENTIDAD

    
   
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
                    $subject  = 'Código de verificación';
                    $email    = $data['email'];
                    $mensaje  = "Estimado/a ".$datos->nombres." ".$datos->apellidos." Para restablecer su contraseña, ingrese el siguiente código de verificación cuando se le indique:";
                    $mensaje2 = $codigo_veri;
                    $d = ['mensaje'=> $mensaje, 'mensaje2'=>$mensaje2];
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
