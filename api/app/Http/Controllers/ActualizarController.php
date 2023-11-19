<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Usuarios;
use \App\Models\Usuarios2;
use \App\Models\Mycars;
use \App\Models\Publicaciones;
use \App\Models\Promociones;

use \App\module;

use DB;
use Mail;
use DateTime;

use App\Http\Controllers\Controller;

class ActualizarController extends Controller
{   


		public function reducir($foto="", $WIDTH=350, $HEIGHT=350, $QUALITY=100, $ruta="" ) {
	          if($foto!=""){
	          	  $extension = pathinfo($foto, PATHINFO_EXTENSION);
	              if($extension=="webp"){
	              				$theme_image_little    = imagecreatefromwebp($foto);
	              }else if($extension=="jpg"){
	              				$theme_image_little    = imagecreatefromjpeg($foto);
	              }
	              
	              if($theme_image_little !== false) {
	                    $org_w = imagesx($theme_image_little);
	                    $org_h = imagesy($theme_image_little);
	                    $image_little           = imagecreatetruecolor($WIDTH, $HEIGHT);
	                    imageinterlace($theme_image_little, true);
	                    imageinterlace($image_little, true);
	                    imagecopyresampled($image_little, $theme_image_little, 0, 0, 0, 0, $WIDTH, $HEIGHT, $org_w, $org_h);
	                    imagewebp($image_little, $ruta, $QUALITY);
	                    return "1";
	              }else{
	                 return "2";
	              }
	              return "3";
	          }else{
	              return "4";
	          }
	    }

	    
	    public function actualizarfotospost(Request $request, $id=null){
	    		$data = $request->json()->all();
	    		$data['id'] = $id;
	    		$nuevo_id = 0;
	    		if($data['id']=="0"){
        			$datos = Publicaciones::where('id', 730)->orderBy('id', 'asc')->get()->toArray();$var=1;
        		}else{
        			$nuevo_id = $data['id'] + 50;
        			$datos = Publicaciones::where('id', ">=", $data['id']  )->where('id', "<", $nuevo_id )->orderBy('id', 'asc')->get()->toArray();$var=1;
        		}
        		foreach($datos as $key){        						
	                            $paso = 1;
	                            $random = rand();

	                          	$data['mycarid']   = $key['mycar_id'];
	                          	$data['usuarioid'] = $key['usuario_id']."_".$random;

        						if($key['imagen_respaldo']!=""){
						                $imgpath1    = "";
						                $imgpath1_   = "";
						                $imgpath1_2  = "";
						                $thumbnail1  = "";

						                $imgpath1     = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H')."_1.webp";
						                $imgpath1_    = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H')."_1.webp";
						                $this->reducir($key['imagen_respaldo'], 500, 500, 80, $imgpath1);

						                
						                $imgpath1_1  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H')."_1_2.webp";
						                $imgpath1_2  = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H')."_1_2.webp";
						                $this->reducir($key['imagen_respaldo'], 250, 250, 80, $imgpath1_1);

						                
						                $thumbnail1_  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H')."th_1.webp";
						                $thumbnail1   = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H')."th_1.webp";
						                $this->reducir($key['imagen_respaldo'], 80, 80, 40, $thumbnail1_);
						        }else{
						                $imgpath1    = "";
						                $imgpath1_   = "";
						                $imgpath1_2  = "";
						                $thumbnail1  = "";
						        }
						        if($key['imagen_respaldo2']!=""){
						                      $imgpath2  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H')."_2.webp";
						                      $imgpath2_ = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H')."_2.webp";
						                      $this->reducir($key['imagen_respaldo2'], 500, 500, 80, $imgpath2);
						                      
						                      $thumbnail2_  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H')."th_2.webp";
						                      $thumbnail2   = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H')."th_2.webp";
						                      $this->reducir($key['imagen_respaldo2'], 80, 80, 40, $thumbnail2_);
						        }else{
						                $imgpath2    = "";
						                $imgpath2_   = "";
						                $thumbnail2  = "";
						        }
						        if($key['imagen_respaldo3']!=""){
						                      $imgpath3  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H')."_3.webp";
						                      $imgpath3_ = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H')."_3.webp";
						                      $this->reducir($key['imagen_respaldo3'], 500, 500, 80, $imgpath3);
						                      
						                      $thumbnail3_  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H')."th_3.webp";
						                      $thumbnail3   = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H')."th_3.webp";
						                      $this->reducir($key['imagen_respaldo3'], 80, 80, 40, $thumbnail3_);
						        }else{
						                $imgpath3    = "";
						                $imgpath3_   = "";
						                $thumbnail3  = "";
						        }
			        			$datos2 = Publicaciones::find($key['id']);
					            $datos2->imagen1      = $imgpath1_;
					            $datos2->imagen1_m    = $imgpath1_2;
					            $datos2->imagen2      = $imgpath2_;
					            $datos2->imagen3      = $imgpath3_;
					            $datos2->thumbnail1   = $thumbnail1;
					            $datos2->thumbnail2   = $thumbnail2;
					            $datos2->thumbnail3   = $thumbnail3;
					            $datos2->save();
        		}//fin foreache
	    		if($nuevo_id>=1750){
	            	return response()->json([
			                                  'msg'   => 'Los datos fueron guardados',
			                                  'code'  => $var,
			                                  'id'    => $data['id']
			                              ],200);
	           	}else{
	           		return redirect('https://apimymotors.olympusapp.es/public/api/actualizarfotospost/'.$nuevo_id);
	           	}
	    }//fin function

