import { Component, OnInit, Input, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController, ModalController, Platform, IonSlides } from '@ionic/angular';

import { Home } from '../../providers/home';
import { Variablesglobales } from '../../providers/variablesglobal';

import { ActivatedRoute, Params } from '@angular/router';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Camera, CameraOptions } from '@ionic-native/camera/ngx';
import { Crop, CropOptions } from '@ionic-native/crop/ngx';
//import { ImageResizer, ImageResizerOptions } from '@ionic-native/image-resizer/ngx';
import { File } from '@ionic-native/file/ngx';
import { Megafonosend } from '../megafonosend/megafonosend';
import { DomSanitizer } from '@angular/platform-browser';
import { Geolocation } from '@ionic-native/geolocation/ngx';
import { GooglePlus } from '@ionic-native/google-plus/ngx';
import {
  MediaCapture,
  MediaFile,
  CaptureError,
  CaptureVideoOptions,
  CaptureAudioOptions
} from '@ionic-native/media-capture/ngx';
import { Cropimagennueva } from '../cropimagennueva/cropimagennueva';
import { AndroidPermissions } from '@ionic-native/android-permissions/ngx';
import { VideoEditor } from '@awesome-cordova-plugins/video-editor/ngx';
//import { BackgroundMode } from '@ionic-native/background-mode/ngx';

declare var google;

@Component({
  selector: 'app-perfilchattema',
  templateUrl: 'perfilchattema.html',
  styleUrls: ['perfilchattema.scss'],
  providers:[Variablesglobales, Home, Camera, File, Crop, MediaCapture, AndroidPermissions, VideoEditor, Geolocation]
})
export class Perfilchattema implements  OnInit{
    @ViewChild("mySliderpublicidad5", { static: false }) mySliderpubli5?: IonSlides;
    public slideOpts_publi = {
          effect: 'coverflow',
          autoplay: {
             delay: 3000,
          },
          speed: 2000,
          slidesPerView: 1,
          paginationType:"arrows"
    };

    public conf_banner_1: any;
    public conf_banner_3: any;
    @ViewChild('solicita', {static: false}) myInput;
    //@Input('usuarioid') usuarioid: string;
    //@Input('mycarid') mycarid: string;
    public directionsDisplay: any = null;
    public directionsService: any = null;
    public pais: string;
    public notificaciones_push = '1';
    public mensajes = "0";
    public version_exporar = ""; 
    public estado: string;
    public municipio: string;
    public datos: any;
    public rutas   = new Variablesglobales();
    public imgurl2: any;
    public searchTerm: any;
    public allItems: any;
    public items: any;
    public calificacion = 0;
    public usuarioid: string;
    public mycarid: string;
    public mycarsid: string;
    public puntaje = "";
    public datos_calificacion: any;
    public myForm: FormGroup;
    public image: string[] = ['', '', '', ''];
    public image1: string = '';
    public image2: string = '';
    public image3: string = '';
    public image4: string = '';


    public video:  string[] = ['', '', ''];
    public video1: string = '';

    public envia = "si";
    public oferta = 1;
    public username = "";
    public sessionactiva = "";
    public fotodeperfil: string;
    public slideOpts = {
          effect: 'flip',
          autoplay: {
            delay: 5000
          }
    };
    public enviar = 1;
    public idiomapalabras: any;
    public croppedImagepath = "";
    public isLoading = false;
    public cropOptions: CropOptions = {
      quality: 100,
      targetHeight: -1,
      targetWidth: -1
    }
    public myLatLng: any;
    public map: any;
    public marker: any;
    public address: string;
    public latitud_ng_2: number;
    public longitud_ng_2: number;
    public activa0    = 0;
    public activa1    = 1;
    public activa2    = 0;
    public activa3    = 0;
    public activa4    = 0;
    public activa5    = 0;
    public activa6    = 0;
    public activa7    = 0;
    public activa8    = 0;
    public activa9    = 0;
    public tipoactiva = 2;
    public p_idioma = "en";
    public latitudeusuario  = "";
    public longitudeusuario = "";

    public latitud_ng: string;
    public longitud_ng: string;
    public pais_ng      = "";
    public municipio_ng = "";
    public estado_ng    = "";
    public titulo_ubicacion_ng    = "";
    public selectedVideo:     string;
    public selectedVideo_url = "";
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
    constructor(private router: Router, 
                public formBuilder: FormBuilder,
                private navController: NavController, 
                private providerhome: Home, 
                public alertCtrl: AlertController,
                public loadingCtrl: LoadingController,
                private rutaActiva: ActivatedRoute,
                private camera: Camera,
                private crop: Crop,
                public provider_mapas: Home,
                //private imageResizer: ImageResizer,
                private videoEditor: VideoEditor,
                public androidPermissions: AndroidPermissions,
                private mediaCapture: MediaCapture,
                private file: File,
                public modalController: ModalController,
                private platform: Platform,
                //private backgroundMode: BackgroundMode,
                private sanitizer: DomSanitizer,
                public geolocation: Geolocation,
                ){
      console.log('datos de post: '+this.usuarioid);
      this.username      = localStorage.getItem('USUARIO');
      this.fotodeperfil  = localStorage.getItem('FOTOPERFIL');
      this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
      this.version_exporar = localStorage.getItem('VERSION_EXPORTAR');
      this.directionsDisplay = new google.maps.DirectionsRenderer();
      this.directionsService = new google.maps.DirectionsService();
    }//FIN FUncTION  


   salirdecargando(){
      this.loadingCtrl.getTop().then(loader => {
        if (loader!=undefined) {
          console.log('sali',loader);
          this.loadingCtrl.dismiss();
        }
      });
  }

