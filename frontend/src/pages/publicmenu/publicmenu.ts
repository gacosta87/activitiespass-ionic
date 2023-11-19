import { Component, OnInit, ViewChild, Input } from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, PopoverController, ModalController, AlertController } from '@ionic/angular';
import { Home } from '../../providers/home';
import { Variablesglobales } from '../../providers/variablesglobal';
import { SocialSharing } from '@ionic-native/social-sharing/ngx';
import { GooglePlus } from '@ionic-native/google-plus/ngx';
import { FacebookLoginResponse, Facebook} from "@ionic-native/facebook/ngx";
import { Instagram } from '@ionic-native/instagram/ngx';
import { Clipboard } from '@ionic-native/clipboard/ngx';
import { Perfilpostedit } from '../perfilpostedit/perfilpostedit';

@Component({
  selector: 'app-publicmenu',
  templateUrl: 'publicmenu.html',
  styleUrls: ['publicmenu.scss'],
  providers:[Home, SocialSharing, GooglePlus, Facebook, Instagram, Variablesglobales, Clipboard] 
})

export class Publicmenu implements  OnInit {
    public iniciologin: string;
    @Input('usuarioid') usuarioid: string;
    @Input('publicid') publicid: string;
    @Input('publicusuarioid') publicusuarioid: string;
    @Input('salirmodal') salirmodal: string;
    @Input('comperfil') comperfil: string;
    @Input('compublic') compublic: string;
    @Input('editarcuenta') editarcuenta: string;
    @Input('salircuenta') salircuenta: string;
    @Input('mycarusuarioid') mycarusuarioid: string;
    @Input('bloqueado') bloqueado: string;
    public rutas   = new Variablesglobales();
    public enviado = "si";
    public data: any;
    public data2: any; 
    public msj: string;
    public url: string;
    public rutaimg: string;
    public version_exporar = ""; 
    public idiomapalabras: any;
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
                public loadingCtrl: LoadingController,
                private provider: Home, 
                public alertCtrl: AlertController,
                public modalController: ModalController,
                public popoverController: PopoverController,
                private socialSharing: SocialSharing,
                private fb: Facebook,
                private googlePlus: GooglePlus,
                private instagram: Instagram,
                private clipboard: Clipboard
                ){
        this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
        this.version_exporar = localStorage.getItem('VERSION_EXPORTAR');
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

    bloquearuser(){
        this.provider.bloquear(this.usuarioid, this.mycarusuarioid).subscribe((response) => { });
        this.popoverController.dismiss({data:['bloqueo',  '2']});
    }

    desbloquearuser(){
        this.provider.desbloquear(this.usuarioid, this.mycarusuarioid).subscribe((response) => { });
        this.popoverController.dismiss({data:['bloqueo','1']});
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
    editar(){
        //this.provider.publidelete(this.publicid).subscribe((response) => { });
        //this.popoverController.dismiss();        
        localStorage.setItem('banderamodal','1');
        const modal = this.modalController.create({
            component: Perfilpostedit,
            showBackdrop: true,
            cssClass: 'my-custom-class-postveredit',
            componentProps: {
              'usuarioid': this.usuarioid,
              'publicid': this.publicid
            },
            swipeToClose: true,
          }).then(load => {
                    load.onDidDismiss().then(detail => {
                       localStorage.setItem('banderamodal','2');
                       if (detail['data'] != null) {
                          //this.ionViewDidEnter();
                          this.popoverController.dismiss(this.publicid);
                       }else{
                          this.popoverController.dismiss(); 
                       }
                    });
                    load.present();
          });//FIn LOADING
    }
    eliminar(){

                    const alert2 = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                                    subHeader: "",
                                    message:this.idiomapalabras.eliminarregistro,
                                    backdropDismiss: true,
                                    buttons: [
                                        {
                                            text: this.idiomapalabras.botoncancelar,
                                            cssClass:'button-camara',
                                            role: 'cancel',
                                            handler: data => {
                                                this.popoverController.dismiss();
                                            }
                                        },
                                        {
                                            text: this.idiomapalabras.botonaceptar,
                                            cssClass:'button-camara',
                                            handler: data => {
                                                this.provider.publidelete(this.publicid, this.usuarioid).subscribe((response) => { });
                                                localStorage.setItem('NUEVA_INFORMACION_PERFIL', '2');
                                                this.popoverController.dismiss(this.publicid);

                                            }
                                        }
                                    ]
                      }).then(alert2 => {
                              alert2.present();
                              alert2.onDidDismiss().then(detail => {
                                  if (detail['data'] == null) {
                                    //alert('a');
                                    localStorage.setItem('banderamodal','2');
                                  }
                              });
                      });


        
    }
    invitaramigos(){
        this.msj   = this.idiomapalabras.invitaramigos3;
        this.url   = this.rutas.getDow();
        this.socialSharing.share(this.msj, null, null, this.url);
        this.popoverController.dismiss();
        if(this.salirmodal=='2'){
            this.modalController.dismiss();
        }
    }
    salimodal(){
        this.popoverController.dismiss();
        this.modalController.dismiss();
    }
    /*
    * Enlce perfil
    */
    copiarenlaceperfil(){
        this.url   = this.rutas.getComvar()+"perfil/"+this.mycarusuarioid;
        this.clipboard.copy(this.url);
        this.popoverController.dismiss();
    }
    compartirperfil(){
        
        /*const loader = this.loadingCtrl.create({
        //duration: 10000
        ////message: "Un momento, por favor...",
        //showBackdrop: true
        }).then(load => {
                load.present();
                this.provider.perfildata(this.mycarusuarioid).subscribe((response) => { 
                      this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} */
                          //this.data  = response['datos'];
                          this.msj   = this.idiomapalabras.compartirperfilmsj;
                          this.url   = this.rutas.getComvar()+"perfil/"+this.mycarusuarioid;
                          //this.socialSharing.share(this.msj, null, this.data[0]['foto2'], this.url)
                          this.socialSharing.share(this.msj, null, null, this.url)
                          this.popoverController.dismiss();
                          if(this.salirmodal=='2'){
                              this.modalController.dismiss();
                          }
                      /*});
                });
        });*/
    }
    denunciarperfil(){
        this.provider.denunciasadd(this.usuarioid, this.mycarusuarioid, 0, 0).subscribe((response) => { });
        this.popoverController.dismiss();
        if(this.salirmodal=='2'){
            this.modalController.dismiss();
        }
    }
    denunciarpublic(op){
        this.provider.denunciasadd(this.usuarioid, 0, this.publicid, op).subscribe((response) => { });
        this.popoverController.dismiss();
        if(this.salirmodal=='2'){
            this.modalController.dismiss();
        }
    }

   

    compartirpublic(){
      /*
      const loader = this.loadingCtrl.create({
        //duration: 10000
        ////message: "Un momento, por favor...",
        //showBackdrop: true
        }).then(load => {
                load.present();
                this.provider.publicaciondata(this.publicusuarioid, this.publicid).subscribe((response) => { 
                    this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} */
                          //this.data  = response['datos'];
                          //this.data2 = response['datos2'];
                          //this.msj   = "@"+this.data[0]['username']+" "+this.data2[0]['texto'].substr(0, 100)+"...";
                          this.msj   = this.idiomapalabras.compartirpublimsj;
                          this.url   = this.rutas.getComvar()+"publicacion/"+this.publicid;
                          /*if(this.data2[0]['imagen1_m']!="" && this.data2[0]['imagen1_m']!=null){
                             this.rutaimg = this.data2[0]['imagen1_m'];
                          }else{
                             this.rutaimg = "";
                          }*/
                          //this.socialSharing.share(this.msj, null, this.rutaimg, this.url);
                          this.socialSharing.share(this.msj, null, null, this.url);
                          this.popoverController.dismiss();
                          if(this.salirmodal=='2'){
                                this.modalController.dismiss();
                          }
                    /*});
                });
        }); */
    }
    /*
    * Enlace publicación
    */
    copiarenlacepublic(){
        this.url = this.rutas.getComvar()+"publicacion/"+this.publicid;
        this.clipboard.copy(this.url);
        this.popoverController.dismiss();
    }
    velocidad(){
        this.socialSharing.share("preba de calificaciones", null, "https://api.olympusapp.es/storage/imagenes/69582020-06-26-20-37-36_1_2.jpg", null);
        this.popoverController.dismiss();
        if(this.salirmodal=='2'){
              this.modalController.dismiss();
        }
    } 
    velocidad2(){
        this.socialSharing.share("preba de calificaciones", null, null, null);
        this.popoverController.dismiss();
        if(this.salirmodal=='2'){
              this.modalController.dismiss();
        }
    } 
    editarsession(){
        this.popoverController.dismiss();
        this.navController.navigateRoot('perfileditar');
    }
    configurarreserva(){
        this.popoverController.dismiss();
        this.navController.navigateRoot('perfilconfreserva');
    }
    closesession(){
        localStorage.removeItem('IDUSER');
        localStorage.removeItem('USUARIO');
        localStorage.removeItem('NOMBRESAPELLIDOS');
        //localStorage.removeItem('TokenInstalacion');
        localStorage.removeItem('SESSIONACTIVA_OLYMPUS_9');
        localStorage.removeItem('FOTOPERFIL');
        localStorage.removeItem('MYCARID');
        localStorage.removeItem('TIPOUSUARIO');
        localStorage.removeItem('data_perfil');
        localStorage.removeItem('lista_mensajes');
        localStorage.removeItem('data_inicio');
        localStorage.removeItem('data_inicio2');
        localStorage.removeItem('data_inicio2_solicitudes');    
        localStorage.removeItem('home_false_data_inicio_OLYMPUS_5');
        localStorage.removeItem('home_false_data_inicio2_OLYMPUS_5');  
        localStorage.removeItem('home_false_data_inicio2_solicitudes_OLYMPUS_5');   
        localStorage.removeItem('home_false_data_sin_registro_OLYMPUS_5');   
        localStorage.removeItem('data_sin_registro');   
        localStorage.removeItem('contarseguidos');   
        localStorage.setItem('SESSIONACTIVA_OLYMPUS_9','false');
        localStorage.setItem('NUEVA_INFORMACION_PERFIL', '2');
        localStorage.setItem('NUEVA_INFORMACION_PERFIL_INICIO', '2');
        localStorage.setItem('NUEVA_INFORMACION_PERFIL_BUSCAR', '2');
        localStorage.setItem('IDUSER','');
        this.iniciologin = localStorage.getItem('INICIOLOGIN');
              if(this.iniciologin=='1'){this.googlePlus.logout();
        }else if(this.iniciologin=='2'){this.fb.logout();
        }else if(this.iniciologin=='3'){
        }
       // this.router.navigateByUrl('menu');
        localStorage.setItem('OPCIONMENU', '1');
        this.popoverController.dismiss();
        this.navController.navigateRoot("/principal/inicio");
    }
    informacion(var1){
      this.popoverController.dismiss();
        if(var1==1){
        this.navController.navigateForward('inforcondiciones');
      }else if(var1==2){
        this.navController.navigateForward('inforpoliticas');
      }else if(var1==3){
        this.navController.navigateForward('loginrecuperar1');
      }else if(var1==4){
        this.navController.navigateForward('perfilinicio');
      }
  }
}//FIN CLASS