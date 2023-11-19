import { Component, OnInit, Input, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController, ModalController } from '@ionic/angular';
import { SocialSharing } from '@ionic-native/social-sharing/ngx';
import { Home } from '../../providers/home';
import { Variablesglobales } from '../../providers/variablesglobal';

import { ActivatedRoute, Params } from '@angular/router';

@Component({
  selector: 'app-perfilcompartir',
  templateUrl: 'perfilcompartir.html',
  styleUrls: ['perfilcompartir.scss'],
  providers:[Variablesglobales, Home, SocialSharing]
})
export class Perfilcompartir implements  OnInit {
    @ViewChild('solicita', {static: false}) myInput;
    @Input('usuarioid') usuarioid: string;
    @Input('mycarid')   mycarid: string;
    @Input('publicid')  publicid: string;
    @Input('publicuserid')  publicuserid: string;
    public fotodeperfil: string;
    public username: string;
    public idiomapalabras: any;
    public msj: string;
    public url: string;
    public latitudeusuario  = "";
    public longitudeusuario = "";
    public rutas   = new Variablesglobales();
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
                private provider: Home, 
                public alertCtrl: AlertController,
                public loadingCtrl: LoadingController,
                private rutaActiva: ActivatedRoute,
                public modalController: ModalController,
                private socialSharing: SocialSharing,
                ){
      console.log('datos de post: '+this.usuarioid);
      this.username       = localStorage.getItem('USUARIO');
      this.fotodeperfil   = localStorage.getItem('FOTOPERFIL');
      this.idiomapalabras = JSON.parse(localStorage.getItem('idiomapalabras'));
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
      this.username      = localStorage.getItem('USUARIO');
      this.fotodeperfil  = localStorage.getItem('FOTOPERFIL');
  }
  close(){
    this.modalController.dismiss();
  }


   compartirpublic(id){
        this.msj   = this.idiomapalabras.compartirpublimsj;
        this.url   = this.rutas.getComvar()+"publicacion/"+id;
        this.socialSharing.share(this.msj, null, null, this.url);
        this.modalController.dismiss();
    }


    compartirpublic_promocionate(id){
        this.latitudeusuario   = JSON.parse(localStorage.getItem('latitudeusuario'));
        this.longitudeusuario  = JSON.parse(localStorage.getItem('longitudeusuario'));
        localStorage.setItem('NUEVA_INFORMACION_PERFIL_INICIO', '2');
        this.provider.compartirpromocionate(this.usuarioid, this.mycarid, id, this.latitudeusuario, this.longitudeusuario).subscribe((response) => {  });
        this.modalController.dismiss();
    }


    compartirpublic_perfil(id){
        this.provider.compartirperfil(this.usuarioid, this.mycarid, id ).subscribe((response) => {  });
        localStorage.setItem('NUEVA_INFORMACION_PERFIL', '2');
        localStorage.setItem('NUEVA_INFORMACION_PERFIL_INICIO', '2');
        this.modalController.dismiss();
    }
    
}//FIN CLASS