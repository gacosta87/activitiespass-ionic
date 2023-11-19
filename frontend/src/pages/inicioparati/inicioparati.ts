import { Component, OnInit, Input, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController, ModalController, Platform, PopoverController, IonContent } from '@ionic/angular';

import { Home } from '../../providers/home';
import { Usuario } from '../../providers/usuario';
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
import { Publicmenu } from '../publicmenu/publicmenu';
import { Postmesguta } from '../postmesguta/postmesguta';
import { Comentarios } from '../comentarios/comentarios';
import * as moment from 'moment';
import 'moment-timezone';
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
  selector: 'app-inicioparati',
  templateUrl: 'inicioparati.html',
  styleUrls: ['inicioparati.scss'],
  providers:[Variablesglobales, Home, Camera, File, Crop, MediaCapture, AndroidPermissions, VideoEditor, Geolocation, Usuario]
})
export class Inicioparati implements  OnInit{
    @ViewChild('solicita', {static: false}) myInput;
    @ViewChild("scrollElement2") content2: IonContent;
    //@Input('usuarioid') usuarioid: string;
    //@Input('mycarid') mycarid: string;
    public directionsDisplay: any = null;
    public directionsService: any = null;
    public pais: string;
    public data2: any;
    public justClicked = false;
    public doubleClicked = false;
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
    public data2_para_ti: any;
    public paraticategoria_id = "";

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
    public slideOpts_publi = {
          effect: 'coverflow',
          autoplay: {
             delay: 3000,
          },
          speed: 2000,
          slidesPerView: 1,
          paginationType:"arrows"
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
    public pagina     = 1;
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
    public conf_banner_1: any;
    public conf_banner_3: any;
    public latitudeusuario  = "";
    public longitudeusuario = "";
    public data2_aux: any;
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
                private provider2: Usuario,
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
                public popoverController: PopoverController,
                //private backgroundMode: BackgroundMode,
                private sanitizer: DomSanitizer,
                public geolocation: Geolocation,
                ){
      console.log('datos de post: '+this.usuarioid);
      this.username      = localStorage.getItem('USUARIO');
      this.fotodeperfil  = localStorage.getItem('FOTOPERFIL');
      this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
      this.directionsDisplay = new google.maps.DirectionsRenderer();
      this.directionsService = new google.maps.DirectionsService();
    }//FIN FUncTION     

  ngOnInit() {
        this.activa0    = 0;
        this.activa1    = 1;
        this.activa2    = 0;
        this.tipoactiva = 2;

         this.conf_banner_1  = JSON.parse(localStorage.getItem('conf_banner_1'));
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
    }


