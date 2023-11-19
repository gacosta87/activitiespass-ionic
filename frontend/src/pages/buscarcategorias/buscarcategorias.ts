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
  selector: 'app-buscarcategorias',
  templateUrl: 'buscarcategorias.html',
  styleUrls: ['buscarcategorias.scss'],
  providers:[Home, Usuario]
})

export class Buscarcategorias    implements  OnInit {
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
  public busqueda   = "";
  public busquedaid = "";
  public tendencia = "2";
  public data_busqueda_tendencia: any;
  public idiomapalabras: any;
  public latitudeusuario  = "";
  public longitudeusuario = "";
  public data_busqueda_tendencia_2: any;
  public data_new_users: any;
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
        let elem: HTMLElement = document.getElementById('usuarioseguir_catgoria'+v);
        elem.classList.add("quitar");
        this.provider2.perfilmycarsfavadd(v, this.usuarioid).subscribe((response) => {  });//FIN POST
  }//FIN FcuntiN
  maspost(m){
    //this.modalController.dismiss();
    this.navController.navigateForward("/perfilpostverall/"+m+"/"+this.usuarioid);
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
         // loader.dismiss();
        }
      });
    } 
  ionViewDidEnter(){ 

    //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });

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
      localStorage.setItem('OPCIONMENU', '2');
      this.latitudeusuario  = localStorage.getItem('latitudeusuario');
      this.longitudeusuario = localStorage.getItem('longitudeusuario');
      this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      this.usuario   = localStorage.getItem('USUARIO');
      this.usuarioid = localStorage.getItem('IDUSER');
      this.mycarid   = localStorage.getItem('MYCARID');
      this.busqueda   = this.rutaActiva.snapshot.paramMap.get('busqueda');
      this.busquedaid = this.rutaActiva.snapshot.paramMap.get('id');
      if(this.busqueda!="" && this.busqueda!='0'){
          if(this.texto_==""){
            this.myForm.value.texto = "#"+this.busqueda;
            this.texto_  = "#"+this.busqueda;
            this.texto_2 = "#"+this.busqueda;
            this.enviarformulario('1');
          }
      }else{
          this.data_busqueda_tendencia_2 = JSON.parse(localStorage.getItem('data_busqueda_tendencia'));
          if(this.texto_2=="" && this.busqueda=='0'){
            this.busqueda = "tendencia";
            this.texto_2  = "tendencia";
            this.myForm.value.texto = this.busqueda;
            this.texto_ = "";
            this.data_busqueda_tendencia = JSON.parse(localStorage.getItem('data_busqueda_tendencia'));
            if(this.myForm.value.texto!=""){
              if(this.data_busqueda_tendencia!=null){
                  //this.data           = this.data_busqueda_tendencia['data'];
                  //this.data2          = this.data_busqueda_tendencia['data2'];
                  //this.data3          = this.data_busqueda_tendencia['data3'];
                  //this.data_new_users = this.data_busqueda_tendencia['data_new_users'];
              }
            }
            this.enviarformulario('2');
          }else if(this.data_busqueda_tendencia_2==null){
            this.busqueda = "tendencia";
            this.texto_2  = "tendencia";
            this.myForm.value.texto = this.busqueda;
            this.texto_ = "";
            this.enviarformulario('2');
          }else{
            console.log('ver buscar 4');
            this.enviarformulario('2');
          }
      }     
  }
  doRefresh(event) {
      localStorage.setItem('OPCIONMENU', '2');
      event.target.complete();  
      this.ngOnInit();
  }
  linkperfil(v){
        this.usuarioid   = localStorage.getItem('IDUSER');
        this.mycarid     = localStorage.getItem('MYCARID');
        let elem: HTMLElement = document.getElementById('usuarioseguir_catgoria'+v);
        elem.classList.add("quitar");
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

  regresar(){
    this.navController.back();
  }
  enviarformulario_2(v){
    if(this.myForm.value.texto!=""){ 
      this.navController.navigateForward("buscar2/"+this.myForm.value.texto); 
    } 
  }
  enviarformulario(v){
    if(v=="3"){

        this.navController.navigateForward("/principal/buscar/"+this.myForm.value.texto);  
    }else{
                  if(this.myForm.value.texto==""){ 
                    this.busqueda = "tendencia";
                    this.myForm.value.texto = this.busqueda;
                  }
                  if(this.myForm.value.texto=="tendencia"){
                    v = '2';
                  } 
                  if(this.myForm.value.texto!=""){ 
                          this.texto_2 = this.myForm.value.texto;
                          this.page_number = 1;
                          if(this.usuarioid==null || this.usuarioid==""){
                            this.usuarioid = '0';
                          }
                          const loader = this.loadingCtrl.create({
                              //showBackdrop: true
                          }).then(load => {
                              load.present();
                                                this.provider.buscarcategoria(
                                                                      this.myForm.value.texto, 
                                                                      this.page_number, 
                                                                      this.usuarioid,
                                                                      this.latitudeusuario,
                                                                      this.longitudeusuario,
                                                                      this.busquedaid
                                                                    ).subscribe((response) => {  
                                                                      
                                                      this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                                                                if(response['code']==200){
                                                                                        this.data   = response['data'];
                                                                                        this.data2  = response['data2'];
                                                                                        this.data3  = response['data3'];
                                                                                        this.data_new_users = response['data_new_users'];
                                                                                        this.page_number++;
                                                                                        if(v=='2'){
                                                                                          //localStorage.setItem('data_busqueda_tendencia',  JSON.stringify(response));
                                                                                        }
                                                                                        ////console.log('datos2: '+JSON.stringify(this.data2));
                                                                                        ////console.log('datos3: '+JSON.stringify(this.data3));
                                                                                        let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                                                                        botonEnvio.removeAttribute('disabled');
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
                                                                          if(v=='2'){
                                                                            this.tendencia = '2';
                                                                          }else if (v=='3'){
                                                                            this.tendencia = '3';
                                                                          }else{
                                                                            this.tendencia = '1';
                                                                          }
                                                                          let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                                                          botonEnvio.removeAttribute('disabled');
                                                      });//FIN POST
                                                },error => {
                                                    this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                                        let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                                        botonEnvio.removeAttribute('disabled');
                                                    });//FIN POST
                                                });//FIN POST
                          });//FIN POST
                  }else{
                      let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                      botonEnvio.removeAttribute('disabled');
                  }
    }//fin else
  }
  loadData(event) {
    if(this.usuarioid==null || this.usuarioid==""){
      this.usuarioid = '0';
    }
    if(this.page_number!=1){
                        this.provider.buscarcategoria(
                                              this.myForm.value.texto, 
                                              this.page_number, 
                                              this.usuarioid,
                                              this.latitudeusuario,
                                              this.longitudeusuario,
                                              this.busquedaid
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
