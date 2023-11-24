import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController } from '@ionic/angular';
import * as moment from 'moment';
import 'moment-timezone';
import { Variablesglobales } from '../../providers/variablesglobal';
import { Home } from '../../providers/home';

@Component({
  selector: 'app-obtenerPerfilesUsuario',
  templateUrl: 'obtenerPerfilesUsuario.html',
  styleUrls: ['obtenerPerfilesUsuario.scss'],
  providers:[Variablesglobales, Home]
})
export class obtenerPerfilesUsuario implements  OnInit {
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
    public perfiles: any;
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

 

  ngOnInit() {
        this.loadingCtrl.getTop().then(loader => {
          if (loader!=undefined) {
            console.log('sali',loader);
            this.loadingCtrl.dismiss();
          }
        });
    }


    seleccionarPerfil(perfil){

        localStorage.setItem('DATOSDEPERFIL', perfil);
        this.navController.navigateForward("/principal/perfil"); 
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


          }).then(load => {
                    load.present();
                    this.provider.obtenerPerfilesUsuario(this.usuarioid).subscribe((response) => {  
                                this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                              if(response['code']==200){
                                                      this.perfiles  = response['perfiles'];

                                                      console.log(this.perfiles);
                                                      
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
    
     
}//FIN CLASS