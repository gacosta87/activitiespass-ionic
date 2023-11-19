import { Component, OnInit, ViewChild, Input } from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController, ModalController, PopoverController } from '@ionic/angular';
import { SocialSharing } from '@ionic-native/social-sharing/ngx';
import { Variablesglobales } from '../../providers/variablesglobal';

declare var google;

@Component({
  selector: 'app-invitaramigos',
  templateUrl: 'invitaramigos.html',
  styleUrls: ['invitaramigos.scss'],
  providers:[SocialSharing, Variablesglobales]
})

export class Invitaramigos implements  OnInit{
    public idiomapalabras: any;
    public msj: string;
    public url: string;
    public rutas   = new Variablesglobales();
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
                private socialSharing: SocialSharing
                ){
        this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
    }//FIN FUncTION 


    ionViewDidEnter(){ 

      //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
        
    }//FIN FcuntiN
    omitir(){
        localStorage.setItem('INVITARAMIGOSBANDERA', '3');
        this.modalController.dismiss('si');
    }
    salir(){
        localStorage.setItem('INVITARAMIGOSBANDERA', '3');
        this.msj   = this.idiomapalabras.invitaramigos3;
        this.url   = this.rutas.getDow();
        this.socialSharing.share(this.msj, null, null, this.url);
        this.modalController.dismiss();
    }

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

}//FIN CLASS