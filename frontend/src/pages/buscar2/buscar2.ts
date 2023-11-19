import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';
import * as moment from 'moment';
import 'moment-timezone';
import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController, ModalController } from '@ionic/angular';
import { Perfilpostver } from '../perfilpostver/perfilpostver'; 
import { Home } from '../../providers/home';
import { Usuario } from '../../providers/usuario';
import { ActivatedRoute, Params } from '@angular/router';

@Component({
  selector: 'app-buscar2',
  templateUrl: 'buscar2.html',
  styleUrls: ['buscar2.scss'],
  providers:[Home, Usuario]
})

export class Buscar2    implements  OnInit {
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
  public loader: any;
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
          public modalController: ModalController
  			  ) {
          this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
          this.myForm = this.formBuilder.group({
      	  	  texto: new FormControl('', Validators.compose([
                                            Validators.pattern('[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9._#-=;, ]*')
                                        ])
                       )
          });
  }
  favoritoadd(v){
        let elem: HTMLElement = document.getElementById('usuarioseguir_buscar2'+v);
        elem.classList.add("quitar");
        this.provider2.perfilmycarsfavadd(v, this.usuarioid).subscribe((response) => {  });//FIN POST
  }//FIN FcuntiN
  maspost(m){
    //this.modalController.dismiss();
    this.navController.navigateForward("/perfilpostverall/"+m+"/"+this.usuarioid);
  }
  enviarformulario_2(v){
    if(this.myForm.value.texto!=""){ 
      this.navController.navigateForward("buscar2/"+this.myForm.value.texto); 
    } 
  }
  regresar(){
    this.navController.back();
  }
  linkcategoria(v){
      this.navController.navigateForward("buscarcategorias/0/"+v);  
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
  /*
  *
  * FUNCTION PARA CREAR ENLACE hashtag
  */
  hashtag(text, hora) {
    let repl = text.replace(/#([A-Za-zÁ-Źá-ź0-9_]+)/g, '<a href="#/buscar2/$1" >#$1</a>');
    let repl2 = repl.replace(/\n/g, "<br />");
    return '* '+repl2+' - '+hora;
  } 
  /*
  *
  * FUNCTION PARA CREAR ENLACE hashtag
  */
  hashtagsinhora(text) {
    let repl = text.replace(/#([A-Za-zÁ-Źá-ź0-9_]+)/g, '<a href="#/buscar2/$1" >#$1</a>');
    let repl2 = repl.replace(/\n/g, "<br />");
    return repl2;
  } 
  /*
  * hast id
  */
  irhashtag(v){
      this.navController.navigateForward("/perfilmycar/"+v);  
  }
  /*
  *  FUNCTION MAS
  */
  mas(v){ 
      let elem: HTMLElement = document.getElementById('texto'+v);
      elem.classList.add("div-publicacion-ver-menos");

      let elem2: HTMLElement = document.getElementById('texto2'+v);
      elem2.classList.add("div-publicacion-ver-mas");

      let elem3: HTMLElement = document.getElementById('verm'+v);
      elem3.classList.add("div-publicacion-ver-menos");
  }

  
  ionViewDidLeave(){
    this.loadingCtrl.getTop().then(loader => {
      if (loader!=undefined) {
        console.log('sali de buscar',loader);
        //this.loadingCtrl.dismiss();
      }
    });
  }

  doRefresh(event) {
      localStorage.setItem('OPCIONMENU', '2');
      event.target.complete();  
      this.ionViewDidEnter();
  }
  linkperfil(v){
        this.usuarioid   = localStorage.getItem('IDUSER');
        this.mycarid     = localStorage.getItem('MYCARID');
        let elem2: HTMLElement = document.getElementById('usuarioseguir_buscar2'+v);
        elem2.classList.add("quitar");
        if(this.mycarid==v){
          this.navController.navigateForward("/principal/perfil"); 
        }else{
          this.navController.navigateForward("/perfilmycar/"+v);  
        }
  }

  linkperfil_l(v){
        this.usuarioid   = localStorage.getItem('IDUSER');
        this.mycarid     = localStorage.getItem('MYCARID');
        let elem2: HTMLElement = document.getElementById('usuarioseguir_buscar2_l'+v);
        elem2.classList.add("quitar");
        if(this.mycarid==v){
          this.navController.navigateForward("/principal/perfil"); 
        }else{
          this.navController.navigateForward("/perfilmycar/"+v);  
        }
  }
  ionViewDidEnter(){ 

   // //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });

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
    this.loader = this.loadingCtrl.create({
        //duration: 10000,
        ////message: "Un momento, por favor...",
        showBackdrop: true
      }).then(load => {
                          console.log('estoy cargando lo buscado');
                          load.present();
                          this.tendencia = '3';
                          this.myForm.value.texto = this.rutaActiva.snapshot.paramMap.get('id');
                          this.texto_             = this.rutaActiva.snapshot.paramMap.get('id');
                          this.usuarioid   = localStorage.getItem('IDUSER');
                          if(this.myForm.value.texto==""){ 
                            this.busqueda = "tendencia";
                            this.myForm.value.texto = this.busqueda;
                          }
                          if(this.myForm.value.texto!=""){ 
                                  this.texto_2 = this.myForm.value.texto;

                                  this.page_number = 1;
                                  if(this.usuarioid==null || this.usuarioid==""){
                                    this.usuarioid = '0';
                                  }
                                  localStorage.setItem('nuevabusqueda', "2");
                                  this.provider.buscarreload(
                                                        this.myForm.value.texto, 
                                                        this.page_number, 
                                                        this.usuarioid,
                                                        this.latitudeusuario,
                                                        this.longitudeusuario
                                                      ).subscribe((response) => {  
                                                                                    this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                                                                                          if(response['code']==200){
                                                                                                                  
                                                                                                                              this.data   = response['data'];
                                                                                                                              console.log(this.data);
                                                                                                                              this.data2  = response['data2'];
                                                                                                                              this.data3  = response['data3'];
                                                                                                                              this.data_new_users = response['data_new_users'];
                                                                                                                              this.page_number++;
                                                                                                                              ////console.log('datos2: '+JSON.stringify(this.data2));
                                                                                                                              ////console.log('datos3: '+JSON.stringify(this.data3));
                                                                                                                              let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                                                                                                              if(botonEnvio){
                                                                                                                                botonEnvio.removeAttribute('disabled');  
                                                                                                                              }
                                                                                                                  
                                                                                                    }else if (response['code']==201){
                                                                                                                let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                                                                                                botonEnvio.removeAttribute('disabled');
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
                                                                                                      
                                                                                                    let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                                                                                    if(botonEnvio){
                                                                                                      botonEnvio.removeAttribute('disabled');  
                                                                                                    }
                                                                                    });//FIN LOADING DISS
                                  },error => {
                                    this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                          let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                          if(botonEnvio){
                                            botonEnvio.removeAttribute('disabled');  
                                          }
                                    });//FIN LOADING DISS
                                  });//FIN POST
                          }else{
                              this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                    let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                    if(botonEnvio){
                                      botonEnvio.removeAttribute('disabled');  
                                    }
                              });//FIN LOADING DISS
                          }
      });//FIN POST
  }
  loadData(event) {
    if(this.usuarioid==null || this.usuarioid==""){
      this.usuarioid = '0';
    }
    if(this.page_number!=1){
                        this.provider.buscarreload(
                                              this.myForm.value.texto, 
                                              this.page_number, 
                                              this.usuarioid,
                                              this.latitudeusuario,
                                              this.longitudeusuario
                                            ).subscribe((response) => {  
                                    if(response['code']==200){
                                            for (let i = 0; i < response['data3'].length; i++) {
                                              this.data3.push(response['data3'][i]);
                                            }
                                            this.page_number++;
                                            event.target.complete();
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
                        });//FIN POST
    }else{
          event.target.complete(); 
    }

  }
  fpostver(item){
      localStorage.setItem('banderamodal','1');
      const modal = this.modalController.create({
          component: Perfilpostver,
          cssClass: 'my-custom-class-postver',
          showBackdrop: true,
          componentProps: {
            'usuarioid': this.usuarioid,
            'item': item
          },
          swipeToClose: true,
        }).then(load => {
                  load.onDidDismiss().then(detail => {
                     if (detail !== null) {
                      localStorage.setItem('banderamodal','2');
                       //this.ionViewDidEnter();
                     }
                  });
                  load.present();
        });//FIn LOADING
  }
}//FIN CLASS
