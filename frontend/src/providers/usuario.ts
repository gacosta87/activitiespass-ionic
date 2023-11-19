import { Injectable, Component } from '@angular/core';
//import { Http,Response,Headers,RequestOptions } from '@angular/http';

import { HttpClient, HttpHeaders } from '@angular/common/http';
import { NavController } from '@ionic/angular';

import 'rxjs/add/operator/map';
import 'rxjs/Rx';
import { Observable } from 'rxjs/Observable';
import { Variablesglobales } from './variablesglobal';
@Injectable()
@Component({
    templateUrl: 'template.html',
     providers:[Variablesglobales]
})
export class Usuario{ //Se define la clase
        public v:string;
        public url     = new Variablesglobales();
        public sessionactiva = "";
        public httpHeader = {
                                headers: new HttpHeaders({  'Content-Type': 'application/json; charset=UTF-8', 
                                                                  'Accept': 'application/json; charset=UTF-8',
                                                                 'tokeapp': this.url.getKeyvar(),
                                                                 'tokeinst': this.url.getTokenIns()
                                                        })
                            };
        public httpHeader_upload = {
                                        headers: new HttpHeaders({  'Content-Type': 'application/json; charset=UTF-8;', 
                                                                    'tokeapp': this.url.getKeyvar(),
                                                                    'tokeinst': this.url.getTokenIns()
                                                                })
                                    };
        public direccionGoogle : string = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=';
        constructor(
            public _http:HttpClient,
            private navController: NavController, 
        ){
            this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
        }
        loginemail(var1){
                return  this._http.post(
                                this.url.getApivar()+"loginemail",  
                                JSON.stringify({
                                    'email':var1.email,
                                }),
                                this.httpHeader
                            );
        }
        loginrecuperar1(var1){ 
                return this._http.post(this.url.getApivar()+"loginrecuperar1",
                        JSON.stringify({
                            'email':var1.email,
                        }),
                                this.httpHeader
                        );
        } 
        loginrecuperar2(var1){
                return this._http.post(this.url.getApivar()+"loginrecuperar2",
                        JSON.stringify({
                            'codigo_recuperacion':var1.codigo_recuperacion,
                        }),
                                this.httpHeader
                        );
        }
        loginrecuperar3(var1, var2){
                return this._http.post(this.url.getApivar()+"loginrecuperar3",
                        JSON.stringify({
                            'email':var1,
                            'clave':var2.clave1,
                        }),
                                this.httpHeader
                        );
        }
        actualizarpush(dato1, dato2, dato3, dato4, dato5, dato6){
                return  this._http.post(
                                this.url.getApivar()+"actualizarpush",
                                JSON.stringify({
                                    't_push':dato1,
                                    'p_push':dato2,
                                    'u_push':dato3,
                                    'p_idio':dato4,
                                    'p_lta':dato5,
                                    'p_lgn':dato6,
                                }),
                                this.httpHeader
                        );
        }
        instalacionapp(dato1, dato2){
                return  this._http.post(
                                this.url.getApivar()+"instalacionapp",
                                JSON.stringify({
                                    't_push':dato1,
                                    'p_push':dato2
                                }),
                                this.httpHeader
                        );
        }
        perfilregistrocompletar(var1, var2){
                return  this._http.post(
                                this.url.getApivar()+"perfilregistrocompletar",
                                JSON.stringify({
                                    'usuarioid':var1,
                                    'datos':var2,
                                }),
                                this.httpHeader
                        );
        }
        perfilverificar1(var1, var2){
                return  this._http.post(
                                this.url.getApivar()+"perfilverificar1",
                                JSON.stringify({
                                    'usuarioid':var1,
                                    'datos':var2,
                                }),
                                this.httpHeader
                        );
        }
        perfilverificar2(var1){
                return  this._http.post(
                                this.url.getApivar()+"perfilverificar2",
                                JSON.stringify({
                                    'usuarioid':var1
                                }),
                                this.httpHeader
                        );
        }
        perfilverificar2_1(var1, var2){
                return  this._http.post(
                                this.url.getApivar()+"perfilverificar2_1",
                                JSON.stringify({
                                    'usuarioid':var1,
                                    'datos':var2,
                                }),
                                this.httpHeader
                        );
        }
        perfilverificar3(dato1, dato2, dato3){
                return  this._http.post(
                                this.url.getApivar()+"perfilverificar3",
                                JSON.stringify({
                                    'mycarid':dato1,
                                    'usuarioid':dato2,
                                    'imagenes': dato3
                                }),
                                this.httpHeader
                        );
        }
        perfilverificar4(dato1, dato2, dato3){
                return  this._http.post(
                                this.url.getApivar()+"perfilverificar4",
                                JSON.stringify({
                                    'mycarid':dato1,
                                    'usuarioid':dato2,
                                    'imagenes': dato3
                                }),
                                this.httpHeader
                        );
        }
        perfilverificar5(dato1, dato2, dato3){
                return  this._http.post(
                                this.url.getApivar()+"perfilverificar5",
                                JSON.stringify({
                                    'mycarid':dato1,
                                    'usuarioid':dato2,
                                    'imagenes': dato3
                                }),
                                this.httpHeader
                        );
        }
        loginregistro(var1, var2){
                return  this._http.post(
                                this.url.getApivar()+"loginregistro",
                                JSON.stringify({
                                    'email':var1,
                                    'clave':var2.clave,
                                    'nombre':var2.nombre,
                                    'apellido':var2.apellido,
                                    'tipo':var2.tipo,
                                    'foto':var2.foto,
                                    'fotourl':var2.fotourl,
                                    'role_id':2,
                                }),
                                this.httpHeader
                        );
        }
        loginregistronacimiento(var1, var2){
                return  this._http.post(
                                this.url.getApivar()+"loginregistronacimiento",
                                JSON.stringify({
                                    'email':var1,
                                    'clave':var2.clave,
                                    'nombre':var2.nombre,
                                    'apellido':var2.apellido,
                                    'tipo':var2.tipo,
                                    'foto':var2.foto,
                                    'fotourl':var2.fotourl,
                                    'fechanacimiento':var2.fechanacimiento,
                                    'role_id':2,
                                }),
                                this.httpHeader
                        );
        }
        login1(dato1){
                return  this._http.post(
                                this.url.getApivar()+"login1",
                                JSON.stringify({
                                    'usuario':dato1.usuario,
                                    'clave':dato1.clave
                                }),
                                this.httpHeader
                        );
        }
        miperfil_usuario(dato1, dato2){
                return  this._http.post(
                                this.url.getApivar()+"miperfil_usuario",
                                JSON.stringify({
                                    'mycarid':dato1,
                                    'usuarioid':dato2
                                }),
                                this.httpHeader
                        );
        }


