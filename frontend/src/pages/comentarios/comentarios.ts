import { Component, OnInit, Input, ElementRef, OnDestroy, ViewChild, Renderer2} from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController, IonContent, ModalController, IonInput } from '@ionic/angular';
import { Variablesglobales } from '../../providers/variablesglobal';
import { Home } from '../../providers/home';
import { ActivatedRoute, Params } from '@angular/router';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';
import * as moment from 'moment';
import 'moment-timezone';

@Component({
  selector: 'app-comentarios',
  templateUrl: 'comentarios.html',
  styleUrls: ['comentarios.scss'],
  providers:[Variablesglobales, Home]
})
export class Comentarios implements  OnInit, OnDestroy{
  @ViewChild('textoenviar') myInput: IonInput
   //@ViewChild('scrollElement', {static: true}) content: IonContent;
   @Input('publiid') publiid: string;
   //@ViewChild('scrollElement') content: Content;
    //@ViewChild(IonContent, { static: false }) content: IonContent;
    public datos: any;
    public imgurl   = new Variablesglobales();
    public imgurl2: any;
    public searchTerm: any;
    public allItems: any;
    public items: any;
    public data: any;
    public data2: any;
    public usuario: string;
    public version_exporar: string;
    public sessionactiva: string;
    public estado: string;
    public pais: string;
    public municipio: string;
    public usuarioid: string;
    public mycarid: string;
    public myForm: FormGroup;
    public chatmsj = "";
    public auxuser = "";
    public mensajeaux = "";
    public textom = "";
    public page_number = 1;
    public data2aux: any;
    public idiomapalabras: any;
    public contarseguidos = 0;
    public hijo_usuario_id = 0;
    public hijo_public_id = 0;
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
                public formBuilder: FormBuilder,
                private navController: NavController, 
                public alertCtrl: AlertController,
                private rutaActiva: ActivatedRoute,
                public loadingCtrl: LoadingController,
                public provider: Home,
                public modalController: ModalController,
                private renderer: Renderer2
                ){
                this.myForm = this.formBuilder.group({
                    texto: new FormControl('', Validators.compose([]))
                });
                this.usuario         = localStorage.getItem('NOMBRESAPELLIDOS');
                this.version_exporar = localStorage.getItem('VERSION_EXPORTAR');
                this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
                this.estado          = localStorage.getItem('estado');
                this.pais            = localStorage.getItem('pais');
                this.municipio       = localStorage.getItem('municipio');
                this.usuarioid       = localStorage.getItem('IDUSER');
                this.mycarid         = localStorage.getItem('MYCARID');
                //this.publiid         = this.rutaActiva.snapshot.paramMap.get('publiid');

                this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
    }//FIN FUncTION
    respondercomentario(idcomentario, idusuario, userpubli){
        this.hijo_usuario_id = idusuario;
        this.hijo_public_id = idcomentario;
        this.textom = "@"+userpubli+" ";
        
         this.myInput.setFocus();

        //document.getElementById('textoenviar').focus();
        //console.log("hijo: "+this.hijo_usuario_id);
    }
    elminarcomentario(id){
              localStorage.setItem('banderamodal','1');
              const alert = this.alertCtrl.create({ cssClass:'my-custom-class-alert',
                  subHeader: this.idiomapalabras.aviso,
                    message: this.idiomapalabras.eliminarcomentario,
                    buttons: [
                      {
                            text: this.idiomapalabras.cancelar,
                            role: 'cancel',
                            handler: data => { 
                              localStorage.setItem('banderamodal','2'); 
                            }
                      },
                      {
                            text: this.idiomapalabras.confirmar,
                            cssClass:'ion-aceptar',
                            handler: data => { 
                                      localStorage.setItem('banderamodal','2');
                                      const loader = this.loadingCtrl.create({
                                        ////message: "Un momento, por favor...",
                                        //showBackdrop: true
                                      }).then(load => {
                                                load.present();
                                                this.page_number = 1;
                                                this.provider.elminarcomentario(id, this.page_number).subscribe((response) => {  
                                                            this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                                                          if(response['code']==200){
                                                                                  this.data   = response['datos'];
                                                                                  this.data2  = response['usuarios'];
                                                                                  this.page_number++;
                                                                                  //console.log(this.data2);
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
                                      });//FIn LOADING
                            }
                      }
                    ]
        }).then(alert => alert.present());
    }//fin fucntion
    /*
    * function combertir hora
    */
    zonahoraria(h){
      let testDateUtc = moment.tz(h, "America/Caracas");
      let localDate   = testDateUtc.clone().local();
      let horaactual  = localDate.format("DD/MM/YYYY hh:mm a");
      return horaactual;
    }
    //FIN FUncTION 
    /*
    *
    * FUNCTION PARA CREAR ENLACE hashtag
    */
    hashtag(text) {
      let repl   = text.replace(/#([A-Za-zÁ-Źá-ź0-9_]+)/g,  '<a href="#/buscar2/$1" >#$1</a>');
      let repl2  = repl.replace(/\n/g, "<br />");
      let repl3  = repl2.replace(/@([A-Za-zÁ-Źá-ź0-9_.]+)/g,  '<a href="#/perfilmycar/$1" >@$1</a>');
      return repl3;
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

   salirdecargando(){
      this.loadingCtrl.getTop().then(loader => {
        if (loader!=undefined) {
          console.log('sali',loader);
          this.loadingCtrl.dismiss();
        }
      });
  }
 

  ngOnInit(){

      this.loadingCtrl.getTop().then(loader => {
        if (loader!=undefined) {
          console.log('sali',loader);
          this.loadingCtrl.dismiss();
        }
      });

    }
    ngOnDestroy(){
        

    }
    ionViewDidEnter(){ 

          //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
          this.usuario          = localStorage.getItem('NOMBRESAPELLIDOS');
          this.version_exporar  = localStorage.getItem('VERSION_EXPORTAR');
          this.sessionactiva    = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
          this.estado           = localStorage.getItem('estado');
          this.pais             = localStorage.getItem('pais');
          this.municipio        = localStorage.getItem('municipio');
          this.usuarioid        = localStorage.getItem('IDUSER');
          this.mycarid          = localStorage.getItem('MYCARID');
          //this.publiid          = this.rutaActiva.snapshot.paramMap.get('publiid');
          const loader = this.loadingCtrl.create({
            ////message: "Un momento, por favor...",
            //showBackdrop: true
          }).then(load => {
                    load.present();
                    this.page_number = 1;
                    this.provider.publicomentalist(this.publiid, this.page_number).subscribe((response) => {  
                                this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                              if(response['code']==200){
                                                      this.data   = response['datos'];
                                                      this.data2  = response['usuarios'];
                                                      this.page_number++;
                                                      //console.log(this.data2);
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
                                                      this.ionViewDidEnter();
                                                  }
                                              }
                                            ]
                                        }).then(alert => alert.present());
                              });//FIN LOADING DISS
                    });//FIN POST
          });//FIn LOADING
  }//fin function
  loadData(event) {
    if(this.page_number!=1){
          this.usuario          = localStorage.getItem('NOMBRESAPELLIDOS');
          this.version_exporar  = localStorage.getItem('VERSION_EXPORTAR');
          this.sessionactiva    = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
          this.estado           = localStorage.getItem('estado');
          this.pais             = localStorage.getItem('pais');
          this.municipio        = localStorage.getItem('municipio');
          this.usuarioid        = localStorage.getItem('IDUSER');
          this.mycarid          = localStorage.getItem('MYCARID');
          this.provider.publicomentalist(this.publiid, this.page_number).subscribe((response) => {  
                    if(response['code']==200){
                            this.data2aux = response['datos'];
                            for (let i = 0; i < this.data2aux.length; i++) {
                                let existe_1 = 0;
                                for (let ii = 0; ii < this.data.length; ii++) {
                                    if(this.data[ii]['id']==this.data2aux[i]['id']){
                                        existe_1++;
                                    }
                                }
                                if(existe_1==0){
                                  this.data.push(this.data2aux[i]);
                                }
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
  }//fin function
  close(){
      this.modalController.dismiss();
  }
  enviarformulario() {
          this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
          if(this.sessionactiva=="true"){
                    if(this.myForm.value.texto!="" && this.mensajeaux!=this.myForm.value.texto){
                            this.mensajeaux = this.myForm.value.texto;
                            this.myForm.value.texto = "";
                            this.textom = "";
                            const loader = this.loadingCtrl.create({
                              //message: "Un momento, por favor..."
                            }).then(load => {
                                       load.present();
                                       this.provider.publicomenta(this.usuarioid,
                                                                  this.data2[0]['mycar_id'],
                                                                  this.publiid,
                                                                  this.mensajeaux,
                                                                  this.hijo_usuario_id,
                                                                  this.hijo_public_id
                                                                ).subscribe((response) => {  
                                                  this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                                          if(response['code']==200){
                                                                    this.myForm.value.texto = "";
                                                                    this.textom = "";
                                                                    this.hijo_usuario_id = 0;
                                                                    this.hijo_public_id  = 0;
                                                                    this.ionViewDidEnter();
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
                                                  let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                                                  botonEnvio.removeAttribute('disabled');   
                                      });//FIN POST
                                });//FIn LOADING
                    }else{
                        let botonEnvio: HTMLElement = document.getElementById('boton_envio');
                        botonEnvio.removeAttribute('disabled');
                    }
        }else{
              let cuentaperfil = "0";
              let cuentaperfil2 = 0;
              cuentaperfil = localStorage.getItem('CUENTAPERFIL');
              cuentaperfil2 = parseInt(cuentaperfil) + 1;
              localStorage.setItem('CUENTAPERFIL', cuentaperfil2+"");
              this.navController.navigateForward("/principal/perfil"); //this.navController.navigateForward("/principal/perfil/"+cuentaperfil);
              this.modalController.dismiss();
        }
  }//FIN FUNCTION
  linkperfil(v){
        this.mycarid     = localStorage.getItem('MYCARID');
        this.modalController.dismiss();
        if(this.usuarioid==v){
          this.navController.navigateForward("/principal/perfil");
        }else{
          this.navController.navigateForward("/perfilmycar/"+v);  
        }

  }
}//FIN CLASS