    ionViewDidEnter(){ 
      this.imgurl2 = this.rutas.getServar();
      this.username      = localStorage.getItem('USUARIO');
      this.fotodeperfil  = localStorage.getItem('FOTOPERFIL');
      this.pais_ng       = localStorage.getItem('ISOMONEDA');
      this.usuarioid     = localStorage.getItem('IDUSER');
      this.pagina        = 1;
      const loader = this.loadingCtrl.create({
          //qmessage: "Un momento, por favor..."
        }).then(load => { load.present();

                this.paraticategoria_id = this.rutaActiva.snapshot.paramMap.get('paraticategoria_id');
                this.providerhome.paratilist(this.paraticategoria_id, this.usuarioid, 1).subscribe((response) => {  
                      this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                    if(response['code']==200){
                                              this.datos  = response['datos'];
                                              this.pagina = response['pagina'];
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



  salirdecargando(){
      this.loadingCtrl.getTop().then(loader => {
        if (loader!=undefined) {
          console.log('sali',loader);
          this.loadingCtrl.dismiss();
        }
      });
  }
   video(v){
        console.log('video: '+v);
        this.navController.navigateForward("iniciovideo/"+v);  
    }


  favoritoadd(v, b){
        this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
        if(this.sessionactiva=="true"){
              let elem1: HTMLElement = document.getElementById('usuarioseguir_inicio'+v+''+b);
              elem1.classList.add("quitar");

              let elem2: HTMLElement = document.getElementById('usuarioseguir_inicio'+v+''+b);
              elem2.classList.add("quitar");
              this.provider2.perfilmycarsfavaddsug(v, this.usuarioid, this.latitudeusuario, this.longitudeusuario).subscribe((response) => { 
                    //this.data_new_users     = response['data_new_users'];
                    localStorage.setItem('data_new_users',  JSON.stringify(response['data_new_users']));
               });//FIN POST
        }else{
              this.navController.navigateRoot("/principal/perfil");
        }
         
    }//FIN FcuntiN
    favoritoadd2(v, b){
        this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
        if(this.sessionactiva=="true"){
              let elem1: HTMLElement = document.getElementById('nosigo'+b);
              elem1.classList.add("quitar");

              let elem2: HTMLElement = document.getElementById('nosigo'+b);
              elem2.classList.add("quitar");
              this.provider2.perfilmycarsfavaddsug(v, this.usuarioid, this.latitudeusuario, this.longitudeusuario).subscribe((response) => { 
                    //this.data_new_users     = response['data_new_users'];
                    localStorage.setItem('data_new_users',  JSON.stringify(response['data_new_users']));
               });//FIN POST
        }else{
              this.navController.navigateRoot("/principal/perfil");
        }
    }//FIN FcuntiN
    favoritoadd3(v, b){
        this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
        if(this.sessionactiva=="true"){
              let elem1: HTMLElement = document.getElementById('nosigo_tipo1'+b);
              elem1.classList.add("quitar");

              let elem2: HTMLElement = document.getElementById('nosigo_tipo1'+b);
              elem2.classList.add("quitar");
              this.provider2.perfilmycarsfavaddsug(v, this.usuarioid, this.latitudeusuario, this.longitudeusuario).subscribe((response) => { 
                    //this.data_new_users     = response['data_new_users'];
                    localStorage.setItem('data_new_users',  JSON.stringify(response['data_new_users']));
               });//FIN POST
        }else{
              this.navController.navigateRoot("/principal/perfil");
        }
    }//FIN FcuntiN


    ver(var1){

          this.navController.navigateForward("inicioparatidetalle/"+var1);

    }

  /*
    *
    * Publicaciones menu
    */ 
    publicmenu(ev: any, pid, uid){
      //console.log('idpublib: '+pid);
      this.usuarioid   = localStorage.getItem('IDUSER');
      this.mycarid     = localStorage.getItem('MYCARID');
      const popover = this.popoverController.create({
        component: Publicmenu,
        cssClass: 'my-custom-class',
        event: ev, 
        componentProps: {
            'usuarioid': this.usuarioid,
            'publicid': pid,
            'publicusuarioid': uid,
            'salirmodal': '1',
            'comperfil': '1',
            'compublic': '2',
            'editarcuenta':'1',
            'salircuenta':'1',
            'mycarusuarioid': '0'
        },
        translucent: true
      }).then(load => {
              load.present();
              load.onDidDismiss().then(detail => {
                  if (detail['data'] != null) {
                      //this.ionViewDidEnter();
                      //console.log(detail['data']);
                      //this.inicio_app(2, detail['data']);
                      
                      this.doRefresh(1); 
                  }
              });
      });
    }


  doubleClick(id, mycarid) {
      if (this.justClicked === true) {
        this.doubleClicked = true;
        let elem = <HTMLInputElement>document.getElementById('icon'+id);
        if(elem.name=="heart-outline"){
            this.like(id, mycarid);
        }else{
            if(document.getElementById('iconlike'+id)){
                let elem3: HTMLElement = document.getElementById('iconlike'+id);
                elem3.classList.add("div-publicacion-content-like-gif-hover");
                setTimeout(() => {
                    let elem4: HTMLElement = document.getElementById('iconlike'+id);
                    elem4.classList.remove("div-publicacion-content-like-gif-hover");
                }, 300);
            }
        }
      } else {
        this.justClicked = true;
        setTimeout(() => {
          this.justClicked = false;
          if (this.doubleClicked === false) {
            //this.singleClick();
          }
          this.doubleClicked = false;
        }, 250);
      }
    }
    like(id, mycarid){
            //auxlike            
            this.usuarioid   = localStorage.getItem('IDUSER');
            //this.mycarid     = localStorage.getItem('MYCARID');
            if(document.getElementById('iconlike'+id)){
              let elem3: HTMLElement = document.getElementById('iconlike'+id);
              elem3.classList.add("div-publicacion-content-like-gif-hover");
              setTimeout(() => {
                  let elem4: HTMLElement = document.getElementById('iconlike'+id);
                  elem4.classList.remove("div-publicacion-content-like-gif-hover");
              }, 300);
            }
            let elem = <HTMLInputElement>document.getElementById('icon'+id);
            if(elem.name=="heart-outline"){
                      let elem = <HTMLInputElement>document.getElementById('icon'+id);
                      elem.name="heart";

                      let elem2 = <HTMLInputElement>document.getElementById('cmegusta'+id);
                      let elem2_  = parseInt(elem2.innerHTML) + 1;
                      elem2.innerHTML = elem2_+'';

                      let elem3: HTMLElement = document.getElementById('megusta'+id);
                      elem3.innerHTML=elem2_+" "+this.idiomapalabras.megusta;

                      for (let i = 0; i < this.datos.length; i++) {
                        if(this.datos[i]['id']==id){
                              this.datos[i]['cmegustame'] = '2';
                              this.datos[i]['cmegusta'] = this.datos[i]['cmegusta'] + 1; 
                        }
                      }
                      localStorage.setItem('data_inicio2', JSON.stringify(this.datos));  
            }else{
                      let elem = <HTMLInputElement>document.getElementById('icon'+id);
                      elem.name="heart-outline";

                      let elem2: HTMLElement = document.getElementById('cmegusta'+id);
                      let elem2_ = parseInt(elem2.innerHTML) - 1;
                      elem2.innerHTML = elem2_+'';

                      let elem3: HTMLElement = document.getElementById('megusta'+id);
                      elem3.innerHTML=elem2_+" "+this.idiomapalabras.megusta;

                      for (let i = 0; i < this.datos.length; i++) {
                        if(this.datos[i]['id']==id){
                              this.datos[i]['cmegustame'] = '1';
                              this.datos[i]['cmegusta']   = this.datos[i]['cmegusta'] - 1; 
                        }
                      }
                      localStorage.setItem('data_inicio2', JSON.stringify(this.datos));  
            }
            this.providerhome.publilike(this.usuarioid, mycarid, id).subscribe((response) => {  
                                        if(response['code']==200){
                                            
                                  }else if (response['code']==201){
                                            
                                            //elem.style="color: none";
                                  }//Fin else
                                  
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
    } 
 
  


  linkperfil(var1){

        //this.navController.navigateForward("/perfilchatnew/"+var1+"/0");  
  }


  loadData2(event){

      this.imgurl2 = this.rutas.getServar();
      this.username      = localStorage.getItem('USUARIO');
      this.fotodeperfil  = localStorage.getItem('FOTOPERFIL');
      this.pais_ng       = localStorage.getItem('ISOMONEDA');
      this.usuarioid     = localStorage.getItem('IDUSER');
      
      this.paraticategoria_id = this.rutaActiva.snapshot.paramMap.get('paraticategoria_id');
      this.providerhome.paratilist(this.paraticategoria_id, this.usuarioid, this.pagina).subscribe((response) => {  
            this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                          event.target.complete();
                          if(response['code']==200){
                                    this.data2_aux = response['datos'];
                                    for (let i = 0; i < this.data2_aux.length; i++) {
                                        let existe_1 = 0;
                                        for (let ii = 0; ii < this.datos.length; ii++) {
                                            if(this.datos[ii]['id']==this.data2_aux[i]['id']){
                                                existe_1++;
                                            }
                                        }
                                        if(existe_1==0){
                                          this.datos.push(this.data2_aux[i]);
                                        }
                                    }
                                    console.log(this.datos);
                                    this.pagina = response['pagina'];
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
      });//FIN POSTzzzz

  }

  doRefresh(event){ 

      this.imgurl2 = this.rutas.getServar();
      this.username      = localStorage.getItem('USUARIO');
      this.fotodeperfil  = localStorage.getItem('FOTOPERFIL');
      this.pais_ng       = localStorage.getItem('ISOMONEDA');
      this.usuarioid     = localStorage.getItem('IDUSER');
      this.pagina        = 1;
      this.paraticategoria_id = this.rutaActiva.snapshot.paramMap.get('paraticategoria_id');
      this.providerhome.paratilist(this.paraticategoria_id, this.usuarioid, 1).subscribe((response) => {  
            this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                          event.target.complete();
                          if(response['code']==200){
                                    this.datos  = response['datos'];
                                    this.pagina = response['pagina'];
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

  }

    /*
    *
    * Publicaciones menu
    */ 
    postmegusta(t, publicid){
              localStorage.setItem('banderamodal','1');
              this.usuarioid   = localStorage.getItem('IDUSER');
              this.mycarid     = localStorage.getItem('MYCARID');
              const modal = this.modalController.create({
                        component: Postmesguta,
                        cssClass: 'my-custom-class-perfilseg',
                        showBackdrop: true,
                        componentProps: {
                          'usuarioid': this.usuarioid,
                          'mycarusuarioid': this.usuarioid,
                          'publicacionid':publicid,
                          'tipo':t
                        },
                        canDismiss: true,
              }).then(load => {
                        load.onDidDismiss().then(detail => {
                            localStorage.setItem('banderamodal','2');
                          if (detail['data'] != null) {

                          }
                        });
                        load.present();
              });//FIn LOADING
    }



    /*
    * function combertir hora
    */
    zonahoraria(h){
      let testDateUtc = moment.tz(h, "America/Caracas");
      let localDate   = testDateUtc.clone().local();
      let horaactual  = localDate.format("DD/MM/YYYY hh:mm a");
      return horaactual;
    }
    /*
    * FunctiON COMENTARiOS
    */
    comentario(var1){
          localStorage.setItem('banderamodal','1');
          const modal = this.modalController.create({
            component: Comentarios,
            cssClass: 'my-custom-class-comentarios',
            canDismiss: true,
            showBackdrop: true,
            componentProps: {
              'publiid': var1
            }
          }).then(load => {
                    load.onDidDismiss().then(detail => {
                        localStorage.setItem('banderamodal','2');
                        if (detail['data'] != null) {

                        }
                    });
                    load.present();
          });//FIn LOADING
    }
    //FIN FUncTION 

    /*
    *
    *  FUNCTION MAS
    */
    mas(v){ 
        let elem: HTMLElement = document.getElementById('texto'+v);
        elem.classList.add("div-publicacion-ver-menos");

        let elem2: HTMLElement = document.getElementById('texto2'+v);
        elem2.classList.add("div-publicacion-ver-mas");

        let elem3: HTMLElement = document.getElementById('verm'+v);
        elem3.classList.add("div-publicacion-ver-menos");
    }

    /*
    *
    * FUNCTION PARA CREAR ENLACE hashtag
    */
    hashtag(text) {
      let repl   = text.replace(/#([A-Za-zÁ-Źá-ź0-9_]+)/g,  '<a href="#/buscar2/$1" >#$1</a>');
      let repl2  = repl.replace(/\n/g, "<br />");
      let repl3  = repl2.replace(/@([A-Za-zÁ-Źá-ź0-9_.]+)/g,  '<a href="#/perfilmycar/$1" >@$1</a>');
      return repl3;
    } 
    irhashtag(v){
      //alert(v);
      //this.navController.navigateRoot("/principal/buscar", { animated: false });
    }
    /*
    * FUncTION PARA VER IMAGEN
    */
    mensaje(v1){
        this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
        if(this.sessionactiva=="true"){
              this.usuarioid = localStorage.getItem('IDUSER');
              this.navController.navigateRoot("/megafonomsj/"+v1+"/"+this.usuarioid+"/"+v1);
        }else{
              let cuentaperfil = "0";
              let cuentaperfil2 = 0;
              cuentaperfil = localStorage.getItem('CUENTAPERFIL');
              cuentaperfil2 = parseInt(cuentaperfil) + 1;
              localStorage.setItem('CUENTAPERFIL', cuentaperfil2+"");
              this.navController.navigateRoot("/principal/perfil"); //this.navController.navigateRoot("/principal/perfil/"+cuentaperfil);
        }
    }
    
}//FIN CLASS