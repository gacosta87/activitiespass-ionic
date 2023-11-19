import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController } from '@ionic/angular';
 
import { GooglePlus } from '@ionic-native/google-plus/ngx';
import {FacebookLoginResponse, Facebook} from "@ionic-native/facebook/ngx";
import { Instagram } from '@ionic-native/instagram/ngx';

import { Usuario } from '../../providers/usuario';

@Component({
  selector: 'app-registro3',
  templateUrl: 'registro3.html',
  styleUrls: ['registro3.scss'],
  providers:[Usuario, GooglePlus, Facebook, Instagram]
})

export class Registro3 implements  OnInit{
  public myForm: FormGroup;
  public loading: any;
  public usuarioid: string;

  public nombres: string;
  public apellidos: string;
  public role_ids: string;
  public claves = "";
  public sessionactiva = "";
  public usuario = "";
  public email = "";
  public clave = "";
  public idiomapalabras: any;
  public t_push: string;
  public p_push: string;
  public u_push: string; 
  public p_idio = "";
  public latitudeusuario  = "";
  public longitudeusuario = "";
  public auxenvio = "";
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
  public fechar = "";
  constructor(public navController: NavController,
  			  public formBuilder: FormBuilder,
  			  private router: Router, 
          private provider_usuario: Usuario, 
          private fb: Facebook,
          private googlePlus: GooglePlus,
          private instagram: Instagram,
          private platform: Platform,
  			  public alertCtrl: AlertController,
  			  public loadingCtrl: LoadingController
  			  ) {
    this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
    this.myForm = this.formBuilder.group({
          fechanacimiento: new FormControl('', Validators.compose([ 
                                  Validators.required
                              ])
                   ),
      });
	  	
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
      this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      this.email         = localStorage.getItem('EMAIL');
      this.clave         = localStorage.getItem('CLAVEREGISTRO2');
      
  }
  enviarformulario(){

    if(this.auxenvio!=this.myForm.value.fechanacimiento){
              this.auxenvio=this.myForm.value.fechanacimiento;
              const loader = this.loadingCtrl.create({
                ////duration: 10000
                //message: "Un momento, por favor..."
              }).then(load => {
                        load.present();
                        this.myForm.value['nombre']    = "";  
                        this.myForm.value['apellido']  = "";
                        this.myForm.value['tipo']      = "3";
                        this.myForm.value['foto']      = "";
                        this.myForm.value['fotourl']   = "";
                        this.myForm.value['clave']     = this.clave;
                        this.provider_usuario.loginregistronacimiento(this.email, this.myForm.value).subscribe((response) => {  
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
                                                        this.navController.navigateRoot('perfilregistrocompletar1/2');
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

                                            }else if (response['code']==202){
                                                        let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                                        botonEnvio.removeAttribute('disabled');
                                                        const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                          subHeader: this.idiomapalabras.aviso,
                                                            message: this.idiomapalabras.fechanacimientomenor,
                                                            buttons: [
                                                              {
                                                                text: "Ok", 
                                                                role: 'cancel'
                                                              }
                                                            ]
                                                        }).then(alert => alert.present());
                                            }//Fin else
                                    });//FIN LOADING DISS
                        },error => {
                              this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();}
                                        const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                            subHeader: this.idiomapalabras.aviso,
                                            message: this.idiomapalabras.noservidor,
                                            buttons: [
                                              {
                                                  text: this.idiomapalabras.reintentar,
                                                  role: 'cancel',
                                                  cssClass:'ion-aceptar',
                                                  handler: data => {
                                                      this.ionViewDidEnter();
                                                  }
                                              }
                                            ]
                                        }).then(alert => alert.present());
                            });//FIN LOADING DISS
                        });//FIN POST
                  });//FIn LOADING
    }//inf if
  }//FIN FUNCTION


  enviarformularioomitir(){
    console.log(this.auxenvio);
              this.auxenvio=this.myForm.value.fechanacimiento;
              const loader = this.loadingCtrl.create({
                ////duration: 10000
                //message: "Un momento, por favor..."
              }).then(load => {
                        load.present();
                        this.myForm.value['nombre']    = "";  
                        this.myForm.value['apellido']  = "";
                        this.myForm.value['tipo']      = "3";
                        this.myForm.value['foto']      = "";
                        this.myForm.value['fotourl']   = "";
                        this.myForm.value['clave']     = this.clave;
                        this.myForm.value['fechanacimiento'] = '2000-10-10';
                        this.provider_usuario.loginregistronacimiento(this.email, this.myForm.value).subscribe((response) => {  
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
                                                        this.navController.navigateRoot('perfilregistrocompletar1/2');
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

                                            }else if (response['code']==202){
                                                        let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                                        botonEnvio.removeAttribute('disabled');
                                                        const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                          subHeader: this.idiomapalabras.aviso,
                                                            message: this.idiomapalabras.fechanacimientomenor,
                                                            buttons: [
                                                              {
                                                                text: "Ok", 
                                                                role: 'cancel'
                                                              }
                                                            ]
                                                        }).then(alert => alert.present());
                                            }//Fin else
                                    });//FIN LOADING DISS
                        },error => {
                              this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();}
                                        const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                            subHeader: this.idiomapalabras.aviso,
                                            message: this.idiomapalabras.noservidor,
                                            buttons: [
                                              {
                                                  text: this.idiomapalabras.reintentar,
                                                  role: 'cancel',
                                                  cssClass:'ion-aceptar',
                                                  handler: data => {
                                                      this.ionViewDidEnter();
                                                  }
                                              }
                                            ]
                                        }).then(alert => alert.present());
                            });//FIN LOADING DISS
                        });//FIN POST
                  });//FIn LOADING
  }//FIN FUNCTION



  informacion(var1){
        if(var1==1){
        this.navController.navigateForward('inforcondiciones');
      }else if(var1==2){
        this.navController.navigateForward('inforpoliticas');
      }else if(var1==3){
        this.navController.navigateForward('loginrecuperar1');
      }
  }
  
}//FIN CLASS
