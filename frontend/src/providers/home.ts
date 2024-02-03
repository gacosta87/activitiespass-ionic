import { Injectable, Component } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import 'rxjs/add/operator/map';
import 'rxjs/Rx';
import { Observable } from 'rxjs/Observable';
import { Variablesglobales } from './variablesglobal';
import { FileTransfer, FileUploadOptions, FileTransferObject } from '@ionic-native/file-transfer/ngx';
@Injectable()
@Component({
    templateUrl: 'template.html',
    providers:[Variablesglobales, FileTransfer]
})
export class Home{ //Se define la clase
        public v:string;
        public apikey = "AIzaSyB-evcLTNdTsHa3w8GVUIBaDP_qGbjCxVA";
        //public apikey = "AIzaSyDBchPwp6bqmhGK0r82nMvYvhtyFS8YDqo";
        //public apikey = "AIzaSyABXxkIu1wUbJTQ3Se-9nif6qhgPpdyuUw";
        public url     = new Variablesglobales();
        public sessionactiva = "";
        public httpHeader = {   
                                headers: new HttpHeaders({  'Content-Type': 'application/json; charset=UTF-8', 
                                                                  'Accept': 'application/json; charset=UTF-8',
                                                                 'tokeapp': this.url.getKeyvar(),
                                                                 'tokeinst': this.url.getTokenIns()
                                                        })
                            };
        constructor(
            public _http:HttpClient,
            private filetransfer: FileTransfer
        ){
            this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
        }


        listtours(lat, lon){
                return  this._http.post(
                                this.url.getApivar()+"listtours",  
                                JSON.stringify({
                                    'lat':lat,
                                    'lon':lon
                                }), 
                                this.httpHeader
                            );
        }


        listtoursfilter(lat, lon, var1, var2){
                return  this._http.post(
                                this.url.getApivar()+"listtoursfilter",  
                                JSON.stringify({
                                    'lat':lat,
                                    'lon':lon,
                                    'selectedDistance':var1,
                                    'selectedCategory':var2
                                }), 
                                this.httpHeader
                            );
        }



        listtoursid(id){
                return  this._http.post(
                                this.url.getApivar()+"listtoursid",  
                                JSON.stringify({
                                    'id':id,
                                }), 
                                this.httpHeader
                            );
        }
        

        obtenerPerfilesUsuario(dato1){
                return  this._http.post(
                                this.url.getApivar()+"obtenerPerfilesUsuario",  
                                JSON.stringify({
                                    'usuarioid':dato1
                                }), 
                                this.httpHeader
                            );
        }

        listapaises(){
                return  this._http.post(
                                this.url.getApivar()+"listapaises",  
                                JSON.stringify({
                                }), 
                                this.httpHeader
                            );
        }


        asistentechatlist(dato1, dato2, dato3){
                return  this._http.post(
                                this.url.getApivar()+"asistentechatlist",  
                                JSON.stringify({
                                    'asistente_usuario_id':dato1,
                                    'asistente_mymotor_id':dato2,
                                    'idioma':dato3
                                }), 
                                this.httpHeader
                            );
        }

        asistentechatadd(dato1, dato2, dato3){
                return  this._http.post(
                                this.url.getApivar()+"asistentechatadd",  
                                JSON.stringify({
                                    'asistente_usuario_id':dato1,
                                    'asistente_mymotor_id':dato2,
                                    'mensaje':dato3
                                }),
                                this.httpHeader
                            );
        }

        optimizar1(dato1){
                return  this._http.post(
                                this.url.getApivar()+"optimizar1",  
                                JSON.stringify({'titulo':dato1}), 
                                this.httpHeader
                            );


        }

        categorias(dato1){
                return  this._http.post(
                                this.url.getApivar()+"categorias",  
                                JSON.stringify({'idioma':dato1}), 
                                this.httpHeader
                            );
        }


        paratiid(dato1){
                return  this._http.post(
                                this.url.getApivar()+"paratiid",  
                                JSON.stringify({
                                    'paratidetalle_id':dato1
                                }), 
                                this.httpHeader
                            );
        }

        paratilist(dato1, dato2, dato3){ 
                return  this._http.post(
                                this.url.getApivar()+"paratilist",  
                                JSON.stringify({
                                    'paraticategoria_id':dato1,
                                    'usuario_id':dato2,
                                    'page':dato3
                                }), 
                                this.httpHeader
                            );
        }

