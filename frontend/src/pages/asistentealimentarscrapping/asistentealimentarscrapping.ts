import { Component, OnInit, ViewChild, Input } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController, ModalController } from '@ionic/angular';
 
import { GooglePlus } from '@ionic-native/google-plus/ngx';
import {FacebookLoginResponse, Facebook} from "@ionic-native/facebook/ngx";
import { Instagram } from '@ionic-native/instagram/ngx';

import { Usuario } from '../../providers/usuario';
import { FileTransfer, FileUploadOptions, FileTransferObject } from '@ionic-native/file-transfer/ngx';
import { Geolocation } from '@ionic-native/geolocation/ngx';
import { Camera, CameraOptions } from '@ionic-native/camera/ngx';
import { Crop, CropOptions } from '@ionic-native/crop/ngx';
import { File } from '@ionic-native/file/ngx';
import { format, parseISO } from 'date-fns';
import { Home } from '../../providers/home';
import { Variablesglobales } from '../../providers/variablesglobal';

import { Cropimagennueva } from '../cropimagennueva/cropimagennueva';

declare var google;

@Component({
  selector: 'app-asistentealimentarscrapping',
  templateUrl: 'asistentealimentarscrapping.html',
  styleUrls: ['asistentealimentarscrapping.scss'],
  providers:[Usuario, Home, Variablesglobales, Camera, File, Crop, GooglePlus, Facebook, Instagram, Geolocation]
})

export class Asistentealimentarscrapping implements  OnInit{
  @ViewChild('solicita', {static: false}) myInput;
  public myForm: FormGroup;
  public loading: any;
  public usuarioid: string;
  public url     = new Variablesglobales();
  public croppedImagepath = "";
  public isLoading = false;
  public cropOptions: CropOptions = {
    quality: 100
  }
  public idiomapalabras: any;
  public nombres: string;
  public apellidos: string;
  public role_ids: string;
  public claves = "";
  public sessionactiva = "";
  public usuario = "";
  public mycarid = "";

  public datos: any;
  public image: string[] = ['', '', '', ''];
  public image1: string = '';
  public image2: string = '';
  public image3: string = '';
  public image4: string = ''; 

  public myLatLng: any;
  public map: any;
  public marker: any;
  public address: string;
  public servicios = "";
  public directionsDisplay: any = null;
  public directionsService: any = null;
  public latitud_ng: number;
  public longitud_ng: number;
  public pais_ng      = "";
  public municipio_ng = "";
  public estado_ng    = "";
  public activa = "0";
  public datos_calificacion: any;
  public seguidores = "";
  public seguidos = "";
  public post = "";
  public postver = "";
  public calificacion =""; 
  public textcheckbox = false;
  public textcheckbox_delivery = false;
  
  public activamapa="";
  public p_push = "";
  public categoriaid = 0;
  public p_idioma = "es";
  public datos_categorias: any;
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


  public entre1: any;
  public entre1_type = "";
  public entre1_name = "";
  public entre1_format = "";

  public entre2: any;
  public entre2_type = "";
  public entre2_name = "";
  public entre2_format = "";
  
