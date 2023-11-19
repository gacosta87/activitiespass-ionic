import { Component, OnInit, OnDestroy, ViewChild, ViewChildren, QueryList, ElementRef} from '@angular/core';
import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController, ModalController, PopoverController, IonContent, IonSlides } from '@ionic/angular';
import { SocialSharing } from '@ionic-native/social-sharing/ngx';
import { Home } from '../../providers/home';
import { Usuario } from '../../providers/usuario';
import { Geolocation } from '@ionic-native/geolocation/ngx';
import { Megafonosend } from '../megafonosend/megafonosend';
import { Promocionview } from '../promocionview/promocionview';
import { Publicmenu } from '../publicmenu/publicmenu';
import { Comentarios } from '../comentarios/comentarios';
import * as moment from 'moment';
import 'moment-timezone';
import { Crop, CropOptions } from '@ionic-native/crop/ngx';
import { File } from '@ionic-native/file/ngx';
import { Perfilpromotext } from '../perfilpromotext/perfilpromotext';
import { Perfilcompartir } from '../perfilcompartir/perfilcompartir';
import { Variablesglobales } from '../../providers/variablesglobal';
import { SuperTabs } from '@ionic-super-tabs/angular';
import { LaunchNavigator, LaunchNavigatorOptions } from '@ionic-native/launch-navigator/ngx';
import {
  MediaCapture,
  MediaFile,
  CaptureError,
  CaptureVideoOptions,
  CaptureAudioOptions
} from '@ionic-native/media-capture/ngx';
import { Postmesguta } from '../postmesguta/postmesguta';
import { Camera, CameraOptions } from '@ionic-native/camera/ngx';
//import { File, FileEntry } from '@ionic-native/file/ngx';
//import { VideoEditor } from '@ionic-native/video-editor/ngx';
import { VideoEditor } from '@awesome-cordova-plugins/video-editor/ngx';
import { StreamingMedia, StreamingVideoOptions } from '@ionic-native/streaming-media/ngx';
import { AndroidPermissions } from '@ionic-native/android-permissions/ngx';
//import { LocationAccuracy } from '@ionic-native/location-accuracy/ngx';
import { Perfilpostinfo } from '../perfilpostinfo/perfilpostinfo';
import { Cropimagennueva } from '../cropimagennueva/cropimagennueva';
//import { BackgroundMode } from '@ionic-native/background-mode/ngx';
import { HelperService } from '../../services/helper.service';

const MEDIA_FOLDER_NAME = 'olympus_media';
declare var google;

@Component({ 
  selector: 'app-inicio',
  templateUrl: 'inicio.html',
  styleUrls: ['inicio.scss'],
  providers:[SocialSharing, 
             Home, 
             Usuario,
             Geolocation, 
             Variablesglobales,
             VideoEditor, 
             StreamingMedia, 
             MediaCapture,
             AndroidPermissions,
             //LocationAccuracy,
             Camera,
             Crop,
             File,
             SuperTabs,
             LaunchNavigator             
            ]
})
 
