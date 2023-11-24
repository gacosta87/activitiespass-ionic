import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController } from '@ionic/angular';
 
import { GooglePlus } from '@ionic-native/google-plus/ngx';
import {FacebookLoginResponse, Facebook} from "@ionic-native/facebook/ngx";
import { Instagram } from '@ionic-native/instagram/ngx';
import { ActivatedRoute, Params } from '@angular/router';
import { Usuario } from '../../providers/usuario';
import { Home } from '../../providers/home';

@Component({
  selector: 'app-perfilregistrocompletar1',
  templateUrl: 'perfilregistrocompletar1.html',
  styleUrls: ['perfilregistrocompletar1.scss'],
  providers:[Usuario, Home, GooglePlus, Facebook, Instagram]
})

export class Perfilregistrocompletar1   implements  OnInit{
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
  public datos_categorias: any;
  public p_idioma = "es";
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
          public provider_home: Home,
          private googlePlus: GooglePlus,
          private instagram: Instagram,
          private platform: Platform,
  			  public alertCtrl: AlertController,
  			  public loadingCtrl: LoadingController
  			  ) {
                this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
                this.myForm = this.formBuilder.group({
                      categoria_id: new FormControl('1', Validators.compose([ 
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
        //this.navController.navigateRoot("/principal/perfil"); 
        this.navController.navigateRoot('obtenerPerfilesUsuario'); 
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
      this.p_idioma   = localStorage.getItem('P_IDIO');
      this.provider_home.categorias(this.p_idioma).subscribe((response) => {  
          this.datos_categorias = response['datos'];
      });
      //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
      localStorage.setItem('OPCIONMENU', '4');  
      this.usuarioid        = localStorage.getItem('IDUSER');
      this.opcionnavegacion = this.rutaActiva.snapshot.paramMap.get('id');
      localStorage.removeItem('data_perfil');
      localStorage.removeItem('data_inicio');
      localStorage.removeItem('data_inicio2');    
      
  }
  enviarformulario(){
    const loader = this.loadingCtrl.create({
      ////duration: 10000
      //message: "Un momento, por favor..."
    }).then(load => {
              load.present();
              this.provider_usuario.perfilregistrocompletar(this.usuarioid, this.myForm.value).subscribe((response) => {  
                          this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                        if(response['code']==200){
                                            localStorage.setItem('NUEVA_INFORMACION_PERFIL', '2');
                                            if(this.opcionnavegacion=='1'){
                                                    let cuentaperfil = "0";
                                                    let cuentaperfil2 = 0;
                                                    cuentaperfil = localStorage.getItem('CUENTAPERFIL');
                                                    cuentaperfil2 = parseInt(cuentaperfil) + 1;
                                                    localStorage.setItem('CUENTAPERFIL', cuentaperfil2+"");
                                                    //this.navController.navigateForward("/principal/perfil"); //this.navController.navigateForward("/principal/perfil/"+cuentaperfil);
                                                    this.navController.back();
                                            }else{
                                                    this.navController.navigateForward('perfilregistrocompletar2/2');
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
}//FIN CLASS
