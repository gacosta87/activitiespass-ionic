import { Component, OnInit, ViewChild, Input } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController } from '@ionic/angular';
 
import { GooglePlus } from '@ionic-native/google-plus/ngx';
import {FacebookLoginResponse, Facebook} from "@ionic-native/facebook/ngx";
import { Instagram } from '@ionic-native/instagram/ngx';

import { Geolocation } from '@ionic-native/geolocation/ngx';
import { Camera, CameraOptions } from '@ionic-native/camera/ngx';
import { Crop, CropOptions } from '@ionic-native/crop/ngx';
import { File } from '@ionic-native/file/ngx';
import { format, parseISO } from 'date-fns';
import { Home } from '../../providers/home';

declare var google;

@Component({
  selector: 'app-perfilconfreserva',
  templateUrl: 'perfilconfreserva.html',
  styleUrls: ['perfilconfreserva.scss'],
  providers:[Home, Camera, File, Crop, GooglePlus, Facebook, Instagram, Geolocation]
})

export class Perfilconfreserva implements  OnInit{
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
  
  public lunescheckbox = false;
  public martescheckbox = false;
  public miercolescheckbox = false;
  public juevescheckbox = false;
  public viernescheckbox = false;
  public sabadocheckbox = false;
  public domingocheckbox = false;


  public turno_a_desde: string;
  public turno_a_hasta: string;
  public turno_a_desde2: string ="00:00:00";
  public turno_a_hasta2: string ="00:00:00";


  public turno_b_desde: string;
  public turno_b_hasta: string;
  public turno_b_desde2: string ="00:00:00";
  public turno_b_hasta2: string ="00:00:00";


  public turno_c_desde: string;
  public turno_c_hasta: string;
  public turno_c_desde2: string ="00:00:00";
  public turno_c_hasta2: string ="00:00:00";


  public turno_d_desde: string;
  public turno_d_hasta: string;
  public turno_d_desde2: string ="00:00:00";
  public turno_d_hasta2: string ="00:00:00";


  public turno_e_desde: string;
  public turno_e_hasta: string;
  public turno_e_desde2: string ="00:00:00";
  public turno_e_hasta2: string ="00:00:00";


  public turno_f_desde: string;
  public turno_f_hasta: string;
  public turno_f_desde2: string ="00:00:00";
  public turno_f_hasta2: string ="00:00:00";


