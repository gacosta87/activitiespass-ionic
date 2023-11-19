import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController } from '@ionic/angular';
import * as moment from 'moment';
import 'moment-timezone';
import { Variablesglobales } from '../../providers/variablesglobal';
import { Home } from '../../providers/home';

@Component({
  selector: 'app-megafono',
  templateUrl: 'megafono.html',
  styleUrls: ['megafono.scss'],
  providers:[Variablesglobales, Home]
})
export class Megafono implements  OnInit {
    public datos: any;
    public imgurl   = new Variablesglobales();
    public imgurl2: any;
    public searchTerm: any;
    public allItems: any;
    public items: any;
    public data: any;
    public usuario: string;
    public version_exporar: string;
    public sessionactiva: string;
    public estado: string;
    public pais: string;
    public municipio: string;
    public usuarioid: string;
    public mycarid: string;
    public varset: number;
    public lista_mensajes: any;
    public idiomapalabras: any;
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
                public provider: Home
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
 

  ngOnInit() {
        this.loadingCtrl.getTop().then(loader => {
          if (loader!=undefined) {
            console.log('sali',loader);
            this.loadingCtrl.dismiss();
          }
        });
    }
    reload_() {
            clearInterval(this.varset);
            this.provider.mensajelist(this.usuarioid).subscribe((response) => {  
                                      if(response['code']==200){
                                              this.data  = response['list'];
                                              this.allItems   = this.data;
                                              localStorage.setItem('lista_mensajes',    JSON.stringify(this.data));
                                              //console.log('list2'+JSON.stringify(this.data));
                                              this.varset = setInterval(function(){
                                                    this.reload_();
                                              }.bind(this),15000);
                                }else if (response['code']==201){
                                            const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                              subHeader: this.idiomapalabras.aviso,
                                                message: response['msg'],
                                                buttons: [
                                                  {
                                                    text: "Ok", 
                                                    role: 'cancel',
                                                    handler: data => {
                                                        this.ionViewDidEnter();
                                                    }
                                                  }
                                                ]
                                            }).then(alert => alert.present());
                                }//Fin else
            });//FIN POST
            this.lista_mensajes = JSON.parse(localStorage.getItem('lista_mensajes')); 
            if(this.lista_mensajes!=null){
                this.data     = JSON.parse(localStorage.getItem('lista_mensajes'));
                this.allItems = this.data;
                //localStorage.setItem('cantidad_mensajes', '0');
            }
    }//fin function 
    /*
    * function combertir hora
    */
    zonahoraria(h){
      let testDateUtc = moment.tz(h, "America/Caracas");
      let localDate   = testDateUtc.clone().local();
      let horaactual  = localDate.format("DD/MM/YYYY hh:mm a");
      return horaactual;
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
          console.log('ver', loader);
          //loader.dismiss();
        }
      });
      clearInterval(this.varset);
    }    
    ionViewDidEnter(){ 

          //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
          localStorage.setItem('OPCIONMENU', '1');
          this.usuario         = localStorage.getItem('NOMBRESAPELLIDOS');
          this.version_exporar = localStorage.getItem('VERSION_EXPORTAR');
          this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
          this.estado          = localStorage.getItem('estado');
          
          this.pais        = localStorage.getItem('pais');
          this.municipio   = localStorage.getItem('municipio');
          this.usuarioid   = localStorage.getItem('IDUSER');
          this.mycarid     = localStorage.getItem('MYCARID');
          this.data        = JSON.parse(localStorage.getItem('lista_mensajes'));
          //localStorage.setItem('cantidad_mensajes', '0');
          const loader = this.loadingCtrl.create({
            ////duration: 10000
            ////message: "Un momento, por favor...",
            //showBackdrop: true
          }).then(load => {
                    load.present();
                    this.provider.mensajelist(this.usuarioid).subscribe((response) => {  
                                this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                              if(response['code']==200){
                                                      this.data  = response['list'];
                                                      this.allItems   = this.data;
                                                      //console.log(this.data);
                                                      localStorage.setItem('lista_mensajes',    JSON.stringify(this.data));
                                                      this.varset = setInterval(function(){
                                                            this.reload_();
                                                      }.bind(this),15000);
                                        }else if (response['code']==201){
                                                    const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                      subHeader: this.idiomapalabras.aviso,
                                                        message: response['msg'],
                                                        buttons: [
                                                          {
                                                            text: "Ok", 
                                                            role: 'cancel',
                                                            handler: data => {
                                                                this.ionViewDidEnter();
                                                            }
                                                          }
                                                        ]
                                                    }).then(alert => alert.present());
                                        }//Fin else
                                });//FIN LOADING DISS                
                    });//FIN POST
          });//FIn LOADING
    }//fin function
    
    onSearchTerm(ev: CustomEvent) {
        this.data = this.allItems;
          this.data = this.data.filter((term) => {
              return term['usuariosdesty']['username'].toLowerCase().indexOf(this.searchTerm.toLowerCase()) > -1 || term['usuariosfrom']['username'].toLowerCase().indexOf(this.searchTerm.toLowerCase()) > -1;
          });
    }
    regresar(){
        this.navController.back();
    }
    irchat(v1, v2, v3){
        this.navController.navigateForward("/megafonomsj/"+v1+"/"+v2+"/"+v3);
    }

    deletechat(v1, v2, v3, v4){
      localStorage.setItem('banderamodal','1');
      const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
          subHeader: this.idiomapalabras.aviso,
            message: this.idiomapalabras.eliminarchatmsj,
            buttons: [
              {
                    text: this.idiomapalabras.cancelar,
                    role: 'cancel',
                    handler: data => { 
                      localStorage.setItem('banderamodal','2'); 
                    }
              },
              {
                    text: this.idiomapalabras.confirmar,
                    cssClass:'ion-aceptar',
                    handler: data => { 
                             localStorage.setItem('banderamodal','2');
                             const loader = this.loadingCtrl.create({
                                ////duration: 10000
                                ////message: "Un momento, por favor...",
                                //showBackdrop: true
                              }).then(load => {
                                        load.present();
                                        this.provider.megafonodelete(v1, v2, v3, v4).subscribe((response) => {  
                                                    this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                                                  if(response['code']==200){
                                                                      clearInterval(this.varset);
                                                                      this.ionViewDidEnter();
                                                            }else if (response['code']==201){ 
                                                                        const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                                          subHeader: this.idiomapalabras.aviso,
                                                                            message: response['msg'],
                                                                            buttons: [
                                                                              {
                                                                                text: "Ok", 
                                                                                role: 'cancel',
                                                                                handler: data => {
                                                                                    this.ionViewDidEnter();
                                                                                }
                                                                              }
                                                                            ]
                                                                        }).then(alert => alert.present());
                                                            }//Fin else
                                                    });//FIN LOADING DISS                
                                        });//FIN POST
                              });//FIn LOADING
                    }
                }
            ]
        }).then(alert => alert.present());
    }//fin function
     
}//FIN CLASS