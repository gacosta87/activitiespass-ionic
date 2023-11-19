import { Component, OnInit, ViewChild, ElementRef, Input  } from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController, ModalController } from '@ionic/angular';

import { Variablesglobales } from '../../providers/variablesglobal';
import { Home } from '../../providers/home';
import { format, parseISO } from 'date-fns';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

@Component({
  selector: 'app-reservasadd',
  templateUrl: 'reservasadd.html',
  styleUrls: ['reservasadd.scss'],
  providers:[Variablesglobales, Home] 
})
export class Reservasadd implements  OnInit{
    @ViewChild('solicita', {static: false}) myInput;
    @Input('reservausuarioid') reservausuarioid: string;
    @Input('usuarioperfilid') usuarioperfilid: string;
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
    public fechar  = "";
    public fechar2 = "";
    public horar  = "";
    public year: number ;
    public datosconfig: any;
    constructor(private router: Router, 
                public formBuilder: FormBuilder,
                private navController: NavController, 
                public alertCtrl: AlertController,
                public loadingCtrl: LoadingController,
                public modalController: ModalController,
                public provider: Home
                ){
        this.myForm = this.formBuilder.group({
            fecha: new FormControl('', Validators.compose([ 
                                  Validators.required
                                  ])
                       ),
            fecha2: new FormControl('', Validators.compose([ 
                                  ])
                       ),
            turno: new FormControl('1', Validators.compose([ 
                                  Validators.required
                                  ])
                       )
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
    formatDate(value: string) {
      const value1 = format(parseISO(value), 'dd/MM/yyyy');
      return value1;
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
        var hoy        = new Date();
        var mes = (hoy.getMonth() + 1);
        if(mes<=9){
          var mes2 = '0'+mes;
        }else{
           var mes2 = ''+mes;
        }
        var dia = hoy.getDate();
        if(dia<=9){
          var dia2 = '0'+dia;
        }else{
          var dia2 = ''+dia;
        }
        var fecha2      = hoy.getFullYear() + '-' + mes2 + '-' +dia2;
        var fecha     = dia2+'/'+ mes2 +'/'+hoy.getFullYear();
        var hora       = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();
        console.log('fecha actual '+fecha);
        var fechaYHora = fecha + ' ' + hora;
        this.year   = hoy.getFullYear();
        this.fechar  = fecha;
        this.fechar2 = fecha2;
        this.horar  = hora;
        this.provider.reservaadd(this.usuarioperfilid, 
                                 this.reservausuarioid, 
                                 fecha,
                                 hora,
                                 'proponer',
                                 1
                                 ).subscribe((response) => { 
              if(response['code']==200){
                      //this.fechar = response['fechar'];
                      //this.horar = response['horar'];
                      this.datosconfig = response['datosconfig'];
              } 
        });//FIn LOADING
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
          //loader.dismiss();
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
                  this.provider.reservaadd(this.usuarioperfilid, 
                                           this.reservausuarioid, 
                                           this.myForm.value.fecha, 
                                           this.horar,
                                           'enviar',
                                           this.myForm.value.turno, 
                                           ).subscribe((response) => {  
                              this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                      if(response['code']==200){
                                        //this.navController.navigateForward("/principal/inicio");
                                        this.modalController.dismiss(this.enviado);
                                      }else if (response['code']==201){
                                                  const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                    subHeader: this.idiomapalabras.aviso,
                                                      message: this.idiomapalabras.mensajerechazadoreserva1,
                                                      buttons: [
                                                        {
                                                          text: this.idiomapalabras.reintentar,
                                                          role: 'cancel',
                                                          handler: data => {
                                                              let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                                              botonEnvio.removeAttribute('disabled');
                                                          }
                                                        }
                                                      ]
                                                  }).then(alert => alert.present());
                                      }else if (response['code']==202){
                                                  const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                    subHeader: this.idiomapalabras.aviso,
                                                      message: this.idiomapalabras.mensajerechazadoreserva2,
                                                      buttons: [
                                                        {
                                                          text: this.idiomapalabras.reintentar,
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
                                                //let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                                //botonEnvio.removeAttribute('disabled');
                                            }
                                        }
                                      ]
                                  }).then(alert => alert.present());
                      });//FIN LOADING DISS
                  });//FIN POST
            });//FIn LOADING
    }//FIN FUNCTION
}//FIN CLASS