import { Component, OnInit} from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController, ModalController } from '@ionic/angular';
import { InAppBrowser, InAppBrowserObject, InAppBrowserOptions } from '@awesome-cordova-plugins/in-app-browser/ngx';

import { Usuario } from '../../providers/usuario';
import { MenuController } from '@ionic/angular';

import { ActivatedRoute, Params } from '@angular/router';

  @Component({
  selector: 'app-suscripcion',
  templateUrl: 'suscripcion.html',
  styleUrls: ['suscripcion.scss'],
  providers:[Usuario, InAppBrowser]
})

export class Suscripcion implements  OnInit{
  public myForm: FormGroup;
  public loading: any;
  public usuarioid: string;
  public mycarid = "";
  public sessionactiva = "";
  public usuario = "";
  public p_idioma = "";
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
  public datos: any;
  public precio = 0;
  public options_nuevo: InAppBrowserOptions = {
      location: 'no',//Or 'no'
      hidden: 'no', //Or  'yes'
      clearcache: 'yes',
      clearsessioncache: 'yes',
      hardwareback : 'no',
      closebuttoncaption: 'Regresar a REDSOS', //iOS only
      disallowoverscroll: 'no', //iOS only
      toolbar: 'yes', //iOS only
      enableViewportScale: 'no', //iOS only
      presentationstyle: 'pagesheet',//iOS only
      fullscreen: 'yes',//Windows only
      //lefttoright: 'no',
      toolbarcolor: '#f1f1f1ff',
      usewkwebview: 'yes',
  };
  public idiomapalabras: any;
  constructor(public navController: NavController,
          public formBuilder: FormBuilder,
          private router: Router, 
          private provider: Usuario, 
          private platform: Platform,
          public alertCtrl: AlertController,
          public loadingCtrl: LoadingController,
          private rutaActiva: ActivatedRoute,
          public modalController: ModalController,
          private iab: InAppBrowser,
          ) {

    this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
  }


  ngOnInit() {
            this.loadingCtrl.getTop().then(loader => {
              if (loader!=undefined) {
                console.log('sali',loader);
                this.loadingCtrl.dismiss();
              }
            });
  }

  
  ionViewDidEnter(){ 
      this.usuarioid = localStorage.getItem('IDUSER');
      this.mycarid   = localStorage.getItem('MYCARID');
      this.p_idioma   = localStorage.getItem('P_IDIO'); 
      localStorage.setItem('OPCIONMENU', '4');  
      this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      this.usuario   = localStorage.getItem('USUARIO');
      this.usuarioid = localStorage.getItem('IDUSER');
      this.mycarid   = localStorage.getItem('MYCARID');
       const loader = this.loadingCtrl.create({
          ////duration: 10000
          //message: "Un momento, por favor..."
        }).then(load => {
                  load.present();

                  this.provider.precios().subscribe((response) => {  
                      this.precio = response['precio'];
                  });
                  this.provider.miperfil(this.mycarid, this.usuarioid, 1).subscribe((response) => {  
                              this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                      if(response['code']==200){
                                          this.datos = response['datos'];
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
                                                this.ionViewDidEnter();
                                            }
                                        }
                                      ]
                                  }).then(alert => alert.present());
                      });//FIN LOADING DISS
                  });//FIN POST
        });//FIn LOADING
  }




  regresar(){
    this.navController.back();
  }
 



  enviarformulario() {
    const loader = this.loadingCtrl.create({

    }).then(load => {
              load.present();
              this.provider.checkout(this.mycarid, this.usuarioid).subscribe((response) => {  
                          this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                  if(response['code']==200){
                                     
                                      const Navegador = this.iab.create(response['url'], '_blank', this.options_nuevo)
                                      const browser: InAppBrowserObject = Navegador;


                                  }else if (response['code']==201){
                                              const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                subHeader: this.idiomapalabras.aviso,
                                                  message: this.idiomapalabras.existeusuario,
                                                  buttons: [
                                                    {
                                                      text: "Ok", 
                                                      role: 'cancel'
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
                                            //this.ionViewDidEnter();
                                        }
                                    }
                                  ]
                              }).then(alert => alert.present());
                  });//FIN LOADING DISS
              });//FIN POST
        });//FIn LOADING
  }//FIN FUNCTION



}//fin class