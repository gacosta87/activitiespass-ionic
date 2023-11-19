import { Component, OnInit, ViewChild, Input } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController, ModalController } from '@ionic/angular';
 
import { GooglePlus } from '@ionic-native/google-plus/ngx';
import {FacebookLoginResponse, Facebook} from "@ionic-native/facebook/ngx";
import { Instagram } from '@ionic-native/instagram/ngx';

import { Usuario } from '../../providers/usuario';

import { Geolocation } from '@ionic-native/geolocation/ngx';
import { Camera, CameraOptions } from '@ionic-native/camera/ngx';
import { Crop, CropOptions } from '@ionic-native/crop/ngx';
import { File } from '@ionic-native/file/ngx';
import { format, parseISO } from 'date-fns';
import { Home } from '../../providers/home';

import { Cropimagennueva } from '../cropimagennueva/cropimagennueva';

declare var google;

@Component({
  selector: 'app-perfileditarmapa',
  templateUrl: 'perfileditarmapa.html',
  styleUrls: ['perfileditarmapa.scss'],
  providers:[Usuario, Home, Camera, File, Crop, GooglePlus, Facebook, Instagram, Geolocation]
})

export class Perfileditarmapa implements  OnInit{
  @ViewChild('solicita', {static: false}) myInput;
  public myForm: FormGroup;
  public loading: any;
  public usuarioid: string;

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
  public activamapa="";
  public p_push = "";
  public categoriaid = 0;
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
  			  ) {
    this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
    this.p_push = localStorage.getItem('P_PUSH');
    this.myForm = this.formBuilder.group({
         
          ver: new FormControl('', Validators.compose([ 
                              ])
                   ),          
          latitud: new FormControl('', Validators.compose([])
                   ),
          longitud: new FormControl('', Validators.compose([])
                   ),
          pais: new FormControl('', Validators.compose([])
                   ),
          municipio: new FormControl('', Validators.compose([])
                   ),
          estado: new FormControl('', Validators.compose([])
                   )
      });
      this.directionsDisplay = new google.maps.DirectionsRenderer();
      this.directionsService = new google.maps.DirectionsService();
	  	
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
  formatDate(value: string) {
    const value1 = format(parseISO(value), 'dd/MM/yyyy');
    return value1;
  }
  addhashtag(v){
        //let elem: <HTMLElement> document.getElementById(v);
        this.myInput.value = this.myInput.value+"#";
        //this.servicios = this.servicios+"#";
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
      //  loader.dismiss();
      }
    });
  }
  ionViewDidEnter(){ 

      //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
      localStorage.setItem('OPCIONMENU', '4');  
      this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      this.usuario   = localStorage.getItem('USUARIO');
      this.usuarioid = localStorage.getItem('IDUSER');
      this.mycarid   = localStorage.getItem('MYCARID');
              this.provider.miperfil(this.mycarid, this.usuarioid, 1).subscribe((response) => {  
                          //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                  if(response['code']==200){
                                      this.datos              = response['datos'];
                                      this.servicios          = response['servicios'];
                                      this.calificacion       = response['calificacion'];
                                      this.seguidores         = response['seguidores'];
                                      this.seguidos           = response['seguidos'];
                                      this.post               = response['post'];
                                      this.postver            = response['postver'];
                                      this.image1   = this.datos[0]['foto1'];
                                      this.image[0] = this.image1;
                                      this.datos_calificacion = response['datos_calificacion'];
                                      this.latitud_ng   = this.datos[0]['latitud'];
                                      this.longitud_ng  = this.datos[0]['longitud'];
                                      if(response['datos'][0]['ver']==1){
                                        this.textcheckbox      = false;
                                        this.activamapa="1";
                                      }else{
                                        this.textcheckbox      = true;
                                        this.activamapa="2";
                                        this.cargarmapa();
                                      }
                                  }//Fin else
                          //});//FIN LOADING DISS
              },error => {
                    //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();}
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
                  //});//FIN LOADING DISS
              });//FIN POST
  }
  regresar(){
    this.navController.back();
  }
  actualizar_pais(var1, var2){
      //console.log(var1+' - '+var2);
      this.provider_mapas.mapalocalizar(var1, var2).subscribe((response_aux) => {
                        /*for(var i=0; i<6 ; i++) { 
                            if(response_aux['results'][0]['address_components'][i]){
                                if (response_aux['results'][0]['address_components'][i]['types'][0] == 'country' ) {                      
                                      this.pais_ng  = response_aux['results'][0]['address_components'][i]['long_name']; 
                                }
                                if (response_aux['results'][0]['address_components'][i]['types'][0] == 'locality' ) {                     
                                      this.municipio_ng = response_aux['results'][0]['address_components'][i]['long_name']; 
                                } 
                            }
                        }*/
      });
      this.latitud_ng  = var1;
      this.longitud_ng = var2;
      ////console.log('pais_editar'+this.pais_ng);
  }
  cargarmapa(){
      console.log('ver text '+this.activamapa);
      if(this.activamapa=='2'){
                this.activamapa='1';
                this.geolocation.getCurrentPosition().then((resp) => {
                       if(this.datos[0]['latitud']=="" || this.datos[0]['latitud']==null){
                        this.datos[0]['latitud'] =resp.coords.latitude;
                        this.datos[0]['longitud']=resp.coords.longitude;
                        this.latitud_ng          = resp.coords.latitude;
                        this.longitud_ng         = resp.coords.longitude;
                      }else{
                        this.latitud_ng   = this.datos[0]['latitud'];
                        this.longitud_ng  = this.datos[0]['longitud'];
                      }
                      this.actualizar_pais(this.latitud_ng, this.longitud_ng);
                      let latLng = new google.maps.LatLng(this.datos[0]['latitud'], this.datos[0]['longitud']);
                              let mapOptions = {
                                center: latLng,
                                zoom: 14,
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                              } 
                              this.directionsDisplay.setMap(this.map);
                              //let myLatLng = { lat: this.datos[0]['latitud'], lng: this.datos[0]['longitud']};
                              let mapEle: HTMLElement = document.getElementById('map2');
                              this.map = new google.maps.Map(mapEle, mapOptions);
                              this.marker = new google.maps.Marker({
                                    position:  new google.maps.LatLng(this.datos[0]['latitud'], this.datos[0]['longitud']),
                                    map: this.map,
                                    title: 'Mi Posicion',
                                    draggable: true,
                                    animation: google.maps.Animation.DROP,
                              });
                              //google.maps.event.addListener(this.marker,'dragend', function() {
                              var that = this;
                              this.marker.addListener('dragend', function() {
                              //document.getElementById("Mycarlatitud").value = this.latitud_ng;
                              //document.getElementById("Mycarlongitud").value = this.longitud_ng;
                              that.actualizar_pais(this.getPosition().lat(), this.getPosition().lng());
                              });
                              mapEle.classList.add('show-map');
                });
      }else{
             this.activamapa='2';
      }
  }

 
  cambiarimagen(){
    localStorage.setItem('banderamodal','1');
    const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                subHeader: this.idiomapalabras.agregarimagenpubli,
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
  linkmenu(var1){
       if(var1=="logout"){
              localStorage.removeItem('IDUSER');
              localStorage.removeItem('USUARIO');
              localStorage.removeItem('NOMBRESAPELLIDOS');
              localStorage.removeItem('TOKEN');
              localStorage.removeItem('SESSIONACTIVA_OLYMPUS_9');
              localStorage.setItem('SESSIONACTIVA_OLYMPUS_9','false');
              this.fb.logout();
              this.googlePlus.logout();
              this.navController.navigateForward('menu');
       }
  }//fin function
  updatefoto() {
    const loader = this.loadingCtrl.create({
      ////duration: 10000
      //message: "Un momento, por favor..."
    }).then(load => {
              load.present();
              this.provider.miperfilfotoupdate(this.mycarid, this.usuarioid, this.image).subscribe((response) => {  
                          this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                  if(response['code']==200){
                                      localStorage.setItem('FOTOPERFIL',  response['datos']['foto_35']);
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
  enviarformulario() {
    const loader = this.loadingCtrl.create({
      ////duration: 10000
      //message: "Un momento, por favor..."
    }).then(load => {
              load.present();
              this.provider.miperfilupdatemapa(this.mycarid, this.myForm.value, this.usuarioid, this.image).subscribe((response) => {  
                          this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                  if(response['code']==200){
                                      localStorage.setItem('IDUSER',           response['datos']['id']);
                                      localStorage.setItem('USUARIO',          response['datos']['username']);
                                      localStorage.setItem('MYCARID',          response['datos']['mycar_id']);
                                      localStorage.setItem('NOMBRESAPELLIDOS', response['datos']['nombre_apellido']);
                                      localStorage.setItem('TIPOUSUARIO',      response['datos']['role_id']);
                                      localStorage.setItem('FOTOPERFIL',       response['datos']['foto_35']);
                                      localStorage.setItem('SESSIONACTIVA_OLYMPUS_9',    'true');
                                      localStorage.setItem('TOKEN',            response['token']);
                                      localStorage.setItem('NUEVA_INFORMACION_PERFIL', '2');
                                      let cuentaperfil = "0";
                                      let cuentaperfil2 = 0;
                                      cuentaperfil = localStorage.getItem('CUENTAPERFIL');
                                      cuentaperfil2 = parseInt(cuentaperfil) + 1;
                                      localStorage.setItem('CUENTAPERFIL', cuentaperfil2+"");
                                      this.navController.back();
                                  }else if (response['code']==201){
                                              const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                subHeader: this.idiomapalabras.aviso,
                                                  message: this.idiomapalabras.existeusuario,
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
