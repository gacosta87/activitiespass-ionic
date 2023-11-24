import { Component,  OnInit, OnDestroy, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';
import * as moment from 'moment';
import 'moment-timezone';
import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController, ModalController, IonContent, IonSlides } from '@ionic/angular';
import { Perfilpostver } from '../perfilpostver/perfilpostver'; 
import { Home } from '../../providers/home';
import { Usuario } from '../../providers/usuario';
import { ActivatedRoute, Params } from '@angular/router';
import { HelperService } from '../../services/helper.service';
import { Variablesglobales } from '../../providers/variablesglobal';

@Component({
  selector: 'app-buscar',
  templateUrl: 'buscar.html',
  styleUrls: ['buscar.scss'],
  providers:[Home, Usuario, Variablesglobales]
})

export class Buscar   implements  OnInit, OnDestroy {
  @ViewChild("scrollElement1")  content1: IonContent;
  @ViewChild("mySliderpublicidad2", { static: false }) mySliderpubli2?: IonSlides;
  public myForm: FormGroup;
  public loading: any;
  public data: any;
  public data2: any;
  public data3: any;
  public page_number = 1;
  public sessionactiva = "";
  public usuario = "";
  public mycarid = "";
  public usuarioid = "";
  public texto_ = "";
  public texto_2= "";
  public busqueda = "";
  public tendencia = "2";
  public data_busqueda_tendencia: any;
  public idiomapalabras: any;
  public latitudeusuario  = "";
  public longitudeusuario = "";
  public data_busqueda_tendencia_2: any;
  public data_new_users: any;
  public data_new_users_aux1: any = [];
  public data_new_users_aux2: any = [];
  public nuevainformacionperfilbuscar = "";
  public nuevainformacionperfilbuscartiempo = "";
  public dispara = 0;
  public conf_banner_2: any; 
  public imgurl2: any;
  public rutas   = new Variablesglobales();
  public slideOpts_publi = {
          effect: 'coverflow',
          autoplay: {
             delay: 3000,
          },
          speed: 2000,
          slidesPerView: 1,
          paginationType:"arrows"
  };
  public promise = new Promise((resolve, reject) => {
      resolve(123);
  });

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
          private platform: Platform,
  			  public alertCtrl: AlertController,
  			  public loadingCtrl: LoadingController,
          private provider: Home,
          private provider2: Usuario,
          private rutaActiva: ActivatedRoute,
          public modalController: ModalController,
          private helper: HelperService
  			  ) {
          this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
          this.myForm = this.formBuilder.group({
      	  	  texto: new FormControl('', Validators.compose([
                                            Validators.pattern('[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9._#-=;, ]*')
                                        ])
                       )
          });
          this.router.events.subscribe(async () => {
            const isModalOpened = await this.modalController.getTop();
            if(isModalOpened){this.modalController.dismiss();}
          });
  }

  doRefresh(event) {
      localStorage.setItem('OPCIONMENU', '2');
      this.latitudeusuario  = localStorage.getItem('latitudeusuario');
      this.longitudeusuario = localStorage.getItem('longitudeusuario');
      this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      this.usuario   = localStorage.getItem('USUARIO');
      this.usuarioid = localStorage.getItem('IDUSER');
      this.mycarid   = localStorage.getItem('MYCARID');

  }



  loadData(event) {
         

  }


  ionViewDidEnter(){ 
      //this.mySliderpubli2.stopAutoplay();
      //this.mySliderpubli2.startAutoplay();
      this.sessionactiva                      = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      this.nuevainformacionperfilbuscar       = localStorage.getItem('NUEVA_INFORMACION_PERFIL_BUSCAR');
      this.nuevainformacionperfilbuscartiempo = localStorage.getItem('NUEVA_INFORMACION_PERFIL_BUSCAR_TIEMPO');

  }

 
  ngOnDestroy(){

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

   
  }

  enviarformulario(v, refres, event){
              
  }

  subirarriba(){
      
      if(document.getElementById('scrollElement1')){
        this.content1.scrollToTop(600);  
      }
  }

  
  
  ionViewDidLeave(){
       this.loadingCtrl.getTop().then(loader => {
        if (loader!=undefined) {
          console.log('ver', loader);
         // loader.dismiss();
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
  

}//FIN CLASS
