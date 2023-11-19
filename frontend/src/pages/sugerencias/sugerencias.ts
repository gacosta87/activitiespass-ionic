import { Component, OnInit} from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController, ModalController } from '@ionic/angular';

import { Home } from '../../providers/home';
import { MenuController } from '@ionic/angular';

import { ActivatedRoute, Params } from '@angular/router';

@Component({
  selector: 'app-sugerencias',
  templateUrl: 'sugerencias.html',
  styleUrls: ['sugerencias.scss'],
  providers:[Home]
})

export class Sugerencias implements  OnInit{
  public myForm: FormGroup;
  public loading: any;
  public usuarioid: string;
  public puntaje = "0";
  public selected = "1";
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
      this.myForm = this.formBuilder.group({
          puntaje: new FormControl('', Validators.compose([ 
                              Validators.required
                              ])
                   ),
          texto: new FormControl('', Validators.compose([ 
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
        const loader = this.loadingCtrl.create({
            ////duration: 10000
            //message: "Un momento, por favor..."
          }).then(load => {
                    load.present();
                    this.provider.sugerenciasadd(this.usuarioid, this.myForm.value).subscribe((response) => {  
                        this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                  localStorage.setItem('SUGERENCIABANDERA3', '1');
                                  localStorage.setItem('SUGERENCIALEDIOOMITIR', '2');
                                  //navigator['app'].exitApp();
                                  this.navController.navigateRoot("/principal/inicio");
                                  //this.modalController.dismiss(this.envia);
                        });//FIN LOADING DISS
                    },error => {
                        this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                  this.envia = 1;
                        });//FIN LOADING DISS
                    });//FIN POST
          });//FIn LOADING
  }
  omitir(){
            localStorage.setItem('SUGERENCIABANDERA3',    '1');
            this.sugerencialecontador = localStorage.getItem('SUGERENCIALECONTADOR');
            if(this.sugerencialecontador=='5'){
              localStorage.setItem('SUGERENCIALEDIOOMITIR', '2');
            }else{
              localStorage.setItem('SUGERENCIALEDIOOMITIR', '1');
            }
            localStorage.setItem('SUGERENCIALECONTADOR',  '1');
            //this.navController.navigateRoot("/principal/inicio");
            navigator['app'].exitApp();  
  }
}//FIN CLASS