        miperfilfacebooksignin(dato1, dato2, dato3, dato4, dato5){
                return  this._http.post(
                                this.url.getApivar()+"miperfilfacebooksignin",
                                JSON.stringify({
                                    'mycarid':dato1,
                                    'toke_facebook': dato2,
                                    'expiretime_facebook': dato3,
                                    'expirein_facebook': dato4,
                                    'user_facebook': dato5
                                }),
                                this.httpHeader
                        );
        }
        miperfilfacebooklogout(dato1){
                return  this._http.post(
                                this.url.getApivar()+"miperfilfacebooklogout",
                                JSON.stringify({
                                    'mycarid':dato1
                                }),
                                this.httpHeader
                        );
        }


        miperfilsmall(dato1, dato2, dato3){
                return  this._http.post(
                                this.url.getApivar()+"miperfilsmall",
                                JSON.stringify({
                                    'mycarid':dato1,
                                }),
                                this.httpHeader
                        );
        }


        estadisticasprincipal(dato1, dato2, dato3){
                return  this._http.post(
                                this.url.getApivar()+"estadisticasprincipal",
                                JSON.stringify({
                                    'mycarid':dato1,
                                    'tipofaceinst':dato2,
                                    'idfaceinst':dato3,
                                }),
                                this.httpHeader
                        );
        }


