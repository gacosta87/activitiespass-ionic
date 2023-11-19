import { Component, OnInit, ViewChild, NgZone } from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController, IonContent, ModalController } from '@ionic/angular';
import { Variablesglobales } from '../../providers/variablesglobal';
import { Home } from '../../providers/home';
import { ActivatedRoute, Params } from '@angular/router';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';
import { Camera, CameraOptions } from '@ionic-native/camera/ngx';
import { Crop, CropOptions } from '@ionic-native/crop/ngx';
import { File } from '@ionic-native/file/ngx';
import * as moment from 'moment';
import 'moment-timezone';
import { Megafonomsjimg } from '../megafonomsjimg/megafonomsjimg';
import { Clipboard } from '@ionic-native/clipboard/ngx';
import { Cropimagennueva } from '../cropimagennueva/cropimagennueva';

@Component({
  selector: 'app-megafonomsj',
  templateUrl: 'megafonomsj.html',
  styleUrls: ['megafonomsj.scss'],
  providers:[Variablesglobales, Home, Camera, File, Crop, Clipboard]
})
export class Megafonomsj  implements  OnInit{
   @ViewChild('scrollElement', {static: true}) content: IonContent;
   //@ViewChild('scrollElement') content: Content;
    //@ViewChild(IonContent, { static: false }) content: IonContent;
    public datos: any;
    public imgurl   = new Variablesglobales();
    public imgurl2: any;
    public searchTerm: any;
    public allItems: any;
    public items: any;
    public data: any = [];
    public data2: any;
    public usuario: string;
    public version_exporar: string;
    public sessionactiva: string;
    public estado: string;
    public pais: string;
    public municipio: string;
    public usuarioid: string;
    public mycarid: string;
    public myForm: FormGroup;
    public usuarioid_desty: string;
    public usuarioid_from: string;
    public usuarioid_buscar: string;
    public fotodesty = "";
    public image: string[] = ['', '', '', ''];
    public image1: string = '';
    public image2: string = '';
    public image3: string = '';
    public image4: string = ''; 
    public textom = "";
    public varset: number;
    public croppedImagepath = "";
    public isLoading = false;
    public mensajeaux="";
    public idiomapalabras: any;
    public cropOptions: CropOptions = {
      quality: 100
    }
    public chatmsj = "";
    public auxuser = "";
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
                public alertCtrl: AlertController,
                private rutaActiva: ActivatedRoute,
                public loadingCtrl: LoadingController,
                public provider: Home,
                private camera: Camera,
                private crop: Crop,
                private file: File,
                public modalController: ModalController,
                public _zone: NgZone,
                private clipboard: Clipboard
                ){
                this.myForm = this.formBuilder.group({
                    texto: new FormControl('', Validators.compose([]))
                });
                this.usuario         = localStorage.getItem('NOMBRESAPELLIDOS');
                this.version_exporar = localStorage.getItem('VERSION_EXPORTAR');
                this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
                this.estado          = localStorage.getItem('estado');
                this.pais            = localStorage.getItem('pais');
                this.municipio       = localStorage.getItem('municipio');
                this.usuarioid       = localStorage.getItem('IDUSER');
                this.mycarid         = localStorage.getItem('MYCARID');

                this.usuarioid_desty  = this.rutaActiva.snapshot.paramMap.get('usuarioid_desty');
                this.usuarioid_from   = this.rutaActiva.snapshot.paramMap.get('usuarioid_from');
                this.usuarioid_buscar = this.rutaActiva.snapshot.paramMap.get('usuarioid_buscar');
                this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));

    }//FIN FUncTION
    ///Copiar o eliminar
    deletechat(v1, v2){
      localStorage.setItem('banderamodal','1');
      const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
          subHeader: this.idiomapalabras.aviso,
            message: this.idiomapalabras.eliminarchatmsj,
            buttons: [
              {
                    text: this.idiomapalabras.cancelar,
                    role: 'cancel',
                    handler: data => {
                        localStorage.setItem('banderamodal','2');
                    }
              },
              {
                    text: this.idiomapalabras.confirmar,
                    cssClass:'ion-aceptar',
                    handler: data => {
                            localStorage.setItem('banderamodal','2');
                             const loader = this.loadingCtrl.create({
                                ////duration: 10000
                                ////message: "Un momento, por favor...",
                                //showBackdrop: true
                              }).then(load => {
                                        load.present();
                                        this.provider.mensajemsjdelete(v1).subscribe((response) => {  
                                                    this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                                                  if(response['code']==200){
                                                                      clearInterval(this.varset);
                                                                      this.ionViewDidEnter();
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
                                        });//FIN POST
                              });//FIn LOADING
                    }
                }
            ]
        }).then(alert => alert.present());
    }//fin function
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
    dobleclick(a1, a2, a3){
              localStorage.setItem('banderamodal','1');
              const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                      subHeader: this.idiomapalabras.aviso,
                      message:"",
                      buttons: [
                        {
                            text: this.idiomapalabras.copiarmensaje,
                            cssClass:'button-camara',
                            handler: data => {
                                localStorage.setItem('banderamodal','2');
                                this.clipboard.copy(a3);
                                console.log('Confirm Copy');
                            }
                        },
                        {
                            text: this.idiomapalabras.eliminarmensaje,
                            cssClass:'button-camara',
                            handler: data => {
                                localStorage.setItem('banderamodal','2');
                                this.deletechat(a1, a2);
                                console.log('Confirm delete');
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
    ///Copiar o eliminar
    dobleclickcopy(a1, a2){
              localStorage.setItem('banderamodal','1');
              const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                      subHeader: this.idiomapalabras.aviso,
                      message:"",
                      buttons: [
                        {
                            text: this.idiomapalabras.cerrar,
                            role: 'cancel',
                            cssClass:'ion-pagar3',
                            handler: data => {
                                localStorage.setItem('banderamodal','2');
                                console.log('Confirm close');
                            }
                        },
                        {
                            text: this.idiomapalabras.copiarmensaje,
                            cssClass:'button-camara',
                            handler: data => {
                                localStorage.setItem('banderamodal','2'); 
                                this.clipboard.copy(a2);
                                console.log('Confirm Copy');
                            }
                        }
                        
                      ]
              }).then(alert => alert.present());
    }
    /*
    * function combertir hora
    */
    zonahoraria(h){
      let testDateUtc = moment.tz(h, "America/Caracas");
      let localDate   = testDateUtc.clone().local();
      let horaactual  = localDate.format("DD/MM/YYYY hh:mm a");
      return horaactual;
    }
    scrollToBottomOnInit() {
      //this._zone.run(() => {
          setTimeout(() => {
              this.content.scrollToBottom();
          });
      //}); 
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
          ///loader.dismiss();
        }
      });
      clearInterval(this.varset);
    } 
    reload_() {
        clearInterval(this.varset);
        this.provider.mensajemsj(this.usuarioid_desty, this.usuarioid_from, this.usuarioid_buscar).subscribe((response) => {  
                                    if(response['code']==200){
                                            //console.log('list'+JSON.stringify(this.data));
                                            if(this.data.length!=response['list'].length){
                                              this.data   = response['list'];
                                              this.scrollToBottomOnInit();
                                            }
                                            this.varset = setInterval(function(){this.reload_();}.bind(this),15000);
                              }else if (response['code']==201){
                                          const alert = this.alertCtrl.create({ 
                                            cssClass:'my-custom-class-alert',
                                            subHeader: this.idiomapalabras.aviso,
                                              message: response['msg'],
                                              buttons: [
                                                {
                                                  text: "Ok", 
                                                  role: 'cancel',
                                                  handler: data => {
                                                      this.ionViewDidEnter();
                                                  }
                                                }
                                              ]
                                          }).then(alert => alert.present());
                              }//Fin else
          });//FIN POST
          console.log('a chatmsj'+this.auxuser);
          this.chatmsj = JSON.parse(localStorage.getItem('chatmsj'+this.auxuser));
          if(this.chatmsj!=null){
              if(this.data.length!=this.chatmsj.length){
                  for (let i = this.chatmsj.length; i > 0; i--) {
                      let vervariable = 0;
                      for (let ii = 0; ii < this.data.length; ii++) {
                          if(this.data[ii]['id']==this.chatmsj[i-1]['id']){
                            vervariable++;
                          }
                      }
                      if(vervariable==0){
                        this.data.push(this.chatmsj[i-1]);  
                      }
                      //console.log('leng 1 '+this.chatmsj.length);
                      //console.log('leng 2 '+this.data.length);
                  }
                  console.log('b chatmsj'+this.auxuser);
                  localStorage.setItem('chatmsj'+this.auxuser, JSON.stringify(this.data)); 
                  this.scrollToBottomOnInit();
              }
          }
    }//fin function    
    final(){
      this.content.scrollToBottom(0);
    }
    ionViewDidEnter(){ 

          //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
          localStorage.setItem('OPCIONMENU', '1');
          this.usuario          = localStorage.getItem('NOMBRESAPELLIDOS');
          this.version_exporar  = localStorage.getItem('VERSION_EXPORTAR');
          this.sessionactiva    = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
          this.estado           = localStorage.getItem('estado');
          this.pais             = localStorage.getItem('pais');
          this.municipio        = localStorage.getItem('municipio');
          this.usuarioid        = localStorage.getItem('IDUSER');
          this.mycarid          = localStorage.getItem('MYCARID');
          this.usuarioid_desty  = this.rutaActiva.snapshot.paramMap.get('usuarioid_desty');
          this.usuarioid_from   = this.rutaActiva.snapshot.paramMap.get('usuarioid_from');
          this.usuarioid_buscar = this.rutaActiva.snapshot.paramMap.get('usuarioid_buscar');
          //this.chatmsj = JSON.parse(localStorage.getItem('chatmsj'+this.auxuser));
          this.scrollToBottomOnInit();
          //localStorage.setItem('cantidad_mensajes', '0');
          const loader = this.loadingCtrl.create({
            ////message: "Un momento, por favor...",
            //showBackdrop: true
          }).then(load => {
                    load.present();
                    if(this.usuarioid_desty==this.usuarioid){
                            this.auxuser = this.usuarioid_from;
                    }else{
                            this.auxuser = this.usuarioid_desty;
                    }
                    this.provider.mensajemsj(this.usuarioid_desty, this.usuarioid_from, this.usuarioid_buscar).subscribe((response) => {  
                                this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                              if(response['code']==200){
                                                      this.data   = response['list'];
                                                      this.data2  = response['usuarios'];
                                                      this.fotodesty=this.data2[0]['foto2'];
                                                      localStorage.setItem('chatmsj'+this.auxuser, JSON.stringify(this.data)); 
                                                      this.scrollToBottomOnInit();   
                                                      //this.reload_();                                                   
                                                      this.varset = setInterval(function(){this.reload_();}.bind(this),15000);
                                        }else if (response['code']==201){
                                                    const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                                      subHeader: this.idiomapalabras.aviso,
                                                        message: response['msg'],
                                                        buttons: [
                                                          {
                                                            text: "Ok", 
                                                            role: 'cancel',
                                                            handler: data => {
                                                                this.ionViewDidEnter();
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
    }//fin function
    regresar(){
      this.navController.back();
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
                                          this.myForm.value.texto="Imagen";
                                          this.textom = "";
                                          clearInterval(this.varset);
                                          this.enviarformulario();
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
      this.myForm.value.texto="Imagen";
      this.textom = "";
      clearInterval(this.varset);
      this.enviarformulario();
    }, error => {
      //alert('Error in showing image' + error);
      this.isLoading = false;
    });
  }
  enviarformulario() {
    if(this.myForm.value.texto!="" && this.mensajeaux!=this.myForm.value.texto){
            this.mensajeaux = this.myForm.value.texto;
            this.myForm.value.texto = "";
            this.textom = "";
            /*const loader = this.loadingCtrl.create({
              //message: "Un momento, por favor..."
            }).then(load => {
                       load.present();*/
                       clearInterval(this.varset);
                       this.data.push({'imagen_m':'', 'texto':this.mensajeaux, 'usuarioid_from':this.usuarioid});
                       this.provider.mensajeadd(this.data2[0]['id'], 
                                                this.usuarioid,
                                                this.usuarioid_buscar, 
                                                this.mensajeaux, 
                                                this.image).subscribe((response) => {  
                                  //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                          if(response['code']==200){
                                                    this.data   = response['list'];
                                                    localStorage.setItem('chatmsj'+this.auxuser, JSON.stringify(this.data)); 
                                                    this.textom = "";
                                                    this.image  = ['', '', '', ''];
                                                    this.image1 = '';
                                                    this.image2 = '';
                                                    this.image3 = '';
                                                    this.image4 = '';                                                     
                                                    this.scrollToBottomOnInit();
                                                    this.varset = setInterval(function(){this.reload_();}.bind(this),15000);
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
                                  //});//FIN LOADING DISS          
                                  let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                  botonEnvio.removeAttribute('disabled');   
                      });//FIN POST
                //});//FIn LOADING
    }else{
        let botonEnvio: HTMLElement = document.getElementById('boton_envio');
        botonEnvio.removeAttribute('disabled');
    }
  }//FIN FUNCTION
  imgver(item){ 
      localStorage.setItem('banderamodal','1');
      const modal = this.modalController.create({
          component: Megafonomsjimg,
          cssClass: 'my-custom-class-verimgchat',
          showBackdrop: true,
          componentProps: {
            'usuarioid': this.usuarioid,
            'item': item
          },
          swipeToClose: true,
        }).then(load => {
                  load.present();
                  load.onDidDismiss().then(detail => {
                     if (detail !== null) {
                      localStorage.setItem('banderamodal','2');
                       //this.ionViewDidEnter();
                     }
                  });                  
        });//FIn LOADING
  }
  linkperfil(v){
        this.usuarioid = localStorage.getItem('IDUSER');
        this.mycarid   = localStorage.getItem('MYCARID');
        if(this.mycarid==v){
              this.navController.navigateForward("/principal/perfil"); 
        }else{
          this.navController.navigateForward("/perfilmycar/"+v);  
        }
  }
}//FIN CLASS