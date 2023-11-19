import { Component, OnInit, Input } from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController, ModalController } from '@ionic/angular';

import { Home } from '../../providers/home';
import { Variablesglobales } from '../../providers/variablesglobal';

import { ActivatedRoute, Params } from '@angular/router';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

@Component({
  selector: 'app-megafonomsjimg',
  templateUrl: 'megafonomsjimg.html',
  styleUrls: ['megafonomsjimg.scss'],
  providers:[Variablesglobales, Home]
})
export class Megafonomsjimg  implements  OnInit{
    @Input('usuarioid') usuarioid: string;
    @Input('item') item: string;
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
    public myForm: FormGroup;
    public image: string[] = ['', '', ''];
    public image1: string = '';
    public image2: string = '';
    public image3: string = '';

    public clickCount = 0;
    public clickId = 0;
    public preventSingleClick = true;
    public timer: any; 
    public justClicked = false;
    public doubleClicked = false;
    public idiomapalabras: any;
    public username = "";
    public fotodeperfil: string;
    public slideOpts = {
          effect: 'flip',
          autoplay: false
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
                public formBuilder: FormBuilder,
                private navController: NavController, 
                private provider: Home, 
                public alertCtrl: AlertController,
                public loadingCtrl: LoadingController,
                private rutaActiva: ActivatedRoute,
                public modalController: ModalController
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
  } 
  
  ionViewDidEnter(){ 

      //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
      this.username      = localStorage.getItem('USUARIO');
      this.fotodeperfil  = localStorage.getItem('FOTOPERFIL');
      const loader = this.loadingCtrl.create({
        //duration: 10000,
        ////message: "Un momento, por favor...",
        showBackdrop: true 
      }).then(load => {
                        load.present();
                        this.provider.mensajemsjimg(this.item).subscribe((response) => {  
                              this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                        this.datos = response['list'];
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
  close(){
      this.modalController.dismiss();
  }
}//FIN CLASS