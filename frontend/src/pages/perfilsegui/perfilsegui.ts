import { Component, OnInit, ViewChild, Input } from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController, ModalController, PopoverController } from '@ionic/angular';
import { SocialSharing } from '@ionic-native/social-sharing/ngx';
import { Usuario } from '../../providers/usuario';
import { Home } from '../../providers/home';
import { Publicmenu } from '../publicmenu/publicmenu';

declare var google;

@Component({
  selector: 'app-perfilsegui',
  templateUrl: 'perfilsegui.html',
  styleUrls: ['perfilsegui.scss'],
  providers:[SocialSharing, Usuario, Home]
})

export class Perfilsegui  implements  OnInit{
    @Input('usuarioid') usuarioid: string;
    @Input('mycarusuarioid') mycarusuarioid: string;
    @Input('tipo') tipo: string; //1 seguido //2 seguidores
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
    public datos: any;
    public datos2: any;
    public data2: any;
    public idiomapalabras: any;
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
    public slideOpts = {
          effect: 'flip',
          autoplay: false
    };
    public config = {
      dragThreshold:20,
      allowElementScroll: true,
      maxDragAngle: 40,
      avoidElements: true
    };
    public page_number = 1;
    public atrscroll = true;
    public varset: any;
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
                private provider1: Usuario, 
                public popoverController: PopoverController
                ){
        this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
        
    }//FIN FUncTION 
    /*
    *
    * Publicaciones menu
    */ 
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
    publicmenu(ev: any){
      const popover = this.popoverController.create({
        component: Publicmenu,
        cssClass: 'my-custom-class',
        event: ev,
        componentProps: {
            'usuarioid': '0',
            'publicid': '0',
            'publicusuarioid': '1',
            'salirmodal': '2',
            'comperfil': '1',
            'compublic': '1',
            'editarcuenta':'1',
            'salircuenta':'1',
            'mycarusuarioid': '0'
        },
        translucent: true
      }).then(load => {
              load.present();
              load.onDidDismiss().then(detail => {
                  if (detail['data'] != null) {
                        this.modalController.dismiss('si');
                  }
              });
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
      clearInterval(this.varset);
      this.loadingCtrl.getTop().then(loader => {
        if (loader!=undefined) {
           // loader.dismiss();
        }
      });
    } 
    favoritoadd(v, id){
            /*const loader = this.loadingCtrl.create({
              //duration: 10000
              //message: "Un momento, por favor..."
            }).then(load2 => {
                      load2.present();*/
                      let elem: HTMLElement = document.getElementById('bseg'+id);
                      elem.classList.remove("activa");
                      elem.classList.add("desactiva");

                      let elem2: HTMLElement = document.getElementById('bseg2'+id);
                      elem2.classList.add("activa");
                      elem2.classList.remove("desactiva");

                      this.provider1.perfilmycarsfavadd(v, this.usuarioid).subscribe((response) => {  
                                  //load2.dismiss().then( () => { 
                                          if(response['code']==200){                                                      
                                          }else if (response['code']==500){
                                                    let cuentaperfil = "0";
                                                    let cuentaperfil2 = 0;
                                                    cuentaperfil = localStorage.getItem('CUENTAPERFIL');
                                                    cuentaperfil2 = parseInt(cuentaperfil) + 1;
                                                    localStorage.setItem('CUENTAPERFIL', cuentaperfil2+"");
                                                    this.navController.navigateForward("/principal/perfil"); //this.navController.navigateForward("/principal/perfil/"+cuentaperfil);
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
           //});//FIn LOADING
  }//FIN FcuntiN
  favoritodelete(v, id){
            /*const loader = this.loadingCtrl.create({
              //duration: 10000
              //message: "Un momento, por favor..."
            }).then(load2 => {
                      load2.present();*/
                      let elem: HTMLElement = document.getElementById('bseg2'+id);
                      elem.classList.remove("activa");
                      elem.classList.add("desactiva");

                      let elem2: HTMLElement = document.getElementById('bseg'+id);
                      elem2.classList.add("activa");
                      elem2.classList.remove("desactiva");

                      this.provider1.perfilmycarsfavdel(v, this.usuarioid).subscribe((response) => {  
                                  //load2.dismiss().then( () => { 
                                          if(response['code']==200){                                                      
                                          }else if (response['code']==500){
                                                    let cuentaperfil = "0";
                                                    let cuentaperfil2 = 0;
                                                    cuentaperfil = localStorage.getItem('CUENTAPERFIL');
                                                    cuentaperfil2 = parseInt(cuentaperfil) + 1;
                                                    localStorage.setItem('CUENTAPERFIL', cuentaperfil2+"");
                                                    this.navController.navigateForward("/principal/perfil"); //this.navController.navigateForward("/principal/perfil/"+cuentaperfil);
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
            //});//FIn LOADING
  }//FIN FcuntiN
  ionViewDidEnter(){ 

      //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
      this.page_number = 1;
      const loader = this.loadingCtrl.create({
        //duration: 10000,
        ////message: "Un momento, por favor...",
      }).then(load => {
                        load.present();
                        this.provider.listarsegui(this.usuarioid, this.mycarusuarioid, this.tipo, this.page_number).subscribe((response) => {  
                              this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                        this.datos  = response['usuarios'];
                                        this.datos2 = response['datos'];
                                        //console.log( this.datos2);
                                        this.page_number++;
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
    loadData(event) {
        if(this.page_number!=1){
            this.provider.listarsegui(this.usuarioid, this.mycarusuarioid, this.tipo, this.page_number).subscribe((response) => {  
                this.data2aux = response['datos'];
                for (let i = 0; i < this.data2aux.length; i++) {
                    let existe_1 = 0;
                    for (let ii = 0; ii < this.datos2.length; ii++) {
                        if(this.datos2[ii]['id']==this.data2aux[i]['id']){
                            existe_1++;
                        }
                    }
                    if(existe_1==0){
                      this.datos2.push(this.data2aux[i]);
                    }
                }
                this.page_number++;
                event.target.complete();
            });//FIN POST
        }//fin provider
    }//fin if
    linkperfil(v){
        this.usuarioid   = localStorage.getItem('IDUSER');
        this.mycarid   = localStorage.getItem('MYCARID');
        if(this.mycarid==v){
          this.modalController.dismiss();
              this.navController.navigateForward("/principal/perfil");
        }else{
          this.modalController.dismiss(v);
          //this.navController.navigateForward("/perfilmycar/"+v);  
        }
    }
}//FIN CLASS