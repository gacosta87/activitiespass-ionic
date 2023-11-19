import { Component } from '@angular/core';
import { Platform, NavController, ModalController, AlertController } from '@ionic/angular';
import { SplashScreen } from '@ionic-native/splash-screen/ngx';
import { StatusBar } from '@ionic-native/status-bar/ngx';
import { Router } from '@angular/router';
//import { Push, PushObject, PushOptions } from '@ionic-native/push/ngx';
import { Usuario } from '../providers/usuario';
//import { Megafonosend } from '../pages/megafonosend/megafonosend';
import { Home } from '../providers/home';
import { Deeplinks } from '@ionic-native/deeplinks/ngx';

import { Perfilmycar } from '../pages/perfilmycar/perfilmycar';
import { Perfilpostverall } from '../pages/perfilpostverall/perfilpostverall';
import { Asistenteconfig } from '../pages/asistenteconfig/asistenteconfig';
import { TranslateService } from '@ngx-translate/core';
//import { BackgroundMode } from '@ionic-native/background-mode/ngx';
import { PushService } from '../services/push.service';

//import { Perfilpost } from '../pages/perfilpost/perfilpost';
//import { Megafonosend } from '../pages/megafonosend/megafonosend';

//import { Sugerencias } from '../pages/sugerencias/sugerencias';

declare var google;

@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  styleUrls: ['app.component.scss'],
  providers:[Usuario, Home, Deeplinks]
})
export class AppComponent { 
      //public rootPage = "";
      public myForm = [];
      public usuario = "";
      public mycarid = "";
      public opcionmenu: string = '1';
      public t_push_aux: string;
      public t_push: string;
      public p_push: string;
      public u_push: string; 
      public banderamodal = "2";
      public banderamodalcontador = "0";
      public sessionactiva = "";
      private counter = 0;
      public ruta = "";
      public languaje = "en";
      public usuarioid: string;
      public aviso1 ="";
      public aviso2 ="";
      public p_idio = "";
      public plataforma_exportar = '2';
      public notificaciones_push = '1';
      public varset: any;
      public latitudeusuario  = "";
      public longitudeusuario = "";

      public menuinicio = "";
      public menubuscar = "";
      public menumapa = "";
      public menunotificaciones = "";
      public menuperfil = "";
      public idiomapalabras: any;

      public publicarpost1: string;
      public publicarpost2: string;
      public publicarpost3: string;
      public publicarpost4: string;
      public sugerenciabandera: string;
      public sugerencialedioomitir: string;
      public sugerencialecontador: string;
      public sugerencialecontador_aux = 0;