	    public function actualizarfotosusuarios(Request $request, $id=null){
        		$data = $request->json()->all();
        		$reducir1 = "0";
        		$reducir2 = "0";
        		$reducir3 = "0";
        		$reducir4 = "0";
        		$reducir5 = "0";
        		$reducir6 = "0";
        		$reducir7 = "0";
        		$data['foto'] = "";
        		$data['id'] = $id;

        		if($data['id']==1000){
        			$datos = Usuarios2::where('id', 69)->orderBy('id', 'asc')->get()->toArray();$var=1;
        		}
        		
        		if($data['id']==1){
        			$datos = Usuarios2::where('id', ">=", "0"  )->where('id', "<", "100")->orderBy('id', 'asc')->get()->toArray();$var=1;
        		}else if($data['id']==2){
        			$datos = Usuarios2::where('id', ">=", "100")->where('id', "<", "150")->orderBy('id', 'asc')->get()->toArray();$var=2;
        		}else if($data['id']==3){
    	    		$datos = Usuarios2::where('id', ">=", "150")->where('id', "<", "200")->orderBy('id', 'asc')->get()->toArray();$var=3;
        		}else if($data['id']==4){
	        		$datos = Usuarios2::where('id', ">=", "200")->where('id', "<", "250")->orderBy('id', 'asc')->get()->toArray();$var=4;
        		}else if($data['id']==5){
        			$datos = Usuarios2::where('id', ">=", "250")->where('id', "<", "300")->orderBy('id', 'asc')->get()->toArray();$var=5;
        		}else if($data['id']==6){
        			$datos = Usuarios2::where('id', ">=", "300")->where('id', "<", "350")->orderBy('id', 'asc')->get()->toArray();$var=6;
        		}else if($data['id']==7){
        			$datos = Usuarios2::where('id', ">=", "350")->where('id', "<", "400")->orderBy('id', 'asc')->get()->toArray();$var=7;
        		}else if($data['id']==8){
        			$datos = Usuarios2::where('id', ">=", "400")->where('id', "<","450")->orderBy('id', 'asc')->get()->toArray();$var=8;
        		}else if($data['id']==9){
        			$datos = Usuarios2::where('id', ">=", "450")->where('id', "<","500")->orderBy('id', 'asc')->get()->toArray();$var=9;
        		}else if($data['id']==10){
        			$datos = Usuarios2::where('id', ">=", "500")->where('id', "<","550")->orderBy('id', 'asc')->get()->toArray();$var=10;
        		}else if($data['id']==11){
        			$datos = Usuarios2::where('id', ">=", "550")->where('id', "<","600")->orderBy('id', 'asc')->get()->toArray();$var=11;
        		}else if($data['id']==12){
        			$datos = Usuarios2::where('id', ">=", "600")->where('id', "<","650")->orderBy('id', 'asc')->get()->toArray();$var=12;
        		}else if($data['id']==13){
        			$datos = Usuarios2::where('id', ">=", "650")->where('id', "<","700")->orderBy('id', 'asc')->get()->toArray();$var=13;
        		}else if($data['id']==14){
        			$datos = Usuarios2::where('id', ">=", "700")->where('id', "<","750")->orderBy('id', 'asc')->get()->toArray();$var=14;
        		}else if($data['id']==15){
        			$datos = Usuarios2::where('id', ">=", "750")->where('id', "<","800")->orderBy('id', 'asc')->get()->toArray();$var=15;
        		}else if($data['id']==16){
        			$datos = Usuarios2::where('id', ">=", "800")->where('id', "<","850")->orderBy('id', 'asc')->get()->toArray();$var=16;
				}else if($data['id']==17){
        			$datos = Usuarios2::where('id', ">=", "850")->where('id', "<","900")->orderBy('id', 'asc')->get()->toArray();$var=17;
        		}else if($data['id']==18){
        			$datos = Usuarios2::where('id', ">=", "900")->where('id', "<","950")->orderBy('id', 'asc')->get()->toArray();$var=18;
        		}else if($data['id']==19){
        			$datos = Usuarios2::where('id', ">=", "950")->where('id', "<","1000")->orderBy('id', 'asc')->get()->toArray();$var=19;
        		}else if($data['id']==20){
        			$datos = Usuarios2::where('id', ">=", "1000")->where('id', "<","1050")->orderBy('id', 'asc')->get()->toArray();$var=20;
        		}else if($data['id']==21){
        			$datos = Usuarios2::where('id', ">=", "1050")->where('id', "<","1100")->orderBy('id', 'asc')->get()->toArray();$var=21;
        		}else if($data['id']==22){
        			$datos = Usuarios2::where('id', ">=", "1100")->where('id', "<","1150")->orderBy('id', 'asc')->get()->toArray();$var=22;
        		}else if($data['id']==23){
        			$datos = Usuarios2::where('id', ">=", "1150")->where('id', "<","1200")->orderBy('id', 'asc')->get()->toArray();$var=23;
        		}else if($data['id']==24){
        			$datos = Usuarios2::where('id', ">=", "1200")->where('id', "<","1250")->orderBy('id', 'asc')->get()->toArray();$var=24;
        		}else if($data['id']==25){
        			$datos = Usuarios2::where('id', ">=", "1250")->where('id', "<","1300")->orderBy('id', 'asc')->get()->toArray();$var=25;
        		}else if($data['id']==26){
        			$datos = Usuarios2::where('id', ">=", "1300")->where('id', "<","1350")->orderBy('id', 'asc')->get()->toArray();$var=26;  
        		}else if($data['id']==27){
        			$datos = Usuarios2::where('id', ">=", "1350")->where('id', "<","1400")->orderBy('id', 'asc')->get()->toArray();$var=27;
        		}else if($data['id']==28){
        			$datos = Usuarios2::where('id', ">=", "1400")->where('id', "<","1450")->orderBy('id', 'asc')->get()->toArray();$var=28;
        		}else if($data['id']==29){
        			$datos = Usuarios2::where('id', ">=", "1450")->where('id', "<","1500")->orderBy('id', 'asc')->get()->toArray();$var=29;
        		}else if($data['id']==30){
        			$datos = Usuarios2::where('id', ">=", "1500")->where('id', "<","1550")->orderBy('id', 'asc')->get()->toArray();$var=30;
        		}else if($data['id']==31){
        			$datos = Usuarios2::where('id', ">=", "1550")->where('id', "<","1600")->orderBy('id', 'asc')->get()->toArray();$var=31;      			
        	    }
        		foreach($datos as $key){
        						$theme_image_enc_little = "";
	                            $imgpath1_ = "";
	                            $imgpath2_ = "";
	                            $thumbnail1 = "";

	                            $foto_144 = "";
	                            $foto_35  = "";
	                            $foto_77  = "";
	                            $foto_62  = "";
	                            $paso = 1;
	                            $random = rand();

	                            if(!isset($key['mycar_id'])){$key['mycar_id']=$key['id'];}
	                          	$data['foto']      = $key['foto'];
	                          	$data['username']  = $key['id'].$key['mycar_id'].$random;
	                          	$data['mycar_id']  = $key['mycar_id'];
	                          	$data['usuarioid'] = $key['id'];

        						if($key['foto']!=""){
        										$paso = 2;
					                          	$cantidad_caracteres = strlen($data['foto']);
		                            			$paso = 3;
				                                $imgpath1  = storage_path('imagenes')."/".$data['username'].date('Y-m-d-H')."_1.webp";
				                                $imgpath1_ = env('APP_URL_IMAGEN')."/".$data['username'].date('Y-m-d-H')."_1.webp";
				                                $reducir1   = $this->reducir($data['foto'], 700, 700, 80, $imgpath1);
				                                
				                                $imgpath2  = storage_path('imagenes')."/".$data['username'].date('Y-m-d-H')."_2.webp";
				                                $imgpath2_ = env('APP_URL_IMAGEN')."/".$data['username'].date('Y-m-d-H')."_2.webp";
				                                $reducir2   = $this->reducir($data['foto'], 150, 150, 80, $imgpath2);
				                                
				                                $thumbnail1_  = storage_path('imagenes')."/".$data['username'].date('Y-m-d-H')."th_1.webp";
				                                $thumbnail1   = env('APP_URL_IMAGEN')."/".$data['username'].date('Y-m-d-H')."th_1.webp";
				                                $reducir3      = $this->reducir($data['foto'], 100, 100, 80, $thumbnail1_);

				                                $foto_144_  = storage_path('imagenes')."/".$data['username'].date('Y-m-d-H')."th_144.webp";
				                                $foto_144   = env('APP_URL_IMAGEN')."/".$data['username'].date('Y-m-d-H')."th_144.webp";
				                                $reducir4    = $this->reducir($data['foto'], 170, 170, 80, $foto_144_);

				                                $foto_35_  = storage_path('imagenes')."/".$data['username'].date('Y-m-d-H')."th_35.webp";
				                                $foto_35   = env('APP_URL_IMAGEN')."/".$data['username'].date('Y-m-d-H')."th_35.webp";
				                                $reducir5   = $this->reducir($data['foto'], 50, 50, 80, $foto_35_);

				                                $foto_77_  = storage_path('imagenes')."/".$data['username'].date('Y-m-d-H')."th_77.webp";
				                                $foto_77   = env('APP_URL_IMAGEN')."/".$data['username'].date('Y-m-d-H')."th_77.webp";
				                                $reducir6   = $this->reducir($data['foto'], 120, 120, 80, $foto_77_);

				                                $foto_62_  = storage_path('imagenes')."/".$data['username'].date('Y-m-d-H')."th_62.webp";
				                                $foto_62   = env('APP_URL_IMAGEN')."/".$data['username'].date('Y-m-d-H')."th_62.webp";
				                                $reducir7   = $this->reducir($data['foto'], 100, 100, 80, $foto_62_);
                        		}//fin if foto
                        					if(isset($key['mycar_id'])){
                        						$datos1 = Mycars::find($data['mycar_id']);
									            $datos1->foto1         = $imgpath1_;
									            $datos1->foto2         = $imgpath2_;
									            $datos1->foto_144      = $foto_144;
									            $datos1->foto_35       = $foto_35;
									            $datos1->foto_77       = $foto_77;
									            $datos1->foto_62       = $foto_62;
									            $datos1->thumbnail1    = $thumbnail1;
									            $datos1->save(); 
                        					}
                        						
							               
							        			$datos2 = Usuarios::find($data['usuarioid']);
									            $datos2->foto             = $imgpath1_;
									            $datos2->foto2            = $imgpath2_;
									            $datos2->thumbnail1       = $thumbnail1;
									            $datos2->foto_144         = $foto_144;
									            $datos2->foto_35          = $foto_35;
									            $datos2->foto_77          = $foto_77;
									            $datos2->foto_62          = $foto_62;
									            $datos2->save();
        		}//fin foreache

        	if($data['id']==31 || $data['id']==1000){
	            return response()->json([
		                                  'msg'   => 'Los datos fueron guardados',
		                                  'code'  => $var,
		                                  'id'    => $data['id']
		                                  //'code2'  => $paso,
		                                  //'reducir1'  => $reducir1,
		                                  //'reducir2'  => $reducir2,
		                                  //'reducir3'  => $reducir3,
		                                  //'reducir4'  => $reducir4,
		                                  //'reducir5'  => $reducir5,
		                                  //'reducir6'  => $reducir6,
		                                  //'reducir7'  => $reducir7,
		                                  //'foto'      => $data['foto']
		                              ],200);
           	}else{
           		$data['id']++;
           		return redirect('https://apimymotors.olympusapp.es/public/api/actualizarfotosusuarios/'.$data['id']);
           		//return redirect('actualizarfotosusuarios/dashboard');
           	}
    	}//fin function



