import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController } from '@ionic/angular';

import { Usuario } from '../../providers/usuario';

@Component({
  selector: 'app-loginrecuperar1',
  templateUrl: 'loginrecuperar1.html',
  styleUrls: ['loginrecuperar1.scss'],
  providers:[Usuario]
})

export class Loginrecuperar1 implements  OnInit{
  public myForm: FormGroup;
  public loading: any;
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
  constructor(public navController: NavController,
  			  public formBuilder: FormBuilder,
  			  private router: Router, 
  			  private provider_usuario: Usuario, 
  			  public alertCtrl: AlertController,
  			  public loadingCtrl: LoadingController
  			  ) {
  		this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
	  	this.myForm = this.formBuilder.group({
	        email: new FormControl('', Validators.compose([ 
															Validators.required, 
															Validators.email 
														  ])
								   )
	    });
  }
  regresar(){
    this.navController.back();
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
         // loader.dismiss();
        }
      });
  } 
  ionViewDidEnter(){ 

       //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
       localStorage.setItem('OPCIONMENU', '4');
  }
  enviarformulario(){
  	const loader = this.loadingCtrl.create({
  		//duration: 10000
  		//message: "Un momento, por favor..."
    }).then(load => {
	    				load.present();
					  	this.provider_usuario.loginrecuperar1(this.myForm.value).subscribe((response) => {  
					                this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
					                        if(response['code']==200){
					                              		localStorage.setItem('EMAIL', response['email']);  
					                              		this.navController.navigateForward('loginrecuperar2');
					                        }else if (response['code']==201){
					                                    const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
					                                    	subHeader: this.idiomapalabras.aviso,
					                                        message: response['msg'],
					                                        buttons: [
					                                          {
					                                            text: "Ok", 
					                                            role: 'cancel'
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
							                            	this.ionViewDidEnter();
							                          }
							                      }
							                    ]
							                }).then(alert => alert.present());
									});//FIN LOADING DISS
				    	});//FIN POST
				});//FIn LOADING
  }//FIN FUNCTION
}//FIN CLASS