        paratilistall(dato1){
                return  this._http.post(
                                this.url.getApivar()+"paratilistall",  
                                JSON.stringify({
                                    'idioma':dato1
                                }),
                                this.httpHeader
                            );
        }


        chatcategorialist(dato1){
                return  this._http.post(
                                this.url.getApivar()+"chatcategorialist",  
                                JSON.stringify({
                                    'idioma':dato1
                                }),
                                this.httpHeader
                            );
        }


        chatid(dato1){
                return  this._http.post(
                                this.url.getApivar()+"chatid",  
                                JSON.stringify({
                                    'chatlista_id':dato1
                                }), 
                                this.httpHeader
                            );
        }

        chatmensajelist(dato1, dato2, dato3){
                return  this._http.post(
                                this.url.getApivar()+"chatmensajelist",  
                                JSON.stringify({
                                    'usuario_id':dato1,
                                    'chatcategoria_id':dato2,
                                    'chatlista_id':dato3
                                }), 
                                this.httpHeader
                            );
        }

        chatmensajeadd(dato1, dato2, dato3){
                return  this._http.post(
                                this.url.getApivar()+"chatmensajeadd",  
                                JSON.stringify({
                                    'usuario_id':dato1,
                                    'chatlista_id':dato2,
                                    'mensaje':dato3,
                                    'chatlistaid':dato2,
                                }),
                                this.httpHeader
                            );
        }

        chatlist(dato1){
                return  this._http.post(
                                this.url.getApivar()+"chatlist",  
                                JSON.stringify({
                                    'usuario_id':dato1
                                }),
                                this.httpHeader
                            );
        }


        chatdel(dato1, dato2){
                return  this._http.post(
                                this.url.getApivar()+"chatdel",  
                                JSON.stringify({
                                    'chatlista_id':dato1,
                                    'usuario_id':dato2
                                }),
                                this.httpHeader
                            );
        }


        chatedit(dato1, dato2, dato3){
                return  this._http.post(
                                this.url.getApivar()+"chatedit",  
                                JSON.stringify({
                                    'chatlista_id':dato1,
                                    'usuario_id':dato2,
                                    'nombre':dato3
                                }),
                                this.httpHeader
                            );
        }


        


        chatpromtist(dato1){
                return  this._http.post(
                                this.url.getApivar()+"chatpromtist",  
                                JSON.stringify({
                                    'chatcategoria_id':dato1
                                }),
                                this.httpHeader
                            );
        }


