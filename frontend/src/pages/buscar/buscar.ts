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
      //this.busqueda = this.rutaActiva.snapshot.paramMap.get('busqueda');
      this.busqueda = "";
      this.page_number = 1;
      localStorage.setItem('page_number_buscar',  JSON.stringify(this.page_number));
      if(this.busqueda!="" && this.busqueda!='0'){
                  if(this.texto_==""){
                    this.myForm.value.texto = "#"+this.busqueda;
                    this.texto_  = "#"+this.busqueda;
                    this.texto_2 = "#"+this.busqueda;
                    console.log('nuevos busqueda 1');
                    this.enviarformulario('1', 1, event);
                  }
      }else{
                  this.data_busqueda_tendencia_2 = JSON.parse(localStorage.getItem('data_busqueda_tendencia'));
                  if(this.texto_2=="" && this.busqueda=='0'){
                    //alert(this.busqueda+' '+this.texto_2+' '+this.texto_);
                    this.busqueda = "tendencia";
                    this.texto_2  = "tendencia";
                    this.myForm.value.texto = this.busqueda;
                    this.texto_ = "";
                    this.data_busqueda_tendencia = JSON.parse(localStorage.getItem('data_busqueda_tendencia'));
                    if(this.myForm.value.texto!=""){
                      if(this.data_busqueda_tendencia!=null){
                          this.data           = this.data_busqueda_tendencia['data'];
                          this.data2          = this.data_busqueda_tendencia['data2'];
                          this.data3          = this.data_busqueda_tendencia['data3'];
                          this.data_new_users = this.data_busqueda_tendencia['data_new_users'];
                          console.log('nuevos usuarios 3');
                          console.log(this.data_new_users);
                      }else{
                          //this.data        = [];
                          //this.data2       = [];
                          //this.data3       = [];
                          console.log('nuevos busqueda 4');
                      }
                    }
                    this.enviarformulario('2', 1, event);
                  }else{
                    this.busqueda = "tendencia";
                    this.texto_2  = "tendencia";
                    this.myForm.value.texto = this.busqueda;
                    this.texto_ = "";
                    console.log('nuevos busqueda 2');
                    this.enviarformulario('2', 1, event);
                  }
      }     

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
                                                  if(response['data3'].length>0){
                                                      this.page_number++;
                                                      this.data_busqueda_tendencia  = JSON.parse(localStorage.getItem('data_busqueda_tendencia'));
                                                      this.data_busqueda_tendencia['data3'] = this.data3;
                                                      localStorage.setItem('page_number_buscar',      JSON.stringify(this.page_number));
                                                      localStorage.setItem('data_busqueda_tendencia', JSON.stringify(this.data_busqueda_tendencia));
                                                  }
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


  ionViewDidEnter(){ 
      this.mySliderpubli2.stopAutoplay();
      this.mySliderpubli2.startAutoplay();
      //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
      this.sessionactiva                      = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      this.nuevainformacionperfilbuscar       = localStorage.getItem('NUEVA_INFORMACION_PERFIL_BUSCAR');
      this.nuevainformacionperfilbuscartiempo = localStorage.getItem('NUEVA_INFORMACION_PERFIL_BUSCAR_TIEMPO');
      let start_actual = Date.now();
      if(this.nuevainformacionperfilbuscartiempo!=null){
          var tiempo_trancurrido = start_actual - parseInt(this.nuevainformacionperfilbuscartiempo);  
      }else{
          var tiempo_trancurrido = 0;
      }
      if((this.nuevainformacionperfilbuscar==null) || (this.nuevainformacionperfilbuscartiempo==null) || (this.nuevainformacionperfilbuscar=='2') ||  (tiempo_trancurrido>=1200000) ){
            this.ngOnInit();
      }

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

      this.loadingCtrl.getTop().then(loader => {
        if (loader!=undefined) {
          console.log('sali',loader);
          this.loadingCtrl.dismiss();
        }
      });
      this.imgurl2 = this.rutas.getServar();
      this.conf_banner_2  = JSON.parse(localStorage.getItem('conf_banner_2'));
      this.helper.recibir2.subscribe(res=>{
          if(this.dispara!=res){
                this.dispara = res;
                this.subirarriba();
                console.log("el disparador: "+this.dispara);
          }
      });      
      localStorage.setItem('OPCIONMENU', '2');
      localStorage.setItem('nuevabusqueda', "1");
      this.latitudeusuario  = localStorage.getItem('latitudeusuario');
      this.longitudeusuario = localStorage.getItem('longitudeusuario');
      this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      this.usuario   = localStorage.getItem('USUARIO');
      this.usuarioid = localStorage.getItem('IDUSER');
      this.mycarid   = localStorage.getItem('MYCARID');
      this.busqueda = "";
      if(this.myForm.value.texto==""){
        this.data_busqueda_tendencia = JSON.parse(localStorage.getItem('data_busqueda_tendencia'));
        this.page_number             = JSON.parse(localStorage.getItem('page_number_buscar'));
        if(this.data_busqueda_tendencia!=null){
            this.data           = this.data_busqueda_tendencia['data'];
            this.data2          = this.data_busqueda_tendencia['data2'];
            this.data3          = this.data_busqueda_tendencia['data3'];
            this.data_new_users = this.data_busqueda_tendencia['data_new_users'];

            console.log('inici 1');
            console.log(this.data_new_users);
        }
      }
      console.log('esta es la pagina actual: '+this.page_number);
      this.nuevainformacionperfilbuscar       = localStorage.getItem('NUEVA_INFORMACION_PERFIL_BUSCAR');
      this.nuevainformacionperfilbuscartiempo = localStorage.getItem('NUEVA_INFORMACION_PERFIL_BUSCAR_TIEMPO');
      let start_actual = Date.now();
      if(this.nuevainformacionperfilbuscartiempo!=null){
          var tiempo_trancurrido = start_actual - parseInt(this.nuevainformacionperfilbuscartiempo);  
      }else{
          var tiempo_trancurrido = 0;
      }
      if((this.nuevainformacionperfilbuscar==null) || (this.nuevainformacionperfilbuscartiempo==null) || (this.nuevainformacionperfilbuscar=='2') ||  (tiempo_trancurrido>=1200000) ){
                this.page_number = 1;
                localStorage.setItem('page_number_buscar',  JSON.stringify(this.page_number));
                let start = Date.now();
                localStorage.setItem('NUEVA_INFORMACION_PERFIL_BUSCAR_TIEMPO', start.toString());
                localStorage.setItem('NUEVA_INFORMACION_PERFIL_BUSCAR','1');
                if(this.busqueda!="" && this.busqueda!='0'){
                    if(this.texto_==""){
                      this.myForm.value.texto = "#"+this.busqueda;
                      this.texto_  = "#"+this.busqueda;
                      this.texto_2 = "#"+this.busqueda;
                      console.log('ver buscar 1');
                      this.enviarformulario('1', 0, 0);
                    }
                }else{
                    this.data_busqueda_tendencia_2 = JSON.parse(localStorage.getItem('data_busqueda_tendencia'));
                    if(this.texto_2=="" && this.busqueda=='0'){
                      //alert(this.busqueda+' '+this.texto_2+' '+this.texto_);
                      this.busqueda = "tendencia";
                      this.texto_2  = "tendencia";
                      this.myForm.value.texto = this.busqueda;
                      this.texto_ = "";            
                      console.log('ver buscar 2');
                      this.enviarformulario('2', 0, 0);
                    }else if(this.data_busqueda_tendencia_2==null){
                      this.busqueda = "tendencia";
                      this.texto_2  = "tendencia";
                      this.myForm.value.texto = this.busqueda;
                      this.texto_ = "";
                      console.log('ver buscar 3');
                      this.enviarformulario('2', 0, 0);
                    }else{
                      console.log('ver buscar 4');
                      this.enviarformulario('2', 0, 0);
                    }
                }  
      }else{
        
      } 
  }



  


  enviarformulario(v, refres, event){
                if(this.myForm.value.texto==""){ 
                  this.busqueda = "tendencia";
                  this.myForm.value.texto = this.busqueda;
                }
                if(this.myForm.value.texto=="tendencia"){
                  v = '2';
                } 
                if(this.myForm.value.texto!=""){ 
                        this.texto_2 = this.myForm.value.texto;

                        this.page_number       = JSON.parse(localStorage.getItem('page_number_buscar'));
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
                                                                                if(response['code']==200){
                                                                                        let start = Date.now();
                                                                                        localStorage.setItem('NUEVA_INFORMACION_PERFIL_BUSCAR_TIEMPO', start.toString());
                                                                                        this.data   = response['data'];
                                                                                        //console.log(this.data);
                                                                                        this.data2  = response['data2'];
                                                                                        this.data3  = response['data3'];
                                                                                        this.data_new_users = response['data_new_users'];
                                                                                        this.page_number++;
                                                                                        localStorage.setItem('page_number_buscar',  JSON.stringify(this.page_number));
                                                                                        if(v=='2'){
                                                                                          localStorage.setItem('data_busqueda_tendencia',  JSON.stringify(response));
                                                                                        }
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
                                                                          if(refres==1){
                                                                            event.target.complete();
                                                                          }
                        },error => {
                          let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                          botonEnvio.removeAttribute('disabled');
                          if(refres==1){
                            event.target.complete();
                          }
                        });//FIN POST
                }else{
                    let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                    botonEnvio.removeAttribute('disabled');
                    if(refres==1){
                      event.target.complete();
                    }
                }
  }

  subirarriba(){
      
      if(document.getElementById('scrollElement1')){
        this.content1.scrollToTop(600);  
      }
  }

  favoritoadd(v){
        this.latitudeusuario  = localStorage.getItem('latitudeusuario');
        this.longitudeusuario = localStorage.getItem('longitudeusuario');
        this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
        let elem: HTMLElement = document.getElementById('usuarioseguir'+v);
        elem.classList.add("quitar");
        this.provider2.perfilmycarsfavadd_buscar(v, this.usuarioid, this.latitudeusuario, this.longitudeusuario).subscribe((response) => {  
            this.data_busqueda_tendencia                   = JSON.parse(localStorage.getItem('data_busqueda_tendencia'));
            this.data_busqueda_tendencia['data_new_users'] = response['data_new_users'];
            localStorage.setItem('data_busqueda_tendencia',  JSON.stringify(this.data_busqueda_tendencia));
        });//FIN POST
  }//FIN FcuntiN
  maspost(m){
        this.navController.navigateForward("/perfilpostverall/"+m+"/"+this.usuarioid);
  }
  linkperfil_publicidad(v){
        this.usuarioid   = localStorage.getItem('IDUSER');
        this.mycarid     = localStorage.getItem('MYCARID');
        if(this.mycarid==v){
          this.navController.navigateForward("/principal/perfil");
        }else{
          this.navController.navigateForward("/perfilmycar/"+v);  
        }
  }
  linkperfil(v){
        this.usuarioid   = localStorage.getItem('IDUSER');
        this.mycarid     = localStorage.getItem('MYCARID');
        let elem2: HTMLElement = document.getElementById('usuarioseguir'+v);
        elem2.classList.add("quitar");

        this.data_busqueda_tendencia = JSON.parse(localStorage.getItem('data_busqueda_tendencia'));
        this.data_new_users_aux1     = this.data_busqueda_tendencia['data_new_users'];
        let existe_1 = 0;
        this.data_new_users_aux2 = [];
        for (let i = 0; i < this.data_new_users_aux1.length; i++) {
           if(this.data_new_users_aux1[i]['id']!=v){
              this.data_new_users_aux2[existe_1] = this.data_new_users_aux1[i];
              existe_1++;  
           }
        }
        this.data_busqueda_tendencia['data_new_users'] = this.data_new_users_aux2;
        localStorage.setItem('data_busqueda_tendencia', JSON.stringify(this.data_busqueda_tendencia));


        if(this.mycarid==v){
          this.navController.navigateForward("/principal/perfil");
        }else{
          this.navController.navigateForward("/perfilmycar/"+v);  
        }
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
  
  
  enviarformulario_2(v){
    if(this.myForm.value.texto!=""){ 
      this.navController.navigateForward("buscar2/"+this.myForm.value.texto); 
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
