import { Component,  OnInit, OnDestroy } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';
import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController, ModalController, PopoverController } from '@ionic/angular';
import { Usuario } from '../../providers/usuario';
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
  providers:[Usuario, LaunchNavigator, SocialSharing, Variablesglobales]
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
          public provider: Usuario,
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

  asistente(){
      this.usuarioid      = localStorage.getItem('IDUSER');
      this.usuariomycarid = this.rutaActiva.snapshot.paramMap.get('id');
      this.sessionactiva  = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      if(this.sessionactiva=="true"){
          this.navController.navigateForward("/asistentechat/"+this.usuarioid+"/"+this.usuariomycarid);
      }else{
            this.navController.navigateForward("/principal/perfil");
      }

  }

  irwhatsapp(cod,  val){
        console.log('+'+cod+val);
       this.socialSharing.shareViaWhatsAppToReceiver('+'+cod+val, 'Olympus app').then(() => {
         // Success!
        }).catch(() => {
          // Error!
        });

  }

  irinstagram(val){
    window.open('https://instagram.com/'+val , '_system');
  }

  irfacebook(val){
    window.open('https://www.facebook.com/'+val , '_system');
  }

  irtiktok(val){
    window.open('https://www.tiktok.com/@'+val , '_system');
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

       //localStorage.setItem('OPCIONMENU', '1');
        this.usuarioid = localStorage.getItem('IDUSER');
        this.username  = localStorage.getItem('USUARIO');
        this.latitudeusuario   = JSON.parse(localStorage.getItem('latitudeusuario'));
        this.longitudeusuario  = JSON.parse(localStorage.getItem('longitudeusuario'));
        this.usuariomycarid = this.rutaActiva.snapshot.paramMap.get('id');
        if(this.usuariomycarid==this.usuarioid || this.usuariomycarid==this.username){
            this.navController.navigateForward("/principal/perfil");
        }else{
             this.loadingCtrl.getTop().then(loader => {
              
              if (loader!=undefined) {
                console.log('llegue',loader);
                loader.dismiss();
              } 
            });
            this.inicio(this.usuariomycarid);
        }

  }
  favoritoadd_sug(v){
          let elem1: HTMLElement = document.getElementById('usuarioseguir_inicio'+v);
          elem1.classList.add("quitar");

          let elem2: HTMLElement = document.getElementById('usuarioseguir_inicio'+v);
          elem2.classList.add("quitar");
          this.provider.perfilmycarsfavaddsug(v, this.usuarioid, this.latitudeusuario, this.longitudeusuario).subscribe((response) => { 
                //this.data_new_users     = response['data_new_users'];
                localStorage.setItem('data_new_users',  JSON.stringify(this.data_new_users));
           });//FIN POST
  }//FIN FcuntiN
  linkperfil(v){
        this.usuarioid   = localStorage.getItem('IDUSER');
        this.mycarid   = localStorage.getItem('MYCARID');
        let elem2: HTMLElement = document.getElementById('usuarioseguir_inicio'+v);
        elem2.classList.add("quitar");
        
        if(this.mycarid==v){
          this.navController.navigateForward("/principal/perfil");
        }else{
          this.navController.navigateForward("/perfilmycar/"+v);  
        }
  }
  /*
    * VER PROMOCION
    */
    promocionview(id, id2){
              localStorage.setItem('banderamodal','1');
              const modal = this.modalController.create({
                  component: Promocionview,
                  cssClass: 'my-custom-class-promociones',
                  swipeToClose: true,
                  showBackdrop: true,
                  componentProps: {
                    'promocioneid': id,
                    'promocioneusuarioid': id2,
                    'promocionlista':this.data1_pro_lista,
                    'latitudeusuario':this.latitudeusuario,
                    'longitudeusuario':this.longitudeusuario,
                    'local':'1',

                  },
              }).then(load => {
                          load.onDidDismiss().then(detail => {
                              localStorage.setItem('banderamodal','2');
                          });
                          load.present();
              });//FIn LOADING
    }
  mas(m){
    //this.modalController.dismiss();
    this.navController.navigateForward("/perfilpostverall/"+m+"/"+this.usuarioid);
  }
  /*
  * MOSTRAR PERFIL SEGuiDORES Y SEGuiDOS
  *
  */
  perfilseg(t){
      localStorage.setItem('banderamodal','1');
      const modal = this.modalController.create({
          component: Perfilsegui,
          cssClass: 'my-custom-class-perfilseg',
          showBackdrop: true,
          componentProps: {
            'usuarioid': this.usuarioid,
            'mycarusuarioid': this.usuariomycarid,
            'tipo':t
          },
          swipeToClose: true,
        }).then(load => {
                  load.onDidDismiss().then(detail => {
                      localStorage.setItem('banderamodal','2');
                    if (detail['data'] != null) {
                         //console.log(detail['data']);
                        //this.ionViewDidEnter();
                        //this.navController.navigateForward("/perfilmycar/"+detail['data']);  
                        this.usuariomycarid = detail['data'];
                        this.inicio(detail['data']);
                    }
                  });
                  load.present();
        });//FIn LOADING
  }
  /*
  *
  * FUNCTION PARA CREAR ENLACE hashtag
  */
  hashtag(text) {
    if(text!=null){
      let repl   = text.replace(/#([A-Za-zÁ-Źá-ź0-9_]+)/g,  '<a class="linkir" href="#/buscar2/$1" >#$1</a>');
      let repl2  = repl.replace(/\n/g, "<br />");
      let repl3  = repl2.replace(/@([A-Za-zÁ-Źá-ź0-9_.]+)/g,  '<a class="linkir"  href="#/perfilmycar/$1" >@$1</a>');
      return repl3;
    }else{
      return text;
    }
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
  descripcionver(id){ 
        //let elem: HTMLElement = document.getElementById('texto');
        //elem.classList.add("div-publicacion-ver-menos");

        //let elem2: HTMLElement = document.getElementById('texto2');
        //elem2.classList.add("div-publicacion-ver-mas");

        let elem3: HTMLElement = document.getElementById('verm'+id);
        elem3.classList.add("div-publicacion-ver-menos");

        this.vardes = '2';
  }
  regresar(){
    this.navController.back();
  }
  iralmapa(){
        let options: LaunchNavigatorOptions = {
          app: this.launchNavigator.APP.GOOGLE_MAPS
        };
        this.launchNavigator.navigate([this.latitude,this.longitude], options).then(success =>{
          //console.log(success);
        },error=>{
          //console.log(error);
        });
    }
  loadData(event) {
          if(this.page_number!=1){
               this.provider.perfilmycar(this.usuariomycarid, this.usuarioid, this.page_number, this.latitudeusuario, this.longitudeusuario).subscribe((response) => {  
                          //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                  if(response['code']==200 && this.page_number!=1){
                                      for (let i = 0; i < response['postver']['data'].length; i++) {
                                        this.postver.push(response['postver']['data'][i]);
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
                          //});//FIN LOADING DISS
              });//FIN POST
          }else{
            event.target.complete(); 
          }
  }
  toggleInfiniteScroll() {
      //this.infiniteScroll.disabled = !this.infiniteScroll.disabled;
  }
  /*
  * FUncTION PARA IR MENSAJE
  */
  link(v){

  }
  /*
  * FUncTION PARA VER IMAGEN
  */
  mensaje(v1){
      this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      if(this.sessionactiva=="true"){
            this.usuarioid = localStorage.getItem('IDUSER');
            this.navController.navigateForward("/megafonomsj/"+v1+"/"+this.usuarioid+"/"+v1);
      }else{
            this.navController.navigateForward("/principal/perfil");
      }
  }
  /*
  * FUncTION PARA VER IMAGEN
  */
  verimg(id){

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

     
    
  }
  
  inicio(var1) {
      this.version_exporar = localStorage.getItem('VERSION_EXPORTAR');
      this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      this.usuario   = localStorage.getItem('USUARIO');
      this.usuarioid = localStorage.getItem('IDUSER');
      this.mycarid   = localStorage.getItem('MYCARID');
      this.page_number = 1;
      this.loader = this.loadingCtrl.create({
        //duration: 10000,
        ////message: "Un momento, por favor...",
        showBackdrop: true
      }).then(load => {
              load.present();
              this.provider.perfilmycar(var1, this.usuarioid, this.page_number, this.latitudeusuario, this.longitudeusuario).subscribe((response) => {  
                          this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                  if(response['code']==200){
                                      this.datos              = response['datos'];
                                      this.datosreservas      = response['datosreservas'];
                                      this.datos_username     = this.datos[0]['usuarios'][0]['username'];
                                      this.servicios          = response['servicios'];
                                      this.calificacion       = response['calificacion'];
                                      this.seguidores         = response['seguidores'];
                                      this.seguidos           = response['seguidos'];
                                      this.post               = response['post'];
                                      this.postver            = response['postver']['data'];
                                      this.datos_calificacion = response['datos_calificacion'];
                                      this.favorito           = response['favorito'];
                                      this.califico           = response['califico'];
                                      this.bloqueado          = response['bloqueado'];
                                      this.latitude           = this.datos[0]['latitud'];
                                      this.longitude          = this.datos[0]['longitud'];
                                      this.contarpromo        = response['contarpromo'];       
                                      this.usuariomycarid     = response['mycarid'];    
                                      this.data_new_users     = response['data_new_users'];   
                                      this.page_number++;
                                      //console.log("favproto" +response['califico']);
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
      });//FIN POST
    });//FIN POST      
  }
  reservaradd(v){
      localStorage.setItem('banderamodal','1');
      const modal = this.modalController.create({
          component: Reservasadd,
          showBackdrop: true,
          cssClass: 'my-custom-class-reservasadd',
          componentProps: {
            'reservausuarioid': this.usuarioid,
            'usuarioperfilid': v
          },
          swipeToClose: true,
        }).then(load => {
                  load.onDidDismiss().then(detail => {
                      localStorage.setItem('banderamodal','2');
                    if (detail['data'] != null) {
                       this.ionViewDidEnter();
                    }
                  });
                  load.present();
        });//FIn LOADING
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
                      localStorage.setItem('banderamodal','2');
                    if (detail['data'] != null) {
                       this.ionViewDidEnter();
                    }
                  });
                  load.present();
        });//FIn LOADING
  }
  calificar(item, puntaje){
      this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
      if(this.sessionactiva=="true"){
            localStorage.setItem('banderamodal','1');
            //this.navController.navigateForward('mecanicoscalificar/'+item.id+'/'+puntaje);
            const modal = this.modalController.create({
                component: Perfilmycarsfavcalif,
                cssClass: 'my-custom-class-califica',
                showBackdrop: true,
                componentProps: {
                  'usuariomycarid': this.usuariomycarid,
                  'puntaje': puntaje,
                },
                swipeToClose: true,
              }).then(load => {
                        load.onDidDismiss().then(detail => {
                           
                           if (detail['data'] != null) {
                            localStorage.setItem('banderamodal','2');
                                  //console.log('enviado '+detail['data']);
                                  this.loader = this.loadingCtrl.create({
                                    //duration: 10000,
                                    ////message: "Un momento, por favor...",
                                    showBackdrop: true
                                  }).then(load => {
                                          load.present();
                                          this.provider.perfilmycar(this.usuariomycarid, this.usuarioid, 1, this.latitudeusuario, this.longitudeusuario).subscribe((response) => {  
                                                      this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                                              if(response['code']==200){
                                                                  this.calificacion       = response['calificacion'];
                                                                  this.datos_calificacion = response['datos_calificacion'];
                                                                  this.bloqueado          = response['bloqueado'];
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
                                          });//FIN POST
                                  });//FIN POST
                           }
                        });
                        load.present();
              });//FIn LOADING
      }else{
              let cuentaperfil = "0";
              let cuentaperfil2 = 0;
              cuentaperfil = localStorage.getItem('CUENTAPERFIL');
              cuentaperfil2 = parseInt(cuentaperfil) + 1;
              localStorage.setItem('CUENTAPERFIL', cuentaperfil2+"");
              this.navController.navigateForward("/principal/perfil"); //this.navController.navigateForward("/principal/perfil/"+cuentaperfil);
      }
  }
  favoritoadd(v){
            /*const loader = this.loadingCtrl.create({
              //duration: 10000
              //message: "Un momento, por favor..."
            }).then(load2 => {
                      load2.present();*/
                      this.favorito = 1;
                      this.seguidores++;
                      this.provider.perfilmycarsfavadd(this.usuariomycarid, this.usuarioid).subscribe((response) => {  
                                  //load2.dismiss().then( () => { 
                                          if(response['code']==200){                                                      
                                          }else if (response['code']==500){
                                                    let cuentaperfil = "0";
                                                    let cuentaperfil2 = 0;
                                                    cuentaperfil = localStorage.getItem('CUENTAPERFIL');
                                                    cuentaperfil2 = parseInt(cuentaperfil) + 1;
                                                    localStorage.setItem('CUENTAPERFIL', cuentaperfil2+"");
                                                    this.navController.navigateForward("/principal/perfil"); //this.navController.navigateForward("/principal/perfil/"+cuentaperfil);
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
                                  //});//FIN LOADING DISS
                      });//FIN POST
           //});//FIn LOADING
  }//FIN FcuntiN
  favoritodelete(v){
            /*const loader = this.loadingCtrl.create({
              //duration: 10000
              //message: "Un momento, por favor..."
            }).then(load2 => {
                      load2.present();*/
                      this.favorito = 0;
                      this.seguidores--;
                      this.provider.perfilmycarsfavdel(this.usuariomycarid, this.usuarioid).subscribe((response) => {  
                                  //load2.dismiss().then( () => { 
                                          if(response['code']==200){                                                      
                                          }else if (response['code']==500){
                                                    let cuentaperfil = "0";
                                                    let cuentaperfil2 = 0;
                                                    cuentaperfil = localStorage.getItem('CUENTAPERFIL');
                                                    cuentaperfil2 = parseInt(cuentaperfil) + 1;
                                                    localStorage.setItem('CUENTAPERFIL', cuentaperfil2+"");
                                                    this.navController.navigateForward("/principal/perfil"); //this.navController.navigateForward("/principal/perfil/"+cuentaperfil);
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
                                  //});//FIN LOADING DISS
                      });//FIN POST
            //});//FIn LOADING
  }//FIN FcuntiN
  compartirperfil(id){
        this.msj   = this.idiomapalabras.compartirperfilmsj;
        this.url   = this.rutas.getComvar()+"perfil/"+id;
        this.socialSharing.share(this.msj, null, null, this.url)
  }
}//FIN CLASS
