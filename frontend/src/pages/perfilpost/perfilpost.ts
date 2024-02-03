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
    public selectedDistance: string; 
    public selectedCategory: string;
    public categories: any;
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
    public map2: any;
    public marker: any;
    public datostour: any;
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

    public latitud_ng: number;
    public longitud_ng: number;
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

      this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
      //this.mycarsid = this.rutaActiva.snapshot.paramMap.get('id');
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



  actualizar_pais(var1, var2){
      //console.log(var1+' - '+var2);
      this.provider_mapas.mapalocalizar(var1, var2).subscribe((response_aux) => {
                        /*for(var i=0; i<6 ; i++) { 
                            if(response_aux['results'][0]['address_components'][i]){
                                if (response_aux['results'][0]['address_components'][i]['types'][0] == 'country' ) {                      
                                      this.pais_ng  = response_aux['results'][0]['address_components'][i]['long_name']; 
                                }
                                if (response_aux['results'][0]['address_components'][i]['types'][0] == 'locality' ) {                     
                                      this.municipio_ng = response_aux['results'][0]['address_components'][i]['long_name']; 
                                } 
                            }
                        }*/
      });
      this.latitud_ng  = var1;
      this.longitud_ng = var2;
      ////console.log('pais_editar'+this.pais_ng);
  }


  buscar(){

    this.username      = localStorage.getItem('USUARIO');
    this.fotodeperfil  = localStorage.getItem('FOTOPERFIL');
    this.pais_ng       = localStorage.getItem('ISOMONEDA');
    this.usuarioid     = localStorage.getItem('IDUSER');
    this.mycarid       = localStorage.getItem('MYCARID');
    //this.selectedDistance
    //this.selectedCategory



    this.latitud_ng          = null;
    this.longitud_ng         = null;


        const loader = this.loadingCtrl.create({
          ////duration: 10000
          //message: "Un momento, por favor..."
        }).then(load => {
                        load.present();

                        this.geolocation.getCurrentPosition().then((resp) => {

                              console.log('position 1');
                              console.log(resp);

                              this.latitud_ng          = resp.coords.latitude;
                              this.longitud_ng         = resp.coords.longitude;

                        }).catch((error) => {
                            console.log('position 2');
                            console.log(error);

                              this.latitud_ng          = null;
                              this.longitud_ng         = null;
                        
                        });

                        this.provider.listtoursfilter(this.latitud_ng, this.longitud_ng, this.selectedDistance, this.selectedCategory).subscribe((response) => {  
                              this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                              this.latitud_ng          = response['latitud'];
                              this.longitud_ng         = response['longitud'];
                              this.categories          = response['listcategorias'];
                              console.log("categoria: ");
                              console.log(this.categories);
                                  
                                this.actualizar_pais(this.latitud_ng, this.longitud_ng);
                                let latLng = new google.maps.LatLng(this.latitud_ng, this.longitud_ng);
                                let mapOptions = {
                                  center: latLng,
                                  zoom: 13,
                                  scrollwheel: false,
                                  mapTypeId: google.maps.MapTypeId.ROADMAP
                                } 
                                this.directionsDisplay.setMap(this.map);
                                let mapEle: HTMLElement = document.getElementById('map2');
                                this.map    = new google.maps.Map(mapEle, mapOptions);
                                this.marker = new google.maps.Marker({
                                      position:  new google.maps.LatLng(this.latitud_ng,  this.longitud_ng),
                                      map: this.map,
                                      title: 'Mi Posicion',
                                      draggable: true,
                                      animation: google.maps.Animation.DROP,
                                });
                                var that = this;
                                this.marker.addListener('dragend', function() {
                                    that.actualizar_pais(this.getPosition().lat(), this.getPosition().lng());
                                });

                                this.datostour = response['datos'];
                                this.datostour.forEach(function (value) {
                                      console.log(value.name+' -- '+value.lat+' -- '+value.lon);
                                      const contentString = '<div id="content">' +
                                                            '<div id="siteNotice">' +
                                                            "</div>" +
                                                            '<div id="bodyContent">' +
                                                            '<p>'+
                                                              '<b>Name:</b> '+value.name+' <br>'+
                                                              '<b>Description:</b> '+value.description+' <br>'+
                                                              '<b>Address:</b> '+value.address+' <br>'+
                                                            '</p>'+
                                                            '<br>'+
                                                            '<a href="/#/perfilmycar/'+value.id+'"><b>ir al perfil</b></a>'+
                                                            '</div>';
                                      const infowindow = new google.maps.InfoWindow({
                                        content: contentString,
                                        ariaLabel: value.name,
                                      });
                                      const marker = new google.maps.Marker({
                                            position:  new google.maps.LatLng(value.lat,  value.lon),
                                            map: that.map,
                                            title: value.name,
                                      });
                                      marker.addListener("click", () => {
                                        infowindow.open({
                                          anchor: marker,
                                          map: that.map
                                        });
                                      });
                                      
                                });
                                mapEle.classList.add('show-map');

                          });//FIN LOADING DISS
                      });


        });//FIn LOADING 

  }

   
  ionViewDidEnter(){ 

      this.username      = localStorage.getItem('USUARIO');
      this.fotodeperfil  = localStorage.getItem('FOTOPERFIL');
      this.pais_ng       = localStorage.getItem('ISOMONEDA');
      this.usuarioid     = localStorage.getItem('IDUSER');
      this.mycarid       = localStorage.getItem('MYCARID');

      this.latitud_ng          = null;
      this.longitud_ng         = null;

      

            this.geolocation.getCurrentPosition().then((resp) => {

                  console.log('position 1');
                  console.log(resp);

                  this.latitud_ng          = resp.coords.latitude;
                  this.longitud_ng         = resp.coords.longitude;

             }).catch((error) => {
                console.log('position 2');
                console.log(error);

                  this.latitud_ng          = null;
                  this.longitud_ng         = null;
             
            });

            this.provider.listtours(this.latitud_ng, this.longitud_ng).subscribe((response) => {  

                  this.latitud_ng          = response['latitud'];
                  this.longitud_ng         = response['longitud'];
                  this.categories          = response['listcategorias'];
                  console.log("categoria: ");
                  console.log(this.categories);
                      
                    this.actualizar_pais(this.latitud_ng, this.longitud_ng);
                    let latLng = new google.maps.LatLng(this.latitud_ng, this.longitud_ng);
                    let mapOptions = {
                      center: latLng,
                      zoom: 13,
                      scrollwheel: false,
                      mapTypeId: google.maps.MapTypeId.ROADMAP
                    } 
                    this.directionsDisplay.setMap(this.map);
                    let mapEle: HTMLElement = document.getElementById('map2');
                    this.map    = new google.maps.Map(mapEle, mapOptions);
                    this.marker = new google.maps.Marker({
                          position:  new google.maps.LatLng(this.latitud_ng,  this.longitud_ng),
                          map: this.map,
                          title: 'Mi Posicion',
                          draggable: true,
                          animation: google.maps.Animation.DROP,
                    });
                    var that = this;
                    this.marker.addListener('dragend', function() {
                        that.actualizar_pais(this.getPosition().lat(), this.getPosition().lng());
                    });

                    this.datostour = response['datos'];
                    this.datostour.forEach(function (value) {
                          console.log(value.name+' -- '+value.lat+' -- '+value.lon);
                          const contentString = '<div id="content">' +
                                                '<div id="siteNotice">' +
                                                "</div>" +
                                                '<div id="bodyContent">' +
                                                '<p>'+
                                                  '<b>Name:</b> '+value.name+' <br>'+
                                                  '<b>Description:</b> '+value.description+' <br>'+
                                                  '<b>Address:</b> '+value.address+' <br>'+
                                                '</p>'+
                                                '<br>'+
                                                '<a href="/#/perfilmycar/'+value.id+'"><b>ir al perfil</b></a>'+
                                                '</div>';
                          const infowindow = new google.maps.InfoWindow({
                            content: contentString,
                            ariaLabel: value.name,
                          });
                          const marker = new google.maps.Marker({
                                position:  new google.maps.LatLng(value.lat,  value.lon),
                                map: that.map,
                                title: value.name,
                          });
                          marker.addListener("click", () => {
                            infowindow.open({
                              anchor: marker,
                              map: that.map
                            });
                          });
                          
                    });
                    mapEle.classList.add('show-map');
                    
          });
      
     
  }

  
  close(){
    this.navController.back();
  }


  irhashtag(v){
      this.navController.navigateForward("/perfilmycar/"+v);  
  }


  
    
}//FIN CLASS