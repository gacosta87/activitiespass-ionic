import { Component, OnInit, ViewChild, OnDestroy, ElementRef, Input, ViewChildren, QueryList} from '@angular/core';
import { Router } from '@angular/router';
import { NavController, LoadingController, AlertController, ModalController, IonSlides } from '@ionic/angular';

import { Variablesglobales } from '../../providers/variablesglobal';
import { Home } from '../../providers/home';

import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

@Component({
  selector: 'app-promocionview',
  templateUrl: 'promocionview.html',
  styleUrls: ['promocionview.scss'],
  providers:[Variablesglobales, Home] 
})
export class Promocionview   implements  OnInit, OnDestroy {
    @ViewChild('solicita', {static: false}) myInput;
    @Input('promocioneid') promocioneid: string;
    @Input('promocioneusuarioid') promocioneusuarioid: string;
    @Input('latitudeusuario') latitudeusuario: string;
    @Input('longitudeusuario') longitudeusuario: string;
    @Input('local') local: string; 
    @Input('promocionlista') promocionlista: any;
    @ViewChild("mySlider", { static: false }) slides?: IonSlides;
    @ViewChildren("player_promo") videoPlayers: QueryList<any>
    public pais: string;
    public estado: string;
    public municipio: string;
    public datos: any;
    public imgurl   = new Variablesglobales();
    public imgurl2: any;
    public searchTerm: any;
    public allItems: any;
    public items: any;
    public username = "";
    public usuarioid: string;
    public mycarid: string;
    public fotodeperfil: string;
    public enviado = "si";
    public sessionactiva = "";
    public myForm: FormGroup;
    public idiomapalabras: any;
    public inicio = 0;
    public iniciocantidad = 0;
    public iniciosiguiente = 0;
    public currentPlaying = null;
    public varset: any;
    public varset_salto: any;
    public slideOpts_cube = {
        grabCursor: true,
        direction: 'vertical',
        /*autoplay: {
           delay: 30000,
           stopOnLastSlide:true,
        },*/
        scrollbar: {
          hide: false,
        }
    }//fin opction de slider
    public cantidad_segundos = 0;
    public cantidad_segundos_isvideo = 0;
    public cantidad_segundos_porcentaje = 0;
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
                public loadingCtrl: LoadingController,
                public modalController: ModalController,
                public provider: Home
                ){
        this.myForm = this.formBuilder.group({
            texto: new FormControl('', Validators.compose([ 
                                  Validators.required
                                  ])
                       ),
        });
        this.idiomapalabras  = JSON.parse(localStorage.getItem('idiomapalabras'));
        
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

    slideInicia(){
      let currentIndex = this.slides.getActiveIndex();
      console.log('Current inicia is', currentIndex);
      //this.slides.slideNext();

    }
    slideChanged() {
      let currentIndex = this.slides.getActiveIndex();
      console.log('Current index is', currentIndex);
      this.didScroll();
    }


    openFullscreen(elem){

    }

    



    playOnSide(elem){


    }

    barrradeproceso(){
        if(this.cantidad_segundos>=29){
           this.slides.slideNext();
        }else if(this.cantidad_segundos_isvideo!=1){
           console.log('llevo', this.cantidad_segundos);
           this.cantidad_segundos++;
           this.cantidad_segundos_porcentaje = this.cantidad_segundos/30;
        }
    }


    ngOnDestroy(){
      clearInterval(this.varset);
      clearInterval(this.varset_salto);

    }

    comprobarprimervideo(){
          console.log('player', this.videoPlayers);
          console.log('currenteplay', this.currentPlaying);
          this.cantidad_segundos_isvideo = 0;
          this.videoPlayers['_results'].forEach(player => {
              if(this.currentPlaying){
                  console.log('scroll', '4');
                  return;
              }
              const nativeElement = player.nativeElement;
              const inView = this.isElementInViewpor(nativeElement);
              if(inView){
                  this.currentPlaying = nativeElement;
                  this.currentPlaying.muted = false;
                  this.currentPlaying.play();
                  this.cantidad_segundos_isvideo = 1;
                  clearInterval(this.varset);
              }
          });
    }


    didScroll(){
          this.cantidad_segundos = 0;
          this.cantidad_segundos_porcentaje = 0;
          this.cantidad_segundos_isvideo = 0;
          if(this.currentPlaying && this.isElementInViewpor(this.currentPlaying)){
              console.log('scroll', '1');
              return;
          }else if(this.currentPlaying && !this.isElementInViewpor(this.currentPlaying)){
              console.log('scroll', '2');
              this.currentPlaying.muted = true;
              this.currentPlaying.pause();
              this.currentPlaying = null;
          }else{
              console.log('scroll', '3');
          }
          console.log('player', this.videoPlayers);
          console.log('currenteplay', this.currentPlaying);
          this.videoPlayers['_results'].forEach(player => {
              if(this.currentPlaying){
                  console.log('scroll', '4');
                  return;
              }
              const nativeElement = player.nativeElement;
              const inView = this.isElementInViewpor(nativeElement);
              if(inView){
                  this.currentPlaying = nativeElement;
                  this.currentPlaying.muted = false;
                  this.currentPlaying.play();
                  this.cantidad_segundos_isvideo = 1;
              }
          });
    }


    isElementInViewpor(el){
        const rect = el.getBoundingClientRect();
        console.log('scroll', rect.top+ '- ' +rect.left+ '- ' +rect.bottom+ '- ' +rect.right);
        return(
          rect.top >= 0 &&
          rect.left >= 0 &&
          rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
          rect.right  <= (window.innerWidth  || document.documentElement.clientWidth)
        );
    }


    mas(m){
      this.modalController.dismiss();
      this.navController.navigateForward("/perfilpostverall/"+m+"/"+this.usuarioid);
    }
    hashtag(text) {
      let repl   = text.replace(/#([A-Za-zÁ-Źá-ź0-9_]+)/g,  '<a class="linkview2" href="/principal/buscar/$1" >#$1</a>');
      let repl2  = repl.replace(/\n/g, "<br />");
      let repl3  = repl2.replace(/@([A-Za-zÁ-Źá-ź0-9_.]+)/g,  '<a  class="linkview" href="#/perfilmycar/$1" >@$1</a>');
      return repl3;
    } 
    append(){
          console.log('Esta en la ultima diapositica '+this.iniciocantidad+' - '+this.inicio);
          if(this.iniciosiguiente!=0){
              if((this.inicio!=0 || (this.iniciocantidad==1 && this.inicio==0 )) && this.local=='0'  ){
                      this.provider.promoviews(this.usuarioid , 
                                              this.promocioneid,
                                              this.iniciosiguiente,
                                              this.latitudeusuario, 
                                              this.longitudeusuario,
                                              this.promocionlista
                                              ).subscribe((response) => {  
                                                                          if(response['code']==200){
                                                                                  console.log(response['datos_usuarios'].length);
                                                                                  this.iniciosiguiente = response['siguiente'];
                                                                                  console.log('informacion 2: '+this.iniciosiguiente);
                                                                                  for (let i = 0; i < response['datos_usuarios'].length; i++) {
                                                                                      this.datos.push(response['datos_usuarios'][i]);
                                                                                  }
                                                                          }//Fin else
                      });//FIN POST
                      this.slides.update();
              }//FIN IF
              this.inicio++;
          }//FIN IF
    }
    updateappend(){
      this.slides.getActiveIndex().then((index: number) => {
            let elem:  HTMLElement = document.getElementById('valor'+index);//valor  de id promedio
            let elem2: HTMLElement = document.getElementById('valor2'+index);//valor2 de id usuariopromedio
            if(elem2.innerHTML!=this.usuarioid+''){
                  this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
                  if(this.sessionactiva=="true"  && this.local=='0' ){
                      this.provider.promocionesupdatevisto(this.usuarioid , 
                                                            elem.innerHTML,
                                                            ).subscribe((response) => {  });//FIN POST  

                  }
            }
      });
    }
    addhashtag(v){
        //let elem: <HTMLElement> document.getElementById(v);
        this.myInput.value = this.myInput.value+"#";
        this.myInput.setFocus();
    }
    ionViewDidEnter(){ 

        //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });

        this.usuarioid  = localStorage.getItem('IDUSER');
        //this.latitudeusuario  = localStorage.getItem('latitudeusuario');
        //this.longitudeusuario = localStorage.getItem('longitudeusuario');
        const loader = this.loadingCtrl.create({
                ////duration: 10000,
                ////message: "Un momento, por favor...",
                //showBackdrop: true
              }).then(load => {
                      load.present();
                      this.provider.promoviews(this.usuarioid , 
                                              this.promocioneid,
                                              this.promocioneusuarioid,
                                              this.latitudeusuario, 
                                              this.longitudeusuario,
                                              this.promocionlista
                                              ).subscribe((response) => {  
                                this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();}  
                                      if(response['code']==200){
                                                this.datos           = response['datos_usuarios'];
                                                this.iniciocantidad  = response['iniciocantidad'];
                                                this.iniciosiguiente = response['siguiente'];
                                                console.log('informacion 1: '+this.iniciosiguiente);
                                                this.varset       = setInterval(function(){this.comprobarprimervideo();}.bind(this),1000);
                                                this.varset_salto = setInterval(function(){this.barrradeproceso();}.bind(this),1000);
                                                if(this.iniciocantidad==1){
                                                    this.append();
                                                    this.updateappend();
                                                }else{
                                                    this.inicio++;
                                                }
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
                      });//FIN POST
              });//FIN POST
    }
    /*
    * FUncTION PARA VER IMAGEN
    */
    mensaje(v1){
        this.sessionactiva   = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
        if(this.sessionactiva=="true"){
              this.usuarioid = localStorage.getItem('IDUSER');
              if(this.usuarioid!=v1){
                  this.navController.navigateForward("/megafonomsj/"+v1+"/"+this.usuarioid+"/"+v1);  
              }else{
                  this.navController.navigateForward("/principal/perfil");
              }
              
        }else{
              let cuentaperfil = "0";
              let cuentaperfil2 = 0;
              cuentaperfil = localStorage.getItem('CUENTAPERFIL');
              cuentaperfil2 = parseInt(cuentaperfil) + 1;
              localStorage.setItem('CUENTAPERFIL', cuentaperfil2+"");
              this.navController.navigateForward("/principal/perfil"); //this.navController.navigateForward("/principal/perfil/"+cuentaperfil);
        }
        this.modalController.dismiss(); 
    }
    next(v, u) {
        this.usuarioid  = localStorage.getItem('IDUSER');
        //this.latitudeusuario  = localStorage.getItem('latitudeusuario');
        //this.longitudeusuario = localStorage.getItem('longitudeusuario');
        const loader = this.loadingCtrl.create({
                ////duration: 10000,
                ////message: "Un momento, por favor...",
                //showBackdrop: true
              }).then(load => {
                      load.present();
                      this.provider.promoviews(this.usuarioid , 
                                              v,
                                              u,
                                              this.latitudeusuario, 
                                              this.longitudeusuario,
                                              this.promocionlista
                                              ).subscribe((response) => { 
                                this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();}  
                                      if(response['code']==200){
                                                this.datos = response['datos_usuarios'];
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
                        });//FIN POST
              });//FIN POST
    }
    back(v, u) {
        this.usuarioid  = localStorage.getItem('IDUSER');
        //this.latitudeusuario  = localStorage.getItem('latitudeusuario');
        //this.longitudeusuario = localStorage.getItem('longitudeusuario');
        const loader = this.loadingCtrl.create({
                ////duration: 10000,
                ////message: "Un momento, por favor...",
                //showBackdrop: true
              }).then(load => {
                      load.present();
                      this.provider.promoviews(this.usuarioid , 
                                              v,
                                              u,
                                              this.latitudeusuario, 
                                              this.longitudeusuario,
                                              this.promocionlista
                                              ).subscribe((response) => {  
                                this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} 
                                        if(response['code']==200){
                                                  this.datos = response['datos_usuarios'];
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
                      });//FIN POST
              });//FIN POST
    }
    close(){
      this.modalController.dismiss();
    }  
    linkperfil(v){
        this.modalController.dismiss();
        this.usuarioid   = localStorage.getItem('IDUSER');
        this.mycarid   = localStorage.getItem('MYCARID');
        if(this.mycarid==v){
          this.navController.navigateForward("/principal/perfil"); 
        }else{
          this.navController.navigateForward("/perfilmycar/"+v);  
        }
        this.modalController.dismiss();
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
        //  loader.dismiss();
        }
      });
    }
    enviarformulario() {

         this.modalController.dismiss(this.enviado);
                                    
    }//FIN FUNCTION
}//FIN CLASS