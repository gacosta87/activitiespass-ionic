import { Component, OnInit, Input, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController, ModalController, Platform, IonContent } from '@ionic/angular';

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
import * as moment from 'moment';
import 'moment-timezone';
declare var google;

@Component({
  selector: 'app-perfilchatedit',
  templateUrl: 'perfilchatedit.html',
  styleUrls: ['perfilchatedit.scss'],
  providers:[Variablesglobales, Home, Camera, File, Crop, MediaCapture, AndroidPermissions, VideoEditor, Geolocation]
})
export class Perfilchatedit implements  OnInit{
    @ViewChild('solicita', {static: false}) myInput;
    @ViewChild('scrollElement', {static: true}) content: IonContent;
    //@Input('usuarioid') usuarioid: string;
    //@Input('mycarid') mycarid: string;
    public directionsDisplay: any = null;
    public directionsService: any = null;
    public pais: string;
    public estado: string;
    public municipio: string;
    public datos: any;
    public datos2: any;
    public imgurl   = new Variablesglobales();
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
    public data: any = [];
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
    public chatcategoria_id = "0";
    public chatlist_id      = "0";
    public latitudeusuario  = "";
    public longitudeusuario = "";
    public textom = "";
    public latitud_ng: string;
    public longitud_ng: string;
    public pais_ng      = "";
    public municipio_ng = "";
    public estado_ng    = "";
    public titulo_ubicacion_ng    = "";
    public selectedVideo:     string;
    public selectedVideo_url = "";
    public mensajeaux = "";
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
    this.myForm = this.formBuilder.group({
                    texto: new FormControl('', Validators.compose([]))
    });
      console.log('datos de post: '+this.usuarioid);
      this.username      = localStorage.getItem('USUARIO');
      this.fotodeperfil  = localStorage.getItem('FOTOPERFIL');
      this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
      this.directionsDisplay = new google.maps.DirectionsRenderer();
      this.directionsService = new google.maps.DirectionsService();
      this.myForm = this.formBuilder.group({
          nombre: new FormControl('', Validators.compose([ Validators.pattern('[a-zA-Z\-áéíóúÁÉÍÓÚñÑ()#0-9:. ]*'), Validators.maxLength(50), Validators.required ]))
      });
    }//FIN FUncTION  


   salirdecargando(){
      this.loadingCtrl.getTop().then(loader => {
        if (loader!=undefined) {
          console.log('sali',loader);
          this.loadingCtrl.dismiss();
        }
      });
  }
    


    zonahoraria(h){
      let testDateUtc = moment.tz(h, "America/Caracas");
      let localDate   = testDateUtc.clone().local();
      let horaactual  = localDate.format("DD/MM/YYYY hh:mm a");
      return horaactual;
    }


  ngOnInit() {
        this.activa0    = 0;
        this.activa1    = 1;
        this.activa2    = 0;
        this.tipoactiva = 2;


        console.log('activa1: '+this.activa1);
        console.log('activa0: '+this.activa0);
        console.log('tipoactiva: '+this.tipoactiva);
        this.loadingCtrl.getTop().then(loader => {
          if (loader!=undefined) {
            console.log('sali',loader);
            this.loadingCtrl.dismiss();
          }
        });
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
      this.chatlist_id      = this.rutaActiva.snapshot.paramMap.get('chatlistid');
      const loader = this.loadingCtrl.create({
              //qmessage: "Un momento, por favor..."
            }).then(load => { load.present();
                                this.providerhome.chatid(this.chatlist_id).subscribe((response) => {  
                                      this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                                    if(response['code']==200){
                                                              this.data     = response['datos'];
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

  
  regresar(){
    this.navController.back();
  }


scrollToBottomOnInit() {
    setTimeout(() => {
        this.content.scrollToBottom();
    });
}

final(){
    this.content.scrollToBottom(0);
}

enviarformulario(){
        this.usuarioid = localStorage.getItem('IDUSER');
        if(this.myForm.value.nombre!="" && this.mensajeaux!=this.myForm.value.nombre){
            this.mensajeaux = this.myForm.value.nombre;
            this.myForm.value.nombre = "";
            this.textom = "";
            const loader = this.loadingCtrl.create({
              //qmessage: "Un momento, por favor..."
            }).then(load => {
                                    load.present();
                                    this.providerhome.chatedit(this.chatlist_id, this.usuarioid, this.mensajeaux).subscribe((response) => {  
                                                this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                                      if(response['code']==200){
                                                                this.navController.back();
                                                      }else if (response['code']==201){
                                                                  const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                                    subHeader: this.idiomapalabras.aviso,
                                                                      message: this.idiomapalabras.noservidor,
                                                                      buttons: [
                                                                        {
                                                                          text: "Ok", 
                                                                          role: 'cancel'
                                                                        }
                                                                      ]
                                                                  }).then(alert => alert.present());
                                                      }//Fin else
                                                });//FIN LOADING DISS          
                                              let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                              botonEnvio.removeAttribute('disabled');   

                                    },error => {
                                            this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                            const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                subHeader: this.idiomapalabras.aviso,
                                                  message: this.idiomapalabras.noservidor,
                                                  buttons: [
                                                    {
                                                      text: "Ok", 
                                                      role: 'cancel'
                                                    }
                                                  ]
                                            }).then(alert => alert.present());
                                            let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                            botonEnvio.removeAttribute('disabled');

                                    });//FIN POST
                        });//FIn LOADING
            });//FIn LOADING
        }else{
            let botonEnvio: HTMLElement = document.getElementById('boton_envio');
            botonEnvio.removeAttribute('disabled');
        }
  }

  linkusar(var1){
    this.myForm.value.texto = var1;
    this.textom = var1;
    this.datos2 = [];
    this.enviarformulario();

  }
 
    
}//FIN CLASS