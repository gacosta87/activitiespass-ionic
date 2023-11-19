import { Component, OnInit} from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController } from '@ionic/angular';
 
 import { GooglePlus } from '@ionic-native/google-plus/ngx';
import {FacebookLoginResponse, Facebook} from "@ionic-native/facebook/ngx";
import { Instagram } from '@ionic-native/instagram/ngx';

import { Usuario } from '../../providers/usuario';

@Component({
  selector: 'app-perfilinicio',
  templateUrl: 'perfilinicio.html',
  styleUrls: ['perfilinicio.scss'],
  providers:[Usuario, GooglePlus, Facebook, Instagram ]
})

export class Perfilinicio implements  OnInit{
  //public myForm: FormGroup;
  public loading: any;

  public nombres: string;
  public apellidos: string;
  public role_ids: string;
  public claves = "";
  public sessionactiva = "";
  public version_exporar = "";
  public version_exporar_ios = "";
  public userData: any;
  public idiomapalabras: any;
  public myForm = [];
  public t_push: string;
  public p_push: string;
  public u_push: string;
  public usuarioid: string;
  public iniciologin: string;
  public p_idio = "";
  public latitudeusuario  = "";
  public longitudeusuario = "";

  //CONFGURACION PARAMETROs
  public conf_activacion = '2';
  public salir_de_loading = new Promise((resolve, reject) => {
      this.loadingCtrl.getTop().then(loader => {
            if (loader!=undefined) {
                this.loadingCtrl.dismiss();
                resolve(123);
            }else{
                resolve(123);
            }
      });
  });
  constructor(public navController: NavController,
  			  public formBuilder: FormBuilder,
  			  private router: Router, 
          private fb: Facebook,
          private googlePlus: GooglePlus,
          private instagram: Instagram,
          private platform: Platform,
  			  public alertCtrl: AlertController,
  			  public loadingCtrl: LoadingController,
          private provider_usuario: Usuario
  			  ) {
          this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
          this.iniciologin = localStorage.getItem('INICIOLOGIN');
              if(this.iniciologin=='1'){this.googlePlus.logout();
        }else if(this.iniciologin=='2'){this.fb.logout();
        }else if(this.iniciologin=='3'){
        }
	  	
  }
 salirdecargando(){
      this.loadingCtrl.getTop().then(loader => {
        if (loader!=undefined) {
          console.log('sali',loader);
          this.loadingCtrl.dismiss();
        }
      });
  }
 

