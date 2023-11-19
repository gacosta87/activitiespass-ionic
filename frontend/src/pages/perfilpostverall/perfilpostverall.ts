import { Component, OnInit, Input, ViewChildren, QueryList, ElementRef} from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController, ModalController, PopoverController } from '@ionic/angular';
import * as moment from 'moment';
import 'moment-timezone';
import { Home } from '../../providers/home';
import { Variablesglobales } from '../../providers/variablesglobal';
import { ActivatedRoute, Params } from '@angular/router';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';
import { Publicmenu } from '../publicmenu/publicmenu';
import { Comentarios } from '../comentarios/comentarios';
import { SocialSharing } from '@ionic-native/social-sharing/ngx';
import { Perfilcompartir } from '../perfilcompartir/perfilcompartir';
import { Postmesguta } from '../postmesguta/postmesguta';
import { LaunchNavigator, LaunchNavigatorOptions } from '@ionic-native/launch-navigator/ngx';
@Component({
  selector: 'app-perfilpostverall',
  templateUrl: 'perfilpostverall.html',
  styleUrls: ['perfilpostverall.scss'],
  providers:[Variablesglobales, Home, SocialSharing, LaunchNavigator]
})
export class Perfilpostverall   implements  OnInit {
    @ViewChildren("player") videoPlayers: QueryList<any>
    public rutas   = new Variablesglobales();
    public pais: string;
    public estado: string;
    public municipio: string;
    public datos: any = [];
    public imgurl   = new Variablesglobales();
    public imgurl2: any;
    public searchTerm: any;
    public allItems: any; 
    public items: any;
    public calificacion = 0;
    //public usuarioid: string;
    public mycarsid: string;
    public puntaje = "";
    public datos_calificacion: any;
    public datos_publicaciones: any;
    public myForm: FormGroup;
    public image: string[] = ['', '', ''];
    public image1: string = '';
    public image2: string = '';
    public image3: string = '';
    public sessionactiva = "";
    public clickCount = 0;
    public clickId = 0;
    public preventSingleClick = true;
    public timer: any; 
    public justClicked = false;
    public doubleClicked = false;
    public idiomapalabras: any;
    public username = "";
    public usuarioid = "";
    public mycarid = "";
    public itemid = "";
    public fotodeperfil: string;
    public msj: string;
    public url: string;
    public slideOpts = {
          effect: 'flip',
          autoplay: false
    };
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
    constructor(private router: Router, 
                public formBuilder: FormBuilder,
                private navController: NavController, 
                private provider: Home, 
                private socialSharing: SocialSharing,
                public alertCtrl: AlertController,
                public loadingCtrl: LoadingController,
                private rutaActiva: ActivatedRoute,
                public modalController: ModalController,
                public popoverController: PopoverController,
                public launchNavigator: LaunchNavigator,
                ){
        this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
    }//FIN FUncTION  

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



    playOnSide(elem){


    }


