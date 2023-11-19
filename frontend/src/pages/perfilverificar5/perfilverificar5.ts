import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController, ModalController } from '@ionic/angular';
 
import { GooglePlus } from '@ionic-native/google-plus/ngx';
import {FacebookLoginResponse, Facebook} from "@ionic-native/facebook/ngx";
import { Instagram } from '@ionic-native/instagram/ngx';
import { ActivatedRoute, Params } from '@angular/router';
import { Usuario } from '../../providers/usuario';

import { Camera, CameraOptions } from '@ionic-native/camera/ngx';
import { Crop, CropOptions } from '@ionic-native/crop/ngx';
import { File } from '@ionic-native/file/ngx';
import { Cropimagennueva } from '../cropimagennueva/cropimagennueva';

@Component({
  selector: 'app-perfilverificar5',
  templateUrl: 'perfilverificar5.html',
  styleUrls: ['perfilverificar5.scss'],
  providers:[Usuario, GooglePlus, Facebook, Instagram, Camera, File, Crop]
})

export class Perfilverificar5  implements  OnInit{
  public myForm: FormGroup;
  public loading: any;
  public usuarioid: string;
  public mycarid = "";
  public nombres: string;
  public apellidos: string;
  public role_ids: string;
  public claves = "";
  public sessionactiva = "";
  public usuario = "";
  public email = "";
  public clave = "";
  public idiomapalabras: any;
  public t_push: string;
  public p_push: string;
  public u_push: string; 
  public p_idio = "";
  public latitudeusuario  = "";
  public longitudeusuario = "";
  public opcionnavegacion = "";
  public image: string[] = ['', '', '', ''];
  public image1: string = '';
  public image2: string = '';
  public image3: string = '';
  public image4: string = ''; 
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
  constructor(public navController: NavController,
          public formBuilder: FormBuilder,
          private router: Router, 
          private provider_usuario: Usuario, 
          private rutaActiva: ActivatedRoute,
          private fb: Facebook,
          private googlePlus: GooglePlus,
          private instagram: Instagram,
          private platform: Platform,
          public alertCtrl: AlertController,
          public loadingCtrl: LoadingController,
          private camera: Camera,
          private crop: Crop,
          private file: File,
          public modalController: ModalController
          ) {
                this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
                this.myForm = this.formBuilder.group({
                      
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
  cambiarimagen(){
    localStorage.setItem('banderamodal','1');
    const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                subHeader: this.idiomapalabras.seleopimg,
                message:this.idiomapalabras.seleopimg,
                
                buttons: [
                  {
                      text: this.idiomapalabras.galeriaimagenes,
                      cssClass:'button-camara',
                      handler: data => {
                          localStorage.setItem('banderamodal','2');
                          this.getPicture(this.camera.PictureSourceType.PHOTOLIBRARY);
                      }
                  },
                  {
                      text: this.idiomapalabras.camara,
                      cssClass:'button-camara',
                      handler: data => {
                          localStorage.setItem('banderamodal','2');
                          this.getPicture(this.camera.PictureSourceType.CAMERA);
                      }
                  },
                  {
                        text: this.idiomapalabras.cerrar,
                        role: 'cancel',
                        cssClass:'ion-pagar3',
                        handler: data => {
                             localStorage.setItem('banderamodal','2');
                             console.log('Confirm close');
                        }
                    }
                ]
         }).then(alert => alert.present());
  }
  getPicture(sourceType){ 
      let options: CameraOptions = {
          destinationType: this.camera.DestinationType.DATA_URL,
          //targetWidth: 1080,
          //targetHeight: 1080,
          quality: 100,
          correctOrientation: true,
          cameraDirection: this.camera.Direction.BACK,
          sourceType: sourceType
        }
        this.camera.getPicture( options )
        .then(imageData => {
            //this.image1 = 'data:image/jpeg;base64,' + imageData;
            //this.image[0] = this.image1;
            //this.p_push
            //this.cropImage(imageData);
            const modal = this.modalController.create({
                component: Cropimagennueva,
                cssClass: 'my-custom-class-cropimagen',
                swipeToClose: true,
                showBackdrop: true,
                componentProps: {
                  'dataimagen1': imageData,
                  'list': '1',
                  'aspectRationew':'3/4'
                },
            }).then(load => {
                        load.onDidDismiss().then(detail => {
                          //aqui accion al cerrar modal de cropimagen
                           console.log(detail);
                                    if(detail['data']['data'][0]=="si"){
                                        if(detail['data']['data'][2]==1){
                                            this.image1   = detail['data']['data'][1];
                                            this.image[0] = this.image1;
                                        }else if(detail['data']['data'][2]==2){
                                            this.image2   = detail['data']['data'][1];
                                            this.image[1] = this.image2;
                                        }else if(detail['data']['data'][2]==3){
                                            this.image3   = detail['data']['data'][1];
                                            this.image[2] = this.image3;
                                        }
                                        this.updatefoto();
                                    }
                        });
                        load.present();
            });//FIn LOADING

        })
        .catch(error =>{
          console.error( error );
        });
  }//FIN FUNCTION
  cropImage(fileUrl) {
    this.crop.crop(fileUrl, this.cropOptions)
      .then(
        newPath => {
          this.showCroppedImage(newPath.split('?')[0])
        },
        error => {
          //alert('Error cropping image' + error);
        }
      );
  }
  showCroppedImage(ImagePath) {
    this.isLoading = true;
    var copyPath = ImagePath;
    var splitPath = copyPath.split('/');
    var imageName = splitPath[splitPath.length - 1];
    var filePath = ImagePath.split(imageName)[0];
    this.file.readAsDataURL(filePath, imageName).then(base64 => {
      this.croppedImagepath = base64;
      this.isLoading        = false;
      this.image1   = base64;
      this.image[0] = this.image1;
      this.updatefoto();
    }, error => {
      //alert('Error in showing image' + error);
      this.isLoading = false;
    });
  }
  updatefoto() {
    const loader = this.loadingCtrl.create({
      ////duration: 10000
      //message: "Un momento, por favor..."
    }).then(load => {
              load.present();
              this.provider_usuario.perfilverificar5(this.mycarid, this.usuarioid, this.image).subscribe((response) => {  
                          this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                  if(response['code']==200){
                                      this.navController.navigateForward('/perfilverificar');
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
                                            //this.ionViewDidEnter();
                                        }
                                    }
                                  ]
                              }).then(alert => alert.present());
                  });//FIN LOADING DISS
              });//FIN POST
        });//FIn LOADING
  }//FIN FUNCTION
  omitir(){
        let cuentaperfil = "0";
        let cuentaperfil2 = 0;
        cuentaperfil = localStorage.getItem('CUENTAPERFIL');
        cuentaperfil2 = parseInt(cuentaperfil) + 1;
        localStorage.setItem('CUENTAPERFIL', cuentaperfil2+"");
        this.navController.navigateRoot("/principal/perfil"); //this.navController.navigateForward("/principal/perfil/"+cuentaperfil);
  }
  regresar(){
    this.navController.navigateRoot("/perfilverificar");
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
        //loader.dismiss();
      }
    });
  }
  ionViewDidEnter(){ 

      //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
      localStorage.setItem('OPCIONMENU', '4');  
      this.usuarioid = localStorage.getItem('IDUSER');
      this.mycarid   = localStorage.getItem('MYCARID');
      this.opcionnavegacion = this.rutaActiva.snapshot.paramMap.get('id');
  }
}//FIN CLASS
