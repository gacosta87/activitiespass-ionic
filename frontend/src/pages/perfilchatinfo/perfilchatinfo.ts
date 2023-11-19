import { Component, OnInit, ViewChild, Input } from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController, ModalController, PopoverController } from '@ionic/angular';

declare var google;

@Component({
  selector: 'app-perfilchatinfo',
  templateUrl: 'perfilchatinfo.html',
  styleUrls: ['perfilchatinfo.scss'],
  providers:[]
})

export class Perfilchatinfo implements  OnInit{
    @Input('tipo') tipo: string; //1 felicidades //2 mensajes
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
    }//FIN FcuntiN
    salir(){
        this.modalController.dismiss();
    }

}//FIN CLASS