        consultarconfiguraciones(dato1, dato2, dato3, dato4, dato5, dato6){
                return  this._http.post(
                                this.url.getApivar()+"consultarconfiguraciones",  
                                JSON.stringify({
                                    't_push':dato1,
                                    'p_push':dato2,
                                    'u_push':dato3,
                                    'p_idio':dato4,
                                    'p_lta':dato5,
                                    'p_lgn':dato6
                                }),
                                this.httpHeader
                            );
        }
        sugerenciasadd(var1, var2){
                return  this._http.post(
                                this.url.getApivar()+"sugerenciasadd",  
                                JSON.stringify({
                                    'usuarioid':var1,
                                    'puntaje':var2.puntaje,
                                    'texto':var2.texto,
                                }),
                                this.httpHeader
                            );
        }
        elminarcomentario(var1, var2){
                return  this._http.post(
                                this.url.getApivar()+"elminarcomentario",  
                                JSON.stringify({
                                    'comentarioid':var1,
                                    'page': var2
                                }),
                                this.httpHeader
                            );
        }
        /*
        *
        *
            bloquear
        ***`
        */
        bloquear(var1, var2){
                return  this._http.post(
                                this.url.getApivar()+"bloquear",  
                                JSON.stringify({
                                    'usuarioid':var1,
                                    'mycarid': var2
                                }),
                                this.httpHeader
                            );

        }
        /*
        *
        *
            desbloquear
        ***`
        */
        desbloquear(var1, var2){
                return  this._http.post(
                                this.url.getApivar()+"desbloquear",  
                                JSON.stringify({
                                    'usuarioid':var1,
                                    'mycarid': var2
                                }),
                                this.httpHeader
                            );

        }
        /*
        *
        *
            DEnunciar
        ***`
        */
        denunciasadd(var1, var2, var3, var4){
                return  this._http.post(
                                this.url.getApivar()+"denunciasadd",  
                                JSON.stringify({
                                    'usuarioid':var1,
                                    'mycarusuarioid': var2,
                                    'publicacioneid': var3,
                                    'tipodenuncia': var4
                                }),
                                this.httpHeader
                            );

        }
        /*
        *
        *   reservaadd
        */
        reservaadd(var1, var2, var3, var4, var5, var6){
            return  this._http.post(
                                this.url.getApivar()+"reservaadd",  
                                JSON.stringify({
                                    'usuarioid':var1,
                                    'reservausuarioid': var2,
                                    'fecha': var3,
                                    'hora': var4,
                                    'indica':var5,
                                    'turno':var6,
                                }),
                                this.httpHeader
                            );
        }
        /*
        *
        *   reservaconfig
        */
        reservaconfig(var1, var2){
            return  this._http.post(
                                this.url.getApivar()+"reservaconfig",  
                                JSON.stringify({
                                    'usuarioid':var1,
                                    'lunes':var2.lunes,
                                    'martes':var2.martes,
                                    'miercoles':var2.miercoles,
                                    'jueves':var2.jueves,
                                    'viernes':var2.viernes,
                                    'sabado':var2.sabado,
                                    'domingo':var2.domingo,
                                    'activarturno1':var2.activarturno1,
                                    'turno_a_desde':var2.turno_a_desde,
                                    'turno_a_hasta':var2.turno_a_hasta,
                                    'turno_a_cantidad':var2.turno_a_cantidad,
                                    'activarturno2':var2.activarturno2,
                                    'turno_b_desde':var2.turno_b_desde,
                                    'turno_b_hasta':var2.turno_b_hasta,
                                    'turno_b_cantidad':var2.turno_b_cantidad,
                                    'activarturno3':var2.activarturno3,
                                    'turno_c_desde':var2.turno_c_desde,
                                    'turno_c_hasta':var2.turno_c_hasta,
                                    'turno_c_cantidad':var2.turno_c_cantidad,
                                    'dias_max_reserva':var2.dias_max_reserva,
                                }),
                                this.httpHeader
                            );
        }



        /*
        *
        *   reservaconfig
        */
        reservahorarioconfig(var1, var2){
            return  this._http.post(
                                this.url.getApivar()+"reservahorarioconfig",  
                                JSON.stringify({
                                    'usuarioid':var1,
                                    'lunes':var2.lunes,
                                    'turno_a_desde':var2.turno_a_desde,
                                    'turno_a_hasta':var2.turno_a_hasta,
                                    'martes':var2.martes,
                                    'turno_b_desde':var2.turno_b_desde,
                                    'turno_b_hasta':var2.turno_b_hasta,
                                    'miercoles':var2.miercoles,
                                    'turno_c_desde':var2.turno_c_desde,
                                    'turno_c_hasta':var2.turno_c_hasta,
                                    'jueves':var2.jueves,
                                    'turno_d_desde':var2.turno_d_desde,
                                    'turno_d_hasta':var2.turno_d_hasta,
                                    'viernes':var2.viernes,
                                    'turno_e_desde':var2.turno_e_desde,
                                    'turno_e_hasta':var2.turno_e_hasta,
                                    'sabado':var2.sabado,
                                    'turno_f_desde':var2.turno_f_desde,
                                    'turno_f_hasta':var2.turno_f_hasta,
                                    'domingo':var2.domingo,
                                    'turno_g_desde':var2.turno_g_desde,
                                    'turno_g_hasta':var2.turno_g_hasta
                                }),
                                this.httpHeader
                            );
        }
        /*
        *
        *   reservaferiadd
        */
        reservaferiadd(var1, var2){
            return  this._http.post(
                                this.url.getApivar()+"reservaferiadd",  
                                JSON.stringify({
                                    'usuarioid':var1,
                                    'fecha':var2
                                }),
                                this.httpHeader
                            );
        }
        /*
        *
        *   reservadel
        */
        reservadel(var1, var2){
            return  this._http.post(
                                this.url.getApivar()+"reservadel",  
                                JSON.stringify({
                                    'usuarioid':var1,
                                    'reservaid':var2
                                }),
                                this.httpHeader
                            );
        }
        /*
        *
        *   reservaferidel
        */
        reservaferidel(var1, var2){
            return  this._http.post(
                                this.url.getApivar()+"reservaferidel",  
                                JSON.stringify({
                                    'usuarioid':var1,
                                    'reservaferiadoid':var2
                                }),
                                this.httpHeader
                            );
        }
        /*
        *
        *  lista de reservas del usuario reservalist
        */
        reservalistconfig(var1){
            return  this._http.post(
                                this.url.getApivar()+"reservalistconfig",  
                                JSON.stringify({
                                    'usuarioid':var1
                                }),
                                this.httpHeader
                            );
        }  

