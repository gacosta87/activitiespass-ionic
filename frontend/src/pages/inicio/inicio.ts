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
 
export class inicio {
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
                    this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
                    this.checkLocation();

                    
    }


    presentPopover(ev: any){
      this.usuarioid   = localStorage.getItem('IDUSER');
      this.mycarid     = localStorage.getItem('MYCARID')
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
        this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
        console.log("hola:"+this.sessionactiva);
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
    

    }//FIN FcuntiN
   
    
    loadData(event) {
        
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

    notificaciones(){
        this.navController.navigateForward("notificaciones");  
    }
    mensajeria(){
      this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
          if(this.sessionactiva=="true"){
              this.navController.navigateForward("megafono");  
          }
    }

  
    
}//FIN CLASS