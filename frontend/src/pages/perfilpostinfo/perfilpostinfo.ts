import { Component, OnInit, ViewChild, Input } from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController, ModalController, PopoverController } from '@ionic/angular';

declare var google;

@Component({
  selector: 'app-perfilpostinfo',
  templateUrl: 'perfilpostinfo.html',
  styleUrls: ['perfilpostinfo.scss'],
  providers:[]
})

export class Perfilpostinfo implements  OnInit{
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
                public modalController: ModalController,
                ){
        
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
    ionViewDidEnter(){ 

        //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
        localStorage.setItem('AGREGARPRODUCTOBANDERA1', '3');
    }//FIN FcuntiN
    salir(){
        this.modalController.dismiss();
    }

    aceptar(){
        this.navController.navigateRoot("/asistenteconfig");
        this.modalController.dismiss();
    }

}//FIN CLASS