        /*
        *
        *  lista de reservas del usuario reservalist
        */
        reservahorariolistconfig(var1){
            return  this._http.post(
                                this.url.getApivar()+"reservahorariolistconfig",  
                                JSON.stringify({
                                    'usuarioid':var1
                                }),
                                this.httpHeader
                            );
        }  

        /*
        *
        *  lista de reservas del usuario reservalist
        */
        reservalist(var1){
            return  this._http.post(
                                this.url.getApivar()+"reservalist",  
                                JSON.stringify({
                                    'usuarioid':var1
                                }),
                                this.httpHeader
                            );
        }
        /*
        *
        *   lista de reservas realizadas a el usuarios reservaviews
        */
        reservaviews(var1){
            return  this._http.post(
                                this.url.getApivar()+"reservaviews",  
                                JSON.stringify({
                                    'usuarioid':var1,
                                }),
                                this.httpHeader
                            );
        }
        /*
        *  VER PROMOCIONES
        */
        promoviews(var1, var2, us, var3, var4, var5){
            return  this._http.post(
                                this.url.getApivar()+"promoviews",  
                                JSON.stringify({
                                    'usuarioid':var1,
                                    'promocioneid':var2,
                                    'promocioneusuarioid':us,
                                    'lat':var3,
                                    'lon':var4,
                                    'promocionesactuales': var5
                                }),
                                this.httpHeader
                            );
        }
        /*
        * Agregar videos
        *
        */
        promocionesadd(dir1, dir2, var1, var2){
             //alert('paso 1 '+dir2);
            return new Promise((resolve, reject) => {
                  //const filename = dir1.substr(dir1.lastIndexOf('/') + 1);
                  const filename = dir1;
                  let options: FileUploadOptions = {
                    fileKey: 'file',
                    fileName: filename,
                    headers: {  
                        'Accept': 'application/json',
                        'tokeapp': this.url.getKeyvar(),
                        'tokeinst': this.url.getTokenIns()
                    },
                    params: {'mycarid':var1, 'usuarioid':var2}
                  }
                  const fileTransfer: FileTransferObject = this.filetransfer.create();
                  fileTransfer.upload(dir2, this.url.getApivar()+"promoadd", options)
                  .then((data2) => {
                          // success
                          //alert('paso 2');
                          console.log('data 2: ', data2);
                          resolve({'status': 200});
                  }, (err) => { 
                          //alert('paso 2 error');
                          console.log('error file trans: ', err);
                          console.log('error file name: ', filename);
                          reject({'status': 201});
                         // error
                  });
            });
        }
        /*
        *
        *       FUncTION agregar post
        *
        *
        */
        postadd(dato1, dato2, dato3, dato4){
                return  this._http.post(
                                this.url.getApivar()+"postadd",
                                //this.url.getApivar()+"postaddwebp",
                                JSON.stringify({
                                    'usuarioid':dato1,
                                    'mycarid':dato2,
                                    'publicacion':dato3,
                                    'texto':dato4.texto,
                                    'publicaciontipo':dato4.publicaciontipo,
                                    'productoyservicio':dato4.productoyservicio,
                                    'ubicaciontipo':dato4.ubicaciontipo,
                                    'titulo':dato4.titulo,
                                    'precio':dato4.precio,
                                    'precio_oferta':dato4.precio_oferta,
                                    'nuevo_usado':dato4.nuevo_usado,
                                    'latitud':dato4.latitud,
                                    'longitud':dato4.longitud,
                                    'titulo_ubicacion':dato4.titulo_ubicacion,
                                    'isomoneda':dato4.isomoneda
                                }),
                                this.httpHeader
                        );
        }
        /*
        * Agregar videos
        *
        */
        postadd_webp_video(dir1, dir2, dato1, dato2, dato3, dato4){
                return new Promise((resolve, reject) => {
                    const filename = dir1;
                    let options: FileUploadOptions = {
                        fileKey: 'file',
                        fileName: filename,
                        headers: {  
                            'Accept': 'application/json',
                            'tokeapp':  this.url.getKeyvar(),
                            'tokeinst': this.url.getTokenIns()
                        },
                        params:{ 'usuarioid':dato1,
                                 'mycarid':dato2,
                                 'publicacion1':dato3[0],
                                 'publicacion2':dato3[1],
                                 'publicacion3':dato3[2],
                                 'publicacion4':dato3[3],
                                 'texto':dato4.texto,
                                 'publicaciontipo':dato4.publicaciontipo,
                                 'ubicaciontipo':dato4.ubicaciontipo,
                                 'nuevo_usado':dato4.nuevo_usado,
                                 'latitud':dato4.latitud,
                                 'longitud':dato4.longitud,
                                 'titulo_ubicacion':dato4.titulo_ubicacion,
                                 'titulo':dato4.titulo,
                                 'precio':dato4.precio,
                                 'precio_oferta':dato4.precio_oferta,
                                 'isomoneda':dato4.isomoneda
                        }
                    }
                    console.log('data de video = ', options);
                    const fileTransfer: FileTransferObject = this.filetransfer.create();
                    fileTransfer.upload(dir2, this.url.getApivar()+"postadd_webp_video", options)
                    .then((data2) => {
                              console.log('data 2: ', data2);
                              resolve({'code': 200});
                    }, (err) => { 
                              console.log('error file trans: ', err);
                              console.log('error file name: ', filename);
                              reject({'code': 201});
                    });
                });
        }
        /*
        * Agregar videos
        *
        */
        promocionesimgadd(dato1, dato2, dato3){
                return  this._http.post(
                                this.url.getApivar()+"promocionesimgadd",
                                JSON.stringify({
                                    'mycarid':dato1,
                                    'usuarioid':dato2,
                                    'imagenes': dato3
                                }),
                                this.httpHeader
                        );
        }
        /*
        * Agregar videos
        *
        */
        promocionestextadd(dato1, dato2, dato3){
                return  this._http.post(
                                this.url.getApivar()+"promocionestextadd",
                                JSON.stringify({
                                    'mycarid':dato1,
                                    'usuarioid':dato2,
                                    'texto': dato3
                                }),
                                this.httpHeader
                        );
        }
        /*
        *  Compartir perfil data
        */
        perfildata(var1){
                return  this._http.post(
                                this.url.getApivar()+"perfildata",  
                                JSON.stringify({
                                    'usuarioid':var1
                                }),
                                this.httpHeader
                            );
        }
        /*
        *  Lista notificaciones
        */
        notifilist(var1, var2){
                return  this._http.post(
                                this.url.getApivar()+"notifilist",  
                                JSON.stringify({
                                    'usuarioid':var1,
                                    'page':var2
                                }),
                                this.httpHeader
                            );
        }
        /*
        *  Compartir perfil data
        */
        publicaciondata(var1, var2){
                return  this._http.post(
                                this.url.getApivar()+"publicaciondata",  
                                JSON.stringify({
                                    'usuarioid':var1,
                                    'publiid':var2
                                }),
                                this.httpHeader
                            );
        }
        /*
        *
        *   Function para buscar datos del Hombe
        */
        comprobarmensajes(var1){
                return  this._http.post(
                                this.url.getApivar()+"comprobarmensajes",  
                                JSON.stringify({
                                    'usuarioid':var1,
                                }),
                                this.httpHeader
                            );
        }
        /*
        *
        *	Function para buscar datos del Hombe
        */
        promocioneslistinupdate(var1, var2, var3){
                return  this._http.post(
                                this.url.getApivar()+"promocioneslistinupdate",  
                                JSON.stringify({
                                    'usuarioid':var1,
                                    'lat': var2,
                                    'lon': var3
                                }),
                                this.httpHeader
                            );
        }
        /*
        *
        *   Function para buscar datos del Hombe
        */
        promocionesupdatevisto(var1, var2){
                return  this._http.post(
                                this.url.getApivar()+"promocionesupdatevisto",  
                                JSON.stringify({
                                    'usuarioid':var1,
                                    'promocionid':var2,
                                }),
                                this.httpHeader
                            );
        }
         /*
        *
        *   Function para buscar datos del Hombe
        */
        homesinregistro(var1, var2){
                var  var3 = localStorage.getItem('P_IDIO');
                return  this._http.post(
                                this.url.getApivar()+"homesinregistro",  
                                JSON.stringify({
                                    'lat': var1,
                                    'lon': var2,
                                    'idioma':var3
                                }),
                                this.httpHeader
                            );
        }
        /*
        *
        *   Function para buscar datos del Hombe
        */
        home(var1, var2, var3, var4, var5, var6, var7, var8, var9){
                var var10 = localStorage.getItem('P_IDIO');
                return  this._http.post(
                                this.url.getApivar()+"home",  
                                JSON.stringify({
                                    'pais':var1,
                                    'estado':var2,
                                    'municipio':var3,
                                    'page':var4,
                                    'usuarioid':var5,
                                    'mycardid':var6,
                                    'sessionactiva':var7,
                                    'lat': var8,
                                    'lon': var9,
                                    'idioma':var10
                                }),
                                this.httpHeader
                            );
        }
        /*
        *
        *   Function para buscar datos del Hombe
        */
        promocionesinicio(var1, var2, var3, var4, var5, var6, var7, var8, var9){
                return  this._http.post(
                                this.url.getApivar()+"promocionesinicio",  
                                JSON.stringify({
                                    'pais':var1,
                                    'estado':var2,
                                    'municipio':var3,
                                    'page':var4,
                                    'usuarioid':var5,
                                    'mycardid':var6,
                                    'sessionactiva':var7,
                                    'lat': var8,
                                    'lon': var9
                                }),
                                this.httpHeader
                            );
        }
         /*
        *
        *   Function para buscar datos del Hombe
        */
        homesinregistro_solicitudes(var1, var2, var3){
                return  this._http.post(
                                this.url.getApivar()+"homesinregistro_solicitudes",  
                                JSON.stringify({
                                    'lat': var1,
                                    'lon': var2,
                                    'page':var3,
                                }),
                                this.httpHeader
                            );
        }
        /*
        *
        *   Function para buscar datos del Hombe
        */
        home_solicitudes(var1, var2, var3, var4, var5, var6, var7, var8, var9){
                return  this._http.post(
                                this.url.getApivar()+"home_solicitudes",  
                                JSON.stringify({
                                    'pais':var1,
                                    'estado':var2,
                                    'municipio':var3,
                                    'page':var4,
                                    'usuarioid':var5,
                                    'mycardid':var6,
                                    'sessionactiva':var7,
                                    'lat': var8,
                                    'lon': var9
                                }),
                                this.httpHeader
                            );
        }        
        /*
        *
        *       FUNCTION SOLICITUDES ADD
        */
        solicitudesadd(var1, var2, var3, var4, var5){
                return  this._http.post(
                                this.url.getApivar()+"solicitudesadd",  
                                JSON.stringify({
                                    'usuarioid': var1,
                                    'mycarid': var2,
                                    'texto': var3.texto,
                                    'lat': var4,
                                    'lon': var5
                                }),
                                this.httpHeader
                            );
        }
        /*
        *  FUcnTION INFORMACION
        */
        inforpoliticas(var1){
                return  this._http.post(
                                this.url.getApivar()+"inforpoliticas",  
                                JSON.stringify({
                                    'categoria':var1,
                                }),
                                this.httpHeader
                            );
        }
        inforcondiciones(var1){
                return  this._http.post(
                                this.url.getApivar()+"inforcondiciones",  
                                JSON.stringify({
                                    'categoria':var1,
                                }),
                                this.httpHeader
                        );
        }
        /*
        *   MAPAS
        */
        mapalocalizar(var1, var2){
                return  this._http.post(
                                "https://maps.googleapis.com/maps/api/geocode/json?latlng="+var1+","+var2+"&key="+this.apikey,  
                                JSON.stringify({})
                            );
        }