  public turno_g_desde: string;
  public turno_g_hasta: string;
  public turno_g_desde2: string ="00:00:00";
  public turno_g_hasta2: string ="00:00:00";






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
          private camera: Camera,
          private crop: Crop,
          private file: File,
          public geolocation: Geolocation,
          public provider: Home,
  			  ) {
          this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
          this.p_push = localStorage.getItem('P_PUSH');
          this.myForm = this.formBuilder.group({
            lunes: new FormControl('', Validators.compose([])),
            turno_a_desde: new FormControl('', Validators.compose([])),
            turno_a_hasta: new FormControl('', Validators.compose([])),
            turno_a_desde2: new FormControl('', Validators.compose([])),
            turno_a_hasta2: new FormControl('', Validators.compose([])),


            martes: new FormControl('', Validators.compose([])),
            turno_b_desde: new FormControl('', Validators.compose([])),
            turno_b_hasta: new FormControl('', Validators.compose([])),
            turno_b_desde2: new FormControl('', Validators.compose([])),
            turno_b_hasta2: new FormControl('', Validators.compose([])),


            miercoles: new FormControl('', Validators.compose([])),
            turno_c_desde: new FormControl('', Validators.compose([])),
            turno_c_hasta: new FormControl('', Validators.compose([])),
            turno_c_desde2: new FormControl('', Validators.compose([])),
            turno_c_hasta2: new FormControl('', Validators.compose([])),


            jueves: new FormControl('', Validators.compose([])),
            turno_d_desde: new FormControl('', Validators.compose([])),
            turno_d_hasta: new FormControl('', Validators.compose([])),
            turno_d_desde2: new FormControl('', Validators.compose([])),
            turno_d_hasta2: new FormControl('', Validators.compose([])),


            viernes: new FormControl('', Validators.compose([])),
            turno_e_desde: new FormControl('', Validators.compose([])),
            turno_e_hasta: new FormControl('', Validators.compose([])),
            turno_e_desde2: new FormControl('', Validators.compose([])),
            turno_e_hasta2: new FormControl('', Validators.compose([])),


            sabado: new FormControl('', Validators.compose([])),
            turno_f_desde: new FormControl('', Validators.compose([])),
            turno_f_hasta: new FormControl('', Validators.compose([])),
            turno_f_desde2: new FormControl('', Validators.compose([])),
            turno_f_hasta2: new FormControl('', Validators.compose([])),


            domingo: new FormControl('', Validators.compose([])),
            turno_g_desde: new FormControl('', Validators.compose([])),
            turno_g_hasta: new FormControl('', Validators.compose([])),
            turno_g_desde2: new FormControl('', Validators.compose([])),
            turno_g_hasta2: new FormControl('', Validators.compose([]))




            
            
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
  formatDate(event: string) {
    const  value  = event['detail']['value'];
    const  value2 = format(parseISO('2022-05-15T'+value), 'hh:mm a');
    return value2;
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
       // loader.dismiss();
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
      const loader = this.loadingCtrl.create({
        ////duration: 10000
        //message: "Un momento, por favor..."
      }).then(load => {
                load.present();
              this.provider.reservahorariolistconfig(this.usuarioid).subscribe((response) => {  
                          this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                  if(response['code']==200){
                                      this.datos              = response['datos'];
                                      console.log(response['datos'][0]);
                                      if(response['datos'][0]){
                                          if(response['datos'][0]['lunes']==1){
                                            this.lunescheckbox      = false;
                                          }else{
                                            this.lunescheckbox      = true;
                                          }
                                          this.turno_a_desde     = response['datos'][0]['turno_a_desde'];
                                          this.turno_a_hasta     = response['datos'][0]['turno_a_hasta'];


                                          if(response['datos'][0]['martes']==1){
                                            this.martescheckbox      = false;
                                          }else{
                                            this.martescheckbox      = true;
                                          }

                                          this.turno_b_desde     = response['datos'][0]['turno_b_desde'];
                                          this.turno_b_hasta     = response['datos'][0]['turno_b_hasta'];



                                          if(response['datos'][0]['miercoles']==1){
                                            this.miercolescheckbox      = false;
                                          }else{
                                            this.miercolescheckbox      = true;
                                          }

                                          this.turno_c_desde     = response['datos'][0]['turno_c_desde'];
                                          this.turno_c_hasta     = response['datos'][0]['turno_c_hasta'];


                                          if(response['datos'][0]['jueves']==1){
                                            this.juevescheckbox      = false;
                                          }else{
                                            this.juevescheckbox      = true;
                                          }

                                          this.turno_d_desde     = response['datos'][0]['turno_d_desde'];
                                          this.turno_d_hasta     = response['datos'][0]['turno_d_hasta'];


                                          if(response['datos'][0]['viernes']==1){
                                            this.viernescheckbox      = false;
                                          }else{
                                            this.viernescheckbox      = true;
                                          }

                                          this.turno_e_desde     = response['datos'][0]['turno_e_desde'];
                                          this.turno_e_hasta     = response['datos'][0]['turno_e_hasta'];


                                          if(response['datos'][0]['sabado']==1){
                                            this.sabadocheckbox      = false;
                                          }else{
                                            this.sabadocheckbox      = true;
                                          }

                                          this.turno_f_desde     = response['datos'][0]['turno_f_desde'];
                                          this.turno_f_hasta     = response['datos'][0]['turno_f_hasta'];
                                          

                                          if(response['datos'][0]['domingo']==1){
                                            this.domingocheckbox      = false;
                                          }else{
                                            this.domingocheckbox      = true;
                                          }

                                          this.turno_g_desde     = response['datos'][0]['turno_g_desde'];
                                          this.turno_g_hasta     = response['datos'][0]['turno_g_hasta'];
                                       

                                          
                                    

                                      }
                                      //}//fin else
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
  }
  regresar(){
    this.navController.back();
  }
  enviarformulario() {
    const loader = this.loadingCtrl.create({
      ////duration: 10000
      //message: "Un momento, por favor..."
    }).then(load => {
              load.present();
              this.provider.reservahorarioconfig(this.usuarioid, this.myForm.value).subscribe((response) => {  
                          this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                  if(response['code']==200){
                                      this.navController.back();
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
}//FIN CLASS