         miperfil(dato1, dato2, dato3){
                return  this._http.post(
                                this.url.getApivar()+"miperfil",
                                JSON.stringify({
                                    'mycarid':dato1,
                                    'usuarioid':dato2,
                                    'page':dato3,
                                }),
                                this.httpHeader
                        );
        }


        precios(){
                return  this._http.post(
                                this.url.getApivar()+"precios",
                                JSON.stringify({ }),
                                this.httpHeader
                        );
        }


        enviarcodigowhatsapp(dato1, dato2, dato3, dato4){
                return  this._http.post(
                                this.url.getApivar()+"enviarcodigowhatsapp",
                                JSON.stringify({
                                    'mycarid':dato1,
                                    'datos':dato2,
                                    'usuarioid':dato3,
                                    'imagenes': dato4
                                }),
                                this.httpHeader
                        );
        }

        
        miperfilupdate(dato1, dato2, dato3, dato4){
                return  this._http.post(
                                this.url.getApivar()+"miperfilupdate",
                                JSON.stringify({
                                    'mycarid':dato1,
                                    'datos':dato2,
                                    'usuarioid':dato3,
                                    'imagenes': dato4
                                }),
                                this.httpHeader
                        );
        }
        miperfilupdate_delete(dato1, dato2, dato3, dato4){
                return  this._http.post(
                                this.url.getApivar()+"miperfilupdate_delete",
                                JSON.stringify({
                                    'mycarid':dato1,
                                    'datos':dato2,
                                    'usuarioid':dato3,
                                    'delete':dato4,
                                }),
                                this.httpHeader
                        );
        }
        miperfilupdate_asistente(dato1, dato2, dato3){
                return  this._http.post(
                                this.url.getApivar()+"miperfilupdate_asistente",
                                JSON.stringify({
                                    'mycarid':dato1,
                                    'datos':dato2,
                                    'usuarioid':dato3,
                                }),
                                this.httpHeader
                        );
        }
        checkout(dato1, dato2){
                return  this._http.post(
                                this.url.getApivar()+"checkout",
                                JSON.stringify({
                                    'mycarid':dato1,
                                    'usuarioid':dato2,
                                }),
                                this.httpHeader
                        );
        }
        miperfilupdate_asistente_upload(dato1, dato2, dato3){
                return  this._http.post(
                                this.url.getApivar()+"miperfilupdate_asistente",
                                JSON.stringify({
                                    'mycarid':dato1,
                                    'datos':dato2,
                                    'usuarioid':dato3, 
                                }),
                                this.httpHeader_upload
                        );
        }

        asistente_scrapping(dato1, dato2, dato3){
                return  this._http.post(
                                this.url.getApivar()+"asistente_scrapping",
                                JSON.stringify({
                                    'mycarid':dato1,
                                    'datos':dato2,
                                    'usuarioid':dato3, 
                                }),
                                this.httpHeader_upload
                        );
        }
        asistente_scrapping_delete(dato1, dato2, dato3, dato4){
                return  this._http.post(
                                this.url.getApivar()+"asistente_scrapping_delete",
                                JSON.stringify({
                                    'mycarid':dato1,
                                    'datos':dato2,
                                    'usuarioid':dato3,
                                    'delete':dato4,
                                }),
                                this.httpHeader
                        );
        }
        
