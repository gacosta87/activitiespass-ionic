import { Component, OnInit, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController, ModalController, PopoverController, IonSlides } from '@ionic/angular';
import { SocialSharing } from '@ionic-native/social-sharing/ngx';
import { Home } from '../../providers/home';
import * as moment from 'moment';
import 'moment-timezone';
import { Variablesglobales } from '../../providers/variablesglobal';

declare var google;

@Component({
  selector: 'app-misproveedores',
  templateUrl: 'misproveedores.html',
  styleUrls: ['misproveedores.scss'],
  providers:[SocialSharing, Home, Variablesglobales]
})

export class Misproveedores implements  OnInit {
    @ViewChild("mySliderpublicidad2", { static: false }) mySliderpubli2?: IonSlides;
    public data: any;
    public myPage: any;
    public datos_menus: any;
    public datos_publi: any;
    public imgurl2: any;
    public selectedIndex = 0;
    public usuario: string;
    public roleid: string;
    public bodys = "";
    public sessionactiva = "";
    public version_exporar = ""; 
    public role_id = "";
    public mycarid = "";
    public pais= "";
    public estado= "" ;
    public municipio = "";
    public usuarioid: string;
    public data2: any;
    public data2aux: any;
    private counter = 0;
    public clickCount = 0;
    public clickId = 0;
    public mensajes = "0";
    public preventSingleClick = true;
    public timer: any; 
    public justClicked = false;
    public doubleClicked = false;
    public auxlike = '1';
    public idiomapalabras: any;
    public slideOpts = {
          effect: 'flip',
          autoplay: false
    };
    public conf_banner_2: any; 
    public config = {
      dragThreshold:20,
      allowElementScroll: true,
      maxDragAngle: 40,
      avoidElements: true
    };
    public page_number = 1;
    public atrscroll = true;
    public varset: any;
    public banderamodal = "2";
    public banderaruta = "";
    public rutas   = new Variablesglobales();
    public slideOpts_publi = {
          effect: 'coverflow',
          autoplay: {
             delay: 3000,
          },
          speed: 2000,
          slidesPerView: 1,
          paginationType:"arrows"
    };
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
                private navController: NavController, 
                public alertCtrl: AlertController,
                public loadingCtrl: LoadingController,
                private socialSharing: SocialSharing,
                public modalController: ModalController,
                private provider: Home, 
                public popoverController: PopoverController
                ){
        this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
        
    }//FIN FUncTION 
   salirdecargando(){
      this.loadingCtrl.getTop().then(loader => {
        if (loader!=undefined) {
          console.log('sali',loader);
          this.loadingCtrl.dismiss();
        }
      });
  }
 

  misproveedoresadd(){
        this.navController.navigateForward("misproveedoresadd");  
  }
  

    ngOnInit() {


    }


    eliminar(v){
          const alert2 = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                        subHeader: "",
                        message:this.idiomapalabras.eliminarregistro,
                        backdropDismiss: true,
                        buttons: [
                            {
                                text: this.idiomapalabras.botoncancelar,
                                cssClass:'button-camara',
                                role: 'cancel',
                                handler: data => {
                                }
                            },
                            {
                                text: this.idiomapalabras.botonaceptar,
                                cssClass:'button-camara',
                                handler: data => {
                                    this.provider.misproveedoresdel(v).subscribe((response) => { });
                                    this.ionViewDidEnter();
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
    }


    linkperfil_publicidad(v){
          this.usuarioid   = localStorage.getItem('IDUSER');
          this.mycarid     = localStorage.getItem('MYCARID');
          if(this.mycarid==v){
            this.navController.navigateForward("/principal/perfil");
          }else{
            this.navController.navigateForward("/perfilmycar/"+v);  
          }
    }

    ionViewDidEnter() {
      this.imgurl2 = this.rutas.getServar();
      this.conf_banner_2  = JSON.parse(localStorage.getItem('conf_banner_2'));
      //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
      localStorage.setItem('OPCIONMENU', '3');
      this.banderamodal = localStorage.getItem('banderamodal');
      if(this.banderamodal=='3'){
          //localStorage.setItem('banderamodal','4');
          //this.banderaruta = localStorage.getItem('rutabandera');
          //this.navController.navigateForward(this.banderaruta);
      }
      this.page_number = 1;
      this.usuarioid = localStorage.getItem('IDUSER');
      localStorage.setItem('notificaciones_push', '1');
      const loader = this.loadingCtrl.create({
        //duration: 10000,
        ////message: "Un momento, por favor...",
      }).then(load => {
                        load.present();
                        this.provider.misproveedoreslis(this.usuarioid, this.page_number).subscribe((response) => {  
                              this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                        this.data  = response['datos'];
                                        this.page_number++;
                                        //console.log(this.data);
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
    }//FIN FcuntiN
    doRefresh(event) {
      this.page_number = 1;
      this.usuarioid = localStorage.getItem('IDUSER');
      this.provider.misproveedoreslis(this.usuarioid, this.page_number).subscribe((response) => {  
                      this.data  = response['datos'];
                      this.page_number++;
                      //console.log(this.data);
                      event.target.complete();
      },error => {
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
      });//FIN
    }//FIN FcuntiN
    loadData(event) {
        this.usuarioid = localStorage.getItem('IDUSER');
        if(this.page_number!=1){
            this.provider.misproveedoreslis(this.usuarioid, this.page_number).subscribe((response) => {  
                this.data2aux = response['datos'];
                for (let i = 0; i < this.data2aux.length; i++) {
                    let existe_1 = 0;
                    for (let ii = 0; ii < this.data.length; ii++) {
                        if(this.data[ii]['id']==this.data2aux[i]['id']){
                            existe_1++;
                        }
                    }
                    if(existe_1==0){
                      this.data.push(this.data2aux[i]);
                    }
                }
                this.page_number++;
                event.target.complete();
            });//FIN POST
        }//fin provider
    }//fin if
    /*
    * function combertir hora
    */
    zonahoraria(h){
      let testDateUtc = moment.tz(h, "America/Caracas");
      let localDate   = testDateUtc.clone().local();
      let horaactual  = localDate.format("DD/MM/YYYY hh:mm a");
      return horaactual;
    }
    regresar(){
        this.navController.back();
    }
}//FIN CLASS