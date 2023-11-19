import { Component, OnInit, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController, ModalController, PopoverController } from '@ionic/angular';
import { SocialSharing } from '@ionic-native/social-sharing/ngx';
import { Home } from '../../providers/home';
import * as moment from 'moment';
import 'moment-timezone';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

declare var google;

@Component({
  selector: 'app-misproveedoresadd',
  templateUrl: 'misproveedoresadd.html',
  styleUrls: ['misproveedoresadd.scss'],
  providers:[SocialSharing, Home]
})

export class Misproveedoresadd implements  OnInit {
    public myForm: FormGroup;
    public data: any;
    public myPage: any;
    public datos_menus: any;
    public datos_publi: any;
    public imgurl2: any;
    public selectedIndex = 0;
    public usuario: string;
    public roleid: string;
    public bodys = "";
    public sessionactiva = "";
    public version_exporar = ""; 
    public role_id = "";
    public mycarid = "";
    public pais= "";
    public estado= "" ;
    public municipio = "";
    public usuarioid: string;
    public data2: any;
    public data2aux: any;
    private counter = 0;
    public clickCount = 0;
    public clickId = 0;
    public mensajes = "0";
    public preventSingleClick = true;
    public timer: any; 
    public justClicked = false;
    public doubleClicked = false;
    public auxlike = '1';
    public idiomapalabras: any;
    public slideOpts = {
          effect: 'flip',
          autoplay: false
    };
    public config = {
      dragThreshold:20,
      allowElementScroll: true,
      maxDragAngle: 40,
      avoidElements: true
    };
    public page_number = 1;
    public atrscroll = true;
    public varset: any;
    public banderamodal = "2";
    public banderaruta = "";
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
                private navController: NavController, 
                public alertCtrl: AlertController,
                public loadingCtrl: LoadingController,
                private socialSharing: SocialSharing,
                public modalController: ModalController,
                private provider: Home, 
                public popoverController: PopoverController,
                public formBuilder: FormBuilder
                ){
        this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
        this.myForm = this.formBuilder.group({
                razon_social: new FormControl('', Validators.compose([ 
                                    Validators.pattern('[a-zA-ZáéíóúÁÉÍÓÚñÑ.,_0-9 ]*'),
                                    ])
                         ),
                email: new FormControl('', Validators.compose([ 
                                  Validators.required, 
                                  Validators.email 
                                  ])
                       ),
                telefono: new FormControl('', Validators.compose([ 
                                    Validators.pattern('[0-9+]*')
                                    ])
                         ),
                categoria: new FormControl('', Validators.compose([ 
                                    ])
                         )
        });
        
    }//FIN FUncTION 
  

    enviarformulario(){
       this.usuarioid = localStorage.getItem('IDUSER');
        const loader = this.loadingCtrl.create({
          ////duration: 10000
          //message: "Un momento, por favor..."
        }).then(load => {
                  load.present();
                  this.provider.misproveedoresadd(this.usuarioid, this.myForm.value).subscribe((response) => {  
                              this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                      if(response['code']==200){
                                          this.navController.navigateRoot("misproveedores");
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


    ionViewDidEnter(){ 
          this.loadingCtrl.getTop().then(loader => {
            if (loader!=undefined) {
              console.log('sali',loader);
             // this.loadingCtrl.dismiss();
            }
          });
    }

    

    ngOnInit() {
      localStorage.setItem('OPCIONMENU', '3');
    }//FIN FcuntiN



    /*
    * function combertir hora
    */
    zonahoraria(h){
      let testDateUtc = moment.tz(h, "America/Caracas");
      let localDate   = testDateUtc.clone().local();
      let horaactual  = localDate.format("DD/MM/YYYY hh:mm a");
      return horaactual;
    }
    regresar(){
        this.navController.back();
    }
}//FIN CLASS