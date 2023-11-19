import { Component, OnInit} from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController } from '@ionic/angular';

import { Home } from '../../providers/home';

import { Geolocation } from '@ionic-native/geolocation/ngx';
import { Variablesglobales } from '../../providers/variablesglobal';

import { LaunchNavigator, LaunchNavigatorOptions } from '@ionic-native/launch-navigator/ngx';

declare var google;
declare var MarkerWithLabel;


@Component({
  selector: 'app-mapa',
  templateUrl: 'mapa.html',
  styleUrls: ['mapa.scss'],
  providers:[Home, Variablesglobales, LaunchNavigator, Geolocation]
})

export class Mapa implements  OnInit {
  //@ViewChild('map') mapElement: ElementRef;
  public map: any;
  public marker: any;
  public address: string;

  public imgurl   = new Variablesglobales();
  public imgurl2: any;
  public usuarioid: string;
  public pais= "";
  public estado= "" ;
  public municipio = "";
  public version_exporar = "";

  public directionsDisplay: any = null;
  public directionsService: any = null;

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

  constructor(public navController: NavController,
      			  public formBuilder: FormBuilder,
      			  private router: Router, 
              private platform: Platform,
              public launchNavigator: LaunchNavigator,
      			  private provider_mapas: Home, 
      			  public alertCtrl: AlertController,
      			  public loadingCtrl: LoadingController,
              private geolocation: Geolocation
  			  ) {
      this.directionsDisplay = new google.maps.DirectionsRenderer();
      this.directionsService = new google.maps.DirectionsService();
      this.imgurl2 = this.imgurl.getServar();
      this.version_exporar = localStorage.getItem('VERSION_EXPORTAR');
      this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
      
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
          console.log('ver', loader);
        //s  loader.dismiss();
        }
      });
  } 
  ionViewDidEnter(){ 

    //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
    localStorage.setItem('OPCIONMENU', '3');
    this.estado    = localStorage.getItem('estado');
    this.pais      = localStorage.getItem('pais');
    this.municipio = localStorage.getItem('municipio');
    this.loadMap(); 
  }
  loadMap() {
          this.geolocation.getCurrentPosition().then((resp) => {
                    let latLng = new google.maps.LatLng(resp.coords.latitude, resp.coords.longitude);
                    let mapOptions = {
                      center: latLng,
                      zoom: 17,
                      mapTypeId: google.maps.MapTypeId.ROADMAP
                    }
                    this.directionsDisplay.setMap(this.map);
                    let myLatLng = { lat: resp.coords.latitude, lng: resp.coords.longitude };
                    let mapEle: HTMLElement = document.getElementById('map');
                    this.map = new google.maps.Map(mapEle, mapOptions);
                    this.marker = new google.maps.Marker({
                          position:  new google.maps.LatLng(myLatLng),
                          map: this.map,
                          title: 'Mi Posición',
                          draggable: false
                    });
                    //var MarkerWithLabel = require('markerwithlabel')(google.maps);
                              this.provider_mapas.mapalistar(this.pais, this.estado, this.municipio, myLatLng.lat, myLatLng.lng).subscribe((response) => {  
                                         // google.maps.event.addListenerOnce(this.map, 'idle', () => {
                                                  let datos  = response['datos'];
                                                  datos.forEach(resultado => {
                                                      if(resultado['foto2']!=""){
                                                              this.marker = new MarkerWithLabel({ 
                                                                  position:  new google.maps.LatLng(resultado['latitud'],resultado['longitud']),
                                                                  map: this.map,
                                                                  title: resultado['razon_social'], 
                                                                  draggable: false,
                                                                  icon: {
                                                                    url: "./assets/icon/icon_mpas.png",
                                                                    scaledSize: new google.maps.Size(90, 90),
                                                                  },
                                                                  labelContent: "<img src='"+resultado['foto2']+"'>",
                                                                  labelClass: "label-img",
                                                                  labelAnchor: new google.maps.Point(35, 89),
                                                                  //labelClass: "my-custom-class-for-label", // the CSS class for the label
                                                                  labelInBackground:  true,
                                                              }); 
                                                      }
                                                      // fin del marcador
                                                      var that = this;
                                                      //this.marker.classList.add('label-img');
                                                      this.marker.addListener('click', function() {
                                                      that.ventanapunto(  resultado['usuario_id'], 
                                                                          resultado['razon_social'], 
                                                                          '<div>' +resultado['descripcion']+'<br><br></div>', 
                                                                          resultado['latitud'], 
                                                                          resultado['longitud'], 
                                                                          myLatLng
                                                                    );
                                                      });//fin ventapunto
                                                  });//fin foreach
                                          //});//fin fatos
                                          mapEle.classList.add('show-map');
                              },error => {
                                          ////console.log('error de mapalistar: '+ JSON.stringify({error}) );
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
          }).catch((error) => {
               
          });
  }//fin function

  ventanapunto(id, nombre, contenido, latitud, longitud, mylt){

      if(this.version_exporar=='1'){
        const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                subHeader: nombre.charAt(0).toUpperCase() + nombre.slice(1),
                message:contenido,
                buttons: [
                  {
                      text: this.idiomapalabras.cerrar,
                      cssClass:'ion-cancelar',
                      role: 'cancel',
                      handler: data => {
                      }
                  },
                  {
                      text: this.idiomapalabras.ver,
                      cssClass:'ion-ir',
                      handler: data => {
                             this.usuarioid   = localStorage.getItem('IDUSER');
                              if(this.usuarioid==id){
                                let cuentaperfil = "0";
let cuentaperfil2 = 0;
                                cuentaperfil = localStorage.getItem('CUENTAPERFIL');
                                cuentaperfil2 = parseInt(cuentaperfil) + 1;
localStorage.setItem('CUENTAPERFIL', cuentaperfil2+"");
                                this.navController.navigateForward("/principal/perfil"); //this.navController.navigateForward("/principal/perfil/"+cuentaperfil);
                              }else{
                                this.navController.navigateForward("/perfilmycar/"+id);  
                              }
                      }
                  }
                ]
         }).then(alert => alert.present());
    }else{
        const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                subHeader: nombre.charAt(0).toUpperCase() + nombre.slice(1),
                message:contenido,
                buttons: [
                  {
                      text: this.idiomapalabras.cerrar,
                      cssClass:'ion-cancelar',
                      role: 'cancel',
                      handler: data => {
                      }
                  },
                  {
                      text: this.idiomapalabras.ver,
                      cssClass:'ion-ir',
                      handler: data => {
                              //this.navController.navigateForward('/perfilmycar/'+id);
                              this.usuarioid   = localStorage.getItem('IDUSER');
                              if(this.usuarioid==id){
                                let cuentaperfil = "0";
let cuentaperfil2 = 0;
                                cuentaperfil = localStorage.getItem('CUENTAPERFIL');
                                cuentaperfil2 = parseInt(cuentaperfil) + 1;
localStorage.setItem('CUENTAPERFIL', cuentaperfil2+"");
                                this.navController.navigateForward("/principal/perfil"); //this.navController.navigateForward("/principal/perfil/"+cuentaperfil);
                              }else{
                                this.navController.navigateForward("/perfilmycar/"+id);  
                              }
                      }
                  },
                  {
                      text: this.idiomapalabras.rutalocal,
                      cssClass:'ion-aceptar2',
                      handler: data => {
                          //this.calcularruta(latitud, longitud, mylt);
                          let options: LaunchNavigatorOptions = {
                            app: this.launchNavigator.APP.GOOGLE_MAPS
                          };
                          this.launchNavigator.navigate([latitud,longitud], options).then(success =>{
                            //console.log(success);
                          },error=>{
                            //console.log(error);
                          });
                      }
                  }
                ]
         }).then(alert => alert.present());
    }
  }//fin function

  calcularruta(lt, lg, vmylt){ 
       //console.log(vmylt);  
      this.directionsService.route({
          origin: new google.maps.LatLng(vmylt),
          destination: new google.maps.LatLng(lt, lg),
          travelMode: google.maps.TravelMode.DRIVING
      }, (response, status)=> {
          if(status === google.maps.DirectionsStatus.OK) {
            //console.log(response);
            this.directionsDisplay.setDirections(response);
          }else{
            //console.log(response);
            //console.log(status);
            //alert('Could not display directions due to: ' + status);
            //alert('No hay ruta viable para llegar hasta el centro de belleza. ');
          } 
      });  
  }//fin function
}//FIN CLASS