        miperfilupdatemapa(dato1, dato2, dato3, dato4){
                return  this._http.post(
                                this.url.getApivar()+"miperfilupdatemapa",
                                JSON.stringify({
                                    'mycarid':dato1,
                                    'datos':dato2,
                                    'usuarioid':dato3, 
                                    'imagenes': dato4
                                }),
                                this.httpHeader
                        );
        }
        miperfilfotoupdate(dato1, dato2, dato3){
                return  this._http.post(
                                this.url.getApivar()+"miperfilfotoupdate",
                                JSON.stringify({
                                    'mycarid':dato1,
                                    'usuarioid':dato2,
                                    'imagenes': dato3
                                }),
                                this.httpHeader
                        );
        }
        /*
        *
        *       FUncTION PARA VER EL PERFIL DE LOS USUARIOS
        *
        *
        */ 
        perfilmycar(dato1, dato2, dato3, var2, var3){
                this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
                return  this._http.post(
                                this.url.getApivar()+"perfilmycar",
                                JSON.stringify({
                                    'usuariomycarid':dato1,
                                    'usuarioid':dato2,
                                    'page':dato3,
                                    'lat': var2,
                                    'lon': var3,
                                    'sessionactiva':this.sessionactiva
                                }),
                                this.httpHeader
                        );
        }
        /*
        *
        *       FUncTION agregar favorito
        *
        *
        */
        perfilmycarsfavaddsug(dato1, dato2, var2, var3){
                this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
                if(this.sessionactiva=='true'){
                        return this._http.post(
                                this.url.getApivar()+"perfilmycarsfavaddsug",
                                JSON.stringify({
                                    'usuariomycarid':dato1,
                                    'usuarioid':dato2,
                                    'lat': var2,
                                    'lon': var3,
                                    'sessionactiva':this.sessionactiva
                                }),
                                this.httpHeader
                        );
                }else{
                        return this._http.post(
                                this.url.getApivar()+"sessionactiva",
                                JSON.stringify({
                                    'sessionactiva':this.sessionactiva,
                                }),
                                this.httpHeader
                        );
                }
                
        }
        /*
        *
        *       FUncTION agregar favorito
        *
        *
        */
        perfilmycarsfavadd(dato1, dato2){
                this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
                if(this.sessionactiva=='true'){
                        return this._http.post(
                                this.url.getApivar()+"perfilmycarsfavadd",
                                JSON.stringify({
                                    'usuariomycarid':dato1,
                                    'usuarioid':dato2
                                }),
                                this.httpHeader
                        );
                }else{
                        return this._http.post(
                                this.url.getApivar()+"sessionactiva",
                                JSON.stringify({
                                    'sessionactiva':this.sessionactiva,
                                }),
                                this.httpHeader
                        );
                }
                
        }


        /*
        *
        *       FUncTION agregar favorito
        *
        *
        */
        perfilmycarsfavadd_buscar(dato1, dato2, var2, var3){
                this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
                if(this.sessionactiva=='true'){
                        return this._http.post(
                                this.url.getApivar()+"perfilmycarsfavadd_buscar",
                                JSON.stringify({
                                    'usuariomycarid':dato1,
                                    'usuarioid':dato2,
                                    'lat': var2,
                                    'lon': var3,
                                    'sessionactiva':this.sessionactiva
                                }),
                                this.httpHeader
                        );
                }else{
                        return this._http.post(
                                this.url.getApivar()+"sessionactiva",
                                JSON.stringify({
                                    'sessionactiva':this.sessionactiva,
                                }),
                                this.httpHeader
                        );
                }
                
        }
        /*
        *
        *       FUncTION borrar favorito
        *
        *
        */
        perfilmycarsfavdel(dato1, dato2){
                this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
                if(this.sessionactiva=='true'){
                        return  this._http.post(
                                        this.url.getApivar()+"perfilmycarsfavdel",
                                        JSON.stringify({
                                            'usuariomycarid':dato1,
                                            'usuarioid':dato2
                                        }),
                                        this.httpHeader
                                );
                }else{
                        return this._http.post(
                                this.url.getApivar()+"sessionactiva",
                                JSON.stringify({
                                    'sessionactiva':this.sessionactiva,
                                }),
                                this.httpHeader
                        );
                }
        }
        /*
        *
        *       FUncTION agregar calificacion
        *
        *
        */
        perfilmycarsfavcalif(dato1, dato2, dato3){
                return  this._http.post(
                                this.url.getApivar()+"perfilmycarsfavcalif",
                                JSON.stringify({
                                    'usuariomycarid':dato1,
                                    'usuarioid':dato2,
                                    'puntaje':dato3.puntaje,
                                    'descripcion':dato3.descripcion
                                }),
                                this.httpHeader
                        );
        }
        


       
}

    