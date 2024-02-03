import { Component,  OnInit, OnDestroy } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';
import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController, ModalController, PopoverController } from '@ionic/angular';
import { Home } from '../../providers/home';
import { Geolocation } from '@ionic-native/geolocation/ngx';
import { ActivatedRoute, Params } from '@angular/router';
import { LaunchNavigator, LaunchNavigatorOptions } from '@ionic-native/launch-navigator/ngx';
import { Perfilmycarsfavcalif } from '../perfilmycarsfavcalif/perfilmycarsfavcalif';
import { Perfilpostver } from '../perfilpostver/perfilpostver';
import { Publicmenu } from '../publicmenu/publicmenu';
import { Perfilsegui } from '../perfilsegui/perfilsegui';
import { Reservasadd } from '../reservasadd/reservasadd';
import { SocialSharing } from '@ionic-native/social-sharing/ngx';
import { Variablesglobales } from '../../providers/variablesglobal';
import { Promocionview } from '../promocionview/promocionview';
@Component({
  selector: 'app-perfilmycar',
  templateUrl: 'perfilmycar.html',
  styleUrls: ['perfilmycar.scss'],
  providers:[Home, LaunchNavigator, SocialSharing, Variablesglobales]
})

export class Perfilmycar implements  OnInit, OnDestroy {
  public rutas   = new Variablesglobales();
  public myForm: FormGroup;
  public loading: any;
  public usuarioid: string;
  public favorito = 0;
  public califico = 0;
  public vardes = '1';
  public nombres: string;
  public apellidos: string;
  public role_ids: string;
  public claves = "";
  public username = "";
  public sessionactiva = "";
  public usuario = "";
  public mycarid = "";
  public idiomapalabras: any;
  public datos: any;

  public listcategorias                               : any;
  public listformaextra                               : any;
  public paqueteprincipal                             : any;
  public paquetesadicionalesdelaactividad             : any;
  public listadegaleriafoto                           : any;
  public listadegaleriavideo                          : any;
  public listacalendarioactividadespaqueteprincipal   : any;
  public listacalendarioactividadespaqueteadicionales : any;


  public datos_username = "";
  public image: string[] = ['', '', '', ''];
  public image1: string = '';
  public image2: string = '';
  public image3: string = '';
  public image4: string = ''; 
  public datosreservas: any;
  public myLatLng: any;
  public bloqueado = "2"; ///es la opcion para bloquear por defecto
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
  public seguidores = 0;
  public seguidos = "";
  public post = "";
  public postver: any;
  public calificacion ="";
  public usuariomycarid: string;
  public version_exporar = "";
  public msj: string;
  public url: string;
  public pais: string;
  public estado: string;
  public municipio: string;
  public latitude:number ;
  public longitude:number ;
  public page_number = 1;
  public loader: any;
  public loader2: any;
  public latitudeusuario  = "";
  public longitudeusuario = "";
  public data1_pro_lista: any;
  public contarpromo = "0";
  public data_new_users: any;
  public config = {
      dragThreshold:20,
      allowElementScroll: true,
      maxDragAngle: 40,
      avoidElements: true
  };
  public salir_de_loading = new Promise(async (resolve, reject) => {
      await this.loadingCtrl.getTop().then(loader => {
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
          public provider: Home,
          public launchNavigator: LaunchNavigator,
          private rutaActiva: ActivatedRoute,
          public modalController: ModalController,
          public popoverController: PopoverController,
          private socialSharing: SocialSharing
  			  ) {

      this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
      this.router.events.subscribe(async () => {
        const isModalOpened = await this.modalController.getTop();
        if(isModalOpened){this.modalController.dismiss();}
      });
     
	  	
  }


  regresar(){
    this.navController.back();
  }


  ngOnDestroy(){


  }

  ngOnInit() {

      this.loadingCtrl.getTop().then(loader => {
        if (loader!=undefined) {
          console.log('sali',loader);
          this.loadingCtrl.dismiss();
        }
      });
        this.usuarioid = localStorage.getItem('IDUSER');
        this.username  = localStorage.getItem('USUARIO');
        this.latitudeusuario   = JSON.parse(localStorage.getItem('latitudeusuario'));
        this.longitudeusuario  = JSON.parse(localStorage.getItem('longitudeusuario'));
        this.usuariomycarid = this.rutaActiva.snapshot.paramMap.get('id');

  }
  
  ionViewWillLeave(){
    this.loadingCtrl.getTop().then(loader => {
      if (loader!=undefined) {
        console.log('sali',loader);
        //this.loadingCtrl.dismiss();
      }
    });
  }
  ionViewDidEnter(){ 

    //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
    const loader2 =  this.modalController.getTop();
      if (loader2) {

          //this.modalController.dismiss();
      }

      this.usuariomycarid = this.rutaActiva.snapshot.paramMap.get('id');

      this.provider.listtoursid(this.usuariomycarid).subscribe((response) => {  

        this.datos                                        = response['datos'];
        this.listcategorias                               = response['listcategorias'];
        this.listformaextra                               = response['listformaextra'];
        this.paqueteprincipal                             = response['paqueteprincipal'];
        this.paquetesadicionalesdelaactividad             = response['paquetesadicionalesdelaactividad'];
        this.listadegaleriafoto                           = response['listadegaleriafoto'];
        this.listadegaleriavideo                          = response['listadegaleriavideo'];
        this.listacalendarioactividadespaqueteprincipal   = response['listacalendarioactividadespaqueteprincipal'];
        this.listacalendarioactividadespaqueteadicionales = response['listacalendarioactividadespaqueteadicionales'];


      });
  }

  presentPopover(ev: any){
    console.log('bloqueo: '+this.bloqueado);
    const popover = this.popoverController.create({
      component: Publicmenu,
      cssClass: 'my-custom-class',
      componentProps: {
            'usuarioid': this.usuarioid,
            'publicid': '0',
            'publicusuarioid': '0',
            'salirmodal': '1',
            'comperfil': '2',
            'compublic': '1',
            'editarcuenta':'1',
            'salircuenta':'1',
            'mycarusuarioid': this.usuariomycarid,
            'bloqueado': this.bloqueado
      },
      event: ev,
      translucent: true
    }).then(load => {
            load.present();
            load.onDidDismiss().then(detail => {
                   console.log('bloqueo pop: ');
                   console.log(detail['data']);
                  if(detail['data']){
                    if(detail['data']['data'][0]=="bloqueo"){
                      console.log('bloqueo pop: '+detail['data']['data'][1]);
                        this.bloqueado = detail['data']['data'][1];
                        this.favorito  = 0;
                    }
                  }
            });
    });
  }
}//FIN CLASS
