import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController } from '@ionic/angular';
 
import { GooglePlus } from '@ionic-native/google-plus/ngx';
import {FacebookLoginResponse, Facebook} from "@ionic-native/facebook/ngx";
import { Instagram } from '@ionic-native/instagram/ngx';

import { Usuario } from '../../providers/usuario';

@Component({
  selector: 'app-registro2',
  templateUrl: 'registro2.html',
  styleUrls: ['registro2.scss'],
  providers:[Usuario, GooglePlus, Facebook, Instagram]
})

export class Registro2 implements  OnInit{
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
  public idiomapalabras: any;
  public t_push: string;
  public p_push: string;
  public u_push: string; 
  public p_idio = "";
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
          clave: new FormControl('', Validators.compose([ 
                              Validators.required,
                              Validators.maxLength(20),
                              Validators.minLength(8)
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
        //loader.dismiss();
      }
    });
  }
  ionViewDidEnter(){ 

      //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
      localStorage.setItem('OPCIONMENU', '4');  
      this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      this.email         = localStorage.getItem('EMAIL');
      
  }
  enviarformulario(){
              localStorage.setItem('CLAVEREGISTRO2', this.myForm.value.clave);
              this.navController.navigateForward("registro3");
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
