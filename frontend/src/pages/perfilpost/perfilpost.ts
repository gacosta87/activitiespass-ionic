import { Component, OnInit, Input, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController, ModalController, Platform } from '@ionic/angular';

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
import { Instagram } from '@ionic-native/instagram/ngx';
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
  selector: 'app-perfilpost',
  templateUrl: 'perfilpost.html',
  styleUrls: ['perfilpost.scss'],
  providers:[Variablesglobales, Home, Camera, File, Crop, MediaCapture, AndroidPermissions, VideoEditor, Geolocation, Instagram]
})
export class Perfilpost implements  OnInit{
    @ViewChild('solicita', {static: false}) myInput;
    //@Input('usuarioid') usuarioid: string;
    //@Input('mycarid') mycarid: string;
    public directionsDisplay: any = null;
    public directionsService: any = null;
    public pais: string;
    public estado: string;
    public municipio: string;
    public datos: any;
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
    public tipo_ubicacion  = 1;
    public version_exporar = '2';
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
    public activa0    = 1;
    public activa1    = 0;
    public activa2    = 0;
    public activa3    = 0;
    public activa4    = 0;
    public activa5    = 0;
    public activa6    = 0;
    public activa7    = 0;
    public activa8    = 0;
    public activa9    = 0;
    public tipoactiva = 1;

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
    public optimizar = 0;
    public texto_optimizado = "";
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
                private provider: Home, 
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
                public instagram_list: Instagram,
                ){
      console.log('datos de post: '+this.usuarioid);
      this.username        = localStorage.getItem('USUARIO');
      this.fotodeperfil    = localStorage.getItem('FOTOPERFIL');
      this.version_exporar = localStorage.getItem('VERSION_EXPORTAR');
      this.myForm = this.formBuilder.group({
        
          texto: new FormControl('', Validators.compose([ 
                              ])
                   ),
          titulo: new FormControl('', Validators.compose([ 
                                  Validators.required,
                              ])
                   ),
          titulo_op: new FormControl('', Validators.compose([ 
                              ])
                   ),
          precio: new FormControl('', Validators.compose([ 
                              ])
                   ),
          precio_oferta: new FormControl('', Validators.compose([ 
                              ])
                   ),
          isomoneda: new FormControl('', Validators.compose([ 
                              ])
                   ),
          nuevo_usado: new FormControl(false, Validators.compose([ 
                              ])
                   ),
          productoyservicio: new FormControl(false, Validators.compose([ 
                              ])
                   ),
          
          publicaciontipo: new FormControl(false, Validators.compose([ 
                              Validators.required,
                              ])
                   ),
           publicaciontipo_optimizar: new FormControl('0', Validators.compose([ 
                              Validators.required,
                              ])
                   ),
          ubicaciontipo: new FormControl('1', Validators.compose([ 
                              Validators.required,
                              ])
                   ),
          latitud: new FormControl('', Validators.compose([])
                   ),
          longitud: new FormControl('', Validators.compose([])
                   ),
          titulo_ubicacion: new FormControl('', Validators.compose([])
                   )

          
      });
      this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
      //this.mycarsid = this.rutaActiva.snapshot.paramMap.get('id');
      this.directionsDisplay = new google.maps.DirectionsRenderer();
      this.directionsService = new google.maps.DirectionsService();
    }//FIN FUncTION  


    publicacionsolicitudadd(){
          this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
          //this.modalController.dismiss();
          if(this.sessionactiva=="true"){
                localStorage.setItem('banderamodal','1');
               const modal = this.modalController.create({
                  component: Megafonosend,
                  cssClass: 'my-custom-class-textopromocion',
                  swipeToClose: true,
                  showBackdrop: true
                }).then(load => {
                          load.onDidDismiss().then(detail => {
                              localStorage.setItem('banderamodal','2');
                              if (detail['data'] != null) {
                                this.navController.navigateForward("/principal/inicio");
                              }
                          });
                          load.present();
                });//FIn LOADING
          }else{
                this.navController.navigateForward("/principal/perfil");
          }
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


    optimizar1(var1){
        this.optimizar = var1;
    }

    optimizar2(){
                                const loader = this.loadingCtrl.create({
                                  ////duration: 10000
                                  //message: "Un momento, por favor..."
                                }).then(load2 => {
                                          load2.present();
                                          //---------aqui this.backgroundMode.enable();
                                          console.log(this.myForm.value.titulo_op);
                                          this.provider.optimizar1(this.myForm.value.titulo_op).subscribe((response) => {  
                                                      
                                                      load2.dismiss().then( () => { 
                                                              if(response['code']==200){
                                                                        
                                                                      this.texto_optimizado = response['texto'];

                                                              }else if (response['code']==201){
                                                                          this.enviar = 1;
                                                                          let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                                                          botonEnvio.removeAttribute('disabled');
                                                                          const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                                            subHeader: this.idiomapalabras.aviso,
                                                                              message: response['msg'],
                                                                              buttons: [
                                                                                {
                                                                                  text: "Ok", 
                                                                                  role: 'cancel',
                                                                                  handler: data => {
                                                                                      this.enviar = 1;
                                                                                      //this.backgroundMode.disable();
                                                                                  }
                                                                                }
                                                                              ]
                                                                          }).then(alert => alert.present());
                                                              }//Fin else
                                                      });//FIN LOADING DISS
                                          },error => {
                                                load2.dismiss().then( () => {
                                                          this.enviar = 1;
                                                          const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                              subHeader: this.idiomapalabras.aviso,
                                                              message: this.idiomapalabras.noservidor,
                                                              buttons: [
                                                                {
                                                                    text: this.idiomapalabras.reintentar,
                                                                    role: 'cancel',
                                                                    cssClass:'ion-aceptar',
                                                                    handler: data => {
                                                                        let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                                                        botonEnvio.removeAttribute('disabled');
                                                                        this.enviar = 1;
                                                                        this.ionViewDidEnter();
                                                                        //this.backgroundMode.disable();
                                                                    }
                                                                }
                                                              ]
                                                          }).then(alert => alert.present());
                                              });//FIN LOADING DISS
                                          });//FIN POST
                                });//FIn LOADING


    }

    continue_(){
      this.activa0=1;
      this.activa1=0;
    }

    continue0(a){
      this.activa0=0;
      this.activa1=1;
      this.activa2=0;
      this.tipoactiva = a;
    }

    continue1_1(){
          this.activa1=0;
          this.activa2=1;
          this.activa3=0;
          this.activa6=0;
    }


    continue1(){
      if((this.image1!="" || this.image2!="" || this.image3!="" || this.selectedVideo_url!="") && this.myForm.value.titulo!=""){
          this.activa1=0;
          this.activa2=1;
          this.activa3=0;
          this.activa6=0;
          if(this.image1=="" && this.image2=="" && this.image3==""){ 
                this.videoEditor.createThumbnail({ 
                                                    fileUri: this.selectedVideo, 
                                                    width: 800,
                                                    height: 800,
                                                    outputFileName: new Date().getTime().toString()+this.usuarioid+this.mycarid+'_min'
                                                 }
                 ).then((outputFileName: string) => {   
                    const ruta_video = "file:///"+outputFileName;
                    var copyPath  = ruta_video;
                    var splitPath = copyPath.split('/');
                    var imageName = splitPath[splitPath.length - 1];
                    var filePath  = ruta_video.split(imageName)[0];
                    this.file.readAsDataURL(filePath, imageName).then(base64 => {
                        this.image[3] = base64;
                        console.log('imagen3:', this.image[3]);
                    });
                
                });
            }
      }else{
              const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                  subHeader: this.idiomapalabras.aviso,
                  message: this.idiomapalabras.publicaciontexto12,
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
      }
    }
    continue2(){
      if(this.myForm.value.texto!=""){
          this.activa2=0;
          this.activa3=1;
          this.activa8=0;
          this.activa4=0;
      }else{
          const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                  subHeader: this.idiomapalabras.aviso,
                  message: this.idiomapalabras.publicaciontexto12,
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
      }
    }
    continue3(){
      this.activa3=0;
      this.activa4=1;
      this.activa5=0;
     /* if(this.myForm.value.publicaciontipo!=""){
          this.activa3=0;
          this.activa4=1;
          this.activa5=0;
      }else{
          const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                  subHeader: this.idiomapalabras.aviso,
                  message: this.idiomapalabras.publicaciontexto12,
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
      }
      */
    }
    continue4(){
      if(this.myForm.value.isomoneda!="" && this.myForm.value.isomoneda!=null && this.myForm.value.isomoneda!='null'){
          this.activa4=0;
          this.activa5=1;
          this.activa6=0;
      }else{
          const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                  subHeader: this.idiomapalabras.aviso,
                  message: this.idiomapalabras.publicaciontexto12,
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
      }
    }
    continue5(){
    
    }


    continue5_1(){
          this.activa3=0;
          this.activa5=1;
          this.activa6=0;
          this.activa7=0;
          this.activa8=0;
    }

    actualizar_pais_2(var1, var2){
      //console.log(var1+' - '+var2);
      this.provider_mapas.mapalocalizar(var1, var2).subscribe((response_aux) => {
        var contar = 0;
        var auxilia = 0;
        this.titulo_ubicacion_ng = "";
        console.log(response_aux);
                            for(var i=0; i<response_aux['results'].length ; i++) { 
                                  if(response_aux['results'][i]['address_components'].length>=contar){
                                        auxilia = i;
                                        contar  = response_aux['results'][i]['address_components'].length;

                                  }
                            }
                            for(var i=0; i<response_aux['results'][auxilia]['address_components'].length ; i++) { 
                                  this.titulo_ubicacion_ng = this.titulo_ubicacion_ng + ' ' +response_aux['results'][auxilia]['address_components'][i]['long_name']; 
                            }
      });
      this.latitud_ng_2  = var1;
      this.longitud_ng_2 = var2;
      ////console.log('pais_editar'+this.pais_ng);
  }

    continue5_2(){
        if(this.myForm.value.texto!=""){
                this.activa3=0;
                this.activa2=0;
                this.activa5=0;
                this.activa6=1;
                this.activa4=0;
                this.activa7=0;
                this.activa8=0;
                this.activa9=0;
                this.geolocation.getCurrentPosition().then((resp) => {
                            this.latitud_ng_2          = resp.coords.latitude;
                            this.longitud_ng_2         = resp.coords.longitude;
                            this.actualizar_pais_2(this.latitud_ng_2, this.longitud_ng_2);
                            let latLng = new google.maps.LatLng(this.latitud_ng_2, this.longitud_ng_2);
                                    let mapOptions = {
                                      center: latLng,
                                      zoom: 14,
                                      mapTypeId: google.maps.MapTypeId.ROADMAP
                                    } 
                                    this.directionsDisplay.setMap(this.map);
                                    let mapEle: HTMLElement = document.getElementById('map2');
                                    this.map = new google.maps.Map(mapEle, mapOptions);
                                    this.marker = new google.maps.Marker({
                                          position:  new google.maps.LatLng(this.latitud_ng_2, this.longitud_ng_2),
                                          map: this.map,
                                          title: 'Mi Posicion',
                                          draggable: true,
                                          animation: google.maps.Animation.DROP,
                                    });
                                    var that = this;
                                    this.marker.addListener('dragend', function() {
                                      that.actualizar_pais_2(this.getPosition().lat(), this.getPosition().lng());
                                    });
                                    mapEle.classList.add('show-map');
                });
        }else{
                const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                    subHeader: this.idiomapalabras.aviso,
                    message: this.idiomapalabras.publicaciontexto12,
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
        }
    }
    continue6(){
        if(this.myForm.value.publicaciontipo==false){
          this.myForm.value.publicaciontipo = '1';
        }else{
          this.myForm.value.publicaciontipo = '2';
        }
        if(this.myForm.value.nuevo_usado==false){
          this.myForm.value.nuevo_usado = '1';
        }else{
          this.myForm.value.nuevo_usado = '2';
        }
        if(this.selectedVideo_url!=""){
            this.enviarformulario_video();
        }else{
            this.enviarformulario();
        }
    }
    actualizar_pais(){
        //console.log(var1+' - '+var2);
        this.latitudeusuario  = JSON.parse(localStorage.getItem('latitudeusuario'));
        this.longitudeusuario = JSON.parse(localStorage.getItem('longitudeusuario'));
        this.provider.mapalocalizar(this.latitudeusuario, this.longitudeusuario).subscribe((response_aux) => {
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
    addhashtag(v){
        //let elem: <HTMLElement> document.getElementById(v);
        this.myInput.value = this.myInput.value+"#";
        this.myInput.setFocus();
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




    cambiarvideo(){
          const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                subHeader: this.idiomapalabras.agregarvideopubli,
                message:this.idiomapalabras.seleopvideo,
                buttons: [
                  {
                      text: this.idiomapalabras.galeriavideo,
                      cssClass:'button-camara',
                      handler: data => {
                                let options: CameraOptions = {
                                      destinationType: this.camera.DestinationType.DATA_URL,
                                      quality: 100,
                                      correctOrientation: true,
                                      cameraDirection: this.camera.Direction.BACK,
                                      sourceType: this.camera.PictureSourceType.PHOTOLIBRARY,
                                      mediaType:this.camera.MediaType.VIDEO
                                } 
                                this.selectedVideo_url = "1";
                                this.camera.getPicture( options ).then(imageData => {
                                                this.videoEditor.getVideoInfo({
                                                            fileUri: "file:///"+imageData,
                                                }).then((fileUri) => {
                                                            if(fileUri['duration']>30){
                                                                  const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                                      subHeader: this.idiomapalabras.aviso,
                                                                        message: this.idiomapalabras.aviso_video,
                                                                        buttons: [
                                                                          {
                                                                            text: "Ok", 
                                                                            role: 'cancel',
                                                                            handler: data => {
                                                                                this.selectedVideo_url = "";
                                                                            }
                                                                          }
                                                                        ]
                                                                    }).then(alert => alert.present());
                                                            }else{

                                                                //this.selectedVideo = data[0].fullPath;
                                                                this.selectedVideo   = "file:///"+imageData;
                                                                this.selectedVideo = this.selectedVideo.replace("////", "///");
                                                                console.log('ruta del video selectedVideo', this.selectedVideo);
                                                               
                                                                
                                                                //this.selectedVideo_url = imageData;
                                                            }
                                                }).catch((error: any) => {
                                                            this.selectedVideo_url = "";
                                                            console.log('error remove: ', error);
                                                });
                                                                        
                              }).catch(error =>{
                                this.selectedVideo_url = "";         
                              });
                      }
                  },
                  {
                      text: this.idiomapalabras.agregarvideocamara,
                      cssClass:'button-camara',
                      handler: data => {
                          //this.getPicture(list, this.camera.PictureSourceType.CAMERA, this.camera.MediaType.VIDEO);
                          this.getVideo();
                      } 
                  },
                  {
                      text: this.idiomapalabras.cerrar,
                      role: 'cancel',
                      cssClass:'ion-pagar3',
                      handler: data => {
                           console.log('Confirm close');
                      }
                  }
                ]
         }).then(alert => alert.present());
  }


  getVideo(){
      this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      this.usuarioid     = localStorage.getItem('IDUSER');
      this.mycarid       = localStorage.getItem('MYCARID');
      if(this.sessionactiva=="true"){
          if(this.platform.is('android')){
                        this.androidPermissions.checkPermission(this.androidPermissions.PERMISSION.WRITE_EXTERNAL_STORAGE).then(result1 => {
                                      if (result1.hasPermission){
                                              this.androidPermissions.checkPermission(this.androidPermissions.PERMISSION.ACCESS_FINE_LOCATION).then(result2 => {
                                                        if (result2.hasPermission) {
                                                                     
                                                                      let optios: CaptureVideoOptions  = { duration: 30, limit: 1 }
                                                                      this.mediaCapture.captureVideo(optios).then((data: MediaFile[]) => {
                                                                                if (data.length > 0) {
                                                                                              this.selectedVideo = data[0].fullPath;
                                                                                              this.selectedVideo = this.selectedVideo.replace("////", "///");
                                                                                              console.log('ruta del video selectedVideo', this.selectedVideo);
                                                                                              /*this.videoEditor.transcodeVideo({
                                                                                                          fileUri: this.selectedVideo,
                                                                                                          outputFileName: new Date().getTime().toString()+this.usuarioid+this.mycarid,
                                                                                                          outputFileType: this.videoEditor.OutputFileType.MPEG4,
                                                                                                          optimizeForNetworkUse: this.videoEditor.OptimizeForNetworkUse.YES,
                                                                                                          saveToLibrary: true,
                                                                                                          maintainAspectRatio: true,
                                                                                                          width: 360,
                                                                                                          height: 360,
                                                                                                          fps: 18,
                                                                                                          videoBitrate: 300000, // 1 megabit
                                                                                                          audioChannels: 1,
                                                                                                          audioSampleRate: 22050,
                                                                                                          audioBitrate: 96000, // 128 kilobits
                                                                                              }).then((fileUri: string) => {
                                                                                                       //this.selectedVideo, fileUri, this.mycarid, this.usuarioid
                                                                                                       this.selectedVideo_url = fileUri;
                                                                                              }).catch((error: any) => {
                                                                                                          console.log('error remove: ', error);
                                                                                              });*/
                                                                                }
                                                                        },(err: CaptureError) => {
                                                                            console.error(err); 
                                                                        });
                                                        }else{
                                                                        this.androidPermissions.requestPermission(this.androidPermissions.PERMISSION.ACCESS_FINE_LOCATION).then(() => {
                                                                          //this.promocionadd(id);
                                                                        });
                                                        }
                                            });//FIN PERMISO
                                    }else{
                                                    this.androidPermissions.requestPermission(this.androidPermissions.PERMISSION.WRITE_EXTERNAL_STORAGE).then(() => {
                                                       //this.promocionadd(id);
                                                    });
                                    }
                        
                    });//FIN PERMISO
          }else{
                                let optios: CaptureVideoOptions  = { duration: 30, limit: 1 }
                                this.mediaCapture.captureVideo(optios).then((data: MediaFile[]) => {
                                        if (data.length > 0) {
                                                  this.selectedVideo = data[0].fullPath;
                                                  this.selectedVideo = this.selectedVideo.replace("////", "///");
                                                  console.log('ruta del video selectedVideo', this.selectedVideo);
                                                  /*this.videoEditor.transcodeVideo({
                                                        fileUri: this.selectedVideo,
                                                        outputFileName: new Date().getTime().toString()+this.usuarioid+this.mycarid,
                                                        outputFileType: this.videoEditor.OutputFileType.MPEG4,
                                                        optimizeForNetworkUse: this.videoEditor.OptimizeForNetworkUse.YES,
                                                        saveToLibrary: true,
                                                        maintainAspectRatio: true,
                                                        width: 360,
                                                        height: 360,
                                                        fps: 18,
                                                        videoBitrate: 300000, // 1 megabit
                                                        audioChannels: 1,
                                                        audioSampleRate: 22050,
                                                        audioBitrate: 96000, // 128 kilobits
                                                  }).then((fileUri: string) => {
                                                      //this.selectedVideo, fileUri, this.mycarid, this.usuarioid
                                                      this.selectedVideo_url = fileUri;
                                                  }).catch((error: any) => {
                                                    this.selectedVideo      = "";
                                                    this.selectedVideo_url  = "";
                                                    console.log('error remove: ', error);
                                                  });*/
                                        }
                                },(err: CaptureError) => {
                                    console.error(err); 
                                });
          }//fin else
      }else{
              this.navController.navigateRoot("/principal/perfil"); 
      }
    }





   cambiarimagen(list){
    const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                subHeader: this.idiomapalabras.agregarimagenpubli,
                message:this.idiomapalabras.seleopimg,
                
                buttons: [
                  {
                      text: this.idiomapalabras.galeriaimagenes,
                      cssClass:'button-camara',
                      handler: data => {
                          this.getPicture(list, this.camera.PictureSourceType.PHOTOLIBRARY);
                      }
                  },
                  {
                      text: this.idiomapalabras.camara,
                      cssClass:'button-camara',
                      handler: data => {
                          this.getPicture(list, this.camera.PictureSourceType.CAMERA);
                      }
                  },
                  {
                      text: this.idiomapalabras.cerrar,
                      role: 'cancel',
                      cssClass:'ion-pagar3',
                      handler: data => {
                           console.log('Confirm close');
                      }
                  }
                ]
         }).then(alert => alert.present());
  }
  activaoferta(v){
    this.oferta=v;
  }
  activarubicacion(v){
    this.tipo_ubicacion=v;
    if(this.tipo_ubicacion==2){
        this.continue5_2();
    }else if(this.tipo_ubicacion==3){
        this.myForm.value.titulo_ubicacion = this.idiomapalabras.titulo_ubicacion
    }else{

    }
    
  }
  getPicture(list, sourceType_){ 
      let options: CameraOptions = {
          destinationType: this.camera.DestinationType.DATA_URL,
          //targetWidth: 1080,
          //targetHeight: 1080,
          quality: 100,
          correctOrientation: true,
          cameraDirection: this.camera.Direction.BACK,
          sourceType: sourceType_,
          //encodingType: this.camera.EncodingType.JPEG,
          //saveToPhotoAlbum: true, // Si guardar en el álbum
          //allowEdit:true
        } 
        this.camera.getPicture( options ).then(imageData => {
                         const modal = this.modalController.create({
                              component: Cropimagennueva,
                              cssClass: 'my-custom-class-cropimagen',
                              swipeToClose: true,
                              showBackdrop: true,
                              componentProps: {
                                'dataimagen1': imageData,
                                'list': list,
                                'aspectRationew':'3/4'
                              },
                          }).then(load => {
                                      load.onDidDismiss().then(detail => {
                                        //aqui accion al cerrar modal de cropimagen
                                         console.log(detail);
                                                  if(detail['data']['data'][0]=="si"){
                                                      if(detail['data']['data'][2]==1){
                                                          this.image1   = detail['data']['data'][1];
                                                          this.image[0] = this.image1;
                                                      }else if(detail['data']['data'][2]==2){
                                                          this.image2   = detail['data']['data'][1];
                                                          this.image[1] = this.image2;
                                                      }else if(detail['data']['data'][2]==3){
                                                          this.image3   = detail['data']['data'][1];
                                                          this.image[2] = this.image3;
                                                      }
                                                  }
                                      });
                                      load.present();
                          });//FIn LOADING
        }).catch(error =>{
             console.log("error de camara");
             console.log(error);
        });
  }//FIN FUNCTION
   cropImage(list, fileUrl) {
    this.crop.crop(fileUrl, this.cropOptions)
      .then(
        newPath => {
          this.showCroppedImage(list, newPath.split('?')[0])
        },
        error => {
          
        }
      );
  }
  showCroppedImage(list, ImagePath) {
    this.isLoading = true;
    var copyPath = ImagePath;
    var splitPath = copyPath.split('/');
    var imageName = splitPath[splitPath.length - 1];
    var filePath = ImagePath.split(imageName)[0];
    this.file.readAsDataURL(filePath, imageName).then(base64 => {
              this.croppedImagepath = base64;
              this.isLoading        = false;
                if(list==1){
              this.image1   = base64;
              this.image[0] = this.image1;
          }else if(list==2){
              this.image2   = base64;
              this.image[1] = this.image2;
          }else if(list==3){
              this.image3   = base64;
              this.image[2] = this.image3;
          }
    }, error => {
      this.isLoading = false;
    });
  }


  


  limpiar_video(var1){
                if(var1==1){
            this.selectedVideo_url = '';
          }
  }//FIN FUNCTION   



  limpiar(var1){
                if(var1==1){
            this.image1 = '';
          }else if(var1==2){
            this.image2 = '';
          }else if(var1==3){
            this.image3 = '';
          }
          this.image[0] = this.image1;
          this.image[1] = this.image2;
          this.image[2] = this.image3;
          
  }//FIN FUNCTION   
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

      this.activa3    = 0;
      this.activa4    = 0;
      this.activa5    = 0;
      this.activa6    = 0;
      this.activa7    = 0;
      

      this.activa0=0;
      this.activa1=1;
      this.activa2=0;
      this.tipoactiva = 1;
  }
  close(){
    this.navController.back();
  }


  enviarformulario(){ 
                      this.enviar = 2;
                          if((this.image1!="" || this.image2!="" || this.image3!="" || this.selectedVideo_url!="") && this.myForm.value.texto!=""){
                                const loader = this.loadingCtrl.create({
                                  ////duration: 10000
                                  //message: "Un momento, por favor..."
                                }).then(load2 => {
                                          load2.present();
                                          //---------aqui this.backgroundMode.enable();
                                          this.provider.postadd(this.usuarioid, this.mycarid, this.image ,this.myForm.value).subscribe((response) => {  
                                                      
                                                      load2.dismiss().then( () => { 
                                                              if(response['code']==200){
                                                                          localStorage.setItem('ISOMONEDA', this.myForm.value.isomoneda);
                                                                          localStorage.setItem('NUEVA_INFORMACION_PERFIL_INICIO', '2');
                                                                          localStorage.setItem('NUEVA_INFORMACION_PERFIL_BUSCAR', '2');
                                                                          localStorage.setItem('NUEVA_INFORMACION_PERFIL',        '2');
                                                                          //this.instagram_list.share('data:image/jpeg;base64,' + this.image[0], 'texto').then(() => console.log('Shared!')).catch((error: any) => console.error(error));
                                                                          this.navController.navigateRoot("/principal/inicio"); 
                                                                          //this.backgroundMode.disable();
                                                              }else if (response['code']==201){
                                                                          this.enviar = 1;
                                                                          let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                                                          botonEnvio.removeAttribute('disabled');
                                                                          const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                                            subHeader: this.idiomapalabras.aviso,
                                                                              message: response['msg'],
                                                                              buttons: [
                                                                                {
                                                                                  text: "Ok", 
                                                                                  role: 'cancel',
                                                                                  handler: data => {
                                                                                      this.enviar = 1;
                                                                                      //this.backgroundMode.disable();
                                                                                  }
                                                                                }
                                                                              ]
                                                                          }).then(alert => alert.present());
                                                              }//Fin else
                                                      });//FIN LOADING DISS
                                          },error => {
                                                
                                                load2.dismiss().then( () => {
                                                          this.enviar = 1;
                                                          const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                              subHeader: this.idiomapalabras.aviso,
                                                              message: this.idiomapalabras.noservidor,
                                                              buttons: [
                                                                {
                                                                    text: this.idiomapalabras.reintentar,
                                                                    role: 'cancel',
                                                                    cssClass:'ion-aceptar',
                                                                    handler: data => {
                                                                        let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                                                        botonEnvio.removeAttribute('disabled');
                                                                        this.enviar = 1;
                                                                        this.ionViewDidEnter();
                                                                        //this.backgroundMode.disable();
                                                                    }
                                                                }
                                                              ]
                                                          }).then(alert => alert.present());
                                              });//FIN LOADING DISS
                                          });//FIN POST
                                });//FIn LOADING
                        }else{
                              this.enviar = 1;
                              let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                              botonEnvio.removeAttribute('disabled');
                              const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                    subHeader: this.idiomapalabras.aviso,
                                    message: this.idiomapalabras.publicaciontexto12,
                                    buttons: [
                                      {
                                          text: this.idiomapalabras.reintentar,
                                          role: 'cancel',
                                          cssClass:'ion-aceptar',
                                          handler: data => {
                                               this.enviar = 1;
                                              //this.ionViewDidEnter();
                                          }
                                      }
                                    ]
                                }).then(alert => alert.present());
                        }
    }//FIN FcuntiN

  enviarformulario_video(){ 
                          this.enviar = 2;
                          if((this.image1!="" || this.image2!="" || this.image3!="" || this.selectedVideo_url!="") && this.myForm.value.texto!=""){
                                const loader = this.loadingCtrl.create({
                                  ////duration: 10000
                                  //message: "Un momento, por favor..."
                                }).then(load2 => {
                                          load2.present();
                                          //this.provider.postadd(this.usuarioid, this.mycarid, this.image ,this.myForm.value).subscribe((response) => {  
                                            //---------aqui this.backgroundMode.enable();       
                                             this.videoEditor.transcodeVideo({
                                                  fileUri: this.selectedVideo,
                                                  outputFileName: new Date().getTime().toString()+this.usuarioid+this.mycarid,
                                                  outputFileType: this.videoEditor.OutputFileType.MPEG4,
                                                  optimizeForNetworkUse: this.videoEditor.OptimizeForNetworkUse.YES,
                                                  saveToLibrary: true,
                                                  maintainAspectRatio: true,
                                                  width: 360,
                                                  height: 360,
                                                  fps: 18,
                                                  videoBitrate: 300000, // 1 megabit
                                                  audioChannels: 1,
                                                  audioSampleRate: 22050,
                                                  audioBitrate: 96000, // 128 kilobits
                                            }).then((fileUri: string) => {
                                                                  //this.selectedVideo, fileUri, this.mycarid, this.usuarioid
                                                                  this.selectedVideo_url = fileUri;
                                                                  this.provider.postadd_webp_video(this.selectedVideo, this.selectedVideo_url, this.usuarioid, this.mycarid, this.image ,this.myForm.value).then((response) => { 
                                                                        this.selectedVideo      = "";
                                                                        this.selectedVideo_url  = "";
                                                                        console.log('respuesta de grabar video ', response);
                                                                        load2.dismiss().then( () => { 
                                                                                if(response['code']==200){
                                                                                            localStorage.setItem('ISOMONEDA', this.myForm.value.isomoneda);
                                                                                            localStorage.setItem('NUEVA_INFORMACION_PERFIL_INICIO', '2');
                                                                                            localStorage.setItem('NUEVA_INFORMACION_PERFIL_BUSCAR', '2');
                                                                                            localStorage.setItem('NUEVA_INFORMACION_PERFIL',        '2');
                                                                                            this.navController.navigateRoot("/principal/inicio"); 
                                                                                            //this.backgroundMode.disable();
                                                                                }else if (response['code']==201){
                                                                                            this.enviar = 1;
                                                                                            let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                                                                            botonEnvio.removeAttribute('disabled');
                                                                                            const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                                                              subHeader: this.idiomapalabras.aviso,
                                                                                                message: this.idiomapalabras.noservidor,
                                                                                                buttons: [
                                                                                                  {
                                                                                                    text: "Ok", 
                                                                                                    role: 'cancel',
                                                                                                    handler: data => {
                                                                                                        this.enviar = 1;
                                                                                                        //this.backgroundMode.disable();
                                                                                                    }
                                                                                                  }
                                                                                                ]
                                                                                            }).then(alert => alert.present());
                                                                                }//Fin else
                                                                        });//FIN LOADING DISS
                                                            },error => {
                                                                  //this.backgroundMode.disable();
                                                                  load2.dismiss().then( () => {
                                                                            this.enviar = 1;
                                                                            const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                                                subHeader: this.idiomapalabras.aviso,
                                                                                message: this.idiomapalabras.noservidor,
                                                                                buttons: [
                                                                                  {
                                                                                      text: this.idiomapalabras.reintentar,
                                                                                      role: 'cancel',
                                                                                      cssClass:'ion-aceptar',
                                                                                      handler: data => {
                                                                                          let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                                                                          botonEnvio.removeAttribute('disabled');
                                                                                          this.enviar = 1;
                                                                                          this.ionViewDidEnter();
                                                                                          //this.backgroundMode.disable();
                                                                                      }
                                                                                  }
                                                                                ]
                                                                            }).then(alert => alert.present());
                                                                });//FIN LOADING DISS
                                                            });//FIN POST
                                            }).catch((error: any) => {
                                              this.selectedVideo_url = "";
                                              console.log('error remove: ', error);
                                            });                                     
                                            
                                });//FIn LOADING
                        }else{
                              this.enviar = 1;
                              let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                              botonEnvio.removeAttribute('disabled');
                              const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                    subHeader: this.idiomapalabras.aviso,
                                    message: this.idiomapalabras.publicaciontexto12,
                                    buttons: [
                                      {
                                          text: this.idiomapalabras.reintentar,
                                          role: 'cancel',
                                          cssClass:'ion-aceptar',
                                          handler: data => {
                                               this.enviar = 1;
                                              //this.ionViewDidEnter();
                                          }
                                      }
                                    ]
                                }).then(alert => alert.present());
                        }
    }//FIN FcuntiN
    
}//FIN CLASS