  constructor(public navController: NavController,
  			  public formBuilder: FormBuilder,
  			  private router: Router, 
          private fb: Facebook,
          private googlePlus: GooglePlus,
          private instagram: Instagram,
          private platform: Platform,
  			  public alertCtrl: AlertController,
  			  public loadingCtrl: LoadingController,
          public provider: Usuario,
          private camera: Camera,
          private crop: Crop,
          private file: File,
          public geolocation: Geolocation,
          public provider_mapas: Home,
          public modalController: ModalController,
          private filetransfer: FileTransfer
  			  ) {
    this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
    this.p_push = localStorage.getItem('P_PUSH');
    this.myForm = this.formBuilder.group({
          file1: new FormControl('', Validators.compose([ 
                              ])
                   ),
          file2: new FormControl('', Validators.compose([ 
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
       // loader.dismiss();
      }
    });
  }
  ionViewDidEnter(){ 
      this.p_idioma   = localStorage.getItem('P_IDIO'); 
      this.provider_mapas.categorias(this.p_idioma).subscribe((response) => {  
          this.datos_categorias = response['datos'];
      });
      //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
      localStorage.setItem('OPCIONMENU', '4');  
      this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      this.usuario   = localStorage.getItem('USUARIO');
      this.usuarioid = localStorage.getItem('IDUSER');
      this.mycarid   = localStorage.getItem('MYCARID');
       const loader = this.loadingCtrl.create({
          ////duration: 10000
          //message: "Un momento, por favor..."
        }).then(load => {
                  load.present();
                  this.provider.miperfil(this.mycarid, this.usuarioid, 1).subscribe((response) => {  
                              this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                      if(response['code']==200){
                                          this.datos              = response['datos'];
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
  }
  regresar(){
    this.navController.back();
  }


  onFileChange1(event){
          console.log(event.target.files[0].type);
          console.log(event.target.files[0].name.substring(event.target.files[0].name.lastIndexOf('.')+1));
          console.log(event.target.files[0].name);

          this.entre1_type = event.target.files[0].type;
          this.entre1_name = event.target.files[0].name;
          this.entre1_format = event.target.files[0].name.substring(event.target.files[0].name.lastIndexOf('.')+1);

          let file = event.target.files[0];  
          let reader = new FileReader();
          reader.readAsDataURL(event.target.files[0]);
          reader.onloadend = (ver) => {
            this.entre1 = reader.result;
            let url = (ver.target as FileReader).result;
            console.log(url)
          };
  }

  onFileChange2(event){
      console.log("2");
      console.log(event.target.files[0].type);
      console.log(event.target.files[0].name.substring(event.target.files[0].name.lastIndexOf('.')+1));
      console.log(event.target.files[0].name);

      this.entre2_type = event.target.files[0].type;
      this.entre2_name = event.target.files[0].name;
      this.entre2_format = event.target.files[0].name.substring(event.target.files[0].name.lastIndexOf('.')+1);

      let file = event.target.files[0];  
      let reader = new FileReader();
      reader.readAsDataURL(event.target.files[0]);
      reader.onloadend = (ver) => {
        this.entre2 = reader.result;
        let url = (ver.target as FileReader).result;
      };
  }


  enviarformulario() {
    const loader = this.loadingCtrl.create({
      ////duration: 10000
      //message: "Un momento, por favor..."
    }).then(load => {
              load.present();
              /*this.myForm.value.file1 = this.entre1; 
              this.myForm.value.file1_type = this.entre1_type; 
              this.myForm.value.file1_name = this.entre1_name; 
              this.myForm.value.file1_format = this.entre1_format; 

              this.myForm.value.file2 = this.entre2;
              this.myForm.value.file2_type = this.entre2_type; 
              this.myForm.value.file2_name = this.entre2_name; 
              this.myForm.value.file2_format = this.entre2_format;*/

              console.log(this.myForm.value.file1);
              this.provider.asistente_scrapping(this.mycarid, this.myForm.value, this.usuarioid).subscribe((response) => {  
                          this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                  if(response['code']==200){
                                      this.datos  = response['datos'];
                                      this.navController.navigateRoot("/principal/perfil");
                                  }else if (response['code']==201){
                                              const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                subHeader: this.idiomapalabras.aviso,
                                                  message: response['msj'],
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
                                            //this.ionViewDidEnter();
                                        }
                                    }
                                  ]
                              }).then(alert => alert.present());
                  });//FIN LOADING DISS
              });//FIN POST
        });//FIn LOADING
  }//FIN FUNCTION

 
  delete(num) {
    const loader = this.loadingCtrl.create({
      ////duration: 10000
      //message: "Un momento, por favor..."
    }).then(load => {
              load.present();
              this.provider.asistente_scrapping_delete(this.mycarid, this.myForm.value, this.usuarioid, num).subscribe((response) => {  
                          this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                  if(response['code']==200){
                                      this.datos              = response['datos'];
                                  }else if (response['code']==201){
                                              const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                subHeader: this.idiomapalabras.aviso,
                                                  message: response['msj'],
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
                                            //this.ionViewDidEnter();
                                        }
                                    }
                                  ]
                              }).then(alert => alert.present());
                  });//FIN LOADING DISS
              });//FIN POST
        });//FIn LOADING
  }//FIN FUNCTION
}//FIN CLASS