 mensajeria(){
    this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
        if(this.sessionactiva=="true"){
            this.navController.navigateForward("megafono");  
        }
  }

  notificaciones(){
    
        if(this.sessionactiva=="true"){
            this.navController.navigateForward("notificaciones");  
        }
  }

  linkhistoria(){
      this.navController.navigateForward("/perfilchat");  
  }

  ngOnInit() {
              this.activa0    = 0;
              this.activa1    = 1;
              this.activa2    = 0;
              this.tipoactiva = 2;
              this.imgurl2 = this.rutas.getServar();
              this.conf_banner_3  = JSON.parse(localStorage.getItem('conf_banner_3'));


              console.log('activa1: '+this.activa1);
              console.log('activa0: '+this.activa0);
              console.log('tipoactiva: '+this.tipoactiva);
              this.loadingCtrl.getTop().then(loader => {
                if (loader!=undefined) {
                  console.log('sali',loader);
                  this.loadingCtrl.dismiss();
                }
              });

              const loader = this.loadingCtrl.create({
                    //qmessage: "Un momento, por favor..."
                  }).then(load => { load.present();
                                        
                                        this.p_idioma   = localStorage.getItem('P_IDIO');
                                        this.providerhome.chatcategorialist(this.p_idioma).subscribe((response) => {  
                                            this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                                          if(response['code']==200){
                                                                    this.datos  = response['datos'];
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

  
    actualizar_pais(){
        //console.log(var1+' - '+var2);
        this.latitudeusuario  = JSON.parse(localStorage.getItem('latitudeusuario'));
        this.longitudeusuario = JSON.parse(localStorage.getItem('longitudeusuario'));
        this.providerhome.mapalocalizar(this.latitudeusuario, this.longitudeusuario).subscribe((response_aux) => {
              console.log(response_aux);
                          for(var i=0; i<6 ; i++) { 
                              if(response_aux['results'][0]['address_components'][i]){
                                  if (response_aux['results'][0]['address_components'][i]['types'][0] == 'country' ) {                      
                                        //this.pais_ng  = response_aux['results'][0]['address_components'][i]['long_name']; 
                                        if(response_aux['results'][0]['address_components'][i]['long_name']=="Venezuela"){
                                            this.pais_ng = "VES Bs";

                                        }else if(response_aux['results'][0]['address_components'][i]['long_name']=="México"){
                                            this.pais_ng = "MXN $";

                                        }else if(response_aux['results'][0]['address_components'][i]['long_name']=="Panamá"){
                                            this.pais_ng = "USD $";

                                        }else if(response_aux['results'][0]['address_components'][i]['long_name']=="Chile"){
                                            this.pais_ng = "CLP $";

                                        }else if(response_aux['results'][0]['address_components'][i]['long_name']=="Colombia"){
                                            this.pais_ng = "COP $";

                                        }else if(response_aux['results'][0]['address_components'][i]['long_name']=="Ecuador"){
                                            this.pais_ng = "USD $";

                                        }else if(response_aux['results'][0]['address_components'][i]['long_name']=="Perú"){
                                            this.pais_ng = "PEN S/";

                                        }else if(response_aux['results'][0]['address_components'][i]['long_name']=="Argentina"){
                                            this.pais_ng = "ARS $";

                                        }else if(response_aux['results'][0]['address_components'][i]['long_name']=="Bolivia"){
                                            this.pais_ng = "BOB Bs";

                                        }else if(response_aux['results'][0]['address_components'][i]['long_name']=="República Dominicana"){
                                            this.pais_ng = "DOP RD$";

                                        }else if(response_aux['results'][0]['address_components'][i]['long_name']=="España"){
                                            this.pais_ng = "EUR €";

                                        }else{
                                            this.pais_ng = "USD $";
                                        }
                                   }else{
                                        this.pais_ng = "USD $";
                                    }
                               }else{
                                    this.pais_ng = "USD $";
                                }
                          }
        },error => {

            this.pais_ng = "USD $";

        });
        this.latitud_ng  = this.latitudeusuario;
        this.longitud_ng = this.longitudeusuario;
        console.log('pais_editar'+this.pais_ng);
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
      this.mySliderpubli5.stopAutoplay();
      this.mySliderpubli5.startAutoplay();
      
      //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
      this.username      = localStorage.getItem('USUARIO');
      this.fotodeperfil  = localStorage.getItem('FOTOPERFIL');
      this.pais_ng       = localStorage.getItem('ISOMONEDA');
      this.usuarioid     = localStorage.getItem('IDUSER');
      this.mycarid       = localStorage.getItem('MYCARID');
      if(this.pais_ng=="" || this.pais_ng==null){
        this.actualizar_pais();  
      }

      this.image1 = '';
      this.image2 = '';
      this.image3 = '';
      this.image4 = '';
      this.image[0] = this.image1;
      this.image[1] = this.image2;
      this.image[2] = this.image3;
      this.image[3] = this.image4;

      this.activa0    = 0;
      this.activa1    = 1;
      this.activa2    = 0;
      this.activa3    = 0;
      this.activa4    = 0;
      this.activa5    = 0;
      this.activa6    = 0;
      this.activa7    = 0;
      this.tipoactiva = 2;

      
  }

  
  regresar(){
    this.navController.back();
  }


  linkperfil(var1){
          this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
          if(this.sessionactiva=="true"){
                  this.navController.navigateForward("/perfilchatnew/"+var1+"/0");  
          }else{
                this.navController.navigateForward("/principal/perfil");
          }
  }


 
    
}//FIN CLASS