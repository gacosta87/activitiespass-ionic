import { Component, OnInit, Input, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController, ModalController, Platform, IonContent } from '@ionic/angular';

import { Home } from '../../providers/home';
import { Variablesglobales } from '../../providers/variablesglobal';

import { ActivatedRoute, Params } from '@angular/router';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';
import { Perfilchatinfo } from '../perfilchatinfo/perfilchatinfo';
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
import { Clipboard } from '@ionic-native/clipboard/ngx';
import Typed from 'typed.js';


declare var google;

@Component({
  selector: 'app-perfilchatnew',
  templateUrl: 'perfilchatnew.html',
  styleUrls: ['perfilchatnew.scss'],
  providers:[Variablesglobales, Home, Camera, File, Crop, MediaCapture, AndroidPermissions, VideoEditor, Geolocation, Clipboard]
})
export class Perfilchatnew implements  OnInit{
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
    public limite = 500;
    public limite_chat = 20;
    public puntos = 0;
    public contar_chat = 0;
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
    public inicio = 1;
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
                private clipboard: Clipboard
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


      this.chatcategoria_id = this.rutaActiva.snapshot.paramMap.get('chatcategoriaid');
      this.chatlist_id      = this.rutaActiva.snapshot.paramMap.get('chatlistid');

      const loader = this.loadingCtrl.create({
              //qmessage: "Un momento, por favor..."
            }).then(load => {
                        load.present();
                      this.providerhome.chatmensajelist(this.usuarioid, this.chatcategoria_id, this.chatlist_id).subscribe((response) => {  
                            this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                          if(response['code']==200){
                                                    this.data        = response['datos'];
                                                    this.datos2      = response['datos2'];
                                                    this.chatlist_id = response['chatlista_id'];
                                                    this.puntos      = response['puntos'];
                                                    this.limite      = response['limite'];
                                                    this.contar_chat = response['contar_chat'];
                                                    this.limite_chat = response['limite_chat'];
                                                    this.inicio      = 1;
                                                    console.log('llego: '+this.chatlist_id);
                                                    this.scrollToBottomOnInit(); 
                                                    if(this.puntos==0){
                                                       console.log('aqui perfil chat info');
                                                        const modal = this.modalController.create({
                                                            component: Perfilchatinfo,
                                                            cssClass: 'my-custom-class-info2',
                                                            componentProps: {
                                                              'tipo':2
                                                            },
                                                            canDismiss: true,
                                                            showBackdrop: true,
                                                        }).then(load_modal => { 

                                                            load_modal.onDidDismiss().then(detail => {
                                                            });
                                                            load_modal.present();
                                                                   
                                                        });//FIn LOADING
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


cargartecto(){
  console.log('#texto'+(this.data.length-1));
  let texto = this.data[this.data.length-1]['content'];
  const typed = new Typed('#texto'+(this.data.length-1), {
                    strings: [texto],
                    typeSpeed: 50,
                    backDelay: 750,
                    loop: false,
                    showCursor:false
                  });

}

copiar(texto){

     if(texto=="ultimo001"){
        texto = this.data[(this.data.length-1)]['content'];
     }
     this.clipboard.copy(texto);
     console.log(texto);
     const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                    subHeader: this.idiomapalabras.aviso,
                      message: this.idiomapalabras.mensajecopiado,
                      buttons: [
                        {
                          text: "Ok", 
                          role: 'cancel'
                        }
                      ]
                  }).then(alert => alert.present());

}

enviarformulario(){
        if(this.myForm.value.texto!="" && this.mensajeaux!=this.myForm.value.texto && this.limite>=this.myForm.value.texto.length){
            this.mensajeaux = this.myForm.value.texto;
            this.myForm.value.texto = "";
            this.textom = "";
            const loader = this.loadingCtrl.create({
              //qmessage: "Un momento, por favor..."
              showBackdrop: true,
              cssClass: 'loading-back'
            }).then(load => {
                                    load.present();
                                    this.data.push({'role':'user', 'content':this.mensajeaux});
                                    let elem: HTMLElement = document.getElementById('ultimo');
                                    elem.innerHTML="";
                                    this.inicio = 3;
                                    console.log('enviar: '+this.chatlist_id);
                                    this.scrollToBottomOnInit(); 
                                    this.providerhome.chatmensajeadd( this.usuarioid, this.chatlist_id, this.mensajeaux).subscribe((response) => {  
                                                this.loadingCtrl.getTop().then(loader => {
                                                      if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                                      if(response['code']==200){
                                                                this.data.push(response['response']);
                                                                this.puntos      = response['puntos'];
                                                                this.limite      = response['limite'];
                                                                this.contar_chat = response['contar_chat'];
                                                                this.limite_chat = response['limite_chat'];
                                                                let elem: HTMLElement = document.getElementById('ultimo');
                                                                elem.innerHTML="<div style='border-radius: 13px; margin-top: 8px; margin-left: 10px; margin-right: 10px; color: #000; background-color: #eaebea; font-size: 18px; min-height: 60px; text-align: left; padding: 10px; padding-bottom: 38px; white-space: pre-wrap;' id='ultimo2'><div id='texto1'></div><div id='copiar1'></div></div>";
                                                                //this.cargartecto(response['response']);
                                                                const typed = new Typed('#texto1', {
                                                                        strings: [response['response']['content']],
                                                                        typeSpeed: 20,
                                                                        backDelay: 750,
                                                                        loop: false,
                                                                        bindInputFocusEvents: true,
                                                                        onLastStringBackspaced: ev => {
                                                                          console.log('aqui');
                                                                        },
                                                                        onComplete: ev => {
                                                                        //  let elem: HTMLElement = document.getElementById('copiar1');
                                                                        //  elem.innerHTML ="<div style='font-size: 16px; color: #000 !important; margin-top: 15px; text-align: right !important;'><ion-icon (click)='copiar(\"ultimo001\");' name='clipboard-outline'></ion-icon></div>";
                                                                          this.scrollToBottomOnInit(); 
                                                                          this.inicio=2;
                                                                        },
                                                                        showCursor:false
                                                                });
                                                                this.scrollToBottomOnInit(); 
                                                                if(this.puntos==0){
                                                                    const modal = this.modalController.create({
                                                                        component: Perfilchatinfo,
                                                                        cssClass: 'my-custom-class-info2',
                                                                        componentProps: {
                                                                          'tipo':2
                                                                        },
                                                                        canDismiss: true,
                                                                        showBackdrop: true,
                                                                    }).then(load_modal => { 

                                                                        load_modal.onDidDismiss().then(detail => {
                                                                        });
                                                                        load_modal.present();
                                                                               
                                                                    });//FIn LOADING
                                                                }
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
    //this.datos2 = [];
    //this.enviarformulario();

  }
 
    
}//FIN CLASS