export class inicio  implements  OnInit, OnDestroy {
   @ViewChild("mySliderpublicidad1", { static: false }) mySliderpubli1?: IonSlides;
   @ViewChild("scrollElement")  content: IonContent;
   @ViewChildren("player") videoPlayers: QueryList<any>
   public data_new_users: any;
   public data_new_users_aux1: any = [];
   public data_new_users_aux2: any = [];
   public rutas   = new Variablesglobales();
    public data: any;
    public data1_pro_lista: any;
    public datos_usuarios: any = '';
    public myPage: any;
    public textsolicitud = "";
    public datos_menus: any;
    public notificaciones_push = '1';
    public datos_publi: any;
    public imgurl2: any;
    public selectedIndex = 0;
    public usuario: string;
    public roleid: string;
    public bodys = "";
    public sessionactiva = "false";
    public version_exporar = ""; 
    public role_id = "";
    public mycarid = "";
    public pais= "";
    public estado= "" ;
    public municipio = "";
    public usuarioid = "";
    public data2: any;
    public data2aux: any;
    public conf_banner_1: any;
    public conf_banner_3: any;
    public data2_solicitudes: any;
    public data2aux_solicitudes: any;
    private counter = 0;
    public clickCount = 0;
    public clickId = 0;
    public mensajes = "0";
    public preventSingleClick = true;
    public timer: any; 
    public justClicked = false;
    public doubleClicked = false;
    public auxlike = '1';
    public cargarpromocion = '0';
    public slideOpts = {
          effect: 'flip',
          autoplay: false
    };
    public slideOpts2 = {
          effect: 'coverflow',
          autoplay: false,
          slidesPerView: 1,
          paginationType:"arrows"
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
    public msj: string;
    public url: string;
    public croppedImagepath = "";
    public isLoading = false;
    public cropOptions: CropOptions = {
      quality: 100,
      targetHeight: 2024,
      targetWidth: 2024
    }
    public selectedVideo: string;
    public selectedVideo_url = "";
    public idiomapalabras: any;
    public config = {
      dragThreshold:20,
      allowElementScroll: true,
      maxDragAngle: 40,
      avoidElements: true
    };
    public dispara = 0;
    public image: string[] = ['', '', '', ''];
    public image1: string = '';
    public image2: string = '';
    public image3: string = '';
    public image4: string = ''; 
    public page_number  = 1;
    public page_number2 = 1;
    public atrscroll = true;
    public varset: any;
    public newyork = "";
    public latitudeusuario  = "";
    public longitudeusuario = "";
    public data_sin_registro: any;
    public version_exporar_ios = "";
    public contarseguidos = 0;
    public banderamodal = "2";
    public banderaruta = "";
    public nuevainformacionperfilinicio = "";
    public nuevainformacionperfiliniciotiempo = "";
    public agregarproductobandera = '0';
    public message: string;
    public editMessage: string;
    public currentPlaying = null;
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
    constructor(  private helper: HelperService,
                  private router: Router, 
                  private navController: NavController, 
                  public alertCtrl: AlertController,
                  public loadingCtrl: LoadingController,
                  private socialSharing: SocialSharing,
                  public modalController: ModalController,
                  private provider: Home, 
                  private provider2: Usuario,
                  private geolocation: Geolocation,
                  public popoverController: PopoverController,
                  public androidPermissions: AndroidPermissions,
                  private mediaCapture: MediaCapture,
                  public launchNavigator: LaunchNavigator,
                  //private locationAccuracy: LocationAccuracy,
                  private streamingMedia: StreamingMedia,
                  private videoEditor: VideoEditor,
                  private camera: Camera,
                  private crop: Crop,
                  private file: File,
                  //private file: File,
                  private platform: Platform,
                  //private backgroundMode: BackgroundMode
                ){
                    this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
                    //this.textsolicitud   = this.idiomapalabras['solicitud'];
                    this.checkLocation();

                    
    }


    iralmapa(lat, long){
        let options: LaunchNavigatorOptions = {
          app: this.launchNavigator.APP.GOOGLE_MAPS
        };
        this.launchNavigator.navigate([lat,long], options).then(success =>{
          //console.log(success);
        },error=>{
          //console.log(error);
        });
    }


    openFullscreen(elem){

    }


    configurarasistente(){
      this.navController.navigateRoot("/asistenteconfig");
    }

    playOnSide(elem){


    }

    linkcategoria(v){
      this.navController.navigateForward("buscarcategorias/0/"+v);  
    }

    didScroll(){
          console.log('player', this.videoPlayers);
          console.log('currenteplay', this.currentPlaying);
          if(this.currentPlaying && this.isElementInViewpor(this.currentPlaying)){
            //this.currentPlaying.play();
            console.log('currente 1');
              return;
          }else if(this.currentPlaying && !this.isElementInViewpor(this.currentPlaying)){
              this.currentPlaying.pause();
              this.currentPlaying = null;
              console.log('currente 2');
          }else{
              console.log('scroll', '3');
          }
          this.videoPlayers.forEach(player => {
              if(this.currentPlaying){
                  console.log('currente 4');
                  return;
              }
              
              const nativeElement = player.nativeElement;
              const inView = this.isElementInViewpor(nativeElement);

              if(inView){
                  this.currentPlaying = nativeElement;
                  //this.currentPlaying.muted = true;
                  this.currentPlaying.play();
              }
          });
    }


    isElementInViewpor(el){
        const rect = el.getBoundingClientRect();
        console.log('top', rect.top);
        return(
          rect.top >= 0 &&
          rect.left >= 0 &&
          rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
          rect.right  <= (window.innerWidth  || document.documentElement.clientWidth)
        );
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
        if(this.currentPlaying){
              this.currentPlaying.pause();
              this.currentPlaying = null;
        }
        clearInterval(this.varset);
          this.loadingCtrl.getTop().then(loader => {
              if (loader!=undefined) {
                console.log('ver', loader);
               // loader.dismiss();
              }
          });
    }

    ngOnDestroy(){
          if(this.currentPlaying){
              this.currentPlaying.pause();
              //this.currentPlaying = null;
          }
    }


    limpiar_vista_video(){
          if(this.currentPlaying){
              this.currentPlaying.pause();
              this.currentPlaying = null;
          }
    }

    subirarriba(){
      if(document.getElementById('scrollElement')){
        this.content.scrollToTop(600);  
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

  ionViewDidEnter(){ 

        this.mySliderpubli1.stopAutoplay();
        this.mySliderpubli1.startAutoplay();

        this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
        this.usuario         = localStorage.getItem('NOMBRESAPELLIDOS');
        this.version_exporar = localStorage.getItem('VERSION_EXPORTAR');
        this.estado          = localStorage.getItem('estado');
        this.pais            = localStorage.getItem('pais');
        this.municipio       = localStorage.getItem('municipio');
        this.usuarioid       = localStorage.getItem('IDUSER');
        this.nuevainformacionperfilinicio        = localStorage.getItem('NUEVA_INFORMACION_PERFIL_INICIO');
        this.nuevainformacionperfiliniciotiempo  = localStorage.getItem('NUEVA_INFORMACION_PERFIL_INICIO_TIEMPO');
        let start_actual = Date.now();
        if(this.nuevainformacionperfiliniciotiempo!=null){
          var tiempo_trancurrido = start_actual - parseInt(this.nuevainformacionperfiliniciotiempo);  
        }else{
          var tiempo_trancurrido = 0;
        }
        //alert("ionViewDidEnter: "+tiempo_trancurrido);
        if((this.nuevainformacionperfilinicio==null) || (this.nuevainformacionperfiliniciotiempo==null) || (this.nuevainformacionperfilinicio=='2') ||  (tiempo_trancurrido>=1200000)){
              //this.limpiar_vista_video();
              if(this.currentPlaying){
                  this.currentPlaying.pause();
                  this.currentPlaying = null;
              }
              //alert("ionViewDidEnter2: "+tiempo_trancurrido);
              this.ngOnInit();
        }

  }

  ngOnInit() {
      //this.datos_usuarios[0]['mycars'] = [''];
      this.loadingCtrl.getTop().then(loader => {
        if (loader!=undefined) {
          console.log('sali',loader);
          this.loadingCtrl.dismiss();
        }
      });
      this.imgurl2 = this.rutas.getServar();
      this.conf_banner_1  = JSON.parse(localStorage.getItem('conf_banner_1'));
      this.conf_banner_3  = JSON.parse(localStorage.getItem('conf_banner_3'));
      this.helper.recibir1.subscribe(res=>{
            if(this.dispara!=res){
                  this.dispara = res;
                  this.subirarriba();
                  console.log("el disparador: "+this.dispara);
            }
      });      
      this.banderamodal    = localStorage.getItem('banderamodal');
      this.usuario         = localStorage.getItem('NOMBRESAPELLIDOS');
      this.version_exporar = localStorage.getItem('VERSION_EXPORTAR');
      this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      this.estado          = localStorage.getItem('estado');
      this.pais            = localStorage.getItem('pais');
      this.municipio       = localStorage.getItem('municipio');
      this.usuarioid       = localStorage.getItem('IDUSER');
      if(this.banderamodal=='3'){
        
      }else{
                    this.checkLocation();
                    this.version_exporar_ios = localStorage.getItem('VERSION_EXPORTAR_IOS');
                    if(this.sessionactiva=="true"){
                            this.agregarproductobandera = localStorage.getItem('AGREGARPRODUCTOBANDERA1');
                            this.agregarproductobandera ='3';
                            if(this.agregarproductobandera=='2'){
                                    localStorage.setItem('banderamodal','1');
                                    const modal = this.modalController.create({
                                        component: Perfilpostinfo,
                                        cssClass: 'my-custom-class-info',
                                        swipeToClose: true,
                                        showBackdrop: true,
                                    }).then(load => { 
                                                load.onDidDismiss().then(detail => {
                                                    localStorage.setItem('banderamodal','2');
                                                });
                                                load.present();
                                      });//FIn LOADING
                            }else if(this.agregarproductobandera=='3'){
                            }else{
                                localStorage.setItem('AGREGARPRODUCTOBANDERA1', '2');
                            }
                    }//fin if
                    this.version_exporar = localStorage.getItem('VERSION_EXPORTAR');
                    localStorage.setItem('OPCIONMENU', '1');
                    if(this.sessionactiva=="true"){
                              this.varset            = setInterval(function(){this.comprobarmensajes();}.bind(this),10000);
                              this.data              = JSON.parse(localStorage.getItem('data_inicio'));
                              this.data1_pro_lista   = JSON.parse(localStorage.getItem('data_inicio_pro'));
                              this.data2             = JSON.parse(localStorage.getItem('data_inicio2'));
                              this.data2_solicitudes = JSON.parse(localStorage.getItem('data_inicio2_solicitudes'));
                              this.latitudeusuario   = JSON.parse(localStorage.getItem('latitudeusuario'));
                              this.longitudeusuario  = JSON.parse(localStorage.getItem('longitudeusuario'));
                              this.page_number       = JSON.parse(localStorage.getItem('page_number_inicio'));
                              this.page_number2      = JSON.parse(localStorage.getItem('page_number_inicio2'));
                              this.datos_usuarios    = JSON.parse(localStorage.getItem('data_inicio_usuarios'));
                              this.data_sin_registro = JSON.parse(localStorage.getItem('data_sin_registro'));
                              this.contarseguidos    = JSON.parse(localStorage.getItem('contarseguidos'));
                              this.data_new_users    = JSON.parse(localStorage.getItem('data_new_users'));


                              if(this.page_number == null){
                                this.page_number = 1;
                              }
                              if(this.page_number2 == null){
                                this.page_number2 = 1;
                              }
                              
                              this.nuevainformacionperfilinicio        = localStorage.getItem('NUEVA_INFORMACION_PERFIL_INICIO');
                              this.nuevainformacionperfiliniciotiempo  = localStorage.getItem('NUEVA_INFORMACION_PERFIL_INICIO_TIEMPO');
                              let start_actual = Date.now();
                              if(this.nuevainformacionperfiliniciotiempo!=null){
                                var tiempo_trancurrido = start_actual - parseInt(this.nuevainformacionperfiliniciotiempo);  
                              }else{
                                var tiempo_trancurrido = 0;
                              }
                              

                              if(this.data2==null){
                                  localStorage.setItem('NUEVA_INFORMACION_PERFIL_INICIO', '1');
                                  this.inicio_app(1, 0);
                              }else if((this.nuevainformacionperfilinicio==null) || (this.nuevainformacionperfiliniciotiempo==null) || (this.nuevainformacionperfilinicio=='2') ||  (tiempo_trancurrido>=1200000) ){
                                  localStorage.setItem('NUEVA_INFORMACION_PERFIL_INICIO', '1');
                                  let start = Date.now();
                                  localStorage.setItem('NUEVA_INFORMACION_PERFIL_INICIO_TIEMPO', start.toString());
                                  this.inicio_app(1, 0);
                              }


                    }else{
                             // localStorage.setItem('SESSIONACTIVA_OLYMPUS_9', 'false');
                              this.data              = JSON.parse(localStorage.getItem('home_false_data_inicio_OLYMPUS_5'));
                              this.data_sin_registro = JSON.parse(localStorage.getItem('home_false_data_sin_registro_OLYMPUS_5'));
                              this.data2             = JSON.parse(localStorage.getItem('home_false_data_inicio2_OLYMPUS_5'));
                              this.latitudeusuario   = JSON.parse(localStorage.getItem('latitudeusuario'));
                              this.longitudeusuario  = JSON.parse(localStorage.getItem('longitudeusuario'));
                              this.data2_solicitudes = JSON.parse(localStorage.getItem('home_false_data_inicio2_solicitudes_OLYMPUS_5'));
                              this.sessionactiva = 'false';


                              this.nuevainformacionperfilinicio        = localStorage.getItem('NUEVA_INFORMACION_PERFIL_INICIO');
                              this.nuevainformacionperfiliniciotiempo  = localStorage.getItem('NUEVA_INFORMACION_PERFIL_INICIO_TIEMPO');
                              let start_actual = Date.now();
                              if(this.nuevainformacionperfiliniciotiempo!=null){
                                var tiempo_trancurrido = start_actual - parseInt(this.nuevainformacionperfiliniciotiempo);  
                              }else{
                                var tiempo_trancurrido = 0;
                              }

                              if((this.nuevainformacionperfilinicio==null) || (this.nuevainformacionperfiliniciotiempo==null) || (this.nuevainformacionperfilinicio=='2') ||  (tiempo_trancurrido>=1200000) ){
                                          let start = Date.now();
                                          localStorage.setItem('NUEVA_INFORMACION_PERFIL_INICIO_TIEMPO', start.toString());                                          
                                          this.provider.homesinregistro(this.latitudeusuario, this.longitudeusuario).subscribe((response) => {  
                                                    if(response['code']==200){
                                                            if(this.currentPlaying){
                                                              this.currentPlaying.pause();
                                                              this.currentPlaying = null;
                                                            }
                                                            this.data_sin_registro  = response['data_sin_registro'];
                                                            this.data               = response['data1_pro_'];
                                                            this.data2              = response['data2'];
                                                            this.data2_solicitudes  = response['data2_solicitudes'];  
                                                            if(this.page_number2 == null){
                                                              this.page_number2 = 1;
                                                            }
                                                            this.page_number2++;
                                                            localStorage.setItem('home_false_data_inicio_OLYMPUS_5',               JSON.stringify(this.data));
                                                            localStorage.setItem('home_false_data_inicio2_OLYMPUS_5',              JSON.stringify(this.data2));
                                                            localStorage.setItem('home_false_data_inicio2_solicitudes_OLYMPUS_5',  JSON.stringify(this.data2_solicitudes));
                                                            localStorage.setItem('home_false_data_sin_registro_OLYMPUS_5',         JSON.stringify(this.data_sin_registro));
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
                                          });//FIN POST
                              }//fin fi

                    }//fin else
      }//fin else bandera
    }//FIN FcuntiN
    /*
    *  FuncION PARA CARGAR EL INICIO
    */
    inicio_app(v, pid){        
        this.mensajes = localStorage.getItem('cantidad_mensajes'); 
        if(this.mensajes==null){
          this.mensajes = '0';
        }
        localStorage.setItem('banderamodalcontador',this.counter+"");
        localStorage.setItem('banderamodal','2');
        this.usuario         = localStorage.getItem('NOMBRESAPELLIDOS');
        this.version_exporar = localStorage.getItem('VERSION_EXPORTAR');
        this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
        this.estado          = localStorage.getItem('estado');
        this.pais            = localStorage.getItem('pais');
        this.municipio       = localStorage.getItem('municipio');
        this.usuarioid       = localStorage.getItem('IDUSER');
        this.page_number     = 1;
        this.provider.home(this.pais, 
                           this.estado, 
                           this.municipio, 
                           this.page_number, 
                           this.usuarioid, 
                           this.mycarid, 
                           this.sessionactiva,
                           this.latitudeusuario,
                           this.longitudeusuario
                           ).subscribe((response) => {  
                    if(response['code']==200){                           
                            let start = Date.now();
                            localStorage.setItem('NUEVA_INFORMACION_PERFIL_INICIO_TIEMPO', start.toString());
                            if((this.data2==null && response['data2'].length>0)){
                                this.data2 = [''];
                                v = 1;
                            }else if(this.data2!=null){
                                    //if(this.data2.length>20){
                                        this.data2 = [''];
                                        v = 1;
                                    //}
                            }
                            this.data               = response['data1_pro_'];
                            this.data_new_users     = response['data_new_users'];
                            this.data1_pro_lista    = response['data1_pro_lista'];
                            this.datos_usuarios     = response['datos_usuarios'];
                            this.data_sin_registro  = response['data_sin_registro'];
                            this.contarseguidos     = response['contarseguidores'];
                            this.data2_solicitudes  = response['data2_solicitudes']; 
                            localStorage.setItem('data_inicio2_solicitudes', JSON.stringify(this.data2_solicitudes)); 
                            this.page_number2=1;
                            this.page_number2++; 
                            localStorage.setItem('page_number_inicio2', JSON.stringify(this.page_number2));
                            if(this.data2!=null){
                                      let existe1 = 0;//Esta variable dice si el id que esta llegando existe
                                      let existe2 = 0;//Esta variable indica si existe alguno nuevo en la consulta que esta llegando
                                      // pid  esta variable es el id que llega eliminado
                                      for (let i = response['data2'].length; i > 0; i--) {
                                                let existe1 = 0;
                                                for (let ii = 0; ii < this.data2.length; ii++) {
                                                    if(response['data2'][i-1]['id']==this.data2[ii]['id']){
                                                      existe1++;
                                                    }
                                                }
                                                if(existe1==0){
                                                  existe2++;
                                                }                                      
                                      }
                                      if(v==1){
                                                  this.data2  = response['data2'];  
                                                  this.content.scrollToTop(0);
                                                  localStorage.setItem('data_inicio2', JSON.stringify(this.data2)); 
                                                  this.page_number=1;
                                                  this.page_number++; 
                                                  localStorage.setItem('page_number_inicio', JSON.stringify(this.page_number));
                                                  //alert("a");                                               
                                      }else if(v==2 && existe2!=0){
                                                 
                                                  ///alert('mensajes nuevos');
                                                  this.data2aux = response['data2']; 
                                                  for (let i = 0; i < this.data2.length; i++) {
                                                          let existe_1 = 0;//Esta variable para ver si el id que ya esta en la cadena de el inicio es esta ya agregado
                                                          for (let ii = 0; ii < this.data2aux.length; ii++) {
                                                             // alert(this.data2[i]['id']+' - '+this.data2aux[ii]['id']);
                                                              if(this.data2[i]['id']==this.data2aux[ii]['id']){
                                                                  this.data2aux[ii]['tcomentarios'] = this.data2[i]['tcomentarios'];
                                                                  this.data2aux[ii]['cmas']         = this.data2[i]['cmas'];
                                                                  this.data2aux[ii]['mas']          = this.data2[i]['mas'];
                                                                  this.data2aux[ii]['textn']        = this.data2[i]['textn'];
                                                                  this.data2aux[ii]['cmegustame']   = this.data2[i]['cmegustame'];
                                                                  this.data2aux[ii]['cmegusta']     = this.data2[i]['cmegusta'];
                                                                  this.data2aux[ii]['ucomentarios'] = this.data2[i]['ucomentarios'];
                                                                  this.data2aux[ii]['ccomentarios'] = this.data2[i]['ccomentarios'];
                                                                  existe_1++;
                                                              }
                                                          }
                                                          if(pid!=this.data2[i]['id'] && existe_1==0){// aqui es para ver si el que se eliminio esta agregandose de nuevo y no dejarlo agregar

                                                              this.data2aux.push(this.data2[i]);

                                                          }
                                                  }
                                                  this.data2 = this.data2aux;
                                                  localStorage.setItem('data_inicio2', JSON.stringify(this.data2));  
                                      }else{
                                              //this.page_number++;
                                      }
                            }
                            if(this.page_number==null){this.page_number=1;this.page_number++;}
                            this.mensajes = response['mensajes']; 
                            ////console.log('mensajes '+this.mensajes); 
                            localStorage.setItem('cantidad_mensajes', this.mensajes);
                            localStorage.setItem('data_inicio',          JSON.stringify(this.data));
                            localStorage.setItem('data_new_users',       JSON.stringify(this.data_new_users));
                            localStorage.setItem('data_inicio_pro',      JSON.stringify(this.data1_pro_lista));
                            localStorage.setItem('data_inicio_usuarios', JSON.stringify(this.datos_usuarios));
                            localStorage.setItem('data_sin_registro',    JSON.stringify(this.data_sin_registro));
                            localStorage.setItem('contarseguidos',       JSON.stringify(this.contarseguidos));
                            if(this.currentPlaying){
                              this.currentPlaying.pause();
                              this.currentPlaying = null;
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
        });//FIN POST
    }




    loadData2(event) {
        console.log("pag: "+this.page_number2);
        if(this.page_number2!=1){
                      this.estado    = localStorage.getItem('estado');
                      this.pais      = localStorage.getItem('pais');
                      this.municipio = localStorage.getItem('municipio');
                      this.usuarioid = localStorage.getItem('IDUSER');
                      this.mycarid   = localStorage.getItem('MYCARID');

                      this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
                      if(this.sessionactiva=="true"){
                                                        this.provider.home_solicitudes(
                                                                                        this.pais, 
                                                                                        this.estado, 
                                                                                        this.municipio, 
                                                                                        this.page_number2, 
                                                                                        this.usuarioid, 
                                                                                        this.mycarid, 
                                                                                        this.sessionactiva,
                                                                                        this.latitudeusuario,
                                                                                        this.longitudeusuario
                                                                                        ).subscribe((response) => {  
                                                                                              if(response['code']==200){
                                                                                                        this.data2aux_solicitudes        = response['data2_solicitudes']; 
                                                                                                        for (let i = 0; i < this.data2aux_solicitudes.length; i++) {
                                                                                                            let existe_1 = 0;
                                                                                                            for (let ii = 0; ii < this.data2_solicitudes.length; ii++) {
                                                                                                                if(this.data2_solicitudes[ii]['id']==this.data2aux_solicitudes[i]['id']){
                                                                                                                    existe_1++;
                                                                                                                }
                                                                                                            }
                                                                                                            if(existe_1==0){
                                                                                                              this.data2_solicitudes.push(this.data2aux_solicitudes[i]);
                                                                                                            }
                                                                                                        }
                                                                                                        if(this.data2aux_solicitudes.length>0){
                                                                                                            this.page_number2++;
                                                                                                            localStorage.setItem('data_inicio2_solicitudes', JSON.stringify(this.data2_solicitudes)); 
                                                                                                            localStorage.setItem('page_number_inicio2', JSON.stringify(this.page_number2));
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
                                                        });//FIN POST
                                                 
                      }else{
                                                  this.provider.homesinregistro_solicitudes(this.latitudeusuario, this.longitudeusuario, this.page_number2).subscribe((response) => {  
                                                                                                  if(response['code']==200){
                                                                                                            this.data2aux_solicitudes  = response['data2_solicitudes']; 
                                                                                                            for (let i = 0; i < this.data2aux_solicitudes.length; i++) {
                                                                                                                let existe_1 = 0;
                                                                                                                for (let ii = 0; ii < this.data2_solicitudes.length; ii++) {
                                                                                                                    if(this.data2_solicitudes[ii]['id']==this.data2aux_solicitudes[i]['id']){
                                                                                                                        existe_1++;
                                                                                                                    }
                                                                                                                }
                                                                                                                if(existe_1==0){
                                                                                                                  this.data2_solicitudes.push(this.data2aux_solicitudes[i]);
                                                                                                                }
                                                                                                            }
                                                                                                            if(this.data2aux_solicitudes.length>0){
                                                                                                                localStorage.setItem('data_inicio2_solicitudes', JSON.stringify(this.data2_solicitudes)); 
                                                                                                                this.page_number2++;
                                                                                                                localStorage.setItem('page_number_inicio2', JSON.stringify(this.page_number2));
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
                                                        });//FIN POST
                      }//fin de la session true
         }else{
            event.target.complete(); 
          }
    }
    loadData(event) {
        console.log("pag: "+this.page_number);
        if(this.page_number!=1){
              this.estado    = localStorage.getItem('estado');
              this.pais      = localStorage.getItem('pais');
              this.municipio = localStorage.getItem('municipio');
              this.usuarioid = localStorage.getItem('IDUSER');
              this.mycarid   = localStorage.getItem('MYCARID');
              this.provider.home(
                                  this.pais, 
                                  this.estado, 
                                  this.municipio, 
                                  this.page_number, 
                                  this.usuarioid, 
                                  this.mycarid, 
                                  this.sessionactiva,
                                  this.latitudeusuario,
                                  this.longitudeusuario
                                  ).subscribe((response) => {  
                                        if(response['code']==200){
                                                  this.contarseguidos = response['contarseguidores'];
                                                  this.data2aux        = response['data2']; 
                                                  for (let i = 0; i < this.data2aux.length; i++) {
                                                      let existe_1 = 0;
                                                      for (let ii = 0; ii < this.data2.length; ii++) {
                                                          if(this.data2[ii]['id']==this.data2aux[i]['id']){
                                                              existe_1++;
                                                          }
                                                      }
                                                      if(existe_1==0){
                                                        this.data2.push(this.data2aux[i]);
                                                      }
                                                  }
                                                  if(this.data2aux.length>0){
                                                      localStorage.setItem('data_inicio2', JSON.stringify(this.data2)); 
                                                      this.page_number++;
                                                      localStorage.setItem('page_number_inicio', JSON.stringify(this.page_number));
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
              });//FIN POST
        }else{
          event.target.complete(); 
        }
    }
    doRefresh(event) {
              if(this.currentPlaying){
                this.currentPlaying.pause();
                this.currentPlaying = null;
              }
              this.estado      = localStorage.getItem('estado');
              this.pais        = localStorage.getItem('pais');
              this.municipio   = localStorage.getItem('municipio');
              this.usuarioid   = localStorage.getItem('IDUSER');
              this.mycarid     = localStorage.getItem('MYCARID');
              this.page_number = 1;
              this.page_number2 = 1;
              this.provider.home(
                                  this.pais, 
                                  this.estado, 
                                  this.municipio, 
                                  1, 
                                  this.usuarioid, 
                                  this.mycarid, 
                                  this.sessionactiva,
                                  this.latitudeusuario,
                                  this.longitudeusuario
                                  ).subscribe((response) => {  
                          //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                        if(response['code']==200){
                                                let start = Date.now();
                                                localStorage.setItem('NUEVA_INFORMACION_PERFIL_INICIO_TIEMPO', start.toString());
                                                this.data             = response['data1_pro_'];
                                                this.data1_pro_lista  = response['data1_pro_lista'];
                                                this.data2            = response['data2'];
                                                this.contarseguidos   = response['contarseguidores'];
                                                this.data_new_users   = response['data_new_users'];  
                                                this.data2_solicitudes  = response['data2_solicitudes']; 
                                                this.datos_usuarios    = response['datos_usuarios'];

                                                localStorage.setItem('data_inicio_usuarios', JSON.stringify(this.datos_usuarios));   
                                                localStorage.setItem('data_new_users',       JSON.stringify(this.data_new_users));
                                                localStorage.setItem('data_inicio',          JSON.stringify(this.data));
                                                localStorage.setItem('data_inicio_pro',      JSON.stringify(this.data1_pro_lista));
                                                localStorage.setItem('data_inicio2',         JSON.stringify(this.data2));
                                                localStorage.setItem('data_inicio2_solicitudes', JSON.stringify(this.data2_solicitudes));
                                                this.page_number++;
                                                this.page_number2++;
                                                localStorage.setItem('page_number_inicio',  JSON.stringify(this.page_number));
                                                localStorage.setItem('page_number_inicio2', JSON.stringify(this.page_number2));
                                                if(event!=1){
                                                  event.target.complete();  
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
                          //});//FIN LOADING DISS
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
    //ngOnInit() {
      /*this.plt.ready().then(() => {
          let path = this.file.dataDirectory;
          this.file.checkDir(path, MEDIA_FOLDER_NAME).then(() => {
            
          }, err => {
              this.file.createDir(path, MEDIA_FOLDER_NAME, false);
          });
      });*/
    //}



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
                        swipeToClose: true,
              }).then(load => {
                        load.onDidDismiss().then(detail => {
                            localStorage.setItem('banderamodal','2');
                          if (detail['data'] != null) {

                          }
                        });
                        load.present();
              });//FIn LOADING
    }





    help(){
        this.socialSharing.shareViaWhatsAppToReceiver('+19787956119', 'Saludos me gustaria solicitar una ayuda sobre olympus').then(() => {
         // Success!
        }).catch(() => {
          // Error!
        });
    }
    iniciarsession(){
        
        if(this.version_exporar_ios=='2'){
          this.navController.navigateForward('login1');
        }else{
          this.navController.navigateForward('perfilinicio');
        }
    }
    registro(){
      this.navController.navigateRoot("perfilregistro");
    }
    checkLocation() {
        this.version_exporar = localStorage.getItem('VERSION_EXPORTAR');
        if(this.version_exporar == '1'){
             //alert('a');
              this.geolocation.getCurrentPosition().then((resp) => {
                    localStorage.setItem('latitudeusuario',  resp.coords.latitude+'');
                    localStorage.setItem('longitudeusuario', resp.coords.longitude+'');   
              });
        }else{
              //alert('b');
              /*this.locationAccuracy.request(this.locationAccuracy.REQUEST_PRIORITY_HIGH_ACCURACY).then((res) => {
                  // When GPS Turned ON call method to get Accurate location coordinates
                  //alert('paso1');
                  this.geolocation.getCurrentPosition().then((resp) => {
                //        alert('c');
                        localStorage.setItem('latitudeusuario',  resp.coords.latitude+'');
                        localStorage.setItem('longitudeusuario', resp.coords.longitude+'');   
                        //alert('paso2');        
                  });
                },
                error => console.log('Error requesting location permissions ' + JSON.stringify(error))
              );*/
        }
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
            swipeToClose: true,
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
    recorrermapa(data){
        for(var i=0; i<6 ; i++) { 
              if(data['results'][0]['address_components'][i]){
                  if (data['results'][0]['address_components'][i]['types'][0] == 'country' ) {                      
                        this.pais  = data['results'][0]['address_components'][i]['long_name']; 
                  }
                  if (data['results'][0]['address_components'][i]['types'][0] == 'locality' ) {                     
                        this.municipio = data['results'][0]['address_components'][i]['long_name']; 
                  } 
              }
          }
          localStorage.setItem('estado',    this.estado);
          localStorage.setItem('pais',      this.pais);
          localStorage.setItem('municipio', this.municipio); 
          ////console.log('pais: '+this.pais);
    }
    ir(op){
          if(op==1){
              this.navController.navigateRoot("/principal/inicio", { animated: false });
          }else if(op==2){
              this.navController.navigateRoot("/principal/buscar", { animated: false });
          }else if(op==3){
              this.navController.navigateRoot("/principal/mapa", { animated: false });
          }else if(op==4){
              let cuentaperfil = "0";
              let cuentaperfil2 = 0;
              cuentaperfil = localStorage.getItem('CUENTAPERFIL');
              cuentaperfil2 = parseInt(cuentaperfil) + 1;
              localStorage.setItem('CUENTAPERFIL', cuentaperfil2+"");
              this.navController.navigateRoot("/principal/perfil"); //this.navController.navigateRoot("/principal/perfil/"+cuentaperfil);
          }
    }/*
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
    * Function para comprobar mensajes nuevos
    */
    comprobarmensajes(){
            this.mensajes = localStorage.getItem('cantidad_mensajes'); 
            if(this.mensajes==null){
              this.mensajes = '0';
            }
            this.notificaciones_push = localStorage.getItem('notificaciones_push'); 
            if(this.notificaciones_push==null){
              this.notificaciones_push = '1';
            }
          /*this.provider.comprobarmensajes(this.usuarioid).subscribe((response) => {  
                this.mensajes = response['mensajes']; 
          });//FIN POST */
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
                      elem3.innerHTML=elem2_+" ";

                      for (let i = 0; i < this.data2.length; i++) {
                        if(this.data2[i]['id']==id){
                              this.data2[i]['cmegustame'] = '2';
                              this.data2[i]['cmegusta'] = this.data2[i]['cmegusta'] + 1; 
                        }
                      }
                      localStorage.setItem('data_inicio2', JSON.stringify(this.data2));  
            }else{
                      let elem = <HTMLInputElement>document.getElementById('icon'+id);
                      elem.name="heart-outline";

                      let elem2: HTMLElement = document.getElementById('cmegusta'+id);
                      let elem2_ = parseInt(elem2.innerHTML) - 1;
                      elem2.innerHTML = elem2_+'';

                      let elem3: HTMLElement = document.getElementById('megusta'+id);
                      elem3.innerHTML=elem2_+" ";

                      for (let i = 0; i < this.data2.length; i++) {
                        if(this.data2[i]['id']==id){
                              this.data2[i]['cmegustame'] = '1';
                              this.data2[i]['cmegusta']   = this.data2[i]['cmegusta'] - 1; 
                        }
                      }
                      localStorage.setItem('data_inicio2', JSON.stringify(this.data2));  
            }
            this.provider.publilike(this.usuarioid, mycarid, id).subscribe((response) => {  
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

    
    notificaciones(){
        this.navController.navigateForward("notificaciones");  
    }
    mensajeria(){
      this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
          if(this.sessionactiva=="true"){
              this.navController.navigateForward("megafono");  
          }
    }

    linkperfil_sugerencia(v, b){ 
        if(this.currentPlaying){
          this.currentPlaying.pause();
          this.currentPlaying = null;
        }

        this.usuarioid   = localStorage.getItem('IDUSER');
        let elem2: HTMLElement = document.getElementById('usuarioseguir_inicio'+v+''+b);
        elem2.classList.add("quitar");


        this.data_new_users_aux1  = JSON.parse(localStorage.getItem('data_new_users'));
        let existe_1 = 0;
        this.data_new_users_aux2 = [];
        for (let i = 0; i < this.data_new_users_aux1.length; i++) {
           if(this.data_new_users_aux1[i]['id']!=v){
              this.data_new_users_aux2[existe_1] = this.data_new_users_aux1[i];
              existe_1++;  
           }
        }
        console.log(this.data_new_users_aux2);
        this.data_new_users = this.data_new_users_aux2;
        localStorage.setItem('data_new_users', JSON.stringify(this.data_new_users));


        if(this.usuarioid==v){
              this.navController.navigateForward("/principal/perfil"); 
        }else{
              this.navController.navigateForward("/perfilmycar/"+v);  
        }
    }
    
    linkperfil(v){
        if(this.currentPlaying){
          this.currentPlaying.pause();
          this.currentPlaying = null;
        }
        this.mycarid     = localStorage.getItem('MYCARID');
        if(this.mycarid==v){
              this.navController.navigateForward("/principal/perfil"); 
        }else{
              this.navController.navigateForward("/perfilmycar/"+v);  
        }
    }
    megafonosend(){
          this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
          if(this.sessionactiva=="true"){
                localStorage.setItem('banderamodal','1');
               const modal = this.modalController.create({
                  component: Megafonosend,
                  cssClass: 'my-custom-class',
                  swipeToClose: true,
                  showBackdrop: true,
                }).then(load => {
                          load.onDidDismiss().then(detail => {
                              localStorage.setItem('banderamodal','2');
                              if (detail['data'] != null) {
                                this.counter += 1;
                                localStorage.setItem('banderamodalcontador', this.counter+"");
                                this.inicio_app(1, 0);
                                //this.navController.navigateRoot("/principal/inicio/"+this.counter);
                              }
                          });
                          load.present();
                });//FIn LOADING
          }else{
                this.navController.navigateRoot("/principal/perfil"); 
          }
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
                                  
                                  backdropDismiss: true,
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
                                                                                      this.selectedVideo = "file:///"+imageData;
                                                                                      this.selectedVideo = this.selectedVideo.replace("////", "///");
                                                                                       console.log('ruta: ', this.selectedVideo);
                                                                                      //this.selectedVideo_url = imageData;
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
                                                                                              this.provider.promocionesadd(this.selectedVideo, this.selectedVideo_url, this.mycarid, this.usuarioid).then((response) => {
                                                                                                      this.selectedVideo      = "";
                                                                                                      this.selectedVideo_url  = "";
                                                                                                      this.cargarpromocion = '0';
                                                                                                      localStorage.setItem('banderamodal','2');
                                                                                                      this.promocionesinicio();
                                                                                                      //this.backgroundMode.disable();
                                                                                              }, (err) => { 
                                                                                                      this.selectedVideo      = "";
                                                                                                      this.selectedVideo_url  = "";
                                                                                                      localStorage.setItem('banderamodal','2');
                                                                                                      this.cargarpromocion = '0';
                                                                                                      console.log('error remove2 video: ',     this.selectedVideo);
                                                                                                      console.log('error remove2 video url: ', this.selectedVideo_url);
                                                                                                      console.log('error remove2: ', err);
                                                                                                      //this.backgroundMode.disable();
                                                                                              }); 
                                                                                      }).catch((error: any) => {
                                                                                        this.cargarpromocion = '0';
                                                                                        console.log('error remove1: ', error);
                                                                                      });
                                                                                      
                                                                              }
                                                                  }).catch((error: any) => {
                                                                              localStorage.setItem('banderamodal','2');
                                                                              console.log('error remove3: ', error);
                                                                              this.cargarpromocion = '0';
                                                                              this.selectedVideo      = "";
                                                                              this.selectedVideo_url  = "";
                                                                  });
                                                                                          
                                                  }).catch(error =>{
                                                    this.cargarpromocion = '0';
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
                this.provider.promocionesimgadd(this.mycarid, this.usuarioid, this.image).subscribe((response) => {  
                            
                            this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                    if(response['code']==200){
                                         this.cargarpromocion = '0';
                                         this.inicio_app(1, 0);
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
                                                                                                          this.provider.promocionesadd(this.selectedVideo, fileUri, this.mycarid, this.usuarioid).then((response) => { 
                                                                                                            //alert(response['status']);
                                                                                                            this.selectedVideo      = "";
                                                                                                            this.selectedVideo_url  = "";
                                                                                                            this.cargarpromocion = '0';
                                                                                                            //this.inicio_app(1, 0);
                                                                                                            this.promocionesinicio();
                                                                                                            //this.backgroundMode.disable();
                                                                                                          }, (err) => { 
                                                                                                            this.selectedVideo      = "";
                                                                                                            this.selectedVideo_url  = "";
                                                                                                            this.cargarpromocion = '0';
                                                                                                            //this.backgroundMode.disable();
                                                                                                          }); 
                                                                                              }).catch((error: any) => {
                                                                                                          //alert('paso 1 error'); 
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
                                              //---------aqui this.backgroundMode.enable();
                                              this.provider.promocionesadd(this.selectedVideo, fileUri, this.mycarid, this.usuarioid).then((response) => { 
                                                this.selectedVideo      = "";
                                                this.selectedVideo_url  = "";
                                                //alert(response['status']);
                                                this.cargarpromocion = '0';
                                                //this.inicio_app(1, 0);
                                                this.promocionesinicio();
                                                //this.backgroundMode.disable();
                                              }, (err) => { 
                                                this.selectedVideo      = "";
                                                this.selectedVideo_url  = "";
                                                this.cargarpromocion = '0';
                                                //this.backgroundMode.disable();
                                              }); 
                                          }).catch((error: any) => {
                                            //alert('paso 1 error'); 
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

    promocionesinicio(){
        localStorage.setItem('banderamodalcontador',this.counter+"");
        localStorage.setItem('banderamodal','2');
        this.usuario         = localStorage.getItem('NOMBRESAPELLIDOS');
        this.version_exporar = localStorage.getItem('VERSION_EXPORTAR');
        this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
        this.estado          = localStorage.getItem('estado');
        this.pais            = localStorage.getItem('pais');
        this.municipio       = localStorage.getItem('municipio');
        this.usuarioid       = localStorage.getItem('IDUSER');
        //this.page_number     = 1;
        this.provider.promocionesinicio(this.pais, 
                                       this.estado, 
                                       this.municipio, 
                                       1, 
                                       this.usuarioid, 
                                       this.mycarid, 
                                       this.sessionactiva,
                                       this.latitudeusuario,
                                       this.longitudeusuario
                                       ).subscribe((response) => {  
                                                                          if(response['code']==200){        

                                                                                  //    

                                                                                  this.datos_usuarios    = response['datos_usuarios'];
                                                                                  localStorage.setItem('datos_usuarios',        JSON.stringify(this.datos_usuarios)); 
                                                                                  localStorage.setItem('data_inicio_usuarios',  JSON.stringify(this.datos_usuarios));  
                                                                                               
                                                                                  
                                                                                  this.data1_pro_lista    = response['data1_pro_lista'];
                                                                                  localStorage.setItem('data_inicio_pro',      JSON.stringify(this.data1_pro_lista));

                                                                                  this.mensajes = response['mensajes']; 
                                                                                  localStorage.setItem('cantidad_mensajes', this.mensajes);

                                                                                  this.data               = response['data1_pro_'];
                                                                                  localStorage.setItem('data_inicio',          JSON.stringify(this.data));

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
        });//FIN POST


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
                                this.counter += 1;
                                localStorage.setItem('banderamodalcontador', this.counter+"");
                                this.promocionesinicio();
                                //this.inicio_app(1, 0);
                                //this.navController.navigateRoot("/principal/inicio/"+this.counter);
                              }
                          });
                          load.present();
                });//FIn LOADING
          }else{
              
              this.navController.navigateRoot("/principal/perfil"); 
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
            'local':'0',
          },
      }).then(load => {
                  load.onDidDismiss().then(detail => {
                      localStorage.setItem('banderamodal','2');
                      this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
                      if(this.sessionactiva=="true"){
                                  this.cargarpromocion = '0';
                                  //this.inicio_app(1, 0);
                                    this.promocionesinicio();        
                      }else{
                              this.promocionesinicio();
                      }
                      if (detail['data'] != null) {
                        localStorage.setItem('banderamodalcontador', this.counter+"");
                      }
                  });
                  load.present();
      });//FIn LOADING
    }
    compartirpublic(id, userid){
                  console.log('log');
                  this.usuarioid     = localStorage.getItem('IDUSER');
                  this.mycarid       = localStorage.getItem('MYCARID');
                  localStorage.setItem('banderamodal','1');
                  const modal = this.modalController.create({
                                                              component: Perfilcompartir,
                                                              cssClass: 'my-custom-class-compartir',
                                                              showBackdrop: true,
                                                              componentProps: {
                                                                'usuarioid': this.usuarioid,
                                                                'mycarid': this.mycarid,
                                                                'publicid':id,
                                                                'publicuserid':userid
                                                              },
                                                              swipeToClose: true,
                    }).then(load => {
                                                              load.onDidDismiss().then(detail => {
                                                                  localStorage.setItem('banderamodal','2');
                                                                 // this.cargarpromocion = '0';
                                                                  //this.inicio_app(1, 0);
                                                              });
                                                              load.present();
                    });
        /*
        this.msj   = this.idiomapalabras.compartirpublimsj;
        this.url   = this.rutas.getComvar()+"publicacion/"+id;
        this.socialSharing.share(this.msj, null, null, this.url);
        */
    }
}//FIN CLASS