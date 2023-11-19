import { Component, ViewChild, Output, EventEmitter, OnInit, OnDestroy} from '@angular/core';
import { Platform, NavController, ModalController, AlertController } from '@ionic/angular';
import { SplashScreen } from '@ionic-native/splash-screen/ngx';
import { StatusBar } from '@ionic-native/status-bar/ngx';
import { Router } from '@angular/router';
//import { Push, PushObject, PushOptions } from '@ionic-native/push/ngx';
import { Usuario } from '../../providers/usuario';
//import { Megafonosend } from '../pages/megafonosend/megafonosend';
import { Home } from '../../providers/home';
import { Deeplinks } from '@ionic-native/deeplinks/ngx';

import { Perfilmycar } from '../perfilmycar/perfilmycar';
import { Perfilpostverall } from '../perfilpostverall/perfilpostverall';
import { TranslateService } from '@ngx-translate/core';

import { Perfilpost } from '../perfilpost/perfilpost';
import { Megafonosend } from '../megafonosend/megafonosend';

import { Geolocation } from '@ionic-native/geolocation/ngx';
//import { LocationAccuracy } from '@ionic-native/location-accuracy/ngx';
import { Cropimagennueva } from '../cropimagennueva/cropimagennueva';
import { Invitaramigos } from '../invitaramigos/invitaramigos';

import { Perfilubucacioninfo } from '../perfilubucacioninfo/perfilubucacioninfo';

import { HelperService } from '../../services/helper.service';

declare var google;

