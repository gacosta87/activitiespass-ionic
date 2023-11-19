import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController } from '@ionic/angular';

import { Home } from '../../providers/home';

@Component({
  selector: 'app-inforcondiciones',
  templateUrl: 'inforcondiciones.html',
  styleUrls: ['inforcondiciones.scss'],
  providers:[Home]
})

export class Inforcondiciones implements  OnInit{
    public texto: string;
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
    constructor(public navController: NavController,
  			  private router: Router, 
  			  private provider_informacion: Home, 
  			  public alertCtrl: AlertController,
  			  public loadingCtrl: LoadingController
  			  ){

          
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
   salirdecargando(){
      this.loadingCtrl.getTop().then(loader => {
        if (loader!=undefined) {
          console.log('sali',loader);
          this.loadingCtrl.dismiss();
        }
      });
  }
 

  ngOnInit(){
      this.loadingCtrl.getTop().then(loader => {
        if (loader!=undefined) {
          console.log('sali',loader);
          this.loadingCtrl.dismiss();
        }
      });

    }
    ionViewDidEnter(){ 

          //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
          localStorage.setItem('OPCIONMENU', '4');  
          const loader = this.loadingCtrl.create({
            //message: "Un momento, por favor..."
            //duration: 10000
          }).then(load => {
              load.present();
              this.provider_informacion.inforcondiciones(1).subscribe((response) => {  
                    this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                          this.texto=response['texto'];
                    });
              });//FIN POST
          });
    }
}//FIN CLASS