    	public function actualizarfotosusuarios_respaldo(Request $request){
        		$data = $request->json()->all();
        		$reducir1 = "0";
        		$reducir2 = "0";
        		$reducir3 = "0";
        		$reducir4 = "0";
        		$reducir5 = "0";
        		$reducir6 = "0";
        		$reducir7 = "0";
        		$data['foto'] = "";
        		$datos = Usuarios2::orderBy('id', 'asc')->get()->toArray();$var=1;
        		foreach($datos as $key){
        						$theme_image_enc_little = "";
	                            $imgpath1_ = "";
	                            $imgpath2_ = "";
	                            $thumbnail1 = "";

	                            $foto_144 = "";
	                            $foto_35  = "";
	                            $foto_77  = "";
	                            $foto_62  = "";
	                            $paso = 1;
        						if($key['foto']!=""){
										$paso = 4;
	                        			$datos1 = Mycars::find($key['mycar_id']);
							            $datos1->foto1         = $key['foto'];
							            $datos1->foto2         = $key['foto2'];
							            $datos1->foto_144      = "";
							            $datos1->foto_35       = "";
							            $datos1->foto_77       = "";  
							            $datos1->foto_62       = "";
							            $datos1->thumbnail1    = $key['thumbnail1'];
							            $datos1->save(); 
					               
					        			$datos2 = Usuarios::find($key['id']);
							            $datos2->foto             = $key['foto'];
							            $datos2->foto2            = $key['foto2'];
							            $datos2->thumbnail1       = $key['thumbnail1'];
							            $datos2->foto_144         = "";
							            $datos2->foto_35          = "";
							            $datos2->foto_77          = "";
							            $datos2->foto_62          = "";
							            $datos2->save();
										        

                        		}//fin if foto
        		}//fin foreache
            return response()->json([
	                                  'msg'   => 'Los datos fueron guardados',
	                                  'code'  => $var,
	                                  'code2'  => $paso,
	                                  'reducir1'  => $reducir1,
	                                  'reducir2'  => $reducir2,
	                                  'reducir3'  => $reducir3,
	                                  'reducir4'  => $reducir4,
	                                  'reducir5'  => $reducir5,
	                                  'reducir6'  => $reducir6,
	                                  'reducir7'  => $reducir7,
	                                  'foto'      => $data['foto']
	                              ],200);
    	}//fin function

}
?>  