  ngOnInit() {
        this.loadingCtrl.getTop().then(loader => {
          if (loader!=undefined) {
            console.log('sali',loader);
            this.loadingCtrl.dismiss();
          }
        });
  }
  regresar(){
    this.navController.back();
  }
  ionViewWillLeave(){
    this.loadingCtrl.getTop().then(loader => {
      if (loader!=undefined) {
        console.log('sali',loader);
        //this.loadingCtrl.dismiss();
      }
    });
  }
  ionViewDidLeave(){
     this.loadingCtrl.getTop().then(loader => {
      if (loader!=undefined) {
       // loader.dismiss();
      } 
    });
  }
  ionViewDidEnter(){ 

      //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
      localStorage.setItem('OPCIONMENU', '4');  
      this.version_exporar     = localStorage.getItem('VERSION_EXPORTAR');
      this.version_exporar_ios = localStorage.getItem('VERSION_EXPORTAR_IOS');
      this.conf_activacion     = localStorage.getItem('conf_activacion');
      this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      this.usuarioid     = localStorage.getItem('IDUSER');
      if(this.sessionactiva!="true"){
                localStorage.removeItem('IDUSER');
                localStorage.removeItem('USUARIO');
                localStorage.removeItem('NOMBRESAPELLIDOS');
                localStorage.removeItem('SESSIONACTIVA_OLYMPUS_9');
                localStorage.removeItem('FOTOPERFIL'); 
                localStorage.removeItem('MYCARID');
                localStorage.removeItem('TIPOUSUARIO');
                localStorage.removeItem('data_perfil');
                localStorage.removeItem('lista_mensajes');
                localStorage.removeItem('data_inicio');
                localStorage.removeItem('data_inicio2');
                localStorage.removeItem('data_inicio2_solicitudes');    
                localStorage.removeItem('home_false_data_inicio_OLYMPUS_5');
                localStorage.removeItem('home_false_data_inicio2_OLYMPUS_5');  
                localStorage.removeItem('home_false_data_inicio2_solicitudes_OLYMPUS_5');   
                localStorage.removeItem('home_false_data_sin_registro_OLYMPUS_5');   
                localStorage.removeItem('data_sin_registro');   
                localStorage.removeItem('contarseguidos');   
                localStorage.setItem('SESSIONACTIVA_OLYMPUS_9','false');
                localStorage.setItem('NUEVA_INFORMACION_PERFIL', '2');
                localStorage.setItem('NUEVA_INFORMACION_PERFIL_INICIO', '2');
                localStorage.setItem('NUEVA_INFORMACION_PERFIL_BUSCAR', '2');
                localStorage.setItem('IDUSER','');
      }
  }
  informacion(var1){
        //this.navController.back();
        //this.navController.navigateForward("perfilregistro");
        if(var1==4 && this.conf_activacion=='2'){
          this.navController.navigateForward('login1');
        }else if(var1==4){
          this.navController.navigateForward('perfilregistro');
        }
  }
  googleSignIn(){
      const loader = this.loadingCtrl.create({
        ////duration: 10000
        //message: "Un momento, por favor..."
      }).then(load => {
                      load.present();
                      this.googlePlus.login({})
                        .then(result => {
                            this.userData = result;
                            //name: result.displayName,
                            //email: result.email,
                            //console.log(result); 
                            this.myForm['clave']     = ""; 
                            this.myForm['nombre']    = result.displayName;  
                            this.myForm['apellido']  = "";
                            this.myForm['tipo']      = "1";
                            this.myForm['foto']      = "";
                            this.myForm['fotourl']   = result.imageUrl;
                            this.provider_usuario.loginregistro(result.email, this.myForm).subscribe((response) => {    
                                this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                    if(response['code']==200){
                                          localStorage.setItem('IDUSER',           response['datos']['id']);
                                          localStorage.setItem('USUARIO',          response['datos']['username']);
                                          localStorage.setItem('MYCARID',          response['datos']['mycar_id']);
                                          localStorage.setItem('NOMBRESAPELLIDOS', response['datos']['nombre_apellido']);
                                          localStorage.setItem('TIPOUSUARIO',      response['datos']['role_id']);
                                          localStorage.setItem('FOTOPERFIL',       response['datos']['foto_35']);
                                          localStorage.setItem('SESSIONACTIVA_OLYMPUS_9',    'true');
                                          //localStorage.setItem('TokenInstalacion', response['token']);
                                          localStorage.setItem('INICIOLOGIN', '1');
                                          localStorage.setItem('NUEVA_INFORMACION_PERFIL', '2');
                                          localStorage.setItem('NUEVA_INFORMACION_PERFIL_INICIO', '2');
                                          localStorage.setItem('NUEVA_INFORMACION_PERFIL_BUSCAR', '2');
                                          localStorage.removeItem('data_inicio2');
                                          this.t_push = localStorage.getItem('T_PUSH');
                                          this.p_push = localStorage.getItem('P_PUSH');
                                          this.p_idio = localStorage.getItem('P_IDIO');
                                          this.latitudeusuario  = JSON.parse(localStorage.getItem('latitudeusuario'));
                                          this.longitudeusuario = JSON.parse(localStorage.getItem('longitudeusuario'));
                                          this.provider_usuario.actualizarpush(this.t_push, this.p_push, response['datos']['id'], this.p_idio, this.latitudeusuario, this.longitudeusuario).subscribe((response2) => {});
                                          let cuentaperfil = "0";
                                          let cuentaperfil2 = 0;
                                          cuentaperfil = localStorage.getItem('CUENTAPERFIL');
                                          cuentaperfil2 = parseInt(cuentaperfil) + 1;
                                          localStorage.setItem('CUENTAPERFIL', cuentaperfil2+"");
                                          this.navController.navigateRoot("/principal/perfil"); //this.navController.navigateForward("/principal/perfil/"+cuentaperfil);
                                    }else if (response['code']==201){
                                                const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                  subHeader: this.idiomapalabras.aviso,
                                                    message: response['msg'],
                                                    buttons: [
                                                      {
                                                        text: "Ok", 
                                                        role: 'cancel'
                                                      }
                                                    ]
                                                }).then(alert => alert.present());
                                    }//Fin else
                                });//FIN LOADING DISS
                            });//FIN POST 
                      }).catch(e => {
                            this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                console.info('Error logging into Gmail', e);
                                //alert(JSON.stringify(e));
                                //alert('error'+e);
                            });//FIN LOADING DISS
                      });
      });//FIn LOADING 
  }
  facebookSignIn(){
      const loader = this.loadingCtrl.create({
        ////duration: 10000
        //message: "Un momento, por favor..."
      }).then(load => {
                      load.present();
                            this.fb.login(['whatsapp_business_management', 'whatsapp_business_messaging', 'pages_messaging', 'instagram_manage_messages', 'instagram_manage_comments', 'instagram_basic'])
                            .then((res: FacebookLoginResponse) => {
                                  console.info('logging into facebookSignIn', res);
                                  this.fb.api('me?fields=' + ['name', 'email', 'first_name', 'last_name', 'picture.type(large)'].join(), null)
                                  .then((res2: any) => {
                                            this.userData = res2;
                                            //alert(res2);
                                            console.info('logging into facebookSignIn2', res2);
                                            this.myForm['clave']     = ""; 
                                            this.myForm['nombre']    = res2.name;  
                                            this.myForm['apellido']  = "";
                                            this.myForm['tipo']      = "2";
                                            this.myForm['foto']      = "";
                                            this.myForm['fotourl']   = res2.picture.data.url;
                                            this.provider_usuario.loginregistro(res2.email, this.myForm).subscribe((response) => {  
                                                this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();}
                                                      if(response['code']==200){
                                                            localStorage.setItem('IDUSER',           response['datos']['id']);
                                                            localStorage.setItem('USUARIO',          response['datos']['username']);
                                                            localStorage.setItem('MYCARID',          response['datos']['mycar_id']);
                                                            localStorage.setItem('NOMBRESAPELLIDOS', response['datos']['nombre_apellido']);
                                                            localStorage.setItem('TIPOUSUARIO',      response['datos']['role_id']);
                                                            localStorage.setItem('FOTOPERFIL',       response['datos']['foto_35']);
                                                            localStorage.setItem('SESSIONACTIVA_OLYMPUS_9',    'true');
                                                            localStorage.setItem('NUEVA_INFORMACION_PERFIL', '2');
                                                            localStorage.setItem('NUEVA_INFORMACION_PERFIL_INICIO', '2');
                                                            localStorage.setItem('NUEVA_INFORMACION_PERFIL_BUSCAR', '2');
                                                            //localStorage.setItem('TokenInstalacion', response['token']);
                                                            localStorage.setItem('INICIOLOGIN', '2');
                                                            localStorage.removeItem('data_inicio2');
                                                            this.t_push = localStorage.getItem('T_PUSH');
                                                            this.p_push = localStorage.getItem('P_PUSH');
                                                            this.p_idio = localStorage.getItem('P_IDIO');
                                                            this.latitudeusuario  = JSON.parse(localStorage.getItem('latitudeusuario'));
                                                            this.longitudeusuario = JSON.parse(localStorage.getItem('longitudeusuario'));
                                                            this.provider_usuario.actualizarpush(this.t_push, this.p_push, response['datos']['id'], this.p_idio, this.latitudeusuario, this.longitudeusuario).subscribe((response2) => {});
                                                            let cuentaperfil = "0";
                                                            let cuentaperfil2 = 0;
                                                            cuentaperfil = localStorage.getItem('CUENTAPERFIL');
                                                            cuentaperfil2 = parseInt(cuentaperfil) + 1;
                                                            localStorage.setItem('CUENTAPERFIL', cuentaperfil2+"");
                                                            //this.navController.navigateRoot("/principal/perfil"); //this.navController.navigateForward("/principal/perfil/"+cuentaperfil);
                                                      }else if (response['code']==201){
                                                                  const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                                    subHeader: this.idiomapalabras.aviso,
                                                                      message: response['msg'],
                                                                      buttons: [
                                                                        {
                                                                          text: "Ok", 
                                                                          role: 'cancel'
                                                                        }
                                                                      ]
                                                                  }).then(alert => alert.present());
                                                      }//Fin else
                                                });//FIN LOADING DISS
                                              
                                            });//FIN POST
                                  }).catch(e => {
                                        this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                            console.info('Error logging into Facebook', e);
                                            //alert('error'+e);
                                        });//FIN LOADING DISS
                                  });
                      }).catch(e => {
                            this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                console.info('Error logging into Facebook', e);
                                //alert('error'+e);
                            });//FIN LOADING DISS
                      });
      });//FIn LOADING 
  }
  instagramSignIn(){
    
  }
  emailSignIn(){
      this.navController.navigateForward("login1");
  }
  enviarformulario(){

  }//FIN FUNCTION
}//FIN CLASS
