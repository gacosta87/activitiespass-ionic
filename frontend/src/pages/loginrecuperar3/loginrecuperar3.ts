import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController } from '@ionic/angular';

import { Usuario } from '../../providers/usuario';

@Component({
  selector: 'app-loginrecuperar3',
  templateUrl: 'loginrecuperar3.html',
  styleUrls: ['loginrecuperar3.scss'],
  providers:[Usuario]
})

export class Loginrecuperar3 implements  OnInit{
  public myForm: FormGroup;
  public loading: any;
  public email: string;
  public idiomapalabras: any;
  public t_push: string;
  public p_push: string;
  public u_push: string;
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
	        clave1: new FormControl('', Validators.compose([ 
															Validators.required
														  ])
								   ),
	        clave2: new FormControl('', Validators.compose([ 
															Validators.required
														  ])
								   )
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
 

  ngOnInit() {
      this.loadingCtrl.getTop().then(loader => {
        if (loader!=undefined) {
          console.log('sali',loader);
          this.loadingCtrl.dismiss();
        }
      });
  }
  regresar(){
    this.navController.back();
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
	    				this.email = localStorage.getItem('EMAIL');
	    				if(this.myForm.value.clave1==this.myForm.value.clave2){
									  	this.provider_usuario.loginrecuperar3(this.email, this.myForm.value).subscribe((response) => {  
									                this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
									                        if(response['code']==200){
															                const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
															                    subHeader: this.idiomapalabras.aviso,
															                    message: response['msg'],
															                    buttons: [
															                      {
															                          text: "Ok", 
															                          role: 'cancel',
															                          cssClass:'ion-aceptar',
															                          handler: data => {
															                            	this.navController.navigateForward('/principal/inicio');
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
											                    message: this.idiomapalabras.aviso,
											                    buttons: [
											                      {
											                          text: this.idiomapalabras.reintentar,
											                          role: 'cancel',
											                          cssClass:'ion-aceptar',
											                          handler: data => {
											                          }
											                      }
											                    ]
											                }).then(alert => alert.present());
													});//FIN LOADING DISS
								    	});//FIN POST
						}else{
										this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();}
								                const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
								                    subHeader: this.idiomapalabras.aviso,
								                    message: this.idiomapalabras.noiguales,
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

						}//FINE ELSE

				});//FIn LOADING
  }//FIN FUNCTION
}//FIN CLASS
