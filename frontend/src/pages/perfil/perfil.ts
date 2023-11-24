import { Component,  OnInit, OnDestroy, ViewChild, ElementRef } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';
import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController, ModalController, PopoverController, IonContent, IonSlides} from '@ionic/angular';
import { GooglePlus } from '@ionic-native/google-plus/ngx';
import { FacebookLoginResponse, Facebook} from "@ionic-native/facebook/ngx";
import { Instagram } from '@ionic-native/instagram/ngx';
import { Usuario } from '../../providers/usuario';
import { Home } from '../../providers/home';
import { Geolocation } from '@ionic-native/geolocation/ngx';
import { Camera, CameraOptions } from '@ionic-native/camera/ngx';
import { Perfilpost } from '../perfilpost/perfilpost';
import { SuperTabs } from '@ionic-super-tabs/angular';
import { Perfilpostver } from '../perfilpostver/perfilpostver';
import { Publicmenu } from '../publicmenu/publicmenu';
//import { Perfilpopover } from '../perfilpopover/perfilpopover';
import { Perfilsegui } from '../perfilsegui/perfilsegui';
import { SocialSharing } from '@ionic-native/social-sharing/ngx';
import { Variablesglobales } from '../../providers/variablesglobal';
import { Promocionview } from '../promocionview/promocionview';
import { Crop, CropOptions } from '@ionic-native/crop/ngx';
import { File } from '@ionic-native/file/ngx';
import { Perfilpromotext } from '../perfilpromotext/perfilpromotext';
import { HelperService } from '../../services/helper.service';
import { Chart, registerables } from 'chart.js';
import {
  MediaCapture,
  MediaFile,
  CaptureError,
  CaptureVideoOptions,
  CaptureAudioOptions
} from '@ionic-native/media-capture/ngx';

import { VideoEditor } from '@awesome-cordova-plugins/video-editor/ngx';
import { StreamingMedia, StreamingVideoOptions } from '@ionic-native/streaming-media/ngx';
import { AndroidPermissions } from '@ionic-native/android-permissions/ngx';
//import { LocationAccuracy } from '@ionic-native/location-accuracy/ngx';
import { Perfilpostinfo } from '../perfilpostinfo/perfilpostinfo';
import { Cropimagennueva } from '../cropimagennueva/cropimagennueva';
//import { BackgroundMode } from '@ionic-native/background-mode/ngx';

@Component({
  selector: 'app-perfil',
  templateUrl: 'perfil.html',
  styleUrls: ['perfil.scss'],
  providers:[Usuario, 
            GooglePlus, 
            Facebook, 
            Instagram, 
            Camera, 
            Geolocation, 
            SuperTabs, 
            Home, 
            SocialSharing, 
            Variablesglobales, 
            AndroidPermissions, 
            StreamingMedia, 
            MediaCapture, 
            Camera, 
            Crop, 
            File, 
            VideoEditor]
})

export class Perfil   implements  OnInit {
  @ViewChild("mySliderpublicidad4", { static: false }) mySliderpubli4?: IonSlides;
  @ViewChild('barCanvas') barCanvas: ElementRef;
  @ViewChild('barCanvas2') barCanvas2: ElementRef;
  @ViewChild("scrollElement1")  content1: IonContent;
  @ViewChild("scrollElement2")  content2: IonContent;
  @ViewChild("scrollElement3")  content3: IonContent;
  @ViewChild("scrollElement4")  content4: IonContent;
  @ViewChild("scrollElement5")  content5: IonContent;
  public cropOptions: CropOptions = {
      quality: 100,
      targetHeight: 2024,
      targetWidth: 2024
  }
  public selectedVideo: string;
  public selectedVideo_url = "";
  public rutas   = new Variablesglobales();
  public version_exporar_ios = "";
  public myForm: FormGroup;
  public loading: any;
  public usuarioid: string;
  public vardes = '1';
  public nombres: string;
  public apellidos: string;
  public role_ids: string;
  public claves = "";
  public sessionactiva = "";
  public usuario = "";
  public mycarid = "";
  public idiomapalabras: any;
  public datos: any;
  public image: string[] = ['', '', '', ''];
  public image1: string = '';
  public image2: string = '';
  public image3: string = '';
  public image4: string = ''; 
  public msj: string;
  public url: string;
  public myLatLng: any;
  public map: any;
  public marker: any;
  public address: string;
  public servicios: any;
  public directionsDisplay: any = null;
  public directionsService: any = null;
  public latitud_ng: number;
  public longitud_ng: number;
  public pais_ng      = "";
  public municipio_ng = "";
  public estado_ng    = "";
  public activa = "0";
  public datos_calificacion: any;
  public seguidores: any;
  public seguidos: any;
  public post: any;
  public postver: any;
  public calificacion: any;
  public page_number = 1;
  public data_perfil: any = [];
  public version_exporar = "";
  public usuariomycarid: string;
  public fechar = "";
  public datosreservas: any;
  public datosreservasatender: any;
  public porcentajeregistro       = 100;
  public porcentajeregistrocuenta = 0;
  public porcentajeregistromini   = 0;
  public cargarpromocion = '0';
  public latitudeusuario  = "";
  public longitudeusuario = "";
  public data1_pro_lista: any;
  public data_estadistica: any
  public contarpromo = "0";
  public croppedImagepath = "";
  public nuevainformacionperfil       = "";
  public nuevainformacionperfiltiempo = "";
  public isLoading = false;
  public dispara = 0;

  public conf_banner_1: any;
  public conf_banner_3: any;

  public cantidad_fecha_like: any;
  public cantidad_fecha_visitas: any;

