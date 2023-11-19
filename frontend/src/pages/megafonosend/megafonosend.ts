import { Component, OnInit, ViewChild, ElementRef  } from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController, ModalController } from '@ionic/angular';

import { Variablesglobales } from '../../providers/variablesglobal';
import { Home } from '../../providers/home';

import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

@Component({
  selector: 'app-megafonosend',
  templateUrl: 'megafonosend.html',
  styleUrls: ['megafonosend.scss'],
  providers:[Variablesglobales, Home] 
})
export class Megafonosend implements  OnInit{
    @ViewChild('solicita', {static: false}) myInput;
    public pais: string;
    public estado: string;
    public municipio: string;
    public datos: any;
    public imgurl   = new Variablesglobales();
    public imgurl2: any;
    public searchTerm: any;
    public allItems: any;
    public items: any;
    public username = "";
    public usuarioid: string;
    public mycarid: string;
    public fotodeperfil: string;
    public enviado = "si";
    public myForm: FormGroup;
    public idiomapalabras: any;
    public latitudeusuario  = "";
    public longitudeusuario = "";
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
                public alertCtrl: AlertController,
                public loadingCtrl: LoadingController,
                public modalController: ModalController,
                public provider: Home
                ){
        this.myForm = this.formBuilder.group({
            texto: new FormControl('', Validators.compose([ 
                                  Validators.required
                                  ])
                       ),
        });
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
    addhashtag(v){
        //let elem: <HTMLElement> document.getElementById(v);
        this.myInput.value = this.myInput.value+"#";
        this.myInput.setFocus();
    }
    ionViewDidEnter(){ 

        //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
        this.username      = localStorage.getItem('USUARIO');
        this.mycarid       = localStorage.getItem('MYCARID');
        this.usuarioid     = localStorage.getItem('IDUSER');
        this.fotodeperfil  = localStorage.getItem('FOTOPERFIL');
    }
    close(){
      this.modalController.dismiss();
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
        //  loader.dismiss();
        }
      });
  } 
  
    enviarformulario() {
            this.latitudeusuario  = localStorage.getItem('latitudeusuario');
            this.longitudeusuario = localStorage.getItem('longitudeusuario');
        // using the injected ModalController this page
        // can "dismiss" itself and optionally pass back data
        const loader = this.loadingCtrl.create({
          //duration: 10000,
          ////message: "Un momento, por favor..."
          showBackdrop: true
        }).then(load => {
                  load.present();
                  this.provider.solicitudesadd(this.usuarioid, 
                                               this.mycarid, 
                                               this.myForm.value, 
                                               this.latitudeusuario, 
                                               this.longitudeusuario
                                               ).subscribe((response) => {  
                              this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                      if(response['code']==200){
                                        //this.navController.navigateForward("/principal/inicio");
                                        localStorage.setItem('NUEVA_INFORMACION_PERFIL_INICIO', '2');
                                        this.modalController.dismiss(this.enviado);
                                      }else if (response['code']==201){
                                                  const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                    subHeader: this.idiomapalabras.aviso,
                                                      message: response['msg'],
                                                      buttons: [
                                                        {
                                                          text: "Ok", 
                                                          role: 'cancel',
                                                          handler: data => {
                                                              let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                                              botonEnvio.removeAttribute('disabled');
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
                                                let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                                botonEnvio.removeAttribute('disabled');
                                            }
                                        }
                                      ]
                                  }).then(alert => alert.present());
                      });//FIN LOADING DISS
                  });//FIN POST
            });//FIn LOADING
    }//FIN FUNCTION
}//FIN CLASS