@Component({
  selector: 'app-principal',
  templateUrl: 'principal.html',
  styleUrls: ['principal.scss'],
  providers:[Usuario, Home, Deeplinks, Geolocation, 
  //LocationAccuracy, 
  Cropimagennueva]
})
export class Principal   implements  OnInit, OnDestroy {
      //public rootPage = "";
      public myForm = [];
      public usuario = "";
      public mycarid = "";
      public opcionmenu: string = '1';
      public t_push_aux: string;
      public t_push: string;
      public p_push: string;
      public u_push: string; 
      public banderamodalcontador = "0";
      public sessionactiva = "";
      public version_exporar = ""; 
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
      public varset2: any;
      public latitudeusuario  = "";
      public longitudeusuario = "";
      public version_exporar_ios = "";
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
      public banderamodal = "2";
      public banderaruta = "";
      public invitaramigosbandera = '0';
      public agregar_ubicacion = '0';
      public dispara  = 0;
      public dispara2 = 0;
      public dispara3 = 0;
      public dispara4 = 0;
      public message: string;
      public editMessage: string;
      constructor(
        private helper: HelperService,
        private platform: Platform,
        private splashScreen: SplashScreen,
        private statusBar: StatusBar,
        private router: Router,
        //private push: Push,
        public alertCtrl: AlertController,
        public modalController: ModalController,
        public navController: NavController,
        private provider_usuario: Usuario,
        private provider: Home,
        private deeplinks: Deeplinks,
        private geolocation: Geolocation,
        private translateService: TranslateService,
      //  private locationAccuracy: LocationAccuracy,
      ) {
            this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));

      }

    actualziar_vista_padre_inicio(){
        this.helper.enviar1(this.dispara);
       // console.log("Principal El nuevo mensaje "+this.dispara);
        this.dispara++;
    }
    

    actualziar_vista_padre_buscar(){
        this.helper.enviar2(this.dispara2);
       // console.log("Principal El nuevo mensaje "+this.dispara);
        this.dispara2++;
    }


    actualziar_vista_padre_perfil(){
        this.helper.enviar3(this.dispara3);
       // console.log("Principal El nuevo mensaje "+this.dispara);
        this.dispara3++;
    }


    actualziar_vista_padre_eventos(){
        this.helper.enviar4(this.dispara4);
       // console.log("Principal El nuevo mensaje "+this.dispara);
        this.dispara4++;
    }

    ngOnInit() {
        //this.helper.customMessage.subscribe(msg => this.message = msg);
        
    }
    ngOnDestroy(){

    }
    ionViewDidEnter(){ 

        this.banderamodal = localStorage.getItem('banderamodal');
        if(this.banderamodal=='3'){
           // localStorage.setItem('banderamodal','2');
           // this.banderaruta = localStorage.getItem('rutabandera');
            //this.navController.navigateForward(this.banderaruta);
        }
        this.checkLocation();
        //this.varset   = setInterval(function(){this.comprobarmenu();}.bind(this),2000);
        this.varset2    = setInterval(function(){this.comprobarnotificaciones();}.bind(this),2000);
    }
    ionViewDidLeave(){
      clearInterval(this.varset);
      clearInterval(this.varset2);
    } 
    comprobarmenu(){
      this.opcionmenu = localStorage.getItem('OPCIONMENU'); 
    }
    /*
    * Function para comprobar mensajes nuevos
    */
    comprobarnotificaciones(){
            this.notificaciones_push = localStorage.getItem('notificaciones_push'); 
            if(this.notificaciones_push==null){
              this.notificaciones_push = '1';
            }
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
                  //      alert('c');
                        localStorage.setItem('latitudeusuario',  resp.coords.latitude+'');
                        localStorage.setItem('longitudeusuario', resp.coords.longitude+'');   
                        //alert('paso2');        
                  });
                },
                error => console.log('Error requesting location permissions ' + JSON.stringify(error))
              );*/
        }
    }
    
     //////////////////////////////////SESSION DE PROMOCIONATE///////////////////////////////////////////////////
    /*
        *
        *
        *
        *
    */
    agregarpublicacion(){
      this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
          if(this.sessionactiva=="true"){
                      this.invitaramigosbandera = localStorage.getItem('INVITARAMIGOSBANDERA');
                      this.agregar_ubicacion    = localStorage.getItem('agregar_ubicacion');
                      this.invitaramigosbandera = '3'; //COn esto quito que le salgan sugerencias siempre al usuario
                      if(this.invitaramigosbandera=='2'){
                                  localStorage.setItem('banderamodal','1');
                                  const modal = this.modalController.create({
                                      component: Invitaramigos,
                                      cssClass: 'my-custom-class-invitar',
                                      swipeToClose: true,
                                      showBackdrop: true
                                  }).then(load => {
                                              load.onDidDismiss().then(detail => {
                                                  localStorage.setItem('banderamodal','2');
                                                  //if (detail['data'] != null){
                                                        this.publicacionpostadd();
                                                  //}
                                              });
                                              load.present();
                                  });//FIn LOADING
                      }else if(this.invitaramigosbandera=='3'){
                        this.publicacionpostadd();
                      }else if(this.agregar_ubicacion!='3'){
                                localStorage.setItem('banderamodal','1');
                                const modal = this.modalController.create({
                                    component: Perfilubucacioninfo,
                                    cssClass: 'my-custom-class-info',
                                    swipeToClose: true,
                                    showBackdrop: true,
                                }).then(load => { 
                                            load.onDidDismiss().then(detail => {
                                                localStorage.setItem('banderamodal','2');
                                                this.publicacionpostadd();
                                            });
                                            load.present();
                                  });//FIn LOADING
                      }else{
                        this.publicacionpostadd();
                        localStorage.setItem('INVITARAMIGOSBANDERA', '2');  
                      }
            }else{
                this.navController.navigateForward("/principal/perfil"); 
            }
    }
    publicacionsolicitudadd(){
          this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
          if(this.sessionactiva=="true"){
                localStorage.setItem('banderamodal','1');
               const modal = this.modalController.create({
                  component: Megafonosend,
                  cssClass: 'my-custom-class',
                  swipeToClose: true,
                  showBackdrop: true
                }).then(load => {
                          load.onDidDismiss().then(detail => {
                              localStorage.setItem('banderamodal','2');
                              if (detail['data'] != null && (this.router.url=='/principal/inicio' || this.router.url=='/principal/solicitudadd')){ 
                                    if(this.router.url=='/principal/inicio'){
                                        this.navController.navigateForward("/principal/solicitudadd");
                                    }else{
                                       this.navController.navigateForward("/principal/inicio");
                                    }
                                    
                              }
                          });
                          load.present();
                });//FIn LOADING
          }else{
                this.navController.navigateForward("/principal/perfil");
          }
    }
    publicacionpostadd(){
      this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
          if(this.sessionactiva=="true"){
                this.navController.navigateRoot("/perfilpost");                 
          }else{
                this.navController.navigateForward("/principal/perfil"); 
          }
  }
  menu(op){
    localStorage.setItem('OPCIONMENU', op);
    if(op==1){
        this.navController.navigateForward("/principal/inicio");
        console.log('click');
    }else if(op==2){
        this.navController.navigateForward("/principal/buscar/0");
    }else if(op==3){
        this.navController.navigateForward("/principal/notificaciones");
    }else if(op==4){
        let cuentaperfil = "0";
        let cuentaperfil2 = 0;
        cuentaperfil = localStorage.getItem('CUENTAPERFIL');
        cuentaperfil2 = parseInt(cuentaperfil) + 1;
        localStorage.setItem('CUENTAPERFIL', cuentaperfil2+"");
        this.navController.navigateForward("/principal/perfil"); 
    }
    this.opcionmenu = op;

  }//fin function menu
  
}