    didScroll(){
          if(this.currentPlaying && this.isElementInViewpor(this.currentPlaying)){
              return;
          }else if(this.currentPlaying && !this.isElementInViewpor(this.currentPlaying)){
              if(this.currentPlaying){
                  this.currentPlaying.pause();
                  this.currentPlaying = null;
              }              
          }
          this.videoPlayers.forEach(player => {
              if(this.currentPlaying){
                  return;
              }
              console.log(player);
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
        if(this.currentPlaying){
            this.currentPlaying.pause();
            this.currentPlaying = null;
        } 
        this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
        if(this.sessionactiva=="true"){
              this.usuarioid = localStorage.getItem('IDUSER');
              this.navController.navigateForward("/megafonomsj/"+v1+"/"+this.usuarioid+"/"+v1);
        }else{
              let cuentaperfil = "0";
              let cuentaperfil2 = 0;
              cuentaperfil = localStorage.getItem('CUENTAPERFIL');
              cuentaperfil2 = parseInt(cuentaperfil) + 1;
              localStorage.setItem('CUENTAPERFIL', cuentaperfil2+"");
              this.navController.navigateForward("/principal/perfil"); //this.navController.navigateForward("/principal/perfil/"+cuentaperfil);
        }
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
  linkperfil(v){
        this.didScroll();
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
  regresar(){
    this.navController.back();
  }
  /*
    *
    * Publicaciones menu
    */ 
    publicmenu(ev: any, pid, uid){
      this.usuarioid   = localStorage.getItem('IDUSER');
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
                      if(this.currentPlaying){
                          this.currentPlaying.pause();
                          this.currentPlaying = null;
                      } 
                      this.navController.navigateForward("/principal/perfil");  
                  }
              });
      });
    }
  ionViewDidLeave(){
    this.loadingCtrl.getTop().then(loader => {
      if (loader!=undefined) {
        console.log('sali de perfilpostverall',loader);
        //this.loadingCtrl.dismiss();
      }
    });
  }
  
  mas(m){
    if(this.currentPlaying){
        this.currentPlaying.pause();
        this.currentPlaying = null;
    } 
    this.navController.navigateForward("/perfilpostverall/"+m+"/"+this.usuarioid);
  }
  ionViewDidEnter(){ 

    //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
      
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
      localStorage.setItem('OPCIONMENU', '1');
      this.usuarioid  = this.rutaActiva.snapshot.paramMap.get('usuarioid');
      this.itemid     = this.rutaActiva.snapshot.paramMap.get('id');
      if(this.usuarioid=="0"){
        this.usuarioid   = localStorage.getItem('IDUSER');
      }
      this.username      = localStorage.getItem('USUARIO');
      this.fotodeperfil  = localStorage.getItem('FOTOPERFIL');
      const loader = this.loadingCtrl.create({
        //duration: 10000,
        ////message: "Un momento, por favor...",
        showBackdrop: true 
      }).then(load => {
                        load.present();
                        this.provider.publiver(this.usuarioid, this.itemid).subscribe((response) => {  
                              this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                        this.datos               = response['datos'];
                                        this.datos_publicaciones = response['datos_publicaciones'];
                                        this.datos_calificacion  = response['datos_calificacion'];
                                        this.didScroll();
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
                                                      this.ionViewDidEnter();
                                                  }
                                              }
                                            ]
                                        }).then(alert => alert.present());
                              });//FIN LOADING DISS
                        });//FIN POST
      });//FIN POST
  }
  doubleClick(id, mycarid) {
      if (this.justClicked === true) {
        this.doubleClicked = true;
        //this.like(id, mycarid);
        let elem = <HTMLInputElement>document.getElementById('icon2'+this.itemid);
        if(elem.name=="heart-outline"){
            this.like(id, mycarid);
        }else{
            if(document.getElementById('iconlike2'+this.itemid)){
                let elem3: HTMLElement = document.getElementById('iconlike2'+this.itemid);
                elem3.classList.add("div-publicacion-content-like-gif-hover");
                setTimeout(() => {
                    let elem4: HTMLElement = document.getElementById('iconlike2'+this.itemid);
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
            this.usuarioid   = localStorage.getItem('IDUSER');
            if(document.getElementById('iconlike2'+this.itemid)){
              let elem3: HTMLElement = document.getElementById('iconlike2'+this.itemid);
              elem3.classList.add("div-publicacion-content-like-gif-hover");
              setTimeout(() => {
                  let elem4: HTMLElement = document.getElementById('iconlike2'+this.itemid);
                  elem4.classList.remove("div-publicacion-content-like-gif-hover");
              }, 300);
            }
            let elem = <HTMLInputElement>document.getElementById('icon2'+this.itemid);
            if(elem.name=="heart-outline"){
                      let elem = <HTMLInputElement>document.getElementById('icon2'+this.itemid);
                      elem.name="heart";

                      let elem2 = <HTMLInputElement>document.getElementById('cmegusta2'+this.itemid);
                      let elem2_  = parseInt(elem2.innerHTML) + 1;
                      elem2.innerHTML = elem2_+'';

                      let elem3: HTMLElement = document.getElementById('megusta2'+this.itemid);
                      elem3.innerHTML=elem2_+'';
            }else{
                      let elem = <HTMLInputElement>document.getElementById('icon2'+this.itemid);
                      elem.name="heart-outline";

                      let elem2: HTMLElement = document.getElementById('cmegusta2'+this.itemid);
                      let elem2_ = parseInt(elem2.innerHTML) - 1;
                      elem2.innerHTML = elem2_+''; 

                      let elem3: HTMLElement = document.getElementById('megusta2'+this.itemid);
                      elem3.innerHTML=elem2_+'';
            }
            this.provider.publilike(this.usuarioid, mycarid, id).subscribe((response) => {  
                                        if(response['code']==200){
                                            let elem = <HTMLInputElement>document.getElementById('icon2'+this.itemid);
                                  }else if (response['code']==201){
                                  }else if (response['code']==500){
                                                    this.modalController.dismiss();
                                                    let cuentaperfil = "0";
                                                    let cuentaperfil2 = 0;
                                                    cuentaperfil = localStorage.getItem('CUENTAPERFIL');
                                                    cuentaperfil2 = parseInt(cuentaperfil) + 1;
                                                    localStorage.setItem('CUENTAPERFIL', cuentaperfil2+"");
                                                    if(this.currentPlaying){
                                                        this.currentPlaying.pause();
                                                        this.currentPlaying = null;
                                                    } 
                                                    this.navController.navigateForward("/principal/perfil"); //this.navController.navigateForward("/principal/perfil/"+cuentaperfil);
                                  }//Fin else
                                  let elem2: HTMLElement = document.getElementById('megusta2'+this.itemid);
                                  elem2.innerHTML=response['cmegusta']+'';
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