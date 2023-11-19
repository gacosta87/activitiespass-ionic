import { Component, OnInit, ViewChild, Input } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController, ModalController } from '@ionic/angular';
 
import { GooglePlus } from '@ionic-native/google-plus/ngx';
import {FacebookLoginResponse, Facebook} from "@ionic-native/facebook/ngx";
import { Instagram } from '@ionic-native/instagram/ngx';

import { Usuario } from '../../providers/usuario';

import { Geolocation } from '@ionic-native/geolocation/ngx';
import { Camera, CameraOptions } from '@ionic-native/camera/ngx';
import { Crop, CropOptions } from '@ionic-native/crop/ngx';
import { File } from '@ionic-native/file/ngx';
import { format, parseISO } from 'date-fns';
import { Home } from '../../providers/home';

import { Cropimagennueva } from '../cropimagennueva/cropimagennueva';

declare var google;

@Component({
  selector: 'app-asistenteconfig',
  templateUrl: 'asistenteconfig.html',
  styleUrls: ['asistenteconfig.scss'],
  providers:[Usuario, Home, Camera, File, Crop, GooglePlus, Facebook, Instagram, Geolocation]
})

export class Asistenteconfig implements  OnInit{
  @ViewChild('solicita', {static: false}) myInput;
  public myForm: FormGroup;
  public loading: any;
  public usuarioid: string;

  public croppedImagepath = "";
  public isLoading = false;
  public cropOptions: CropOptions = {
    quality: 100
  }
  public idiomapalabras: any;
  public nombres: string;
  public apellidos: string;
  public role_ids: string;
  public claves = "";
  public sessionactiva = "";
  public usuario = "";
  public mycarid = "";

  public datos: any;
  public image: string[] = ['', '', '', ''];
  public image1: string = '';
  public image2: string = '';
  public image3: string = '';
  public image4: string = ''; 

  public myLatLng: any;
  public map: any;
  public marker: any;
  public address: string;
  public servicios = "";
  public directionsDisplay: any = null;
  public directionsService: any = null;
  public latitud_ng: number;
  public longitud_ng: number;
  public pais_ng      = "";
  public municipio_ng = "";
  public estado_ng    = "";
  public activa = "0";
  public datos_calificacion: any;
  public seguidores = "";
  public seguidos = "";
  public post = "";
  public postver = "";
  public calificacion =""; 
  public textcheckbox = false;
  public textcheckbox_delivery = false;
  
  public activamapa="";
  public p_push = "";
  public categoriaid = 0;
  public p_idioma = "es";
  public datos_categorias: any;
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
          public provider: Usuario,
          private camera: Camera,
          private crop: Crop,
          private file: File,
          public geolocation: Geolocation,
          public provider_mapas: Home,
          public modalController: ModalController,
  			  ) {
    this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
    this.p_push = localStorage.getItem('P_PUSH');
    this.myForm = this.formBuilder.group({
          produtos_servicios_ofrecidos: new FormControl('', Validators.compose([ 
                              Validators.required, 
                              ])
                   ),
          mision_vision: new FormControl('', Validators.compose([ 
                              Validators.required, 
                              ])
                   ),
          fortalezas_debilidades: new FormControl('', Validators.compose([ 
                              Validators.required,
                              ])
                   ),
          comentarios_clientes: new FormControl('', Validators.compose([ 
                              Validators.required, 
                              ])
                   ),
          metodos_de_pago: new FormControl('', Validators.compose([ 
                              Validators.required, 
                              ])
                   ),
          ubicacion_especifica: new FormControl('', Validators.compose([ 
                              Validators.required, 
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
      this.provider_mapas.categorias(this.p_idioma).subscribe((response) => {  
          this.datos_categorias = response['datos'];
      });
      //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
      localStorage.setItem('OPCIONMENU', '4');  
      this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      this.usuario   = localStorage.getItem('USUARIO');
      this.usuarioid = localStorage.getItem('IDUSER');
      this.mycarid   = localStorage.getItem('MYCARID');
       const loader = this.loadingCtrl.create({
          ////duration: 10000
          //message: "Un momento, por favor..."
        }).then(load => {
                  load.present();
                  this.provider.miperfil(this.mycarid, this.usuarioid, 1).subscribe((response) => {  
                              this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                      if(response['code']==200){
                                          this.datos              = response['datos'];
                                          this.servicios          = response['servicios'];
                                          this.calificacion       = response['calificacion'];
                                          this.seguidores         = response['seguidores'];
                                          this.seguidos           = response['seguidos'];
                                          this.post               = response['post'];
                                          this.postver            = response['postver'];
                                          this.image1   = this.datos[0]['foto1'];
                                          this.image[0] = this.image1;
                                          this.datos_calificacion = response['datos_calificacion'];
                                          this.latitud_ng   = this.datos[0]['latitud'];
                                          this.longitud_ng  = this.datos[0]['longitud'];
                                          if(response['datos'][0]['ver']==1){
                                            this.textcheckbox      = false;
                                            this.activamapa="1";
                                          }else{
                                            this.textcheckbox      = true;
                                            this.activamapa="2";
                                          }


                                          if(response['datos'][0]['delivery']==1){
                                            this.textcheckbox_delivery      = false;
                                          }else{
                                            this.textcheckbox_delivery      = true;
                                          }
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
  }
  regresar(){
    this.navController.back();
  }
 
  enviarformulario() {
    const loader = this.loadingCtrl.create({
      ////duration: 10000
      //message: "Un momento, por favor..."
    }).then(load => {
              load.present();
              this.provider.miperfilupdate_asistente(this.mycarid, this.myForm.value, this.usuarioid).subscribe((response) => {  
                          this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                  if(response['code']==200){
                                      localStorage.setItem('IDUSER',           response['datos']['id']);
                                      localStorage.setItem('USUARIO',          response['datos']['username']);
                                      localStorage.setItem('MYCARID',          response['datos']['mycar_id']);
                                      localStorage.setItem('NOMBRESAPELLIDOS', response['datos']['nombre_apellido']);
                                      localStorage.setItem('TIPOUSUARIO',      response['datos']['role_id']);
                                      localStorage.setItem('FOTOPERFIL',       response['datos']['foto_35']);
                                      localStorage.setItem('SESSIONACTIVA_OLYMPUS_9',    'true');
                                      localStorage.setItem('TOKEN',            response['token']);
                                      localStorage.setItem('NUEVA_INFORMACION_PERFIL', '2');
                                      this.navController.navigateRoot("/principal/perfil");
                                  }else if (response['code']==201){
                                              const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                subHeader: this.idiomapalabras.aviso,
                                                  message: this.idiomapalabras.existeusuario,
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
