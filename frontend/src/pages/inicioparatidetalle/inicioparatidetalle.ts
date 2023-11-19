import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController } from '@ionic/angular';
import { ActivatedRoute, Params } from '@angular/router';
import { Home } from '../../providers/home';

@Component({
  selector: 'app-inicioparatidetalle',
  templateUrl: 'inicioparatidetalle.html',
  styleUrls: ['inicioparatidetalle.scss'],
  providers:[Home]
})

export class Inicioparatidetalle implements  OnInit{
    public texto: string;
    public usuarioid: string;
    public public_id: string;
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
  			  public loadingCtrl: LoadingController,
          private rutaActiva: ActivatedRoute,
  			  ){
    }

    regresar(){
      this.navController.back();
    }

    ionViewDidLeave(){
       this.loadingCtrl.getTop().then(loader => {
        if (loader!=undefined) {
          console.log('ver', loader);
         // loader.dismiss();
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
            //duration: 10000
            //message: "Un momento, por favor..."
          }).then(load => {
              load.present();
              this.public_id = this.rutaActiva.snapshot.paramMap.get('id');
              this.usuarioid = localStorage.getItem('IDUSER');
              this.provider_informacion.publicaciondata(this.usuarioid, this.public_id).subscribe((response) => {  
                    this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                          this.texto=response['datos2'][0]['documentacion'];
                    });
              });//FIN POST
          });
    }
}//FIN CLASS