        mapalistar(var1, var2, var3, var4, var5){
                return  this._http.post(
                                this.url.getApivar()+"mapalistar",  
                                JSON.stringify({
                                    'pais':var1,
                                    'estado':var2,
                                    'municipio':var3,
                                    'lat':var4,
                                    'lon':var5 
                                }),
                                this.httpHeader
                            );
        }
        /*
        *   PUBLICACIONES
        */
        publilike(var1, var2, var3){
                this.sessionactiva = localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
                if(this.sessionactiva=='true'){
                        return  this._http.post(
                                        this.url.getApivar()+"publilike",  
                                        JSON.stringify({
                                            'usuarioid': var1,
                                            'mycarid': var2,
                                            'publiid': var3
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
        *   PUBLICACION VER
        */
        publiver(var1, var2){
                return  this._http.post(
                                this.url.getApivar()+"publiver",  
                                JSON.stringify({
                                    'usuarioid': var1,
                                    'publiid': var2
                                }),
                                this.httpHeader
                            );
        }
        /*
        * FUNCTION AGREGAR COMENTARIO
        */
        publicomenta(var1, var2, var3, var4, var5, var6){
                return  this._http.post(
                                this.url.getApivar()+"publicomenta",  
                                JSON.stringify({
                                    'usuarioid': var1,
                                    'mycarid': var2,
                                    'publiid': var3,
                                    'comentario': var4,
                                    'hijo':var5,
                                    'hijo_public_id':var6
                                }),
                                this.httpHeader
                            );
        }
        /*
        * FUNCTION LISTAR COMENTARIO
        */
        publicomentalist(var1, var2){
                return  this._http.post(
                                this.url.getApivar()+"publicomentalist",  
                                JSON.stringify({
                                    'publiid': var1,
                                    'page': var2,
                                }),
                                this.httpHeader
                            );
        }
        publiupdate(dato1, dato2, dato3){
                return  this._http.post(
                                this.url.getApivar()+"publiupdate",  
                                JSON.stringify({
                                    'usuarioid':dato1,
                                    'publicid':dato2,
                                    'texto':dato3.texto,
                                    'publicaciontipo':dato3.publicaciontipo,
                                    'titulo':dato3.titulo,
                                    'precio':dato3.precio,
                                    'precio_oferta':dato3.precio_oferta,
                                    'isomoneda':dato3.isomoneda
                                }),
                                this.httpHeader
                            );
        }

        publidelete(var1, var2){
                return  this._http.post(
                                this.url.getApivar()+"publidelete",  
                                JSON.stringify({
                                    'publiid': var1,
                                    'usuarioid':var2,
                                }),
                                this.httpHeader
                            );
        }
        /*
        * MENSAJERIA LIST
        */
         mensajemsjimg(var1){
                return  this._http.post(
                                this.url.getApivar()+"mensajemsjimg",  
                                JSON.stringify({
                                    'mensajeid': var1
                                }),
                                this.httpHeader
                            );
        }
        /*
        * MENSAJERIA LIST
        */
         mensajelist(var1){
                return  this._http.post(
                                this.url.getApivar()+"mensajelist",  
                                JSON.stringify({
                                    'usuarioid': var1
                                }),
                                this.httpHeader
                            );
        }
        /*
        * MENSAJERIA VER MENSAJES CON EL USUARIO DELETE 
        */
         megafonodelete(var1, var2, var3, var4){ 
                return  this._http.post(
                                this.url.getApivar()+"megafonodelete",  
                                JSON.stringify({
                                    'usuarioid_desty': var1,
                                    'usuarioid_from': var2,
                                    'usuarioid_buscar': var3,
                                    'usuarioid': var4,
                                }),
                                this.httpHeader
                            );
        }
        /*
        * MENSAJERIA VER MENSAJES CON EL USUARIO DELETE MENSAJE
        */
         mensajemsjdelete(var1){ 
                return  this._http.post(
                                this.url.getApivar()+"mensajemsjdelete",  
                                JSON.stringify({
                                    'id': var1,
                                }),
                                this.httpHeader
                            );
        }
        /*
        * MENSAJERIA VER MENSAJES CON EL USUARIO 
        */
         mensajemsj(var1, var2, var3){ 
                return  this._http.post(
                                this.url.getApivar()+"mensajemsj",  
                                JSON.stringify({
                                    'usuarioid_desty': var1,
                                    'usuarioid_from': var2,
                                    'usuarioid_buscar': var3,
                                }),
                                this.httpHeader
                            );
        }
        /*
        * MENSAJERIA LIST
        */
        mensajeadd(var1, var2, var3, var4, var5){
                return  this._http.post(
                                this.url.getApivar()+"mensajeadd",  
                                JSON.stringify({
                                    'usuarioid_desty': var1,
                                    'usuarioid_from': var2,
                                    'usuarioid_buscar': var3,
                                    'texto': var4,
                                    'imagen': var5,
                                }),
                                this.httpHeader
                            );
        }

        /*
        * Buscar
        */
        buscar(var1, var2, var3, var4, var5){
                return  this._http.post(
                                this.url.getApivar()+"buscar",  
                                JSON.stringify({
                                    'clave': var1,
                                    'page': var2,
                                    'usuarioid': var3,
                                    'lat': var4,
                                    'lon': var5
                                    
                                }),
                                this.httpHeader
                            );
        }
        /*
        * Buscar
        */
        buscarreload(var1, var2, var3, var4, var5){
                return  this._http.post(
                                this.url.getApivar()+"buscarreload",  
                                JSON.stringify({
                                    'clave': var1,
                                    'page': var2,
                                    'usuarioid': var3,
                                    'lat': var4,
                                    'lon': var5
                                    
                                }),
                                this.httpHeader
                            );
        }
        /*
        * Buscar
        */
        buscarcategoria(var1, var2, var3, var4, var5, var6){
                return  this._http.post(
                                this.url.getApivar()+"buscarcategoria",  
                                JSON.stringify({
                                    'clave': var1,
                                    'page': var2,
                                    'usuarioid': var3,
                                    'lat': var4,
                                    'lon': var5,
                                    'catagoriaid': var6
                                    
                                }),
                                this.httpHeader
                            );
        }
        /*
        *
        *   listarpostmegusta
        *
        */
        listarpostmegusta(var1, var2, var3, var4, var5){
                return  this._http.post(
                                this.url.getApivar()+"listarpostmegusta",  
                                JSON.stringify({
                                    'usuarioid': var1,
                                    'mycarusuarioid': var2,
                                    'tipo': var3,
                                    'page': var4,
                                    'publiid': var5
                                }),
                                this.httpHeader
                            );

        }
        /*
        *
        *   listarsegui
        *
        */
        listarsegui(var1, var2, var3, var4){
                return  this._http.post(
                                this.url.getApivar()+"listarsegui",  
                                JSON.stringify({
                                    'usuarioid': var1,
                                    'mycarusuarioid': var2,
                                    'tipo': var3,
                                    'page': var4
                                }),
                                this.httpHeader
                            );

        }
        /*
        *
        *   compartirperfil
        *
        */
        compartirperfil(var1, var2, var3){
                return  this._http.post(
                                this.url.getApivar()+"compartirperfil",  
                                JSON.stringify({
                                    'usuarioid': var1,
                                    'mycarid': var2,
                                    'publicid': var3
                                }),
                                this.httpHeader
                            );

        }
        /*
        *
        *   compartirpromocionate
        *
        */
        compartirpromocionate(var1, var2, var3, var4, var5){
                return  this._http.post(
                                this.url.getApivar()+"compartirpromocionate",  
                                JSON.stringify({
                                    'usuarioid': var1,
                                    'mycarid': var2,
                                    'publicid': var3,
                                    'lat': var4,
                                    'lon': var5,
                                }),
                                this.httpHeader
                            );

        }
        /*
        *
        *   misproveedoresadd
        *
        */
        misproveedoresadd(var1, var2){
                return  this._http.post(
                                this.url.getApivar()+"misproveedoresadd",  
                                JSON.stringify({
                                    'usuarioid': var1,
                                    'razon_social': var2.razon_social,
                                    'telefono': var2.telefono,
                                    'categoria': var2.categoria,
                                    'email': var2.email
                                }),
                                this.httpHeader
                            );

        }
        /*
        *
        *   misproveedoresadd
        *
        */
        misproveedoresdel(var1){
                return  this._http.post(
                                this.url.getApivar()+"misproveedoresdel",  
                                JSON.stringify({
                                    'proveedorid': var1
                                }),
                                this.httpHeader
                            );

        }
        /*
        *
        *   misproveedoresadd
        *
        */
        misproveedoreslis(var1, var2){
                return  this._http.post(
                                this.url.getApivar()+"misproveedoreslis",  
                                JSON.stringify({
                                    'usuarioid': var1,
                                    'page': var2
                                }),
                                this.httpHeader
                            );

        }

        /*
        *
        *   misproveedoresadd
        *
        */
        mipromocionadd(var1, var2, var3){
                return  this._http.post(
                                this.url.getApivar()+"mipromocionadd",  
                                JSON.stringify({
                                    'usuarioid': var1,
                                    'mycarid':   var2,
                                    'texto':     var3.texto
                                }),
                                this.httpHeader
                            );

        }
}

    