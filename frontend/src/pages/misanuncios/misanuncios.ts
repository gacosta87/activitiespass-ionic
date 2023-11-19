import { Component, OnInit} from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController, ModalController } from '@ionic/angular';

import { Home } from '../../providers/home';
import { MenuController } from '@ionic/angular';

import { ActivatedRoute, Params } from '@angular/router';

@Component({
  selector: 'app-misanuncios',
  templateUrl: 'misanuncios.html',
  styleUrls: ['misanuncios.scss'],
  providers:[Home]
})

export class Misanuncios implements  OnInit{
  public myForm: FormGroup;
  public loading: any;
  public usuarioid: string;
  public mycarid = "";
  public puntaje = "0";
  public selected = "1";
  public idiomapalabras: any;
  public selected2 = "1";
  public nombres: string;
  public apellidos: string;
  public avatar:string="";
  public invitados = "";
  public seguidores: any;
  public seguidores1: any;
  public seguidores2: any;
  public ordena      = "";
  public color     = "";
  public usuario = "";
  public searchTerm: any;
  public allItems: any;
  public items: any;
  public seguidoresid = "";
  public nombressub = "";
  public seleccionado = "0";
  public envia = 1;
  public sugerencialecontador: string;
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
  			  private provider: Home, 
          private platform: Platform,
  			  public alertCtrl: AlertController,
  			  public loadingCtrl: LoadingController,
          private rutaActiva: ActivatedRoute,
          public modalController: ModalController,
  			  ) {
      this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
      this.myForm = this.formBuilder.group({
          texto: new FormControl('', Validators.compose([ 
                              Validators.required,
                              Validators.maxLength(100)
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
  
  regresar(){
        this.navController.back();
  }

  ngOnInit() {
            this.loadingCtrl.getTop().then(loader => {
              if (loader!=undefined) {
                console.log('sali',loader);
                this.loadingCtrl.dismiss();
              }
            });
  }
  seleccion(id){
      if(this.seleccionado!='0'){
        let notiEle: HTMLElement = document.getElementById('col'+this.seleccionado);
        notiEle.classList.remove('focus_col');
      }
      this.seleccionado = id;
      this.myForm.value.puntaje = id;
      this.puntaje = id;
      let notiEle2: HTMLElement = document.getElementById('col'+id);
      notiEle2.classList.add('focus_col');
      
  }
  ionViewDidEnter(){ 
        //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
        this.usuarioid = localStorage.getItem('IDUSER');
  }
  enviarformulario(){
        this.envia = 2;
        this.usuarioid     = localStorage.getItem('IDUSER');
        this.mycarid       = localStorage.getItem('MYCARID');
         const loader = this.loadingCtrl.create({
            ////duration: 10000
            //message: "Un momento, por favor..."
          }).then(load => {
                    load.present();
                    this.provider.mipromocionadd(this.usuarioid, this.mycarid, this.myForm.value).subscribe((response) => {  
                        this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                            if(response['code']==200){
                            
                                  this.navController.navigateRoot("/principal/perfil");
                            
                            }else if(response['code']==201){

                                  const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                          subHeader: this.idiomapalabras.aviso,
                                          message: this.idiomapalabras.notiempo+ ' '+response['time'],
                                          buttons: [
                                            {
                                                text: this.idiomapalabras.botonaceptar,
                                                role: 'cancel',
                                                cssClass:'ion-aceptar',
                                                handler: data => {
                                                    //this.ionViewDidEnter();
                                                    this.envia = 1;
                                                }
                                            }
                                          ]
                                  }).then(alert => alert.present());

                            }
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
                                              //this.ionViewDidEnter();
                                              this.envia = 1;
                                          }
                                      }
                                    ]
                            }).then(alert => alert.present());
                        });//FIN LOADING DISS
                    });//FIN POST
          });//FIn LOADING
  }
 
}//FIN CLASS
