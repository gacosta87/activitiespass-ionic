import { Component, OnInit, Input } from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController,ModalController } from '@ionic/angular';

import { Usuario } from '../../providers/usuario';
import { Variablesglobales } from '../../providers/variablesglobal';

import { ActivatedRoute, Params } from '@angular/router';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

@Component({
  selector: 'app-perfilmycarsfavcalif',
  templateUrl: 'perfilmycarsfavcalif.html',
  styleUrls: ['perfilmycarsfavcalif.scss'],
  providers:[Usuario, Variablesglobales]
})
export class Perfilmycarsfavcalif implements  OnInit{
    @Input('usuariomycarid') usuariomycarid: string;
    @Input('puntaje') puntaje: string;
    public pais: string;
    public estado: string;
    public municipio: string;
    public datos: any;
    public imgurl   = new Variablesglobales();
    public imgurl2: any;
    public searchTerm: any;
    public allItems: any;
    public items: any;
    public calificacion = 0;
    public usuarioid: string;
    public mycarsid: string;
    //public puntaje = "";
    public enviado = "si";
    public datos_calificacion: any;
    public myForm: FormGroup;
    public slideOpts = {
          effect: 'flip',
          autoplay: {
            delay: 5000
          }
    };
    public idiomapalabras: any;
    public username = "";
    public fotodeperfil: string;
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
                private provider: Usuario, 
                public alertCtrl: AlertController,
                public loadingCtrl: LoadingController,
                private rutaActiva: ActivatedRoute,
                public modalController: ModalController,
                ){
      this.myForm = this.formBuilder.group({
          puntaje: new FormControl('', Validators.compose([ 
                              Validators.required,
                              ])
                   ),
          descripcion: new FormControl('', Validators.compose([ 
                              Validators.required,
                              ])
                   )
      });
        this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
      //this.usuariomycarid = this.rutaActiva.snapshot.paramMap.get('id');
      //this.puntaje  = this.rutaActiva.snapshot.paramMap.get('puntaje');
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
      this.username      = localStorage.getItem('USUARIO');
      this.fotodeperfil  = localStorage.getItem('FOTOPERFIL');
    }
    close(){
      this.modalController.dismiss();
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
        //  loader.dismiss();
        }
      });
    }
    enviarformulario(){
              this.usuarioid = localStorage.getItem('IDUSER');
              //this.slider.startAutoplay();
              const loader = this.loadingCtrl.create({
                //duration: 10000
                //message: "Un momento, por favor..."
              }).then(load2 => {
                        load2.present();
                        this.provider.perfilmycarsfavcalif(this.usuariomycarid, this.usuarioid,this.myForm.value ).subscribe((response) => {  
                                    load2.dismiss().then( () => { 
                                            if(response['code']==200){
                                                          this.modalController.dismiss(this.enviado);
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
                              load2.dismiss().then( () => {
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
    }//FIN FcuntiN
    
}//FIN CLASS