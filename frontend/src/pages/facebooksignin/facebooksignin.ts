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
  selector: 'app-facebooksignin',
  templateUrl: 'facebooksignin.html',
  styleUrls: ['facebooksignin.scss'],
  providers:[Usuario, Home, Camera, File, Crop, GooglePlus, Facebook, Instagram, Geolocation]
})

export class Facebooksignin implements  OnInit{
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
  public conf_activacion = '1';
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
          private googlePlus: GooglePlus,
          private instagram: Instagram,
          private platform: Platform,
  			  public alertCtrl: AlertController,
  			  public loadingCtrl: LoadingController,
          public provider: Usuario,
          private camera: Camera,
          private crop: Crop,
          private file: File,
          private fb: Facebook,
          public geolocation: Geolocation,
          public provider_home: Home,
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

  
  miwhatsapp(){
    this.navController.navigateRoot("/perfileditarwhatsapp");
  }

  estadisticasredes(){
    this.navController.navigateRoot("/estadistica1");
  }

  configurarasistente(){
    this.navController.navigateRoot("/asistenteconfig");
  }

  configurarfacebook(){
    this.navController.navigateRoot("/facebooksignin");
  }


  asistentealimentar(){
    this.navController.navigateRoot("/asistentealimentar");
  }

  configurarreserva(){
        this.navController.navigateRoot('perfilconfreserva');
  }

  editarsession(){
        this.navController.navigateRoot('perfileditar');
  }


  configurarmapa(){
    this.navController.navigateForward("/perfileditarmapa");  
  }


  asistente(us){
      this.usuarioid      = localStorage.getItem('IDUSER');
      this.sessionactiva  = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      if(this.sessionactiva=="true"){
          this.navController.navigateForward("/asistentechat/"+this.usuarioid+"/"+us);
      }else{
            this.navController.navigateForward("/principal/perfil");
      }
  }

  facebookSignIn(){
      this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      this.usuario   = localStorage.getItem('USUARIO');
      this.usuarioid = localStorage.getItem('IDUSER');
      this.mycarid   = localStorage.getItem('MYCARID');
      this.fb.login([
                      ////ESTOS PERMISOS ME AYUDARAN A LEER WHATSApp, leer comentarios y responderlos
                        
                        //'whatsapp_business_management', 
                        //'whatsapp_business_messaging', 
                      
                      //-----------------------------------FIN-------------------------------------
                      //PERMISOS POR REVISAR
                      'pages_messaging',
                      'instagram_manage_messages',
                      'whatsapp_business_messaging',
                      'whatsapp_business_management',

                      //PERMISOS YA APROBADOS
                      'instagram_basic',
                      'pages_show_list',
                      'read_insights',
                      'instagram_manage_insights',
                      'pages_manage_metadata'
                     ])
            .then((res: FacebookLoginResponse) => {
                  console.info('logging into facebookSignIn', res);
                  this.fb.api('me?fields=' + ['name', 'email', 'first_name', 'last_name', 'picture.type(large)'].join(), null)
                  .then((res2: any) => {
                            console.info('logging into facebookSignIn2', res2);
                            const loader = this.loadingCtrl.create({
                              ////duration: 10000
                              //message: "Un momento, por favor..."
                            }).then(load => {
                                            load.present();
                                            this.provider.miperfilfacebooksignin(this.mycarid, res.authResponse.accessToken, 
                                                                                               res.authResponse.data_access_expiration_time, 
                                                                                               res.authResponse.expiresIn, 
                                                                                               res.authResponse.userID ).subscribe((response) => {  
                                              this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();}
                                                    if(response['code']==200){
                                                          localStorage.setItem('toke_facebook',       res.authResponse.accessToken);
                                                          localStorage.setItem('expiretime_facebook', "'"+res.authResponse.data_access_expiration_time+"'");
                                                          localStorage.setItem('expirein_facebook',   "'"+res.authResponse.expiresIn+"'");
                                                          localStorage.setItem('user_facebook',       res.authResponse.userID);
                                                          localStorage.setItem('activacion_facebook', response['activacion_facebook']);
                                                          this.conf_activacion = response['activacion_facebook'];
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

                            });//FIn LOADING 

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
  }

  facebookLogout(){
      this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      this.usuario   = localStorage.getItem('USUARIO');
      this.usuarioid = localStorage.getItem('IDUSER');
      this.mycarid   = localStorage.getItem('MYCARID');
      this.fb.logout();
      const loader = this.loadingCtrl.create({
        ////duration: 10000
        //message: "Un momento, por favor..."
      }).then(load => {
                      load.present();
                      this.provider.miperfilfacebooklogout(this.mycarid).subscribe((response) => {  
                        this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();}
                              if(response['code']==200){
                                    localStorage.setItem('toke_facebook',  '');
                                    localStorage.setItem('expiretime_facebook',  '');
                                    localStorage.setItem('expirein_facebook',  '');
                                    localStorage.setItem('user_facebook',  '');
                                    localStorage.setItem('activacion_facebook', response['activacion_facebook']);
                                    this.conf_activacion = response['activacion_facebook'];
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

      });//FIn LOADING 

  }

  ionViewDidEnter(){ 
      this.p_idioma   = localStorage.getItem('P_IDIO'); 
      this.provider_home.categorias(this.p_idioma).subscribe((response) => {  
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
                                          this.datos  = response['datos'];
                                          this.conf_activacion = this.datos[0]['activacion_facebook'];
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

}//FIN CLASS
