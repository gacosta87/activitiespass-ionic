import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController } from '@ionic/angular';
 
import { GooglePlus } from '@ionic-native/google-plus/ngx';
import { FacebookLoginResponse, Facebook} from "@ionic-native/facebook/ngx";
import { Instagram } from '@ionic-native/instagram/ngx';
import { Usuario } from '../../providers/usuario';

@Component({
  selector: 'app-perfilregistro',
  templateUrl: 'perfilregistro.html',
  styleUrls: ['perfilregistro.scss'],
  providers:[Usuario, GooglePlus, Facebook, Instagram ]
})

export class Perfilregistro  implements  OnInit{
  //public myForm: FormGroup;
  public loading: any;
  public usuarioid: string;

  public nombres: string;
  public apellidos: string;
  public role_ids: string;
  public claves = "";
  public sessionactiva = "";
  public version_exporar = "";
  public version_exporar_ios = "";
  public userData: any;
  public myForm = [];
  public t_push: string;
  public p_push: string;
  public u_push: string; 
  public iniciologin: string;
  public idiomapalabras: any;
  public p_idio = "";
  public latitudeusuario  = "";
  public longitudeusuario = "";
  public textcheckbox = false;
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
      this.version_exporar_ios = localStorage.getItem('VERSION_EXPORTAR_IOS');
      this.version_exporar     = localStorage.getItem('VERSION_EXPORTAR');
      this.conf_activacion     = localStorage.getItem('conf_activacion');
      this.sessionactiva       = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
  }
  informacion(var1){
        if(var1==1){
        this.navController.navigateForward('inforcondiciones');
      }else if(var1==2){
        this.navController.navigateForward('inforpoliticas');
      }else if(var1==3){
        this.navController.navigateForward('loginrecuperar1');
      }else if(var1==4 && this.version_exporar_ios=='2'){
        this.navController.navigateForward('login1');
      }else if(var1==4){
        this.navController.navigateForward('perfilinicio');
      }
  }
  googleSignIn(){

      if(this.textcheckbox==false){

            const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                subHeader: this.idiomapalabras.aviso,
                  message: this.idiomapalabras.avisotermino,
                  buttons: [
                    {
                      text: "Ok", 
                      role: 'cancel'
                    }
                  ]
              }).then(alert => alert.present());

      }else{


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
                                                  //alert(JSON.stringify(response));
                                                  this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                                      if(response['code']=='200'){
                                                            //alert(JSON.stringify(response));
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
                                                            localStorage.setItem('INICIOLOGIN', '1');
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
                                                            //this.navController.navigateForward("/principal/perfil"); //this.navController.navigateForward("/principal/perfil/"+cuentaperfil);
                                                            if(response['registrado']=="2"){
                                                                    this.navController.navigateRoot("/principal/perfil");
                                                            }else{
                                                                    if(response['datos']['foto_35']!='' && response['datos']['foto_35']!=null){
                                                                              
                                                                              this.navController.navigateRoot('perfilregistrocompletar2/2');
                                                                    }else{
                                                                              
                                                                              //this.navController.navigateRoot('perfilregistrocompletar1/2'); 
                                                                              this.navController.navigateRoot('perfilregistrocompletar2/2'); 
                                                                    }  
                                                            }                                          
                                                      }else if (response['code']=='201'){
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
                                              //alert('error'+JSON.stringify(e));
                                          });//FIN LOADING DISS
                                    });
                    });//FIn LOADING 
      }//fin if
  }
  facebookSignIn(){

    if(this.textcheckbox==false){

            const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                subHeader: this.idiomapalabras.aviso,
                  message: this.idiomapalabras.avisotermino,
                  buttons: [
                    {
                      text: "Ok", 
                      role: 'cancel'
                    }
                  ]
              }).then(alert => alert.present());

      }else{
                  const loader = this.loadingCtrl.create({
                    ////duration: 10000
                    //message: "Un momento, por favor..."
                  }).then(load => {
                                  load.present();
                                        this.fb.login(['whatsapp_business_management', 'whatsapp_business_messaging', 'pages_messaging', 'instagram_manage_messages', 'instagram_manage_comments', 'instagram_basic'])
                                        .then((res: FacebookLoginResponse) => {
                                              this.fb.api('me?fields=' + ['name', 'email', 'first_name', 'last_name', 'picture.type(large)'].join(), null)
                                              .then((res2: any) => {
                                                        this.userData = res2;
                                                        //alert(res2);
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
                                                                        //this.navController.navigateForward("/principal/perfil"); //this.navController.navigateForward("/principal/perfil/"+cuentaperfil);
                                                                        //this.navController.navigateRoot('perfilregistrocompletar1/2');
                                                                        if(response['registrado']=="2"){
                                                                                this.navController.navigateRoot("/principal/perfil");
                                                                        }else{
                                                                                if(response['datos']['foto_35']!='' && response['datos']['foto_35']!=null){
                                                                               
                                                                                         this.navController.navigateRoot('perfilregistrocompletar2/2');
                                                                                }else{
                                                                                      
                                                                                          //this.navController.navigateRoot('perfilregistrocompletar1/2');  
                                                                                          this.navController.navigateRoot('perfilregistrocompletar2/2');
                                                                                
                                                                                }  
                                                                        }
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
                                                        //alert('error'+JSON.stringify(e));
                                                    });//FIN LOADING DISS
                                              });
                                  }).catch(e => {
                                        this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                            console.info('Error logging into Facebook', e);
                                            //alert('error'+JSON.stringify(e));
                                        });//FIN LOADING DISS
                                  });
                  });//FIn LOADING 
      }
  }
  instagramSignIn(){
    
  }
  emailSignIn(){
       
      if(this.textcheckbox==false){

            const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                subHeader: this.idiomapalabras.aviso,
                  message: this.idiomapalabras.avisotermino,
                  buttons: [
                    {
                      text: "Ok", 
                      role: 'cancel'
                    }
                  ]
              }).then(alert => alert.present());

      }else{

            this.navController.navigateForward("registro1");

      }

       

       
  }
  enviarformulario(){

  }//FIN FUNCTION
}//FIN CLASS