      //CONFGURACION PARAMETROs
      public conf_activacion = '2';
      constructor(
        private platform: Platform,
        public splashScreen: SplashScreen,
        public statusBar: StatusBar,
        public router: Router,
        //public push: Push,
        public alertCtrl: AlertController,
        public modalController: ModalController,
        public navController: NavController,
        public provider_usuario: Usuario,
        public provider: Home,
        public deeplinks: Deeplinks,
        public translateService: TranslateService,
        private pushService: PushService,
       // private backgroundMode: BackgroundMode
      ) {
            
            //this.navController.navigateRoot("sugerencias");  
            // VERSION_EXPORTAR = 1 es web
            // VERSION_EXPORTAR = 2 es mobil
            localStorage.setItem('VERSION_EXPORTAR', '2'); 
            this.platform.ready().then(() => {
                    this.platform.backButton.subscribe(() => {
                                this.banderamodal = localStorage.getItem('banderamodal');
                                if((this.router.url=='/principal/inicio' || this.router.url=='/solicitudadd') && this.banderamodal=='2') {
                                            localStorage.setItem('OPCIONMENU', '1');
                                            this.sugerenciabandera = localStorage.getItem('SUGERENCIABANDERA3');
                                            if(this.sugerenciabandera=='1'){
                                                    this.sugerencialedioomitir = localStorage.getItem('SUGERENCIALEDIOOMITIR');
                                                    if(this.sugerencialedioomitir!='2'){
                                                            this.sugerencialecontador = localStorage.getItem('SUGERENCIALECONTADOR');
                                                            if(this.sugerencialecontador=='5'){
                                                                    this.navController.navigateRoot("sugerencias");
                                                            }else{
                                                                    if(this.sugerencialecontador==null || this.sugerencialecontador==undefined || this.sugerencialecontador=='NaN'){
                                                                        this.sugerencialecontador_aux=0;
                                                                    }
                                                                    this.sugerencialecontador_aux = parseInt(this.sugerencialecontador) + 1;
                                                                    localStorage.setItem('SUGERENCIALECONTADOR', this.sugerencialecontador_aux+'');
                                                                    navigator['app'].exitApp();
                                                            }//fin else
                                                    }else{
                                                            navigator['app'].exitApp();   
                                                    }//fin else
                                            }else{
                                                        this.navController.navigateRoot("sugerencias");  
                                            }//fin else
                                }else if(this.banderamodal=='2' && this.router.url=='/principal/perfil'){
                                    this.navController.navigateRoot("/principal/inicio");
                                }else if(this.banderamodal=='2' && this.router.url=='/perfilregistrocompletar1/2'){
                                    //Si se registro y entro en pedir categoria no regresar
                                }else if(this.banderamodal=='2' && this.router.url=='/sugerencias'){
                                    //navigator['app'].exitApp(); 
                                }else if(this.banderamodal=='2'){
                                    this.navController.back();
                                }else if(this.banderamodal=='3'){
                                    localStorage.setItem('banderamodal','2');
                                    this.navController.navigateRoot("/principal/inicio");
                                }

                    });
                    
                  console.log("ruta: "+this.router.url);
                  if((this.router.url=='/principal/inicio' || this.router.url=='/solicitudadd')) {
                      localStorage.setItem('OPCIONMENU', '1');
                  }
                  // VERSION_EXPORTAR_IOS = 1 NO
                  // VERSION_EXPORTAR_IOS = 2 SI
                  //this.navController.navigateRoot("sugerencias");  
                    if(this.plataforma_exportar=='2'){
                                  if (this.platform.is('ios')) {    localStorage.setItem('P_PUSH', 'ios');     localStorage.setItem('VERSION_EXPORTAR_IOS', '2'); 
                            }else if(this.platform.is('android')){  localStorage.setItem('P_PUSH', 'android'); localStorage.setItem('VERSION_EXPORTAR_IOS', '1'); }
                    }else{ localStorage.setItem('P_PUSH', 'pwa'); }
                    ///////////////////////////////////////////////////////////////////////////////
                    this.translateService.setDefaultLang('en');
                    if (this.translateService.getBrowserLang() !== undefined) {
                        this.translateService.use(this.translateService.getBrowserLang());
                        //this.translateService.use("es");
                        localStorage.setItem('P_IDIO', this.translateService.getBrowserLang());
                    } else {
                        this.translateService.use('en'); // Set your language here
                    } 


                    ///INICIALIZAR SESSION
                    this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
                    if(this.sessionactiva!="true"){
                        localStorage.removeItem('IDUSER');
                        localStorage.removeItem('USUARIO');
                        localStorage.removeItem('NOMBRESAPELLIDOS');
                        localStorage.removeItem('TOKEN');
                        localStorage.removeItem('SESSIONACTIVA_OLYMPUS_9');
                        localStorage.removeItem('FOTOPERFIL');
                        localStorage.removeItem('MYCARID');
                        localStorage.removeItem('TIPOUSUARIO');
                        localStorage.removeItem('SUGERENCIABANDERA2');
                        localStorage.removeItem('data_inicio');
                        localStorage.removeItem('data_inicio2');
                        localStorage.removeItem('data_inicio_pro');
                        localStorage.removeItem('page_number_inicio');
                        localStorage.setItem('SESSIONACTIVA_OLYMPUS_9', 'false');
                    }

                    ///INICIALIZAR BANDERA MODAL
                    this.banderamodalcontador = localStorage.getItem('banderamodal');
                    if(this.banderamodalcontador!="2" && this.banderamodalcontador!="1"){
                        localStorage.setItem('banderamodal', '2');
                    }


                    this.statusBar.styleDefault();
                    this.splashScreen.hide();

                    //this.pushService.configuracionInicial();
                    this.initializeApp_();
                    this.deeplinks_(); 

            });

      }
      initializeApp_(){
            this.opcionmenu = localStorage.getItem('OPCIONMENU');
            //this.varset     = setInterval(function(){this.comprobarmenu();}.bind(this),2000);
            //this.varset     = setInterval(function(){this.comprobarnotificaciones();}.bind(this),2000);
            this.t_push     = localStorage.getItem('T_PUSH');
            this.p_push     = localStorage.getItem('P_PUSH');
            this.usuarioid  = localStorage.getItem('IDUSER');
            this.p_idio     = localStorage.getItem('P_IDIO');
            this.latitudeusuario  = JSON.parse(localStorage.getItem('latitudeusuario'));
            this.longitudeusuario = JSON.parse(localStorage.getItem('longitudeusuario'));
            if(this.usuarioid!=null){
              this.provider_usuario.actualizarpush(this.t_push, this.p_push, this.usuarioid, this.p_idio, this.latitudeusuario, this.longitudeusuario).subscribe((response2) => {});
            }
            this.provider.consultarconfiguraciones(this.t_push, this.p_push, this.usuarioid, this.p_idio, this.latitudeusuario, this.longitudeusuario).subscribe((respuesta_configuracion) => {
                this.conf_activacion = respuesta_configuracion['datos'][0]['activacion'];
                localStorage.setItem('conf_activacion', this.conf_activacion);
                localStorage.setItem('conf_banner_1', JSON.stringify(respuesta_configuracion['banner_1']));
                localStorage.setItem('conf_banner_2', JSON.stringify(respuesta_configuracion['banner_2']));
                localStorage.setItem('conf_banner_3', JSON.stringify(respuesta_configuracion['banner_3']));
            });
            this.translateService.get(['aviso', 
                                       'noservidor', 
                                       'ver', 
                                       'rutalocal', 
                                       'cerrar', 
                                       'reintentar', 
                                       'noiguales',
                                       'camara',
                                       'galeriaimagenes',
                                       'agregarimagenpubli',
                                       'seleopimg',
                                       'megusta',
                                       'compartirperfilmsj',
                                       'compartirpublimsj',
                                       'eliminarreserva',
                                       'cancelar',
                                       'confirmar',
                                       'mensajerechazadoreserva1',
                                       'mensajerechazadoreserva2',
                                       'agregarimagen',
                                       'agregarvideo',
                                       'agregartexto',
                                       'textopromocion',
                                       'textopromociontext',
                                       'menu_inicio',
                                       'menu_buscar',
                                       'menu_mapa',
                                       'menu_aviso',
                                       'menu_perfil',
                                       'publicarpost1',
                                       'publicarpost2',
                                       'publicarpost3',
                                       'publicarpost4', 
                                       'solicitud',
                                       'menu_notificaciones',
                                       'fechanacimientomenor',
                                       'invitaramigos3',
                                       'eliminarchatmsj',
                                       'copiarmensaje',
                                       'eliminarmensaje',
                                       'publicaciontexto12',
                                       'eliminarcomentario',
                                       'existeusuario',
                                       'agregarvideopubli',
                                       'seleopvideo',
                                       'galeriavideo',
                                       'aviso_video',
                                       'agregarvideocamara',
                                       'eliminarregistro',
                                       'botoncancelar',
                                       'botonaceptar',
                                       'notiempo',
                                       'avisotermino',
                                       'titulo_ubicacion'
                                       ]).subscribe((res: string) => { //  4
                  //this.aviso1 = res; // 
                  this.menuinicio           = res['menu_inicio'];
                  this.menubuscar           = res['menu_buscar'];
                  this.menumapa             = res['menu_mapa'];
                  this.menunotificaciones   = res['menu_notificaciones'];
                  this.menuperfil = res['menu_perfil'];
                  this.publicarpost1 = res['publicarpost1'];
                  this.publicarpost2 = res['publicarpost2'];
                  this.publicarpost3 = res['publicarpost3'];
                  this.publicarpost4 = res['publicarpost4'];
                  this.idiomapalabras = res;

                  localStorage.setItem('idiomapalabras', JSON.stringify(res));
                  //alert(this.aviso1.noservidor);
            }); // add  this
            
      }//fin function
      deeplinks_(){
          this.deeplinks.route({
           '/social/Social/perfil/:id': Perfilmycar,
           '/social/Social/publicacion/:id': Perfilpostverall,
           '/asistenteconfig': Asistenteconfig
          }).subscribe(match => {
            // match.$route - the route we matched, which is the matched entry from the arguments to route()
            // match.$args - the args passed in the link
            // match.$link - the full link data
            //if(match.route.name="CompartirPage"){
              //this.nav.push("RecargasgifcardreferidosPage", { codigo : match.$args.id});
            //}
            //'/perfilmycar/:id': Perfilmycar,
           //'/perfilpostverall/:id/:usuarioid': Perfilpostverall


            if(match.$link.path=="/social/Social/perfil/"+match.$args.id){
              this.ruta = "/perfilmycar/"+match.$args.id;

            }else if(match.$link.path=="/asistenteconfig"){
              this.ruta = "/asistenteconfig";

            }else if(match.$link.path=="/social/Social/publicacion/"+match.$args.id){
              this.ruta = "/perfilpostverall/"+match.$args.id+'/0';
            }


             console.error('Got a deeplink: ', match.$link.path);

            this.navController.navigateForward(this.ruta);  
            //alert('1'+JSON.stringify(match));
             ////console.log('Successfully matched route', match);
          }, nomatch => {
            // nomatch.$link - the full link data
             console.error('Got a deeplink that didn\'t match', nomatch);
          });
      }
        
       
}