  public bars: any;
  public bars2: any;
  public colorArray: any;

  public imgurl2: any;

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

  public slideOpts_publi = {
          effect: 'coverflow',
          autoplay: {
             delay: 3000,
          },
          speed: 2000,
          slidesPerView: 1,
          paginationType:"arrows"
  };

  constructor(public navController: NavController,
  			  public formBuilder: FormBuilder,
          private helper: HelperService,
  			  private router: Router, 
          private fb: Facebook,
          private googlePlus: GooglePlus,
          private instagram: Instagram,
          private platform: Platform,
  			  public alertCtrl: AlertController,
  			  public loadingCtrl: LoadingController,
          public provider: Usuario,
          public providerhome: Home,
          public modalController: ModalController,
          public popoverController: PopoverController,
          private socialSharing: SocialSharing,
          private videoEditor: VideoEditor,
          private camera: Camera,
          private crop: Crop,
          private file: File,
          public androidPermissions: AndroidPermissions,
          private mediaCapture: MediaCapture,
          //private backgroundMode: BackgroundMode
  			  ) {
                this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
                this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
                this.usuario       = localStorage.getItem('USUARIO');
                this.usuarioid     = localStorage.getItem('IDUSER');
                this.mycarid       = localStorage.getItem('MYCARID');
                this.router.events.subscribe(async () => {
                  const isModalOpened = await this.modalController.getTop();
                  if(isModalOpened){this.modalController.dismiss();}
                });

                 Chart.register(...registerables);
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

  asistentealimentar_scrapping(){
    this.navController.navigateRoot("/asistentealimentarscrapping");
  }

  configurarreserva(){
        this.navController.navigateRoot('perfilconfreserva');
  }

  editarsession(){
        this.navController.navigateRoot('perfileditar');
  }

  irwhatsapp(val){

       this.socialSharing.shareViaWhatsAppToReceiver(val, 'Olympus app').then(() => {
         // Success!
        }).catch(() => {
          // Error!
        });

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

  irinstagram(val){
    window.open('https://instagram.com/'+val , '_system');
  }

  irfacebook(val){
    window.open('https://www.facebook.com/'+val , '_system');
  }

  irtiktok(val){
    window.open('https://www.tiktok.com/@'+val , '_system');
  }

  createBarChart(variable) {
           if(this.bars){
             this.bars.destroy();
            }
            var chartjsData = [];
            for (var i = 0; i < variable.length; i++) {
               chartjsData.push(variable[i].valor);
            }
            var chartjsLabels = [];
            for (var i = 0; i < variable.length; i++) {
               chartjsLabels.push(variable[i].fecha);
            }
            /*this.bars = new Chart(this.barCanvas.nativeElement, {
                      type: 'line',
                      data: {
                        labels: chartjsLabels,
                        datasets: [{
                          label: '',
                          data: chartjsData,
                          backgroundColor: 'rgba(54, 162, 235, 0.2)',
                          borderColor: "green",
                          borderWidth: 3,
                          pointRadius: 3,
                          fill: true,
                          tension: 0.1                          
                        }]
                      },
                      options: {
                        plugins: {
                         legend: {display: false}
                        }
                      }
            });*/
  }//fin function



  configurarmapa(){
    this.navController.navigateForward("/perfileditarmapa");  
  }


  suscripcion(){
    this.navController.navigateForward("/suscripcion");  
  }

  perfilinformacion(){
    this.navController.navigateForward("/perfilinfo");  
  }

  linkperfil(v){
        this.mycarid     = localStorage.getItem('MYCARID');
        if(this.mycarid==v){
              this.navController.navigateForward("/principal/perfil"); 
        }else{
              this.navController.navigateForward("/perfilmycar/"+v);  
        }
    }
  

  createBarChart2(variable) {
          if(this.bars2){
             this.bars2.destroy();
          }
          var chartjsData = [];
          for (var i = 0; i < variable.length; i++) {
             chartjsData.push(variable[i].valor);
          }
          var chartjsLabels = [];
          for (var i = 0; i < variable.length; i++) {
             chartjsLabels.push(variable[i].fecha);
          }
          /*this.bars2 = new Chart(this.barCanvas2.nativeElement, {
                    type: 'line',
                    data: {
                      labels: chartjsLabels,
                      datasets: [{
                        label: '',
                        data: chartjsData,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: "blue",
                        borderWidth: 3,
                        pointRadius: 3,
                        fill: true,
                        tension: 0.1
                      }]
                    },
                    options: {
                      plugins: {
                       legend: {display: false}
                      }
                    }
          });*/
  }//fin function




  ionViewDidEnter(){
        
        //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
        this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
        if(this.sessionactiva!='true'){

                this.navController.navigateRoot("/principal/inicio");
        }else{

               
                
                this.nuevainformacionperfil       = localStorage.getItem('NUEVA_INFORMACION_PERFIL');
                this.nuevainformacionperfiltiempo = localStorage.getItem('NUEVA_INFORMACION_PERFIL_TIEMPO');
                let start_actual = Date.now();
                if(this.nuevainformacionperfiltiempo!=null){
                    var tiempo_trancurrido = start_actual - parseInt(this.nuevainformacionperfiltiempo);  
                }else{
                    var tiempo_trancurrido = 0;
                }

                this.data_perfil  = JSON.parse(localStorage.getItem('data_perfil'));
                console.log('datos de reservas por atender', this.datosreservasatender);
                if(this.data_perfil!=null){
                    this.cantidad_fecha_visitas = this.data_perfil['cantidad_fecha_visitas'];
                    this.cantidad_fecha_like    = this.data_perfil['cantidad_fecha_like'];

                    this.createBarChart(this.cantidad_fecha_visitas);
                    this.createBarChart2(this.cantidad_fecha_like);
                }
                
                //this.mySliderpubli4.stopAutoplay();
                //this.mySliderpubli4.startAutoplay();
                if((this.nuevainformacionperfil==null) || (this.nuevainformacionperfiltiempo==null) || (this.nuevainformacionperfil=='2') ||  (tiempo_trancurrido>=2400000) ){
                    this.ngOnInit();
                    console.log('aqui voy');
                }
        }
  }


  help(){
        this.socialSharing.shareViaWhatsAppToReceiver('+19787956119', 'Saludos me gustaria solicitar una ayuda sobre Olympus').then(() => {
         // Success!
        }).catch(() => {
          // Error!
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
        this.imgurl2 = this.rutas.getServar();
        this.conf_banner_1  = JSON.parse(localStorage.getItem('conf_banner_1'));
        this.loadingCtrl.getTop().then(loader => {
          if (loader!=undefined) {
            console.log('sali',loader);
            this.loadingCtrl.dismiss();
          }
        });
        this.helper.recibir3.subscribe(res=>{
              if(this.dispara!=res){
                    this.dispara = res;
                    this.subirarriba();
                    console.log("el disparador: "+this.dispara);
              }
        });  
        this.data_perfil  = JSON.parse(localStorage.getItem('data_perfil'));

        console.log(this.data_perfil);
        if(this.data_perfil!=null){
              this.datos              = this.data_perfil['datos'];
              this.servicios          = this.data_perfil['servicios'];
              this.calificacion       = this.data_perfil['calificacion'];
              this.seguidores         = this.data_perfil['seguidores'];
              this.seguidos           = this.data_perfil['seguidos'];
              this.post               = this.data_perfil['post'];
              this.postver            = this.data_perfil['postver']['data'];
              this.datos_calificacion = this.data_perfil['datos_calificacion'];
              this.data_estadistica   = this.data_perfil['estadisticas'];
              this.datosreservas        = this.data_perfil['datosreservas'];
              this.datosreservasatender = this.data_perfil['datosreservasatender'];
              this.contarpromo          = this.data_perfil['contarpromo'];
              this.cantidad_fecha_visitas = this.data_perfil['cantidad_fecha_visitas'];
              this.cantidad_fecha_like    = this.data_perfil['cantidad_fecha_like'];

              this.porcentajeregistrocuenta = 0;
              this.porcentajeregistromini   = 0;
              this.porcentajeregistro       = 0;
              this.porcentajeregistrocuenta++;
              if(this.datos[0]['foto1']!='' && this.datos[0]['foto1']!=null){
                  this.porcentajeregistrocuenta++;
              }
              if(this.datos[0]['categoria_id']!=null){
                  this.porcentajeregistrocuenta++;
              }
              if(this.datos[0]['razon_social']!='' && this.datos[0]['razon_social']!=null){
                  this.porcentajeregistrocuenta++;
              }
              if(this.datos[0]['descripcion']!='' && this.datos[0]['descripcion']!=null){
                  this.porcentajeregistrocuenta++;
              }
              if(this.postver.length!=0){
                  this.porcentajeregistrocuenta++; 
              }
              this.porcentajeregistro     = Math.round((this.porcentajeregistrocuenta*100) / 6);
              this.porcentajeregistromini = this.porcentajeregistro/100;

              
              if(this.data_perfil['page_number']){
                  this.page_number      = this.data_perfil['page_number'];  
              }else{
                  this.page_number      = 1;
              }
              
        }else{
              this.datos              = [];
              this.servicios          = [];
              this.calificacion       = [];
              this.seguidores         = [];
              this.seguidos           = [];
              this.post               = [];
              this.postver            = [];
              this.datos_calificacion = [];
              this.data_estadistica   = [];
              this.page_number      = 1;
        }
        localStorage.setItem('OPCIONMENU', '4');  
        this.nuevainformacionperfil       = localStorage.getItem('NUEVA_INFORMACION_PERFIL');
        this.nuevainformacionperfiltiempo = localStorage.getItem('NUEVA_INFORMACION_PERFIL_TIEMPO');
        let start_actual = Date.now();
        if(this.nuevainformacionperfiltiempo!=null){
            var tiempo_trancurrido = start_actual - parseInt(this.nuevainformacionperfiltiempo);  
        }else{
            var tiempo_trancurrido = 0;
        }
        if((this.nuevainformacionperfil==null) || (this.nuevainformacionperfiltiempo==null) || (this.nuevainformacionperfil=='2') ||  (tiempo_trancurrido>=2400000) ){
            let start = Date.now();
            localStorage.setItem('NUEVA_INFORMACION_PERFIL_TIEMPO', start.toString());
            localStorage.setItem('NUEVA_INFORMACION_PERFIL','1');
            this.inicio(1, 0, 0);     
        }
  }

  doRefresh(event) {
    let start = Date.now();
    localStorage.setItem('NUEVA_INFORMACION_PERFIL_TIEMPO', start.toString());
    this.inicio(2, 1, event);
  }



  loadData(event) {
      if(this.page_number!=1){
              this.provider.miperfil(this.mycarid, this.usuarioid, this.page_number).subscribe((response) => {  
                          //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                  if(response['code']==200){
                                      for (let i = 0; i < response['postver']['data'].length; i++) {
                                        this.postver.push(response['postver']['data'][i]);
                                      }
                                      if(response['postver']['data'].length>0){
                                          this.page_number++;  
                                          this.data_perfil  = JSON.parse(localStorage.getItem('data_perfil'));
                                          this.data_perfil['postver']['data'] = this.postver;
                                          this.data_perfil['page_number']     = this.page_number;
                                          localStorage.setItem('data_perfil',  JSON.stringify(this.data_perfil));
                                      }
                                      event.target.complete();
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
                          //});//FIN LOADING DISS
              });//FIN POST
      }else{
          event.target.complete(); 
      }

  }

  inicio(ver, refres, event){    
      this.version_exporar = localStorage.getItem('VERSION_EXPORTAR');
      this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      this.usuario       = localStorage.getItem('USUARIO');
      this.usuarioid     = localStorage.getItem('IDUSER');
      this.mycarid       = localStorage.getItem('MYCARID');
      this.page_number   = 1;
      var hoy        = new Date();
      var mes = (hoy.getMonth() + 1);
      if(mes<=9){
        var mes2 = '0'+mes;
      }else{
         var mes2 = ''+mes;
      }
      var dia = hoy.getDate();
      if(dia<=9){
        var dia2 = '0'+dia;
      }else{
        var dia2 = ''+dia;
      }
      var fecha      = hoy.getFullYear() + '-' + mes2 + '-' +dia2;
      var hora       = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();
      var fechaYHora = fecha + ' ' + hora;
      this.fechar = fecha;
      if(this.sessionactiva=="true"){                 
                        this.data_perfil = JSON.parse(localStorage.getItem('data_perfil'));         
                        this.provider.miperfil(this.mycarid, this.usuarioid, this.page_number).subscribe((response) => {  
                                              if(response['code']==200){
                                                            this.postver = response['postver']['data'];  
                                                            this.datos   = response['datos'];
                                                            this.porcentajeregistrocuenta = 0;
                                                            this.porcentajeregistromini   = 0;
                                                            this.porcentajeregistro       = 0;
                                                            this.porcentajeregistrocuenta++;
                                                            if(this.datos[0]['foto1']!='' && this.datos[0]['foto1']!=null){
                                                                this.porcentajeregistrocuenta++;
                                                            }
                                                            if(this.datos[0]['categoria_id']!=null){
                                                                this.porcentajeregistrocuenta++;
                                                            }
                                                            if(this.datos[0]['razon_social']!='' && this.datos[0]['razon_social']!=null){
                                                                this.porcentajeregistrocuenta++;
                                                            }
                                                            if(this.datos[0]['descripcion']!='' && this.datos[0]['descripcion']!=null){
                                                                this.porcentajeregistrocuenta++;
                                                            }
                                                            if(this.postver.length!=0){
                                                                this.porcentajeregistrocuenta++; 
                                                            }
                                                            this.porcentajeregistro     = Math.round((this.porcentajeregistrocuenta*100) / 6);
                                                            this.porcentajeregistromini = this.porcentajeregistro/100;
                                                            this.calificacion         = response['calificacion'];
                                                            this.seguidores           = response['seguidores'];
                                                            this.seguidos             = response['seguidos'];
                                                            this.post                 = response['post'];
                                                            this.servicios            = response['servicios'];
                                                            this.datos_calificacion   = response['datos_calificacion'];
                                                            this.datosreservas        = response['datosreservas'];
                                                            this.datosreservasatender = response['datosreservasatender'];
                                                            this.contarpromo          = response['contarpromo'];
                                                            this.data_estadistica     = response['estadisticas'];
                                                            this.cantidad_fecha_visitas = response['cantidad_fecha_visitas'];
                                                            this.cantidad_fecha_like    = response['cantidad_fecha_like'];

                                                            this.createBarChart(this.cantidad_fecha_visitas);
                                                            this.createBarChart2(this.cantidad_fecha_like);
                                                            if(response['postver']['data'].length > 0){
                                                              this.page_number++;  
                                                            }
                                                            if(refres==1){
                                                              this.page_number = 2;
                                                              event.target.complete();  
                                                            }
                                                            response['page_number']     = this.page_number;
                                                            localStorage.setItem('data_perfil',  JSON.stringify(response));
                                              }else if (response['code']==201){
                                                          const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                            subHeader: this.idiomapalabras.aviso,
                                                              message: response['msg'],
                                                              buttons: [
                                                                {
                                                                  text: "Ok", 
                                                                  role: 'cancel',
                                                                  handler: data => {
                                                                      event.target.complete(); 
                                                                  }
                                                                }
                                                              ]
                                                          }).then(alert => alert.present());
                                              }//Fin else

                         }, (err) => { 

                                        if(refres==1){
                                          event.target.complete();  
                                        }

                        });//FIN POST
      }//fin sesssion      
  }//fin function


  subirarriba(){
    if(this.datos!=null && this.datos!=''){
          if(document.getElementById('scrollElement1')){
            this.content1.scrollToTop(600);  
          }
          if(document.getElementById('scrollElement2')){
            this.content2.scrollToTop(600);  
          }
          if(document.getElementById('scrollElement3')){
            this.content3.scrollToTop(600);  
          }
          if(document.getElementById('scrollElement4')){
            this.content4.scrollToTop(600);  
          }
          if(document.getElementById('scrollElement5')){
            this.content5.scrollToTop(600);  
          }
    }

  }


  /*
    * VER PROMOCION
  */
  promocionview(id, id2){
            localStorage.setItem('banderamodal','1');
            const modal = this.modalController.create({
                component: Promocionview,
                cssClass: 'my-custom-class-promociones',
                swipeToClose: true,
                showBackdrop: true,
                componentProps: {
                  'promocioneid': id,
                  'promocioneusuarioid': id2,
                  'promocionlista':this.data1_pro_lista,
                  'latitudeusuario':this.latitudeusuario,
                  'longitudeusuario':this.longitudeusuario,
                  'local':'1',

                },
            }).then(load => {
                        load.onDidDismiss().then(detail => {
                            localStorage.setItem('banderamodal','2');
                        });
                        load.present();
            });//FIn LOADING
  }
  verificar(){
    this.navController.navigateRoot("/perfilverificar");
  }
  //////////////////////////////////SESSION DE PROMOCIONATE///////////////////////////////////////////////////
    /*
        *
        *
        *
        *
    */
    agregarpromocion(id){
      this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
          if(this.sessionactiva=="true"){

                      localStorage.setItem('banderamodal','1');
                      const alert2 = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                  subHeader: this.idiomapalabras.textopromocion,
                                  message:this.idiomapalabras.textopromociontext,
                                  
                                  buttons: [
                                    {
                                        text: this.idiomapalabras.galeriaimagenes,
                                        cssClass:'button-camara',
                                        handler: data => {
                                          this.alertCtrl.dismiss('si').then( () => { 
                                            localStorage.setItem('banderamodal','2');
                                            this.getPicture(this.camera.PictureSourceType.PHOTOLIBRARY);
                                          });//FIN LOADING DISS
                                        }
                                    },
                                    {
                                        text: this.idiomapalabras.camara,
                                        cssClass:'button-camara',
                                        handler: data => {
                                          this.alertCtrl.dismiss('si').then( () => { 
                                            localStorage.setItem('banderamodal','2');
                                            this.getPicture(this.camera.PictureSourceType.CAMERA);
                                          });//FIN LOADING DISS
                                        }
                                    },

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
                                                  this.cargarpromocion = '1';
                                                  this.usuarioid   = localStorage.getItem('IDUSER');
                                                  this.mycarid     = localStorage.getItem('MYCARID');
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
                                                                                                  localStorage.setItem('banderamodal','2');
                                                                                              }
                                                                                            }
                                                                                          ]
                                                                                      }).then(alert => alert.present());
                                                                              }else{
                                                                                  //---------aqui this.backgroundMode.enable();
                                                                                  this.selectedVideo     = "file:///"+imageData;
                                                                                  this.selectedVideo = this.selectedVideo.replace("////", "///");
                                                                                  //this.selectedVideo_url = imageData;
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
                                                                                            this.providerhome.promocionesadd(this.selectedVideo, this.selectedVideo_url, this.mycarid, this.usuarioid).then((response) => { 
                                                                                                    this.cargarpromocion = '0';
                                                                                                    this.selectedVideo      = "";
                                                                                                    this.selectedVideo_url  = "";
                                                                                                    this.ionViewDidEnter();
                                                                                                    localStorage.setItem('banderamodal','2');
                                                                                                    //this.backgroundMode.disable();
                                                                                            }, (err) => { 
                                                                                                    this.cargarpromocion = '0';
                                                                                                    this.selectedVideo      = "";
                                                                                                    this.selectedVideo_url  = "";
                                                                                                    localStorage.setItem('banderamodal','2');
                                                                                                    //this.backgroundMode.disable();
                                                                                            }); 
                                                                                  }).catch((error: any) => {
                                                                                    console.log('error remove: ', error);
                                                                                  });
                                                                                  
                                                                                  
                                                                              }
                                                                  }).catch((error: any) => {
                                                                              console.log('error remove: ', error);
                                                                              this.selectedVideo      = "";
                                                                              this.selectedVideo_url  = "";
                                                                              localStorage.setItem('banderamodal','2');
                                                                  });
                                                                                          
                                                  }).catch(error =>{
                                                              this.selectedVideo      = "";
                                                              this.selectedVideo_url  = "";
                                                              localStorage.setItem('banderamodal','2');
                                                         
                                                  });
                                        }
                                    },
                                    {
                                        text: this.idiomapalabras.agregarvideocamara,
                                        cssClass:'button-camara',
                                        handler: data => {
                                          this.alertCtrl.dismiss('si').then( () => { 
                                            localStorage.setItem('banderamodal','2');
                                            this.promocionadd(id);
                                          });//FIN LOADING DISS
                                        }
                                    },
                                    {
                                        text: this.idiomapalabras.agregartexto,
                                        cssClass:'button-camara',
                                        handler: data => {
                                          this.alertCtrl.dismiss('si').then( () => { 
                                            localStorage.setItem('banderamodal','2');
                                            this.perfilpromotextsend();
                                          });//FIN LOADING DIS
                                        }
                                    },
                                    {
                                        text: this.idiomapalabras.cerrar,
                                        role: 'cancel',
                                        cssClass:'ion-pagar3',
                                        handler: data => {
                                              localStorage.setItem('banderamodal','2');
                                             console.log('Confirm close');
                                        }
                                    }
                                  ]
                      }).then(alert2 => {
                              alert2.present();
                              alert2.onDidDismiss().then(detail => {
                                  if (detail['data'] == null) {
                                    //alert('a');
                                    localStorage.setItem('banderamodal','2');
                                  }
                              });
                      });
            }else{
                let cuentaperfil = "0";
                let cuentaperfil2 = 0;
                cuentaperfil = localStorage.getItem('CUENTAPERFIL');
                cuentaperfil2 = parseInt(cuentaperfil) + 1;
                localStorage.setItem('CUENTAPERFIL', cuentaperfil2+"");
                this.navController.navigateRoot("/principal/perfil"); //this.navController.navigateRoot("/principal/perfil/"+cuentaperfil);
            }
    }
    getPicture(sourceType){ 
        let options: CameraOptions = {
            destinationType: this.camera.DestinationType.DATA_URL,
            //targetWidth: 1080,
            //targetHeight: 1080,
            quality: 100,
            correctOrientation: true,
            cameraDirection: this.camera.Direction.BACK,
            sourceType: sourceType
          }
          this.camera.getPicture( options )
          .then(imageData => {
              //this.image1 = 'data:image/jpeg;base64,' + imageData;
              //this.image[0] = this.image1;
              //this.p_push
              
              //this.cropImage(imageData);
              const modal = this.modalController.create({
                  component: Cropimagennueva,
                  cssClass: 'my-custom-class-cropimagen',
                  swipeToClose: true,
                  showBackdrop: true,
                  componentProps: {
                    'dataimagen1': imageData,
                    'list': '1',
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
                                          this.updatefoto();
                                      }
                          });
                          load.present();
              });//FIn LOADING
              //this.show_resizer_image(imageData.split('?')[0]);
          })
          .catch(error =>{
            console.error( error );
          });
    }//FIN FUNCTION
    show_resizer_image(ImagePath) {
                this.isLoading = true;
                var copyPath = ImagePath;
                var splitPath = copyPath.split('/');
                var imageName = splitPath[splitPath.length - 1];
                var filePath = ImagePath.split(imageName)[0];
                this.file.readAsDataURL(filePath, imageName).then(base64 => {
                          this.croppedImagepath = base64;
                          this.isLoading        = false;
                          this.image1   = base64;
                          this.image[0] = this.image1;
                          this.updatefoto();
                }, error => {
                  
                  this.isLoading = false;
                });
    }

    cropImage(fileUrl) {
      this.crop.crop(fileUrl, this.cropOptions)
        .then(
          newPath => {
            this.showCroppedImage(newPath.split('?')[0])
          },
          error => {
            //alert('Error cropping image' + error);
          }
        );
    }
    showCroppedImage(ImagePath) {
      this.isLoading = true;
      var copyPath = ImagePath;
      var splitPath = copyPath.split('/');
      var imageName = splitPath[splitPath.length - 1];
      var filePath = ImagePath.split(imageName)[0];
      this.file.readAsDataURL(filePath, imageName).then(base64 => {
        this.croppedImagepath = base64;
        this.isLoading        = false;
        this.image1   = base64;
        this.image[0] = this.image1;
        this.updatefoto();
      }, error => {
        //alert('Error in showing image' + error);
        this.isLoading = false;
      });
    }
    updatefoto() {
    const loader = this.loadingCtrl.create({
      ////duration: 10000
      //message: "Un momento, por favor..."
    }).then(load => {
                load.present();
                this.cargarpromocion = '1';
                this.usuarioid   = localStorage.getItem('IDUSER');
                this.mycarid     = localStorage.getItem('MYCARID');
                //---------aqui this.backgroundMode.enable();
                this.providerhome.promocionesimgadd(this.mycarid, this.usuarioid, this.image).subscribe((response) => {  
                            this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                    if(response['code']==200){
                                         this.cargarpromocion = '0';
                                         this.ionViewDidEnter();
                                         //this.backgroundMode.disable();
                                    }else if (response['code']==201){
                                                const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                  subHeader: this.idiomapalabras.aviso,
                                                    message: response['msg'],
                                                    buttons: [
                                                      {
                                                        text: "Ok", 
                                                        role: 'cancel',
                                                        handler: data => {
                                                            this.cargarpromocion = '0';
                                                            //this.backgroundMode.disable();
                                                        }
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
                                              this.cargarpromocion = '0';
                                              //this.backgroundMode.disable();
                                          }
                                      }
                                    ]
                                }).then(alert => alert.present());
                    });//FIN LOADING DISS
                });//FIN POST
          });//FIn LOADING
    }//FIN FUNCTION
     /*
    *
    */
    promocionadd(id){
      this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      if(this.sessionactiva=="true"){
          if(this.platform.is('android')){
                        this.androidPermissions.checkPermission(this.androidPermissions.PERMISSION.WRITE_EXTERNAL_STORAGE).then(result1 => {
                                      if (result1.hasPermission){
                                              this.androidPermissions.checkPermission(this.androidPermissions.PERMISSION.ACCESS_FINE_LOCATION).then(result2 => {
                                                        if (result2.hasPermission) {
                                                                      this.cargarpromocion = '1';
                                                                      this.usuarioid   = localStorage.getItem('IDUSER');
                                                                      this.mycarid     = localStorage.getItem('MYCARID');
                                                                      let optios: CaptureVideoOptions  = { duration: 30, limit: 1 }
                                                                      this.mediaCapture.captureVideo(optios).then(
                                                                        (data: MediaFile[]) => {
                                                                                if (data.length > 0) {
                                                                                              this.selectedVideo = data[0].fullPath;
                                                                                              this.selectedVideo = this.selectedVideo.replace("////", "///");
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
                                                                                                        // E.g: Use the Streaming Media plugin to play a video
                                                                                                          //---------aqui this.backgroundMode.enable();
                                                                                                          this.providerhome.promocionesadd(this.selectedVideo, fileUri, this.mycarid, this.usuarioid).then((response) => { 
                                                                                                            //alert(response['status']);
                                                                                                            this.selectedVideo      = "";
                                                                                                            this.selectedVideo_url  = "";
                                                                                                            this.cargarpromocion = '0';
                                                                                                            this.ionViewDidEnter();
                                                                                                            //this.backgroundMode.disable();
                                                                                                          }, (err) => { 
                                                                                                            this.selectedVideo      = "";
                                                                                                            this.selectedVideo_url  = "";
                                                                                                            this.cargarpromocion = '0';
                                                                                                            //this.backgroundMode.disable();
                                                                                                          }); 
                                                                                              }).catch((error: any) => {
                                                                                                          //alert('paso 1 error'); 
                                                                                                          this.selectedVideo      = "";
                                                                                                          this.selectedVideo_url  = "";
                                                                                                          this.cargarpromocion = '0';
                                                                                                          console.log('error remove: ', error);
                                                                                              });
                                                                                }else{
                                                                                    this.cargarpromocion = '0';
                                                                                }
                                                                        },(err: CaptureError) => {
                                                                                          console.error(err); 
                                                                                          this.cargarpromocion = '0';
                                                                        });
                                                        }else{
                                                                        this.androidPermissions.requestPermission(this.androidPermissions.PERMISSION.ACCESS_FINE_LOCATION).then(() => {this.promocionadd(id);});
                                                        }
                                            });//FIN PERMISO
                                    }else{
                                                    this.androidPermissions.requestPermission(this.androidPermissions.PERMISSION.WRITE_EXTERNAL_STORAGE).then(() => {this.promocionadd(id);});
                                    }
                        
                    });//FIN PERMISO
          }else{
                                this.cargarpromocion = '1';
                                this.usuarioid   = localStorage.getItem('IDUSER');
                                this.mycarid     = localStorage.getItem('MYCARID');
                                let optios: CaptureVideoOptions  = { duration: 30, limit: 1 }
                                this.mediaCapture.captureVideo(optios).then((data: MediaFile[]) => {
                                        if (data.length > 0) {
                                            //this.copyFileToLocalDir(data[0].fullPath);
                                          this.selectedVideo = data[0].fullPath;
                                          this.selectedVideo = this.selectedVideo.replace("////", "///");
                                          //alert(this.selectedVideo);
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
                                            // E.g: Use the Streaming Media plugin to play a video
                                              this.providerhome.promocionesadd(this.selectedVideo, fileUri, this.mycarid, this.usuarioid).then((response) => { 
                                                //alert(response['status']);
                                                this.selectedVideo      = "";
                                                this.selectedVideo_url  = "";
                                                this.cargarpromocion = '0';
                                                this.ionViewDidEnter();
                                              }, (err) => { 
                                                this.selectedVideo      = "";
                                                this.selectedVideo_url  = "";
                                                this.cargarpromocion = '0';
                                              }); 
                                          }).catch((error: any) => {
                                            //alert('paso 1 error'); 
                                            this.selectedVideo      = "";
                                            this.selectedVideo_url  = "";
                                            this.cargarpromocion = '0';
                                            console.log('error remove: ', error);
                                          });
                                        }else{
                                            this.cargarpromocion = '0';
                                        }
                                },(err: CaptureError) => {
                                    console.error(err); 
                                    this.cargarpromocion = '0';
                                });
          }//fin else
      }else{
              this.navController.navigateRoot("/principal/perfil"); 
      }
    }
    perfilpromotextsend(){
          this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
          if(this.sessionactiva=="true"){
                localStorage.setItem('banderamodal','1');
                this.cargarpromocion = '1';
               const modal = this.modalController.create({
                  component: Perfilpromotext,
                  cssClass: 'my-custom-class-textopromocion',
                  swipeToClose: true,
                  showBackdrop: true,
                }).then(load => {
                          load.onDidDismiss().then(detail => {
                              localStorage.setItem('banderamodal','2');
                              this.cargarpromocion = '0';
                              if (detail['data'] != null) {
                                this.ionViewDidEnter();
                              }
                          });
                          load.present();
                });//FIn LOADING
          }else{
                let cuentaperfil = "0";
              let cuentaperfil2 = 0;
              cuentaperfil = localStorage.getItem('CUENTAPERFIL');
              cuentaperfil2 = parseInt(cuentaperfil) + 1;
              localStorage.setItem('CUENTAPERFIL', cuentaperfil2+"");
              this.navController.navigateRoot("/principal/perfil"); //this.navController.navigateRoot("/principal/perfil/"+cuentaperfil);
          }
    }

  
  /*
  * MOSTRAR PERFIL SEGuiDORES Y SEGuiDOS
  *
  */
  perfilseg(t){
      localStorage.setItem('banderamodal','1');
      const modal = this.modalController.create({
          component: Perfilsegui,
          cssClass: 'my-custom-class-perfilseg',
          showBackdrop: true,
          componentProps: {
            'usuarioid': this.usuarioid,
            'mycarusuarioid': this.usuarioid,
            'tipo':t
          },
          swipeToClose: true,
        }).then(load => {
                  load.onDidDismiss().then(detail => {
                      localStorage.setItem('banderamodal','2');
                    if (detail['data'] != null) {
                        this.navController.navigateForward("/perfilmycar/"+detail['data']);  
                    }
                  });
                  load.present();
        });//FIn LOADING
  }
  /*
  *
  * FUNCTION PARA CREAR ENLACE hashtag
  */
  hashtag(text) {
    if(text!=null){
      let repl   = text.replace(/#([A-Za-zÁ-Źá-ź0-9_]+)/g,  '<a class="linkir" href="#/buscar2/$1" >#$1</a>');
      let repl2  = repl.replace(/\n/g, "<br />");
      let repl3  = repl2.replace(/@([A-Za-zÁ-Źá-ź0-9_.]+)/g,  '<a class="linkir"  href="#/perfilmycar/$1" >@$1</a>');
      return repl3;
    }else{
      return text;
    }
  }
  presentPopover(ev: any){
    const popover = this.popoverController.create({
      component: Publicmenu,
      cssClass: 'my-custom-class_popver',
      componentProps: {
            'usuarioid': this.usuarioid,
            'publicid': '0',
            'publicusuarioid': '0',
            'salirmodal': '1',
            'comperfil': '1',
            'compublic': '1',
            'editarcuenta':'2',
            'salircuenta':'2',
            'mycarusuarioid': this.usuarioid
      },
      event: ev,
      translucent: true
    }).then(load => {
            load.present();
            load.onDidDismiss().then(detail => {
                  console.log(detail);
            });
    });
  }
  mas(m){
    //this.modalController.dismiss();
    this.navController.navigateRoot("/perfilpostverall/"+m+"/"+this.usuarioid);
  }
  descripcionver(){ 
        //let elem: HTMLElement = document.getElementById('texto');
        //elem.classList.add("div-publicacion-ver-menos");

        //let elem2: HTMLElement = document.getElementById('texto2');
        //elem2.classList.add("div-publicacion-ver-mas");

        let elem3: HTMLElement = document.getElementById('verm');
        elem3.classList.add("div-publicacion-ver-menos");

        this.vardes = '2';
  }
  
  
  toggleInfiniteScroll() {
      //this.infiniteScroll.disabled = !this.infiniteScroll.disabled;
  }
 
  reservadelete(id){
        const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                subHeader: this.idiomapalabras.aviso,
                message:this.idiomapalabras.eliminarreserva,
                buttons: [
                  {
                      text: this.idiomapalabras.cancelar,
                      cssClass:'ion-cancelar',
                      role: 'cancel',
                      handler: data => {

                      }
                  },
                  {
                      text: this.idiomapalabras.confirmar,
                      cssClass:'ion-ir',
                      handler: data => {
                            const loader = this.loadingCtrl.create({
                              //showBackdrop: true
                            }).then(load => {
                              load.present();
                              this.providerhome.reservadel(this.usuarioid, id).subscribe((response) => {  
                                          this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                                  if(response['code']==200){
                                                            this.datosreservas        = response['datosreservas'];
                                                            this.datosreservasatender = response['datosreservasatender'];

                                                            this.data_perfil  = JSON.parse(localStorage.getItem('data_perfil'));
                                                            this.data_perfil['datosreservas']        = response['datosreservas'];
                                                            this.data_perfil['datosreservasatender'] = response['datosreservasatender'];
                                                            localStorage.setItem('data_perfil',  JSON.stringify(this.data_perfil));
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
                            });//FIN POST
                      }
                  }
                ]
        }).then(alert => alert.present());
  }
  /*
  * FUncTION PARA VER IMAGEN
  */
  verimg(id){

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
  compararfechas(date1, date2){
    var hoy        = new Date();
    var mes = (hoy.getMonth() + 1);
    if(mes<=9){
      var mes2 = '0'+mes;
    }else{
       var mes2 = ''+mes;
    }
    var dia = hoy.getDate();
    if(dia<=9){
      var dia2 = '0'+dia;
    }else{
      var dia2 = ''+dia;
    }
    var fecha      = hoy.getFullYear() + '-' + mes2 + '-' +dia2;
    var hora       = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();
    var fechaYHora = fecha + ' ' + hora;
    var date2_aux = fecha;
    if( (new Date(date1).getTime() > new Date(date2_aux).getTime())){
        return 1;
    }else{
        return 2;
    }
    
  }

  mipromocionadd(){

    this.navController.navigateRoot('misanuncios');

  }

  misproveedores(){
     this.navController.navigateRoot('misproveedores');
  }

  agregar(v){
            if(v==1){
                      this.navController.navigateRoot('perfilregistrocompletar1/1');
      }else if(v==2){
                      this.navController.navigateRoot('perfilregistrocompletar2/1');
      }else if(v==3){
                      this.navController.navigateRoot('perfilregistrocompletar3/1');
      }else if(v==4){ 
                      this.navController.navigateRoot('perfilregistrocompletar4/1');
      }else if(v==5){
                      this.publicacionpostadd();
      }     
  }

  editar(){
    this.navController.navigateRoot("perfileditar");
  }


  iniciarsession(){
        this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
        this.version_exporar_ios = localStorage.getItem('VERSION_EXPORTAR_IOS');
        if(this.version_exporar_ios=='2'){
          this.navController.navigateRoot('login1');
        }else{
          this.navController.navigateRoot('perfilinicio');
        }
  }


  registro(){
    this.navController.navigateRoot("perfilregistro");
  }
  

  compartirperfil(id){
        this.msj   = this.idiomapalabras.compartirperfilmsj;
        this.url   = this.rutas.getComvar()+"perfil/"+id;
        this.socialSharing.share(this.msj, null, null, this.url)
  }


  publicacionpostadd(){
      this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
          if(this.sessionactiva=="true"){
                  this.usuarioid     = localStorage.getItem('IDUSER');
                  this.mycarid       = localStorage.getItem('MYCARID');
                  localStorage.setItem('banderamodal','1');
                  //this.navController.navigateForward('mecanicoscalificar/'+item.id+'/'+puntaje);
                  const modal = this.modalController.create({
                      component: Perfilpost,
                      cssClass: 'my-custom-class-postadd',
                      showBackdrop: true,
                      componentProps: {
                        'usuarioid': this.usuarioid,
                        'mycarid': this.mycarid,
                      },
                      swipeToClose: true,
                    }).then(load => {
                              load.onDidDismiss().then(detail => {
                                       //console.log(detail);
                                       localStorage.setItem('banderamodal','2');
                                    if (detail['data'] != null){ 
                                            this.ionViewDidEnter();
                                    }
                              });
                              load.present();
                    });//FIn LOADING
          }else{
                 this.navController.navigateForward("/principal/perfil"); 
          }
  }
}//FIN CLASS
