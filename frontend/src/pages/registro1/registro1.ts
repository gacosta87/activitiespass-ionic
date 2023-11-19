import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController } from '@ionic/angular';
 
import { GooglePlus } from '@ionic-native/google-plus/ngx';
import {FacebookLoginResponse, Facebook} from "@ionic-native/facebook/ngx";
import { Instagram } from '@ionic-native/instagram/ngx';

import { Usuario } from '../../providers/usuario';

@Component({
  selector: 'app-registro1',
  templateUrl: 'registro1.html',
  styleUrls: ['registro1.scss'],
  providers:[Usuario, GooglePlus, Facebook, Instagram]
})

export class Registro1 implements  OnInit {
  public myForm: FormGroup;
  public loading: any;
  public usuarioid: string;

  public nombres: string;
  public apellidos: string;
  public role_ids: string;
  public claves = "";
  public sessionactiva = "";
  public usuario = "";
  public idiomapalabras: any;
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
          private fb: Facebook,
          private googlePlus: GooglePlus,
          private instagram: Instagram,
          private platform: Platform,
  			  public alertCtrl: AlertController,
  			  public loadingCtrl: LoadingController
  			  ) {
    this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
    this.myForm = this.formBuilder.group({
          email: new FormControl('', Validators.compose([ 
                              Validators.required,
                              Validators.email
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
      
  }
  enviarformulario(){
    const loader = this.loadingCtrl.create({
      ////duration: 10000
      //message: "Un momento, por favor..."
    }).then(load => {
              load.present();
              this.provider_usuario.loginemail(this.myForm.value).subscribe((response) => {  
                          this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                  if(response['code']==200){
                                            localStorage.setItem('EMAIL', response['email']);  
                                            this.navController.navigateForward('registro2');
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
                    //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();}
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
                  //});//FIN LOADING DISS
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
