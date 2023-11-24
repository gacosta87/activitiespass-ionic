import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController } from '@ionic/angular';
 
import { GooglePlus } from '@ionic-native/google-plus/ngx';
import {FacebookLoginResponse, Facebook} from "@ionic-native/facebook/ngx";
import { Instagram } from '@ionic-native/instagram/ngx';

import { Usuario } from '../../providers/usuario';

@Component({
  selector: 'app-login1',
  templateUrl: 'login1.html',
  styleUrls: ['login1.scss'],
  providers:[Usuario, GooglePlus, Facebook, Instagram]
})

export class Login1 implements  OnInit{
  public myForm: FormGroup;
  public loading: any;
  public nombres: string;
  public apellidos: string;
  public role_ids: string;
  public claves = "";
  public sessionactiva = "";
  public t_push: string;
  public p_push: string;
  public u_push: string;
  public p_idio = "";
  public idiomapalabras: any;
  public latitudeusuario  = "";
  public longitudeusuario = "";
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
          public providers: Usuario
  			  ) {
      this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
      this.myForm = this.formBuilder.group({
          usuario: new FormControl('', Validators.compose([ 
                              Validators.required
                              ])
                   ),
          clave: new FormControl('', Validators.compose([ 
                              Validators.required
                              ])
                   )
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
          console.log('ver', loader);
        //  loader.dismiss();
        }
      });
    } 
  ionViewDidEnter(){ 

      //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
      localStorage.setItem('OPCIONMENU', '4');
      this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      
  }
  enviarformulario(){
          const loader = this.loadingCtrl.create({
            ////duration: 10000
            //message: "Un momento, por favor..."
          }).then(load => {
                    load.present();
                    this.providers.login1(this.myForm.value).subscribe((response) => {  
                                this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                        if(response['code']==200){
                                              localStorage.setItem('IDUSER',           response['datos']['id']);
                                              localStorage.setItem('NOMBRESAPELLIDOS', response['datos']['nombre_apellido']);
                                              localStorage.setItem('TIPOUSUARIO',      response['datos']['role_id']);
                                              localStorage.setItem('USUARIO',          response['datos']['username']);
                                              localStorage.setItem('MYCARID',          response['datos']['mycar_id']);
                                              localStorage.setItem('FOTOPERFIL',       response['datos']['foto_35']);
                                              localStorage.setItem('NUEVA_INFORMACION_PERFIL', '2');
                                              localStorage.setItem('NUEVA_INFORMACION_PERFIL_INICIO', '2');
                                              localStorage.setItem('NUEVA_INFORMACION_PERFIL_BUSCAR', '2');
                                              //localStorage.setItem('TokenInstalacion', response['token']);
                                              localStorage.setItem('INICIOLOGIN', '3');
                                              localStorage.setItem('SESSIONACTIVA_OLYMPUS_9','true');
                                              localStorage.removeItem('data_inicio2');
                                              this.t_push = localStorage.getItem('T_PUSH');
                                              this.p_push = localStorage.getItem('P_PUSH');
                                              this.p_idio = localStorage.getItem('P_IDIO');
                                              this.latitudeusuario  = JSON.parse(localStorage.getItem('latitudeusuario'));
                                              this.longitudeusuario = JSON.parse(localStorage.getItem('longitudeusuario'));
                                              this.providers.actualizarpush(this.t_push, this.p_push, response['datos']['id'], this.p_idio, this.latitudeusuario, this.longitudeusuario).subscribe((response2) => {});
                                              //this.navController.navigateRoot("/principal/perfil");
                                              this.navController.navigateRoot('obtenerPerfilesUsuario'); 
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
  recuperar(){
      this.navController.navigateForward('loginrecuperar1');
  }
  
}//FIN CLASS
