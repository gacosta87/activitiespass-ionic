import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController } from '@ionic/angular';
 
import { GooglePlus } from '@ionic-native/google-plus/ngx';
import {FacebookLoginResponse, Facebook} from "@ionic-native/facebook/ngx";
import { Instagram } from '@ionic-native/instagram/ngx';
import { ActivatedRoute, Params } from '@angular/router';
import { Usuario } from '../../providers/usuario';

@Component({
  selector: 'app-perfilverificar2',
  templateUrl: 'perfilverificar2.html',
  styleUrls: ['perfilverificar2.scss'],
  providers:[Usuario, GooglePlus, Facebook, Instagram]
})

export class Perfilverificar2  implements  OnInit{
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
  public opcionnavegacion = "";
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
          private provider_usuario: Usuario, 
          private rutaActiva: ActivatedRoute,
          private fb: Facebook,
          private googlePlus: GooglePlus,
          private instagram: Instagram,
          private platform: Platform,
  			  public alertCtrl: AlertController,
  			  public loadingCtrl: LoadingController
  			  ) {
                this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
                this.myForm = this.formBuilder.group({
                      codigo_recuperacion: new FormControl('', Validators.compose([ 
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
  omitir(){
        let cuentaperfil = "0";
        let cuentaperfil2 = 0;
        cuentaperfil = localStorage.getItem('CUENTAPERFIL');
        cuentaperfil2 = parseInt(cuentaperfil) + 1;
        localStorage.setItem('CUENTAPERFIL', cuentaperfil2+"");
        this.navController.navigateRoot("/principal/perfil"); //this.navController.navigateForward("/principal/perfil/"+cuentaperfil);
  }
  regresar(){
    this.navController.navigateRoot("/perfilverificar");
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
      this.usuarioid        = localStorage.getItem('IDUSER');
      this.opcionnavegacion = this.rutaActiva.snapshot.paramMap.get('id');
      this.provider_usuario.perfilverificar2(this.usuarioid).subscribe((response) => {  });//FIN POST
  }
  enviarformulario(){
    const loader = this.loadingCtrl.create({
      ////duration: 10000
      //message: "Un momento, por favor..."
    }).then(load => {
              load.present();
              this.provider_usuario.perfilverificar2_1(this.usuarioid, this.myForm.value).subscribe((response) => {  
                          this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                        if(response['code']==200){
                                            this.navController.navigateForward('/perfilverificar3');
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
                                            //this.ionViewDidEnter();
                                        }
                                    }
                                  ]
                              }).then(alert => alert.present());
                  });//FIN LOADING DISS
              });//FIN POST
        });//FIn LOADING
  }//FIN FUNCTION
}//FIN CLASS
