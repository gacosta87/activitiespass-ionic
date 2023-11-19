import { EventEmitter, Injectable, Component } from '@angular/core';
import OneSignal from 'onesignal-cordova-plugin';
import { Platform, NavController, LoadingController, AlertController, ModalController, PopoverController } from '@ionic/angular';
import { Usuario } from '../providers/usuario';
import { Router } from '@angular/router';

@Injectable({
    providedIn: 'root'
})
export class PushService {

    public userId: string;
    public t_push_one: string;
    public p_push_one: string;
    public t_push_aux_one: string;
    public p_push_aux_one: string;
    constructor(public provider_usuario: Usuario,
                public router: Router,
                private navController: NavController
                ) {
    }  

    configuracionInicial() {

        OneSignal.setAppId("d2240633-f2c5-4e4a-a5ab-35a75b8648c7");
        OneSignal.setNotificationWillShowInForegroundHandler((noti) => {
            // do something when notification is received
            console.log('Notificación recibida');
            console.log(noti);
            if(noti['notification']['additionalData']['notificacion']==1){
                localStorage.setItem('cantidad_mensajes',noti['notification']['additionalData']['notimsj']);
                localStorage.setItem('rutabandera',      noti['notification']['additionalData']['page']);
                localStorage.setItem('banderamodal','2');
            }else{
                localStorage.setItem('notificaciones_push', noti['notification']['additionalData']['notificacion']);
                if(noti['notification']['additionalData']['page']!=''){
                    localStorage.setItem('banderamodal','2');
                    localStorage.setItem('rutabandera', noti['notification']['additionalData']['page']);    
                }
            }
        });

        OneSignal.setNotificationOpenedHandler((resp) => {
            console.log('notificationOpenedCallback: ');
            console.log(resp);
            if(resp['notification']['additionalData']['notificacion']==1){
                localStorage.setItem('cantidad_mensajes',resp['notification']['additionalData']['notimsj']);
                localStorage.setItem('rutabandera',      resp['notification']['additionalData']['page']);
                localStorage.setItem('banderamodal','2');
                this.navController.navigateForward(resp['notification']['additionalData']['page']);
            }else{
                localStorage.setItem('notificaciones_push', resp['notification']['additionalData']['notificacion']);
                if(resp['notification']['additionalData']['page']!=''){
                    localStorage.setItem('banderamodal','2');
                    localStorage.setItem('rutabandera', resp['notification']['additionalData']['page']);    
                    this.navController.navigateForward(resp['notification']['additionalData']['page']);
                }
                console.log('Notificación abierta2', resp);
            }
        });


        // Prompts the user for notification permissions.
        //    * Since this shows a generic native prompt, we recommend instead using an In-App Message to prompt for notification permission (See step 7) to better communicate to your users what notifications they will get.
        OneSignal.promptForPushNotificationsWithUserResponse(function(accepted) {
          console.log("User accepted notifications: " + accepted);
        });


        // Obtener ID del suscriptor
        OneSignal.getDeviceState((info) => {
            console.log("Datos de usuario: ");
            console.log(info);
            this.userId = info['userId'];
            console.log("IDuser: "+this.userId);
            this.t_push_aux_one = localStorage.getItem('T_PUSH');
            localStorage.setItem('T_PUSH', this.userId);
            if(this.t_push_aux_one!=this.userId){
                localStorage.removeItem('IDUSER');
                localStorage.removeItem('USUARIO');
                localStorage.removeItem('NOMBRESAPELLIDOS');
                localStorage.removeItem('TOKEN');
                localStorage.removeItem('SESSIONACTIVA_OLYMPUS_9');
                localStorage.removeItem('FOTOPERFIL');
                localStorage.removeItem('MYCARID');
                localStorage.removeItem('TIPOUSUARIO');
                localStorage.removeItem('SUGERENCIABANDERA2');
                localStorage.removeItem('data_inicio');
                localStorage.removeItem('data_inicio2');
                localStorage.removeItem('data_inicio_pro');
                localStorage.removeItem('page_number_inicio');
                localStorage.setItem('SESSIONACTIVA_OLYMPUS_9','false');    
                this.t_push_one = localStorage.getItem('T_PUSH');
                this.p_push_one = localStorage.getItem('P_PUSH');
                this.provider_usuario.instalacionapp(this.t_push_one, this.p_push_one).subscribe((response2) => {
                  localStorage.setItem('TokenInstalacion', response2['token']);
                });
            }

        });
    }



}