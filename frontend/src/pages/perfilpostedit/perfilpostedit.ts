import { Component, OnInit, Input, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController, ModalController } from '@ionic/angular';

import { Home } from '../../providers/home';
import { Variablesglobales } from '../../providers/variablesglobal';

import { ActivatedRoute, Params } from '@angular/router';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Camera, CameraOptions } from '@ionic-native/camera/ngx';
import { Crop, CropOptions } from '@ionic-native/crop/ngx';
import { File } from '@ionic-native/file/ngx';

@Component({
  selector: 'app-perfilpostedit',
  templateUrl: 'perfilpostedit.html',
  styleUrls: ['perfilpostedit.scss'],
  providers:[Variablesglobales, Home, Camera, File, Crop]
})
export class Perfilpostedit implements  OnInit{
    @ViewChild('solicita', {static: false}) myInput;
    @Input('usuarioid') usuarioid: string;
    @Input('publicid') publicid: string;
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
    //public usuarioid: string;
    public mycarsid: string;
    public puntaje = "";
    public datos_calificacion: any;
    public myForm: FormGroup;
    public image: string[] = ['', '', ''];
    public image1: string = '';
    public image2: string = '';
    public image3: string = '';
    public envia = "si";
    public oferta = 1;
    public username = "";
    public fotodeperfil: string;
    public slideOpts = {
          effect: 'flip',
          autoplay: {
            delay: 5000
          }
    };
    public idiomapalabras: any;
    public croppedImagepath = "";
    public isLoading = false;
    public cropOptions: CropOptions = {
      quality: 100
    }
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
                private provider: Home, 
                public alertCtrl: AlertController,
                public loadingCtrl: LoadingController,
                private rutaActiva: ActivatedRoute,
                private camera: Camera,
                private crop: Crop,
                private file: File,
                public modalController: ModalController,
                ){
      this.username      = localStorage.getItem('USUARIO');
      this.fotodeperfil  = localStorage.getItem('FOTOPERFIL');
      this.myForm = this.formBuilder.group({
          texto: new FormControl('', Validators.compose([ 
                              Validators.required,
                              //Validators.pattern('[a-zA-ZáéíóúÁÉÍÓÚñÑ()#0-9.,;-_ ]*')
                              ])
                   ),
          titulo: new FormControl('', Validators.compose([ 
                              Validators.required,
                              Validators.maxLength(50)
                              //Validators.pattern('[a-zA-ZáéíóúÁÉÍÓÚñÑ()#0-9.,;-_ ]*')
                              ])
                   ),
          precio: new FormControl('', Validators.compose([ 
                              ])
                   ),
          precio_oferta: new FormControl('', Validators.compose([ 
                              ])
                   ),
          isomoneda: new FormControl('', Validators.compose([ 
                              ])
                   ),
          publicaciontipo: new FormControl('1', Validators.compose([ 
                              Validators.required,
                              ])
                   )
      });
      this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
      //this.mycarsid = this.rutaActiva.snapshot.paramMap.get('id');
  }//FIN FUncTION  
  addhashtag(v){
      //let elem: <HTMLElement> document.getElementById(v);
      this.myInput.value = this.myInput.value+"#";
      this.myInput.setFocus();
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
     //   loader.dismiss();
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
 

  ngOnInit() {
        this.loadingCtrl.getTop().then(loader => {
          if (loader!=undefined) {
            console.log('sali',loader);
            this.loadingCtrl.dismiss();
          }
        });
  }
  activaoferta(v){
    this.oferta=v;
  }
  ionViewDidEnter(){ 

      //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
      this.username      = localStorage.getItem('USUARIO');
      this.fotodeperfil  = localStorage.getItem('FOTOPERFIL');
      const loader = this.loadingCtrl.create({
        //duration: 10000,
        ////message: "Un momento, por favor...",
        showBackdrop: true 
      }).then(load => {
                        load.present();
                        this.provider.publiver(this.usuarioid, this.publicid).subscribe((response) => {  
                              this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                        this.datos  = response['datos'];
                                        this.oferta = this.datos[0]['publicartipo'];
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
      });//FIN POST
  }
  close(){
    this.modalController.dismiss();
  }
  enviarformulario(){ 
              const loader = this.loadingCtrl.create({
                ////duration: 10000
                //message: "Un momento, por favor..."
              }).then(load2 => {
                        load2.present();
                        //alert(this.usuarioid+' - '+this.mycarid);
                        this.provider.publiupdate(this.usuarioid, this.publicid, this.myForm.value).subscribe((response) => {  
                                    load2.dismiss().then( () => { 
                                            if(response['code']==200){
                                                        localStorage.setItem('ISOMONEDA', this.myForm.value.isomoneda);
                                                        this.modalController.dismiss(this.envia);
                                            }else if (response['code']==201){
                                                        let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                                        botonEnvio.removeAttribute('disabled');
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
                                                      let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                                      botonEnvio.removeAttribute('disabled');
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