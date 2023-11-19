
function cambia_color(selBackground){
  var bgc = selBackground;
  var bgcVal = bgc.options.item(bgc.selectedIndex).value;
  bgc.style.backgroundColor = bgcVal;
}


function cambia_color2(selBackground){
  var bgc = document.getElementById(selBackground);
  var bgcVal = bgc.options.item(bgc.selectedIndex).value;
  bgc.style.backgroundColor = bgcVal;
}

function activa_ciclo(id, val){
   if(val=='1'){  
     $('#'+id).hide();
   }else{
     $('#'+id).show();
   }
}


function activa(id, val){
   if(val=='1'){  
     $('#'+id).hide();
   }else{
     $('#'+id).show();
   }
}

function activa_funcional(id, val){
         if(val=='2'){  
     $('#'+id).show();
     $('#verdadero').show();
     $('#pregunta1').val('');
     $('#pregunta2').val('');
     $('#pregunta3').val('');
     $('#pregunta4').val('');

   }else if(val=='1'){  
     $('#'+id).show();
     $('#verdadero').hide();
     $('#pregunta1').val('VERDADERO');
     $('#pregunta2').val('FALSO');
     $('#pregunta3').val('');
     $('#pregunta4').val('');

   }else{
     $('#'+id).hide();
     $('#pregunta1').val('');
     $('#pregunta2').val('');
     $('#pregunta3').val('');
     $('#pregunta4').val('');
   }
}



function valida_respuesta(a){
   // alert(a);
   if(eval(a)>100){
          alert("La respuesta del cuestionario es mayor a 100");
          $('input[type="submit"]').attr('disabled','disabled');
    }else{
          $('input[type="submit"]').removeAttr('disabled');
    }
}



function valida_valor_cuestionario(){
   valor = 0;
   if($('#Actuacicuefuncional').val()==2){
     f     = $('#Actuacicuefuncion_valor').val();
     valor = eval(valor) + eval(f);
   }
    if($('#Actuacicueconceptual').val()==2){
     c     = $('#Actuacicueconceptual_valor').val();
     valor = eval(valor) + eval(c);
   }
    if($('#Actuacicueobjetivos').val()==2){
     o     = $('#Actuacicueobjetivos_valor').val();
     valor = eval(valor) + eval(o);
   }
   if(eval(valor)>100){
          alert("El valor del cuestionario es mayor a 100");
          $('input[type="submit"]').attr('disabled','disabled');
    }else{
          $('input[type="submit"]').removeAttr('disabled');
    }
}





///////ALMACEN////////
function validar_valor_a(a, b){
        $.ajax({
                  url:b,
                  type:"post",
                  data:{
                        id1:$('#Actuacicueconaactucieva_id').val(),
                        id2:$('#Actuacicueconaactuacicue_id').val(),
                        id3:$('#Actuacicueconaactuacioncompetenciatipo_id').val(),
                        id4:$('#Actuacicueconaactuacioncompetencia_id').val(),
                      },
                  success:function(n){
                        valor = eval(a)+eval(n);
                        if(eval(valor)>100){
                              alert("El valor del cuestionario es mayor a 100");
                              $('input[type="submit"]').attr('disabled','disabled');
                        }else{
                              $('input[type="submit"]').removeAttr('disabled');
                        }
                      
                  }
        });
}

///////ALMACEN////////
function validar_valor_b(a, b){
   // alert(b);
        $.ajax({
                  url:b,
                  type:"post",
                  data:{
                        id1:$('#Actuacicuefunaactucieva_id').val(),
                        id2:$('#Actuacicuefunaactuacicue_id').val(),
                        id3:$('#Actuacicuefunaactuacioncompetenciatipo_id').val(),
                        id4:$('#Actuacicuefunaactuacioncompetencia_id').val(),
                      },
                  success:function(n){
                    valor = eval(a)+eval(n);
                        if(eval(valor)>100){
                              alert("El valor del cuestionario es mayor a 100");
                              $('input[type="submit"]').attr('disabled','disabled');
                        }else{
                              $('input[type="submit"]').removeAttr('disabled');
                        }
                      
                  }
        });
}
///////ALMACEN////////
function validar_valor_c(a, b){
        $.ajax({
                  url:b,
                  type:"post",
                  data:{
                        id1:$('#Actuacicueobjactucieva_id').val(),
                        id2:$('#Actuacicueobjactuacicue_id').val(),
                        id3:$('#Actuacicueobjactuacioncompetenciatipo_id').val(),
                        id4:$('#Actuacicueobjactuacioncompetencia_id').val(),
                      },
                  success:function(n){
                        valor = eval(a)+eval(n);
                        if(eval(valor)>100){
                              alert("El valor del cuestionario es mayor a 100");
                              $('input[type="submit"]').attr('disabled','disabled');
                        }else{
                              $('input[type="submit"]').removeAttr('disabled');
                        }
                      
                  }
        });
}




///////ALMACEN////////
function validar_nombre_almacen(){
        $.ajax({
                  url:"/Almacenes/nombre/",
                  type:"post",
                  data:{
                        nombre:$('#Almacenenombre').val(),
                      },
                  success:function(n){
                      if(n!='0'){
                            alert("Para el nombre elejido ya se encuentra registrado");
                            $('input[type="submit"]').attr('disabled','disabled');
                      }else{
                            $('input[type="submit"]').removeAttr('disabled');
                      }
                  }
        });
}
///////ALMACEN AMTERIAL////////
function validar_nombre_almacenmaterial(){
        $.ajax({
                  url:"/Almacenmateriales/nombre/",
                  type:"post",
                  data:{
                        nombre:$('#Almacenmaterialenombre').val(),
                      },
                  success:function(n){
                      if(n!='0'){
                            alert("Para el nombre elejido ya se encuentra registrado");
                            $('input[type="submit"]').attr('disabled','disabled');
                      }else{
                            $('input[type="submit"]').removeAttr('disabled');
                      }
                  }
        });
}
///////VALIDAR RFC////////
function validar_nombre_rfc(){
        $.ajax({
                  url:"/Clientes/rfc/",
                  type:"post",
                  data:{
                        rfc:$('#Clienterfc').val(),
                      },
                  success:function(n){
                      if(n!='0'){
                            if($('#Clienterequiere_factura1').prop('checked')) {
                              alert("El formato es incorrecto");
                              $('input[type="submit"]').attr('disabled','disabled');
                            }else{
                              $('input[type="submit"]').removeAttr('disabled');
                            }
                      }else{
                            $('input[type="submit"]').removeAttr('disabled');
                      }
                  }
        });
}
///////ALMACEN MARCAS////////
function validar_nombre_almacenmarcas(){
        $.ajax({
                  url:"/Almacenmarcas/nombre/",
                  type:"post",
                  data:{
                        nombre:$('#Almacenmarcanombre').val(),
                      },
                  success:function(n){
                      if(n!='0'){
                            alert("Para el nombre elejido ya se encuentra registrado");
                            $('input[type="submit"]').attr('disabled','disabled');
                      }else{
                            $('input[type="submit"]').removeAttr('disabled');
                      }
                  }
        });
}
///////ALMACEN PRODUCTOS////////
function validar_nombre_almacenproductos(){
        $.ajax({
                  url:"/Almacenproductos/nombre/",
                  type:"post",
                  data:{
                        nombre:$('#Almacenproductonombre').val(),
                      },
                  success:function(n){
                      if(n!='0'){
                            alert("Para el nombre elejido ya se encuentra registrado");
                            $('input[type="submit"]').attr('disabled','disabled');
                      }else{
                            $('input[type="submit"]').removeAttr('disabled');
                      }
                  }
        });
}

function activar_almacenfuente(){
   var a = $('#Inventariomovimientotipo').val();
         if(eval(a)==eval(1)){ $('#tipo_fuente').hide();

   }else if(eval(a)==eval(2)){ $('#tipo_fuente').hide();

   }else if(eval(a)==eval(3)){ $('#tipo_fuente').show();

   }
}

function validar_prospecto(){
        if($('#Prospectonombres').val()==''){
                                                alert('Deber insertar un nombre');
                                                return false;
  }else if($('#Prospectorespuesta').val()==''){
                                                alert('Deber seleccionar una objeción');
                                                return false;
  }else if($('#Prospectotelefonocasa').val()=='' && $('#Prospectotelefonomovil').val()=='' && $('#Prospectotelefonooficina').val()==''){
                                                alert('Deber seleccionar una teléfono');
                                                return false;
  }
}


function validar_user(){
  if($('#Userpassword').val()!=$('#Userpassword2').val()){
    alert('la confirmación de Password no es igual a Password');
    return false;
  }
}

function limpiar_calculo1(){
  $("#Reservacionefecha_entrada").val('');
  $("#Reservacionefecha_salida").val('');
  $("#Reservacionedias").val('0');
  $("#Reservacionetotal").val('0');
}
function cambiardoctmp(id){
    if(document.getElementById("AfiliadoDocumentacionTmp"+id).checked==true){
       document.getElementById("AfiliadoDocumentacion"+id).checked=true;
    }else{
       document.getElementById("AfiliadoDocumentacion"+id).checked=false;
    }
}
/*function cambiardoc(id){
  $("#AfiliadoDocumentacion"+id).removeAttr("onChange");
  $("#AfiliadoDocumentacion"+id).attr("disabled", "disabled");
  $("#capa"+id).show();
  $.ajax({
            url:"/Documentaciones/cambiarstatus/",
            type:"post",
            data:{
                  id:id,
                },
            success:function(n){
            }
  });
}
function cambiardoc2(id){
  $("#AfiliadoDocumentacion"+id).removeAttr("disabled");
  $("#AfiliadoDocumentacion"+id).attr("onChange", "cambiardoc('"+id+"');");
  $("#AfiliadoDocumentacion"+id).attr("checked", "checked");
  $("#capa"+id).hide();
 
}*/
function habilitar_tarjeta(){
       var t = $('#Afiliadopagoafiliadotipopago_id').val();
        if(t==1){
          $('#Afiliadopagotarjeta_v').hide();
  }else if(t==2){
          $('#Afiliadopagotarjeta_v').hide();
  }else if(t==3){
          $('#Afiliadopagotarjeta_v').show();
  }else{
          $('#Afiliadopagotarjeta_v').hide();
  }
}
function verifica_nino(){
   nino  = $('#Reservacionecantidadninos').val(); 
   if(eval(nino)>2){
          alert("La cantidad debe ser menor o igual a 2");
          $('input[type="submit"]').attr('disabled','disabled');
          $('#Reservacionecantidadninos').val('0'); 
   }else{

   }
}
function calcular_habitacion(url){
    fecha1  = $('#Reservacionefecha_entrada').val(); 
    var dia1   = fecha1.substr(8);
    var mes1   = fecha1.substr(5,2);
    var anyo1  = fecha1.substr(0,4);
    fecha2  = $('#Reservacionefecha_salida').val();
    var dia2   = fecha2.substr(8);
    var mes2   = fecha2.substr(5,2);
    var anyo2  = fecha2.substr(0,4);
    var n=$("#autoriza_pass").val();
    var t=$("#autoriza_user").val();
    var fecha1  = new Date(anyo1+","+mes1+","+dia1);
    var fecha2  = new Date(anyo2+","+mes2+","+dia2);
    var diasDif = fecha2.getTime() - fecha1.getTime();
    var dias    = Math.round(diasDif/(1000 * 60 * 60 * 24));
    if(fecha1 <= fecha2 && fecha1!="" && fecha2!=""){
        $.ajax({
           //"/Reservaciones/disponibilidad"
            url:url,
            type:"post",
            data:{
                  fecha_a:$('#Reservacionefecha_entrada').val(),
                  fecha_b:$('#Reservacionefecha_salida').val(),
                  hotel_id:$('#Reservacionehotele_id').val(),
                  tipohabitacione_id:$('#Reservacionereserhabitaciontipo_id').val(),
                  habitacione_id:$('#Reservacionereserhabitacione_id').val()
                },
            success:function(n){
              if(n==!0){
                             $('#Reservacionedias').val(dias);
                var a      = $('#Reservacioneprecioxdia').val();
                var total  = (eval(dias)*eval(a));
                    total2 = parseFloat(total).toFixed(2);
                           // $('#Reservacionetotal').val(total2);
                    $('input[type="submit"]').removeAttr('disabled');
              }else{
                    $('#Reservacionedias').val('0');
                    //$('#Reservacioneprecioxdia').val('0');
                    //$('#Reservacionetotal').val('0');
                    alert("Para el periodo elejido ya se encuentra una reservar en la habitación");
                    $('input[type="submit"]').attr('disabled','disabled');
              }
            }
        });
    }else{
          $('#Reservacionedias').val('0');
          $('#Reservacioneprecioxdia').val('0');
          $('#Reservacionetotal').val('0');
          alert("La fecha de Salida debe ser mayor a la de Entrada");
          $('input[type="submit"]').attr('disabled','disabled');
    }
}

function generar_reporte_afiliado(id){
    //window.open("/Afiliados/reporte/"+id,'_blank');
}

function generar_reporte_factura_afiliado(id, nfactura){
    //window.open("/Afiliadopagos/facturarreporte/"+id+"/"+nfactura,'_blank');
}

function generar_reporte_factura_reserva(id, nfactura){
    //window.open("/Afiliadopagos/facturarreservareporte/"+id+"/"+nfactura,'_blank');
}

function selectTagRemote(url_cargar, id, parametro_extra){
  //url_cargar = url_cargar+'/'+parametro_extra;
  //new Ajax.Updater(id_cargar,url_cargar, {asynchronous:true, evalScripts:true,onLoading:function(request){Element.show('mini_loading');}, onComplete:function(request){Element.hide('mini_loading')}, requestHeaders:['X-Update', id_cargar]});
  url_cargar = url_cargar+'/'+parametro_extra;
  jQuery('#'+id).load(url_cargar);
}

function cargar_contenido(url_cargar,id_cargar){
  new Ajax.Updater(id_cargar,url_cargar, {asynchronous:true, evalScripts:true,onLoading:function(request){Element.show('mini_loading');}, onComplete:function(request){Element.hide('mini_loading')}, requestHeaders:['X-Update', id_cargar]});
}

function linkTagRemote(url_cargar, id){
  //url_cargar = 'cochesplus/'+url_cargar+'/'+parametro_extra;
  url_cargar = url_cargar;
  $('#'+id).load(url_cargar);
}

function inputTagRemote(url_cargar, id, parametro_extra){
  //url_cargar = 'cochesplus/'+url_cargar+'/'+parametro_extra;
  url_cargar = url_cargar+'/'+parametro_extra;
  $('#'+id).load(url_cargar);
}

function vafiliados(){
  var a = $('#Afiliadocedula').val();
  var b = $('#Afiliadopasaporte').val();
  if(a=="" && b==""){
    alert('Debe ingresar la cédula o Pasaporte.');
    return false;
  }
}


function limpiar_msj(v){
  if(v==2){
    id='msj_internal_exito';
  }else{
    id='msj_internal_error';
  }
  new Effect.Fade(id);
}


function  pago_afiliado(){
  var a = $('#Afiliadopagosaldo').val();
  var b = $('#Afiliadopagopago').val();
  if(eval(a)<eval(b)){
    alert('El pago es mayor al Saldo.');
     $('input[type="submit"]').attr('disabled','disabled');
  }else{
     $('input[type="submit"]').removeAttr('disabled');  
  }
}

function  ver_cedula(url){
    $.ajax({
            //"/Afiliados/vercedula"
            url:url,
            type:"post",
            data:{
                  id:$('#Afiliadocedula').val()
                 },
            success:function(n){
              if(n!="0"){
                          alert('La cédula ya se encuentra registrado.');
                          $('input[type="submit"]').attr('disabled','disabled');
              }else{ 
                          $('input[type="submit"]').removeAttr('disabled');  
              }
            }
    });
}

function  ver_pasaporte(url){
    $.ajax({
            //"/Afiliados/verpasaporte"
            url:url,
            type:"post",
            data:{
                  id:$('#Afiliadopasaporte').val()
                 },
            success:function(n){
              if(n!="0"){
                          alert('El pasaporte ya se encuentra registrado.');
                          $('input[type="submit"]').attr('disabled','disabled');
              }else{ 
                          $('input[type="submit"]').removeAttr('disabled');
              }
            }
    });
}

function solonumeros_con_punto(e){
   ncomas = new Array(0,0);
   tecla_codigo = (document.all) ? e.keyCode : e.which;
   //alert(tecla_codigo);
   if(tecla_codigo==8 || tecla_codigo==0 || tecla_codigo==13 || tecla_codigo==46 || tecla_codigo==45){
     if(tecla_codigo==46){
          if(document.getElementById(e.target.id).value.length==0){
              document.getElementById(e.target.id).value=document.getElementById(e.target.id).value+'0.';
          }else{
              document.getElementById(e.target.id).value=document.getElementById(e.target.id).value+'.';
          }
               document.getElementById(e.target.id).value=document.getElementById(e.target.id).value.replace("..",".");
               for (i=0; i < document.getElementById(e.target.id).value.length; i++){
                 letra = document.getElementById(e.target.id).value.charAt(i);
                 ncomas[0] = (letra==".")? ncomas[0] + 1: ncomas[0];
               }
               for(i=1;i<=ncomas[0]-1;i++){
                  document.getElementById(e.target.id).value=document.getElementById(e.target.id).value.replace(",","");
               }

               return false;
      }
      /*if(tecla_codigo==45){
         if(document.getElementById(e.target.id).value.length==0){
              document.getElementById(e.target.id).value=document.getElementById(e.target.id).value+'-';
          }else{
              document.getElementById(e.target.id).value=document.getElementById(e.target.id).value+'-';
          }
               document.getElementById(e.target.id).value=document.getElementById(e.target.id).value.replace("--","-");
               for (i=0; i < document.getElementById(e.target.id).value.length; i++){
                 letra = document.getElementById(e.target.id).value.charAt(i);
                 ncomas[1] = (letra=="-")? ncomas[1] + 1: ncomas[1];
               }
               for(i=1;i<=ncomas[1];i++){
                  document.getElementById(e.target.id).value=document.getElementById(e.target.id).value.replace("-","");
               }
               document.getElementById(e.target.id).value="-"+document.getElementById(e.target.id).value;
         return false;
     }*/
      return true;
   }
   patron =/[0-9]/;
   tecla_valor = String.fromCharCode(tecla_codigo);
   return patron.test(tecla_valor);

}//fin solo numeros con punto
function solonumeros(e){
 /**var key=tecla ? evt.which:evt.keyCode;
 return (key==13 || (key>=48 && key<=57));*/

  tecla_codigo = (document.all) ? e.keyCode : e.which;
  if(tecla_codigo==8 || tecla_codigo==0 || tecla_codigo==13)return true;
  patron =/[0-9\-]/;
  tecla_valor = String.fromCharCode(tecla_codigo);
  return patron.test(tecla_valor);
}
function manageExt(n){
    var t=".tel-"+n+"-ext";
     $(".tel-"+n).val()=="3"?$(t).removeAttr("disabled"):$(t).prop("disabled",!0)
 }
 function CambiarFechaDeMembresia(n){var t=$("#slMem option:selected").attr("data-costo");
  return $("#Afiliado_CostoMembresia").attr("value",t),$("#Afiliado_CostoMembresia").attr("text",t),$("#Afiliado_CostoMembresia").val(t),$.ajax({url:"/Afiliados/GetFechaVencimiento",type:"post",data:{id:n},success:function(n){$("#Afiliado_FechaVencimiento").val(n)}}),!1
}
function ShowTarjetasAdicionalesModal(n){
    modifyContentTarAddModal(n)
}
function openmodalempty(){
    return $("#TarjetaAdicionalModal").modal("show"),!1
}
function modifyContentTarAddModal(n){
    return $.ajax({url:"/Afiliados/CreateNewTarjetaAdicional",type:"post",data:{Tarjetas:n},success:function(n){$("#TarjetasAdicionalesContainer").html(n);$("#TarjetaAdicionalModal").modal("show")}}),!1
}
function modifyTarAddTable(n){
    var t;for($("#TarAddTable > tbody > tr").empty(),t=0;t<n;t++){var i=$("#tarjetasadicionales_"+t+"__nombre").val(),r=$("#tarjetasadicionales_"+t+"__cedula").val(),u=$("#tarjetasadicionales_"+t+"__email").val(),f=$("#tarjetasadicionales_"+t+"__telefono1").val(),e=$("#tarjetasadicionales_"+t+"__telefono2").val(),o=$("#tarjetasadicionales_"+t+"__direccion").val(),s=$("#tarjetasadicionales_"+t+"__cargo").val();$("#TarAddTable > tbody").append("<tr><td>"+i+"<\/td><td>"+r+"<\/td><td>"+f+"<\/td><td>"+e+"<\/td><td>"+u+"<\/td><td>"+o+"<\/td><\/td><td>"+s+"<\/td>")}
}
function OnlySave(){
    Prospecto={Id:$("#ProspectoID").val(),Nombres:$("#Nombres").val(),Apellido1:$("#Apellido1").val(),Apellido2:$("#Apellido2").val(),Cedula:$("#Cedula").val(),Respuesta:$("#Respuesta").val(),Fax:$("#Fax").val(),FechaDeNacimiento:$("#FechaDeNacimiento").val(),Email:$("#Email").val(),Comentario:$("#Comentario").val(),Tipo1:"CASA",Descripcion1:$("#Telefonos_0__Descripcion").val(),Extension1:$("#Telefonos_0__Extension").val(),Tipo2:"MOVIL",Descripcion2:$("#Telefonos_1__Descripcion").val(),Extension2:$("#Telefonos_1__Extension").val(),Tipo3:"OFICINA",Descripcion3:$("#Telefonos_2__Descripcion").val(),Extension3:$("#Telefonos_2__Extension").val(),Direccion1:$("#Direcciones_0__Descripcion").val(),Direccion2:$("#Direcciones_1__Descripcion").val()};$.ajax({url:"/Prospectos/SoloGuardar",type:"get",data:Prospecto,success:function(n){alert(n);location.reload()}})
}
function OpenDetailsModal(n,t){
    console.log(t);t=="O"&&$.ajax({url:"/Objeciones/GetObjecionesById",type:"get",data:{id:n},success:function(n){console.log(n);$("#ModalGenericTitle").text(n.Titulo);$("#ModalGenericBody").text(n.Descripcion);$("#ModalGeneric").modal("show")}});t=="H"&&$.ajax({url:"/HotelesDummys/GetHotelesById",type:"get",data:{id:n},success:function(n){console.log(n);$("#ModalGenericTitle").text(n.Ubicacion);$("#ModalGenericBody").text(n.Hotel);$("#ModalGeneric").modal("show")}});t=="S"&&$.ajax({url:"/ScriptDummies/GetScriptsById",type:"get",data:{id:n},success:function(n){console.log(n);$("#ModalGenericTitle").text(n.Titulo);$("#ModalGenericBody").text(n.Descripcion);$("#ModalGeneric").modal("show")}})
}
function AgregarHabitacion(){
    var n=$("#hotel-container .con-hab:last-child").data("hotel")+1;return $.ajax({url:"/Reservas/CreateNewHabitacion",type:"post",data:{Habs:n},success:function(n){$("#hotel-container").append(n);CalcularPrecio()}}),!1
}
function QuitarHabitacion(){
    $("#hotel-container .con-hab:last-child").remove();CalcularPrecio()
}
function ControlHabs(n){
    var i=$("#cant-hab").val(),t=parseInt(i);t==1&&n!="+"?alert("Debe haber al menos una habitaciÃ³n"):n=="+"?($("#cant-hab").val(t+1),AgregarHabitacion()):($("#cant-hab").val(t-1),QuitarHabitacion())
}
function RemoveHotel(n){
    $("#hotel-"+n).remove();var t=$("#cant-hab").val();return $("#cant-hab").val(t-1),!1
}
function CalcularPrecio(){
    var i=0,w=$("#hotelSGL").val(),b=$("#hotelDBL").val(),k=$("#hotelTPL").val(),d=$("#hotelCPL").val(),g=$("#hotelCHD").val(),v=$("#hotelCHDF").val(),r=$("#Dias").val(),s,h,p;r=parseInt(r);var u=0,f=0,e=0,o=0,c=0,l=0,nt=$(".con-hab").size();for(s=1;s<=nt;s++){var tt=$("#hotel-container .con-hab:nth-child("+s+")"),y=tt.data("hotel"),a=$("#hotel-container #ni"+y).val(),n=$("#hotel-container #ad"+y).val(),t=0;c=parseInt(c)+parseInt(n);l=parseInt(l)+parseInt(a);n=parseInt(n);console.log("dias: "+r);console.log("ad: "+n);n==1&&(t=parseInt(w),u=u+1);n==2&&(t=parseInt(b),f=f+1);n==3&&(t=parseInt(k),e=e+1);n==4&&(t=parseInt(d),o=o+1);t=t*n;a<=v?i=i+t*r:(h=v-a,h=h*g,i=i+t*r+h);$("#Costo").val(i);$("#CantidadAdultos").val(c);$("#CantidadNinios").val(l);p='<input value="'+u+'" class="form-control text-box single-line" id="Habitaciones_0__Cantidad" name="Habitaciones[0].Cantidad" type="text"><input value="SGL" class="form-control text-box single-line" id="Habitaciones_0__Tipo" name="Habitaciones[0].Tipo" type="text"><input value="'+f+'" class="form-control text-box single-line" id="Habitaciones_1__Cantidad" name="Habitaciones[1].Cantidad" type="text"><input value="DBL" class="form-control text-box single-line" id="Habitaciones_1__Tipo" name="Habitaciones[1].Tipo" type="text"><input value="'+e+'" class="form-control text-box single-line" id="Habitaciones_2__Cantidad" name="Habitaciones[2].Cantidad" type="text"><input value="TPL" class="form-control text-box single-line" id="Habitaciones_2__Tipo" name="Habitaciones[2].Tipo" type="text"><input value="'+o+'" class="form-control text-box single-line" id="Habitaciones_3__Cantidad" name="Habitaciones[3].Cantidad" type="text"><input value="CPL" class="form-control text-box single-line" id="Habitaciones_3__Tipo" name="Habitaciones[3].Tipo" type="text">';$("#Habs").html(p);$("#habs-table tbody").html("<tr><td>SIMPLE<\/td><td>"+u+"<\/td><tr> <tr><td>DOBLE<\/td><td>"+f+"<\/td><tr> <tr><td>TRIPLE<\/td><td>"+e+"<\/td><tr> <tr><td>CUADRUPLE<\/td><td>"+o+"<\/td><tr>")}
}
function sessionOut(){
    return $.ajax({url:"/Login/SessionOut",type:"post",success:function(){window.location.href="/login"}}),!1
}
function GenerarADM(){
    return $.ajax({url:"/Archivos/GenerarNomina",type:"post",success:function(n){window.open(n[0],"_blank");DeleteFile(n[1])}}),!1
}
function DeleteFile(n){
    return $.ajax({url:"Archivos/DeleteFile",type:"post",data:{path:n},success:window.location.reload()}),!1
}
function List607(){
    var n=[],i=$("tbody tr").length,t;i>0&&(t=0,$(".table tbody tr").each(function(){t++;var r=0,i=[];$(this).children("td").each(function(){r++;i.push($(this).text())});n.push(i)}),Generar607(n))
}
function Generar607(n){
    return $.ajax({url:"/Archivos/Reporte607",type:"post",data:{List:n},success:function(){window.open("/Archivos/loadFile","_blank")}}),!1}(function(n){function i(n,t){for(var i=window,r=(n||"").split(".");i&&r.length;)i=i[r.shift()];return typeof i=="function"?i:(t.push(n),Function.constructor.apply(null,t))
}
function u(n){
    return n==="GET"||n==="POST"
}
function o(n,t){
    u(t)||n.setRequestHeader("X-HTTP-Method-Override",t)
}
function s(t,i,r){
    var u;r.indexOf("application/x-javascript")===-1&&(u=(t.getAttribute("data-ajax-mode")||"").toUpperCase(),n(t.getAttribute("data-ajax-update")).each(function(t,r){var f;switch(u){case"BEFORE":f=r.firstChild;n("<div />").html(i).contents().each(function(){r.insertBefore(this,f)});break;case"AFTER":n("<div />").html(i).contents().each(function(){r.appendChild(this)});break;case"REPLACE-WITH":n(r).replaceWith(i);break;default:n(r).html(i)}}))
}
function f(t,r){
    var e,h,f,c;(e=t.getAttribute("data-ajax-confirm"),!e||window.confirm(e))&&(h=n(t.getAttribute("data-ajax-loading")),c=parseInt(t.getAttribute("data-ajax-loading-duration"),10)||0,n.extend(r,{type:t.getAttribute("data-ajax-method")||undefined,url:t.getAttribute("data-ajax-url")||undefined,cache:!!t.getAttribute("data-ajax-cache"),beforeSend:function(n){var r;return o(n,f),r=i(t.getAttribute("data-ajax-begin"),["xhr"]).apply(t,arguments),r!==!1&&h.show(c),r},complete:function(){h.hide(c);i(t.getAttribute("data-ajax-complete"),["xhr","status"]).apply(t,arguments)},success:function(n,r,u){s(t,n,u.getResponseHeader("Content-Type")||"text/html");i(t.getAttribute("data-ajax-success"),["data","status","xhr"]).apply(t,arguments)},error:function(){i(t.getAttribute("data-ajax-failure"),["xhr","status","error"]).apply(t,arguments)}}),r.data.push({name:"X-Requested-With",value:"XMLHttpRequest"}),f=r.type.toUpperCase(),u(f)||(r.type="POST",r.data.push({name:"X-HTTP-Method-Override",value:f})),n.ajax(r))
}
function h(t){
    var i=n(t).data(e);return!i||!i.validate||i.validate()}var t="unobtrusiveAjaxClick",r="unobtrusiveAjaxClickTarget",e="unobtrusiveValidation";n(document).on("click","a[data-ajax=true]",function(n){n.preventDefault();f(this,{url:this.href,type:"GET",data:[]})});n(document).on("click","form[data-ajax=true] input[type=image]",function(i){var r=i.target.name,u=n(i.target),f=n(u.parents("form")[0]),e=u.offset();f.data(t,[{name:r+".x",value:Math.round(i.pageX-e.left)},{name:r+".y",value:Math.round(i.pageY-e.top)}]);setTimeout(function(){f.removeData(t)},0)});n(document).on("click","form[data-ajax=true] :submit",function(i){var f=i.currentTarget.name,e=n(i.target),u=n(e.parents("form")[0]);u.data(t,f?[{name:f,value:i.currentTarget.value}]:[]);u.data(r,e);setTimeout(function(){u.removeData(t);u.removeData(r)},0)});n(document).on("submit","form[data-ajax=true]",function(i){var e=n(this).data(t)||[],u=n(this).data(r),o=u&&u.hasClass("cancel");(i.preventDefault(),o||h(this))&&f(this,{url:this.action,type:this.method||"GET",data:e.concat(n(this).serializeArray())})})})(jQuery),function(n){"function"==typeof define&&define.amd?define(["jquery"],n):"object"==typeof exports?module.exports=n(require("jquery")):n(jQuery||Zepto)}(function(n){var r=function(t,i,r){var f,e,o,u;t=n(t);f=this;e=t.val();i="function"==typeof i?i(t.val(),void 0,t,r):i;u={invalid:[],getCaret:function(){try{var n,i=0,f=t.get(0),u=document.selection,r=f.selectionStart;return u&&-1===navigator.appVersion.indexOf("MSIE 10")?(n=u.createRange(),n.moveStart("character",t.is("input")?-t.val().length:-t.text().length),i=n.text.length):(r||"0"===r)&&(i=r),i}catch(e){}},setCaret:function(n){try{if(t.is(":focus")){var i,r=t.get(0);r.setSelectionRange?r.setSelectionRange(n,n):r.createTextRange&&(i=r.createTextRange(),i.collapse(!0),i.moveEnd("character",n),i.moveStart("character",n),i.select())}}catch(u){}},events:function(){t.on("input.mask keyup.mask",u.behaviour).on("paste.mask drop.mask",function(){setTimeout(function(){t.keydown().keyup()},100)}).on("change.mask",function(){t.data("changed",!0)}).on("blur.mask",function(){e===t.val()||t.data("changed")||t.triggerHandler("change");t.data("changed",!1)}).on("blur.mask",function(){e=t.val()}).on("focus.mask",function(t){!0===r.selectOnFocus&&n(t.target).select()}).on("focusout.mask",function(){r.clearIfNotMatch&&!o.test(u.val())&&u.val("")})},getRegexMask:function(){for(var n=[],t,e,o,r,u=0;u<i.length;u++)(t=f.translation[i.charAt(u)])?(e=t.pattern.toString().replace(/.{1}$|^.{1}/g,""),o=t.optional,(t=t.recursive)?(n.push(i.charAt(u)),r={digit:i.charAt(u),pattern:e}):n.push(o||t?e+"?":e)):n.push(i.charAt(u).replace(/[-\/\\^$*+?.()|[\]{}]/g,"\\$&"));return n=n.join(""),r&&(n=n.replace(new RegExp("("+r.digit+"(.*"+r.digit+")?)"),"($1)?").replace(new RegExp(r.digit,"g"),r.pattern)),new RegExp(n)},destroyEvents:function(){t.off("input keydown keyup paste drop blur focusout ".split(" ").join(".mask "))},val:function(n){var i=t.is("input")?"val":"text";return 0<arguments.length?(t[i]()!==n&&t[i](n),i=t):i=t[i](),i},getMCharsBeforeCount:function(n,t){for(var u=0,r=0,e=i.length;r<e&&r<n;r++)f.translation[i.charAt(r)]||(n=t?n+1:n,u++);return u},caretPos:function(n,t,r,e){return f.translation[i.charAt(Math.min(n-1,i.length-1))]?Math.min(n+r-t-e,r):u.caretPos(n+1,t,r,e)},behaviour:function(t){var i;if(t=t||window.event,u.invalid=[],i=t.keyCode||t.which,-1===n.inArray(i,f.byPassKeys)){var r=u.getCaret(),e=u.val().length,h=r<e,o=u.getMasked(),s=o.length,c=u.getMCharsBeforeCount(s-1)-u.getMCharsBeforeCount(e-1);return u.val(o),!h||65===i&&t.ctrlKey||(8!==i&&46!==i&&(r=u.caretPos(r,e,s,c)),u.setCaret(r)),u.callbacks(t)}},getMasked:function(n){var h=[],k=u.val(),t=0,l=i.length,o=0,p=k.length,e=1,a="push",v=-1,c,w;for(r.reverse?(a="unshift",e=-1,c=0,t=l-1,o=p-1,w=function(){return-1<t&&-1<o}):(c=l-1,w=function(){return t<l&&o<p});w();){var b=i.charAt(t),y=k.charAt(o),s=f.translation[b];s?(y.match(s.pattern)?(h[a](y),s.recursive&&(-1===v?v=t:t===c&&(t=v-e),c===v&&(t-=e)),t+=e):s.optional?(t+=e,o-=e):s.fallback?(h[a](s.fallback),t+=e,o-=e):u.invalid.push({p:o,v:y,e:s.pattern}),o+=e):(n||h[a](b),y===b&&(o+=e),t+=e)}return n=i.charAt(c),l!==p+1||f.translation[n]||h.push(n),h.join("")},callbacks:function(n){var f=u.val(),h=f!==e,s=[f,n,t,r],o=function(n,t,i){"function"==typeof r[n]&&t&&r[n].apply(this,i)};o("onChange",!0===h,s);o("onKeyPress",!0===h,s);o("onComplete",f.length===i.length,s);o("onInvalid",0<u.invalid.length,[f,n,t,u.invalid,r])}};f.mask=i;f.options=r;f.remove=function(){var n=u.getCaret();return u.destroyEvents(),u.val(f.getCleanVal()),u.setCaret(n-u.getMCharsBeforeCount(n)),t};f.getCleanVal=function(){return u.getMasked(!0)};f.init=function(i){i=i||!1;r=r||{};f.byPassKeys=n.jMaskGlobals.byPassKeys;f.translation=n.jMaskGlobals.translation;f.translation=n.extend({},f.translation,r.translation);f=n.extend(!0,{},f,r);o=u.getRegexMask();!1===i?(r.placeholder&&t.attr("placeholder",r.placeholder),n("input").length&&!1=="oninput"in n("input")[0]&&"on"===t.attr("autocomplete")&&t.attr("autocomplete","off"),u.destroyEvents(),u.events(),i=u.getCaret(),u.val(u.getMasked()),u.setCaret(i+u.getMCharsBeforeCount(i,!0))):(u.events(),u.val(u.getMasked()))};f.init(!t.is("input"))},u,i,t;n.maskWatchers={};u=function(){var t=n(this),u={},f=t.attr("data-mask");return t.attr("data-mask-reverse")&&(u.reverse=!0),t.attr("data-mask-clearifnotmatch")&&(u.clearIfNotMatch=!0),"true"===t.attr("data-mask-selectonfocus")&&(u.selectOnFocus=!0),i(t,f,u)?t.data("mask",new r(this,f,u)):void 0};i=function(t,i,r){r=r||{};var u=n(t).data("mask"),f=JSON.stringify;t=n(t).val()||n(t).text();try{return"function"==typeof i&&(i=i(t)),"object"!=typeof u||f(u.options)!==f(r)||u.mask!==i}catch(e){}};n.fn.mask=function(t,u){u=u||{};var f=this.selector,o=n.jMaskGlobals,s=n.jMaskGlobals.watchInterval,e=function(){if(i(this,t,u))return n(this).data("mask",new r(this,t,u))};return n(this).each(e),f&&""!==f&&o.watchInputs&&(clearInterval(n.maskWatchers[f]),n.maskWatchers[f]=setInterval(function(){n(document).find(f).each(e)},s)),this};n.fn.unmask=function(){return clearInterval(n.maskWatchers[this.selector]),delete n.maskWatchers[this.selector],this.each(function(){var t=n(this).data("mask");t&&t.remove().removeData("mask")})};n.fn.cleanVal=function(){return this.data("mask").getCleanVal()};n.applyDataMask=function(t){t=t||n.jMaskGlobals.maskElements;(t instanceof n?t:n(t)).filter(n.jMaskGlobals.dataMaskAttr).each(u)};t={maskElements:"input,td,span,div",dataMaskAttr:"*[data-mask]",dataMask:!0,watchInterval:300,watchInputs:!0,watchDataMask:!1,byPassKeys:[9,16,17,18,36,37,38,39,40,91],translation:{0:{pattern:/\d/},9:{pattern:/\d/,optional:!0},"#":{pattern:/\d/,recursive:!0},A:{pattern:/[a-zA-Z0-9]/},S:{pattern:/[a-zA-Z]/}}};n.jMaskGlobals=n.jMaskGlobals||{};t=n.jMaskGlobals=n.extend(!0,{},t,n.jMaskGlobals);t.dataMask&&n.applyDataMask();setInterval(function(){n.jMaskGlobals.watchDataMask&&n.applyDataMask()},t.watchInterval)}),function(n,t){"use strict";function k(i){n("body").toggleClass(i);t.layout.fixSidebar();i=="layout-boxed"&&t.controlSidebar._fix(n(".control-sidebar-bg"));n("body").hasClass("fixed")&&i=="fixed"&&(t.pushMenu.expandOnHover(),t.layout.activate());t.controlSidebar._fix(n(".control-sidebar-bg"));t.controlSidebar._fix(n(".control-sidebar"))
}
function d(t){
    return n.each(u,function(t){n("body").removeClass(u[t])}),n("body").addClass(t),nt("skin",t),!1
}
function nt(n,t){
    typeof Storage!="undefined"?localStorage.setItem(n,t):window.alert("Please use a modern browser to properly view this template!")
}
function tt(n){
    //if(typeof Storage!="undefined")return localStorage.getItem(n);
    //window.alert("Please use a modern browser to properly view this template!")
}
function it(){
    var i=tt("skin");i&&n.inArray(i,u)&&d(i);
    n("[data-skin]").on("click",function(t){t.preventDefault();d(n(this).data("skin"))});
    n("[data-layout]").on("click",function(){k(n(this).data("layout"))});
    n("[data-controlsidebar]").on("click",function(){k(n(this).data("controlsidebar"));var i=!t.options.controlSidebarOptions.slide;t.options.controlSidebarOptions.slide=i;i||n(".control-sidebar").removeClass("control-sidebar-open")});
    n("[data-sidebarskin='toggle']").on("click",function(){var t=n(".control-sidebar");t.hasClass("control-sidebar-dark")?(t.removeClass("control-sidebar-dark"),t.addClass("control-sidebar-light")):(t.removeClass("control-sidebar-light"),t.addClass("control-sidebar-dark"))});
    n("[data-enable='expandOnHover']").on("click",function(){n(this).attr("disabled",!0);t.pushMenu.expandOnHover();n("body").hasClass("sidebar-collapse")||n("[data-layout='sidebar-collapse']").click()});n("body").hasClass("fixed")&&n("[data-layout='fixed']").attr("checked","checked");n("body").hasClass("layout-boxed")&&n("[data-layout='layout-boxed']").attr("checked","checked");n("body").hasClass("sidebar-collapse")&&n("[data-layout='sidebar-collapse']").attr("checked","checked")}var u=["skin-blue","skin-black","skin-red","skin-yellow","skin-purple","skin-green","skin-blue-light","skin-black-light","skin-red-light","skin-yellow-light","skin-purple-light","skin-green-light"],f=n("<div />",{id:"control-sidebar-theme-demo-options-tab","class":"tab-pane active"}),g=n("<li />",{"class":"active"}).html("<a href='#control-sidebar-theme-demo-options-tab' data-toggle='tab'><i class='fa fa-wrench'><\/i><\/a>"),r,i,e,o,s,h,c,l,a,v,y,p,w,b;n("[href='#control-sidebar-home-tab']").parent().before(g);r=n("<div />");r.append("<h4 class='control-sidebar-heading'>Layout Options<\/h4><div class='form-group'><label class='control-sidebar-subheading'><input type='checkbox' data-layout='fixed' class='pull-right'/> Fixed layout<\/label><p>Activate the fixed layout. You can't use fixed and boxed layouts together<\/p><\/div><div class='form-group'><label class='control-sidebar-subheading'><input type='checkbox' data-layout='layout-boxed'class='pull-right'/> Boxed Layout<\/label><p>Activate the boxed layout<\/p><\/div><div class='form-group'><label class='control-sidebar-subheading'><input type='checkbox' data-layout='sidebar-collapse' class='pull-right'/> Toggle Sidebar<\/label><p>Toggle the left sidebar's state (open or collapse)<\/p><\/div><div class='form-group'><label class='control-sidebar-subheading'><input type='checkbox' data-enable='expandOnHover' class='pull-right'/> Sidebar Expand on Hover<\/label><p>Let the sidebar mini expand on hover<\/p><\/div><div class='form-group'><label class='control-sidebar-subheading'><input type='checkbox' data-controlsidebar='control-sidebar-open' class='pull-right'/> Toggle Right Sidebar Slide<\/label><p>Toggle between slide over content and push content effects<\/p><\/div><div class='form-group'><label class='control-sidebar-subheading'><input type='checkbox' data-sidebarskin='toggle' class='pull-right'/> Toggle Right Sidebar Skin<\/label><p>Toggle between dark and light skins for the right sidebar<\/p><\/div>");i=n("<ul />",{"class":"list-unstyled clearfix"});e=n("<li />",{style:"float:left; width: 33.33333%; padding: 5px;"}).append("<a href='javascript:void(0);' data-skin='skin-blue' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'><div><span style='display:block; width: 20%; float: left; height: 7px; background: #367fa9;'><\/span><span class='bg-light-blue' style='display:block; width: 80%; float: left; height: 7px;'><\/span><\/div><div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'><\/span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'><\/span><\/div><\/a><p class='text-center no-margin'>Blue<\/p>");i.append(e);o=n("<li />",{style:"float:left; width: 33.33333%; padding: 5px;"}).append("<a href='javascript:void(0);' data-skin='skin-black' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'><div style='box-shadow: 0 0 2px rgba(0,0,0,0.1)' class='clearfix'><span style='display:block; width: 20%; float: left; height: 7px; background: #fefefe;'><\/span><span style='display:block; width: 80%; float: left; height: 7px; background: #fefefe;'><\/span><\/div><div><span style='display:block; width: 20%; float: left; height: 20px; background: #222;'><\/span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'><\/span><\/div><\/a><p class='text-center no-margin'>Black<\/p>");i.append(o);s=n("<li />",{style:"float:left; width: 33.33333%; padding: 5px;"}).append("<a href='javascript:void(0);' data-skin='skin-purple' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'><div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-purple-active'><\/span><span class='bg-purple' style='display:block; width: 80%; float: left; height: 7px;'><\/span><\/div><div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'><\/span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'><\/span><\/div><\/a><p class='text-center no-margin'>Purple<\/p>");i.append(s);h=n("<li />",{style:"float:left; width: 33.33333%; padding: 5px;"}).append("<a href='javascript:void(0);' data-skin='skin-green' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'><div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-green-active'><\/span><span class='bg-green' style='display:block; width: 80%; float: left; height: 7px;'><\/span><\/div><div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'><\/span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'><\/span><\/div><\/a><p class='text-center no-margin'>Green<\/p>");i.append(h);c=n("<li />",{style:"float:left; width: 33.33333%; padding: 5px;"}).append("<a href='javascript:void(0);' data-skin='skin-red' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'><div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-red-active'><\/span><span class='bg-red' style='display:block; width: 80%; float: left; height: 7px;'><\/span><\/div><div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'><\/span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'><\/span><\/div><\/a><p class='text-center no-margin'>Red<\/p>");i.append(c);l=n("<li />",{style:"float:left; width: 33.33333%; padding: 5px;"}).append("<a href='javascript:void(0);' data-skin='skin-yellow' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'><div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-yellow-active'><\/span><span class='bg-yellow' style='display:block; width: 80%; float: left; height: 7px;'><\/span><\/div><div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'><\/span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'><\/span><\/div><\/a><p class='text-center no-margin'>Yellow<\/p>");i.append(l);a=n("<li />",{style:"float:left; width: 33.33333%; padding: 5px;"}).append("<a href='javascript:void(0);' data-skin='skin-blue-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'><div><span style='display:block; width: 20%; float: left; height: 7px; background: #367fa9;'><\/span><span class='bg-light-blue' style='display:block; width: 80%; float: left; height: 7px;'><\/span><\/div><div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'><\/span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'><\/span><\/div><\/a><p class='text-center no-margin' style='font-size: 12px'>Blue Light<\/p>");i.append(a);v=n("<li />",{style:"float:left; width: 33.33333%; padding: 5px;"}).append("<a href='javascript:void(0);' data-skin='skin-black-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'><div style='box-shadow: 0 0 2px rgba(0,0,0,0.1)' class='clearfix'><span style='display:block; width: 20%; float: left; height: 7px; background: #fefefe;'><\/span><span style='display:block; width: 80%; float: left; height: 7px; background: #fefefe;'><\/span><\/div><div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'><\/span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'><\/span><\/div><\/a><p class='text-center no-margin' style='font-size: 12px'>Black Light<\/p>");i.append(v);y=n("<li />",{style:"float:left; width: 33.33333%; padding: 5px;"}).append("<a href='javascript:void(0);' data-skin='skin-purple-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'><div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-purple-active'><\/span><span class='bg-purple' style='display:block; width: 80%; float: left; height: 7px;'><\/span><\/div><div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'><\/span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'><\/span><\/div><\/a><p class='text-center no-margin' style='font-size: 12px'>Purple Light<\/p>");i.append(y);p=n("<li />",{style:"float:left; width: 33.33333%; padding: 5px;"}).append("<a href='javascript:void(0);' data-skin='skin-green-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'><div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-green-active'><\/span><span class='bg-green' style='display:block; width: 80%; float: left; height: 7px;'><\/span><\/div><div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'><\/span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'><\/span><\/div><\/a><p class='text-center no-margin' style='font-size: 12px'>Green Light<\/p>");i.append(p);w=n("<li />",{style:"float:left; width: 33.33333%; padding: 5px;"}).append("<a href='javascript:void(0);' data-skin='skin-red-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'><div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-red-active'><\/span><span class='bg-red' style='display:block; width: 80%; float: left; height: 7px;'><\/span><\/div><div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'><\/span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'><\/span><\/div><\/a><p class='text-center no-margin' style='font-size: 12px'>Red Light<\/p>");i.append(w);b=n("<li />",{style:"float:left; width: 33.33333%; padding: 5px;"}).append("<a href='javascript:void(0);' data-skin='skin-yellow-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'><div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-yellow-active'><\/span><span class='bg-yellow' style='display:block; width: 80%; float: left; height: 7px;'><\/span><\/div><div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'><\/span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'><\/span><\/div><\/a><p class='text-center no-margin' style='font-size: 12px;'>Yellow Light<\/p>");i.append(b);r.append("<h4 class='control-sidebar-heading'>Skins<\/h4>");r.append(i);f.append(r);n("#control-sidebar-home-tab").after(f);it()}(jQuery,$.AdminLTE);$(function(){var n=new Date,t=n.getMonth()+1,i=n.getDate(),r=n.getFullYear();$(".datepicker").datetimepicker({viewMode:"days",format:"dd-MM-yyyy"});$(".datepickerinput").val(i+"-"+t+"-"+r);
        
    });


    $(document).ready(function(){
        $("#dwReport").click();
        $(".open-bar").addClass("hide");
        $("#sessionOut").on("click",function(){sessionOut()});
        $(".hide-tar").click(function(n){n.preventDefault();
        var t=this.id;
        return $("#Tarjetas_"+t+"__NumeroTarjeta").val(""),$("#tarjeta_"+t).hide(),$("#Tarjetas_"+t+"__NumeroTarjeta").removeAttr("required"),!1});
        $("#AcceptMonth").on("click",function(){
            var n=$("#autoriza_pass").val(),t=$("#autoriza_user").val();
            return $.ajax({
                url:"/Afiliados/GetSpecialsPermissions",
                type:"post",
                data:{User:t,Password:n,Tipo:"Meses"},
                success:function(n){
                if(n==!0){
                    var t=$("#autoriza_cant").val();
                    $("#Afiliado_MesAdicionalCan").val(t);
                    $("#Afiliado_MesAdicionalCan[type='number']").prop("max",t);
                    $("#myModal").modal("hide")
                }else alert("Estimado usuario a ocurrido un error, por favor intente de nuevo. Si el error persiste quizas se deba a que usted no tiene suficientes permisos."),$("#myModal").modal("hide")}}),!1});
        $("#TarAddModalOkBtn").on("click",function(){
            var n=$("#autoriza_passTar").val(),
                t=$("#autoriza_userTar").val(),
                i=$("#tarjetasadicionales_0__nombre").val(),
                r=$("#tarjetasadicionales_0__cedula").val(),
                u=$("#tarjetasadicionales_0__email").val(),
                f=$("#tarjetasadicionales_0__telefono1").val();
                return i==""||r==""||u==""||f==""?alert("Por favor complete los campos."):$.ajax({
                url:"/Afiliados/GetSpecialsPermissions",
                type:"post",
                data:{User:t,Password:n,Tipo:"TARJETAS"},
                success:function(n){
                    if(console.log(n),n==!0){
                        var t=$("#TarjetasAdicionales-Container").size();
                        t>0?(modifyTarAddTable(t),$("#Afiliado_TarjetaAdicionalCan[type='number']").prop("max",t),$("#TarjetaAdicionalModal").modal("hide")):(alert("No hay tarjetas adicionales que guardar"),
                        $("#TarjetaAdicionalModal").modal("hide"))
                    }else alert("Estimado usuario a ocurrido un error, por favor intente de nuevo. Si el error persiste quizas se deba a que usted no tiene suficientes permisos."),$("#TarjetaAdicionalModal").modal("hide");$("#autoriza_passTar").val("");$("#autoriza_userTar").val("")}}),!1})});
    $(document).ready(function(){
        $(".tarjeta").mask("00/00",{placeholder:"MM/YY"});
        $(".id-mask").mask("0000 - 0000",{placeholder:"1234 - 5678"});
        $(".id-mask2").mask("0000-0000-0000-0000",{placeholder:"1234-5678-9123-1234"});
        $(".cedula-mask").mask("000-0000000-0",{placeholder:"___ - _______ - _"});
        $(".cedula-maskA").mask("000-0000000-0",{placeholder:"Cedula"});
        $(".telefono-mask").mask("000-000-0000",{placeholder:"___ - ___ - ____"});
        $(".telefono-maskA1").mask("000-000-0000",{placeholder:"Telefono 1"});
        $(".telefono-maskA2").mask("000-000-0000",{placeholder:"Telefono 2"});
        $(".tarjeta-mask").mask("0000-0000-0000-0000",{placeholder:"____ - ____ - ____ - ____"});
        $(".rnc-mask").mask("000-000-000",{placeholder:"___ - ___ - ___"});
        $(".rnc-emp-mask").mask("000-00000-0",{placeholder:"___ - ___ - ___"});
        $(".pasaporte-mask").mask("SS-0000000",{translation:{S:{pattern:/[A-Z]/}},placeholder:"AA - 0000000"})});
    $(document).ready(function(){function t(){$("#Afi-ID").val($.trim($(".datatableSA tbody .selected td:eq(4)").text()));$("#Afi-IDa").val($.trim($(".datatableSA tbody .selected td:eq(0)").text()));$("#Afi-Name").val($.trim($(".datatableSA tbody .selected td:eq(1)").text()));$("#Afi-Ced").val($.trim($(".datatableSA tbody .selected td:eq(2)").text()));$("#Afi-Mem").val($.trim($(".datatableSA tbody .selected td:eq(3)").text()));var n=$.trim($(".datatableSA tbody .selected td:eq(4)").text());i(n)
}
function i(n){
    return $("#TarjetaUsuario_TarjetaUsuarioID").empty(),$.ajax({url:"/Pagos/GetTarjetaUsuario",type:"post",data:{id:n},success:function(n){$.each(n,function(n,t){$("#TarjetaUsuario_TarjetaUsuarioID").append('<option value = "'+t.TarjetaUsuarioID+'">'+t.Banco+" "+t.Tipo+" "+t.NumeroTarjeta+"<\/option>")})}}),!1}$(".datatableUI").DataTable({columnDefs:[{targets:[0],orderData:[0,1]},{targets:[1],orderData:[1,0]},{targets:[4],orderData:[4,0]}],responsive:!0});$(".datatableUI2").DataTable({responsive:!0});var n=$(".datatableSA").DataTable({responsive:!0,bLengthChange:!1,language:{search:"Buscar Afiliado:"},pageLength:4,pagingType:"simple"});
    $(".datatableSA tbody").on("click","tr",function(){$(this).hasClass("selected")?$(this).removeClass("selected"):(n.$("tr.selected").removeClass("selected"),$(this).addClass("selected"),t())})});$(document).ready(function(){$("input").keypress(function(n){if(n.which==13){n.preventDefault();var t=$("form input");$(this).is(t.last())?$("form").submit():t.eq(t.index(this)+1).focus()}});$(".txtmesadd").prop("disabled",!0);$(".txttaradd").prop("disabled",!0);$(".top-special-span").hide();$("#Afiliado_MesesAdicionales").change(function(){$(this).is(":checked")?($(".txtmesadd").prop("disabled",!1),$(".mes-permission-btn").show()):($(".txtmesadd").prop("disabled",!0),$(".mes-permission-btn").hide(),$(".txtmesadd").val("0"))});$("#Afiliado_TarjetaAdicional").change(function(){$(this).is(":checked")?($(".txttaradd").prop("disabled",!1),$(".tar-permission-btn").show()):($(".txttaradd").prop("disabled",!0),$(".tar-permission-btn").hide(),$(".txttaradd").val("0"))});$("#TarAddModalCloseBtn").click(function(){$("#TarjetasAdicionalesContainer").empty();$("#TarjetaAdicionalModal").modal("hide")})});$(document).ready(function(){function n(n,t){module=$("#"+t);var i=$("#"+t+"-chkC").is(":checked")?"1":"0",r=$("#"+t+"-chkR").is(":checked")?"1":"0",u=$("#"+t+"-chkU").is(":checked")?"1":"0",f=$("#"+t+"-chkD").is(":checked")?"1":"0",e=$("#"+t+"-chkRE").is(":checked")?"1":"0",o=$("#"+t+"-chkCI").is(":checked")?"1":"0";module.val(i+r+u+f+e+o)}$('.chkPermisos[data-checked="true"]').prop("checked",!0);$(".chkPermisos").change(function(){var t=$(this).data("group"),i=$(this).data("module");n(t,i)})});$(document).ready(function(){$(".aplicar-certificado").change(function(){$(this).is(":checked")?$(".certificado").prop("disabled",!1):$(".certificado").prop("disabled",!0)});$("input:text").keyup(function(){/*this.value=this.value.toUpperCase()*/});$("#ni1, #ad1, #hab-more, #hab-less, .reserva-body > div > div > div > input").attr("disabled",!0);$(".spinners").on("change",function(){var n=$(this).data("hab"),t=$(this).val(),i=$(this).data("type");i=="a"&&(t==1&&($("#ni"+n).attr("max",0),$("#ni"+n).attr("min",0)),t>1&&$("#ni"+n).attr("max",4-t));i=="n"&&(t==2&&($("#ad"+n).attr("min",2),$("#ad"+n).attr("max",2)),t==1&&($("#ad"+n).attr("min",2),$("#ad"+n).attr("max",3)),t==0&&($("#ad"+n).attr("min",0),$("#ad"+n).attr("max",4)));CalcularPrecio()});$('.spinners[type="number"]').keyup(function(){$(this).val()>$(this).attr("max")&&($(this).value=$(this).attr("max"),$(this).val($(this).attr("max")))});$("#cant-hab").change(function(){CalcularPrecio()});$("#Dias").change(function(){var n=$("#Dias").val();n>0?($("#pHabc").removeClass("hide"),$("#hotel-1").removeClass("hide"),$("#ni1, #ad1, #hab-more, #hab-less, .box-body > div > div > div > input").attr("disabled",!1)):($("#ni1, #ad1, #hab-more, #hab-less, .box-body > div > div > div > input").attr("disabled",!0),$("#pHabc").addClass("hide"),$("#hotel-1").addClass("hide"),$(this).attr("disabled",!1));CalcularPrecio()});$(".hotelAjax").change(function(){var n=$(".hotelAjax").val();return n!=0&&$("#Dias").attr("disabled",!1),n==0?($("#hotelSGL").val(""),$("#hotelDBL").val(""),$("#hotelTPL").val(""),$("#hotelCPL").val(""),$("#hotelCHD").val(""),$("#hotelCHDF").val(""),$("#collapse-price").click()):$.ajax({url:"/Hoteles/GetHotelById",type:"post",data:{id:n},success:function(n){if($("#hotelSGL").val(n.Simple),$("#hotelDBL").val(n.Doble),$("#hotelTPL").val(n.Triple),$("#hotelCPL").val(n.Cuadruple),$("#hotelCHD").val(n.Ninio),$("#hotelCHDF").val(n.NinioGratis),$("#box-price-hot").hasClass("collapsed-box"))CalcularPrecio(),$("#collapse-price").click();else return!1}}),!1});$(".calc-hab").click(function(){var n=$(this).data("type");return ControlHabs(n),!1})});$(document).ready(function(){$(".certificado-tipo").change(function(){$(".certificado-tipo").val()=="PORCENTAJE"?($(".certificado-cantidad").attr("readonly","readonly"),$(".certificado-descuento").removeAttr("readonly")):($(".certificado-cantidad").removeAttr("readonly"),$(".certificado-descuento").attr("readonly","readonly"))});$("#id-helper").focusout(function(){var n=$(this).val().replace(" - ","");$("#Afiliado_AfiliadoIndice").val(n)})});$(".datepicker").on("changeDate",function(){alert("Hey")});(function(n){function a(n){return n.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g,"\\$&")
}
function r(n,t,i){
    return t<n.length?n:Array(t-n.length+1).join(i||" ")+n
}
function y(n,i,r,u,f,o){
    return i&&r?'<div class="bootstrap-datetimepicker-widget dropdown-menu"><ul><li'+(o?' class="collapse in"':"")+'><div class="datepicker">'+t.template+'<\/div><\/li><li class="picker-switch accordion-toggle"><a><i class="'+n+'"><\/i><\/a><\/li><li'+(o?' class="collapse"':"")+'><div class="timepicker">'+e.getTemplate(u,f)+"<\/div><\/li><\/ul><\/div>":r?'<div class="bootstrap-datetimepicker-widget dropdown-menu"><div class="timepicker">'+e.getTemplate(u,f)+"<\/div><\/div>":'<div class="bootstrap-datetimepicker-widget dropdown-menu"><div class="datepicker">'+t.template+"<\/div><\/div>"
}
function i(){
    return new Date(Date.UTC.apply(Date,arguments))
}
var p=window.orientation!=undefined,o=function(n,t){this.id=v++;this.init(n,t)},w=function(n){return typeof n=="string"?new Date(n):n},h,c,l,t,e;o.prototype={constructor:o,init:function(t,i){var r;if(!(i.pickTime||i.pickDate))throw new Error("Must choose at least one picker");if(this.options=i,this.$element=n(t),this.language=i.language in s?i.language:"en",this.pickDate=i.pickDate,this.pickTime=i.pickTime,this.isInput=this.$element.is("input"),this.component=!1,(this.$element.find(".input-append")||this.$element.find(".input-prepend"))&&(this.component=this.$element.find(".add-on")),this.format=i.format,this.format||(this.format=this.isInput?this.$element.data("format"):this.$element.find("input").data("format"),this.format||(this.format="MM/dd/yyyy")),this._compileFormat(),this.component&&(r=this.component.find("i")),this.pickTime&&(r&&r.length&&(this.timeIcon=r.data("time-icon")),this.timeIcon||(this.timeIcon="icon-time"),r.addClass(this.timeIcon)),this.pickDate&&(r&&r.length&&(this.dateIcon=r.data("date-icon")),this.dateIcon||(this.dateIcon="icon-calendar"),r.removeClass(this.timeIcon),r.addClass(this.dateIcon)),this.widget=n(y(this.timeIcon,i.pickDate,i.pickTime,i.pick12HourFormat,i.pickSeconds,i.collapse)).appendTo("body"),this.minViewMode=i.minViewMode||this.$element.data("date-minviewmode")||0,typeof this.minViewMode=="string")switch(this.minViewMode){case"months":this.minViewMode=1;break;case"years":this.minViewMode=2;break;default:this.minViewMode=0}if(this.viewMode=i.viewMode||this.$element.data("date-viewmode")||0,typeof this.viewMode=="string")switch(this.viewMode){case"months":this.viewMode=1;break;case"years":this.viewMode=2;break;default:this.viewMode=0}this.startViewMode=this.viewMode;this.weekStart=i.weekStart||this.$element.data("date-weekstart")||0;this.weekEnd=this.weekStart===0?6:this.weekStart-1;this.setStartDate(i.startDate||this.$element.data("date-startdate"));this.setEndDate(i.endDate||this.$element.data("date-enddate"));this.fillDow();this.fillMonths();this.fillHours();this.fillMinutes();this.fillSeconds();this.update();this.showMode();this._attachDatePickerEvents()},show:function(n){this.widget.show();this.height=this.component?this.component.outerHeight():this.$element.outerHeight();this.place();this.$element.trigger({type:"show",date:this._date});this._attachDatePickerGlobalEvents();n&&(n.stopPropagation(),n.preventDefault())},disable:function(){this.$element.find("input").prop("disabled",!0);this._detachDatePickerEvents()},enable:function(){this.$element.find("input").prop("disabled",!1);this._attachDatePickerEvents()},hide:function(){for(var i=this.widget.find(".collapse"),t,n=0;n<i.length;n++)if(t=i.eq(n).data("collapse"),t&&t.transitioning)return;this.widget.hide();this.viewMode=this.startViewMode;this.showMode();this.set();this.$element.trigger({type:"hide",date:this._date});this._detachDatePickerGlobalEvents()},set:function(){var n="",t;this._unset||(n=this.formatDate(this._date));this.isInput?(this.$element.val(n),this._resetMaskPos(this.$element)):(this.component&&(t=this.$element.find("input"),t.val(n),this._resetMaskPos(t)),this.$element.data("date",n))},setValue:function(n){this._unset=n?!1:!0;typeof n=="string"?this._date=this.parseDate(n):n&&(this._date=new Date(n));this.set();this.viewDate=i(this._date.getUTCFullYear(),this._date.getUTCMonth(),1,0,0,0,0);this.fillDate();this.fillTime()},getDate:function(){return this._unset?null:new Date(this._date.valueOf())},setDate:function(n){n?this.setValue(n.valueOf()):this.setValue(null)},setStartDate:function(n){n instanceof Date?this.startDate=n:typeof n=="string"?(this.startDate=new i(n),this.startDate.getUTCFullYear()||(this.startDate=-Infinity)):this.startDate=-Infinity;this.viewDate&&this.update()},setEndDate:function(n){n instanceof Date?this.endDate=n:typeof n=="string"?(this.endDate=new i(n),this.endDate.getUTCFullYear()||(this.endDate=Infinity)):this.endDate=Infinity;this.viewDate&&this.update()},getLocalDate:function(){if(this._unset)return null;var n=this._date;return new Date(n.getUTCFullYear(),n.getUTCMonth(),n.getUTCDate(),n.getUTCHours(),n.getUTCMinutes(),n.getUTCSeconds(),n.getUTCMilliseconds())},setLocalDate:function(n){n?this.setValue(Date.UTC(n.getFullYear(),n.getMonth(),n.getDate(),n.getHours(),n.getMinutes(),n.getSeconds(),n.getMilliseconds())):this.setValue(null)},place:function(){var r="absolute",t=this.component?this.component.offset():this.$element.offset(),i;this.width=this.component?this.component.outerWidth():this.$element.outerWidth();t.top=t.top+this.height;i=n(window);this.options.width!=undefined&&this.widget.width(this.options.width);this.options.orientation=="left"&&(this.widget.addClass("left-oriented"),t.left=t.left-this.widget.width()+20);this._isInFixed()&&(r="fixed",t.top-=i.scrollTop(),t.left-=i.scrollLeft());i.width()<t.left+this.widget.outerWidth()?(t.right=i.width()-t.left-this.width,t.left="auto",this.widget.addClass("pull-right")):(t.right="auto",this.widget.removeClass("pull-right"));this.widget.css({position:r,top:t.top,left:t.left,right:t.right})},notifyChange:function(){this.$element.trigger({type:"changeDate",date:this.getDate(),localDate:this.getLocalDate()})},update:function(n){var r=n,t;r||(r=this.isInput?this.$element.val():this.$element.find("input").val(),r&&(this._date=this.parseDate(r)),this._date||(t=new Date,this._date=i(t.getFullYear(),t.getMonth(),t.getDate(),t.getHours(),t.getMinutes(),t.getSeconds(),t.getMilliseconds())));this.viewDate=i(this._date.getUTCFullYear(),this._date.getUTCMonth(),1,0,0,0,0);this.fillDate();this.fillTime()},fillDow:function(){for(var t=this.weekStart,i=n("<tr>");t<this.weekStart+7;)i.append('<th class="dow">'+s[this.language].daysMin[t++%7]+"<\/th>");this.widget.find(".datepicker-days thead").append(i)},fillMonths:function(){for(var n="",t=0;t<12;)n+='<span class="month">'+s[this.language].monthsShort[t++]+"<\/span>";this.widget.find(".datepicker-months td").append(n)},fillDate:function(){var r=this.viewDate.getUTCFullYear(),c=this.viewDate.getUTCMonth(),g=i(this._date.getUTCFullYear(),this._date.getUTCMonth(),this._date.getUTCDate(),0,0,0,0),e=typeof this.startDate=="object"?this.startDate.getUTCFullYear():-Infinity,b=typeof this.startDate=="object"?this.startDate.getUTCMonth():-1,o=typeof this.endDate=="object"?this.endDate.getUTCFullYear():Infinity,k=typeof this.endDate=="object"?this.endDate.getUTCMonth():12,u,p,l,a,w,h,v,y,d,f;for(this.widget.find(".datepicker-days").find(".disabled").removeClass("disabled"),this.widget.find(".datepicker-months").find(".disabled").removeClass("disabled"),this.widget.find(".datepicker-years").find(".disabled").removeClass("disabled"),this.widget.find(".datepicker-days th:eq(1)").text(s[this.language].months[c]+" "+r),u=i(r,c-1,28,0,0,0,0),p=t.getDaysInMonth(u.getUTCFullYear(),u.getUTCMonth()),u.setUTCDate(p),u.setUTCDate(p-(u.getUTCDay()-this.weekStart+7)%7),(r==e&&c<=b||r<e)&&this.widget.find(".datepicker-days th:eq(0)").addClass("disabled"),(r==o&&c>=k||r>o)&&this.widget.find(".datepicker-days th:eq(2)").addClass("disabled"),l=new Date(u.valueOf()),l.setUTCDate(l.getUTCDate()+42),l=l.valueOf(),a=[];u.valueOf()<l;)u.getUTCDay()===this.weekStart&&(w=n("<tr>"),a.push(w)),h="",u.getUTCFullYear()<r||u.getUTCFullYear()==r&&u.getUTCMonth()<c?h+=" old":(u.getUTCFullYear()>r||u.getUTCFullYear()==r&&u.getUTCMonth()>c)&&(h+=" new"),u.valueOf()===g.valueOf()&&(h+=" active"),u.valueOf()+864e5<=this.startDate&&(h+=" disabled"),u.valueOf()>this.endDate&&(h+=" disabled"),w.append('<td class="day'+h+'">'+u.getUTCDate()+"<\/td>"),u.setUTCDate(u.getUTCDate()+1);for(this.widget.find(".datepicker-days tbody").empty().append(a),v=this._date.getUTCFullYear(),y=this.widget.find(".datepicker-months").find("th:eq(1)").text(r).end().find("span").removeClass("active"),v===r&&y.eq(this._date.getUTCMonth()).addClass("active"),v-1<e&&this.widget.find(".datepicker-months th:eq(0)").addClass("disabled"),v+1>o&&this.widget.find(".datepicker-months th:eq(2)").addClass("disabled"),f=0;f<12;f++)r==e&&b>f||r<e?n(y[f]).addClass("disabled"):(r==o&&k<f||r>o)&&n(y[f]).addClass("disabled");for(a="",r=parseInt(r/10,10)*10,d=this.widget.find(".datepicker-years").find("th:eq(1)").text(r+"-"+(r+9)).end().find("td"),this.widget.find(".datepicker-years").find("th").removeClass("disabled"),e>r&&this.widget.find(".datepicker-years").find("th:eq(0)").addClass("disabled"),o<r+9&&this.widget.find(".datepicker-years").find("th:eq(2)").addClass("disabled"),r-=1,f=-1;f<11;f++)a+='<span class="year'+(f===-1||f===10?" old":"")+(v===r?" active":"")+(r<e||r>o?" disabled":"")+'">'+r+"<\/span>",r+=1;d.html(a)},fillHours:function(){var e=this.widget.find(".timepicker .timepicker-hours table"),n,t,i,u,f;if(e.parent().hide(),n="",this.options.pick12HourFormat)for(t=1,i=0;i<3;i+=1){for(n+="<tr>",u=0;u<4;u+=1)f=t.toString(),n+='<td class="hour">'+r(f,2,"0")+"<\/td>",t++;n+="<\/tr>"}else for(t=0,i=0;i<6;i+=1){for(n+="<tr>",u=0;u<4;u+=1)f=t.toString(),n+='<td class="hour">'+r(f,2,"0")+"<\/td>",t++;n+="<\/tr>"}e.html(n)},fillMinutes:function(){var f=this.widget.find(".timepicker .timepicker-minutes table"),n,t,i,u,e;for(f.parent().hide(),n="",t=0,i=0;i<5;i++){for(n+="<tr>",u=0;u<4;u+=1)e=t.toString(),n+='<td class="minute">'+r(e,2,"0")+"<\/td>",t+=3;n+="<\/tr>"}f.html(n)},fillSeconds:function(){var f=this.widget.find(".timepicker .timepicker-seconds table"),n,t,i,u,e;for(f.parent().hide(),n="",t=0,i=0;i<5;i++){for(n+="<tr>",u=0;u<4;u+=1)e=t.toString(),n+='<td class="second">'+r(e,2,"0")+"<\/td>",t+=3;n+="<\/tr>"}f.html(n)},fillTime:function(){var u,f;if(this._date){var t=this.widget.find(".timepicker span[data-time-component]"),o=t.closest("table"),e=this.options.pick12HourFormat,n=this._date.getUTCHours(),i="AM";e&&(n>=12&&(i="PM"),n===0?n=12:n!=12&&(n=n%12),this.widget.find(".timepicker [data-action=togglePeriod]").text(i));n=r(n.toString(),2,"0");u=r(this._date.getUTCMinutes().toString(),2,"0");f=r(this._date.getUTCSeconds().toString(),2,"0");t.filter("[data-time-component=hours]").text(n);t.filter("[data-time-component=minutes]").text(u);t.filter("[data-time-component=seconds]").text(f)}},click:function(r){var u,f,e;if(r.stopPropagation(),r.preventDefault(),this._unset=!1,u=n(r.target).closest("span, td, th"),u.length===1&&!u.is(".disabled"))switch(u[0].nodeName.toLowerCase()){case"th":switch(u[0].className){case"switch":this.showMode(1);break;case"prev":case"next":var s=this.viewDate,h=t.modes[this.viewMode].navFnc,o=t.modes[this.viewMode].navStep;u[0].className==="prev"&&(o=o*-1);s["set"+h](s["get"+h]()+o);this.fillDate();this.set()}break;case"span":u.is(".month")?(f=u.parent().find("span").index(u),this.viewDate.setUTCMonth(f)):(e=parseInt(u.text(),10)||0,this.viewDate.setUTCFullYear(e));this.viewMode!==0&&(this._date=i(this.viewDate.getUTCFullYear(),this.viewDate.getUTCMonth(),this.viewDate.getUTCDate(),this._date.getUTCHours(),this._date.getUTCMinutes(),this._date.getUTCSeconds(),this._date.getUTCMilliseconds()),this.notifyChange());this.showMode(-1);this.fillDate();this.set();break;case"td":if(u.is(".day")){var c=parseInt(u.text(),10)||1,f=this.viewDate.getUTCMonth(),e=this.viewDate.getUTCFullYear();u.is(".old")?f===0?(f=11,e-=1):f-=1:u.is(".new")&&(f==11?(f=0,e+=1):f+=1);this._date=i(e,f,c,this._date.getUTCHours(),this._date.getUTCMinutes(),this._date.getUTCSeconds(),this._date.getUTCMilliseconds());this.viewDate=i(e,f,Math.min(28,c),0,0,0,0);this.fillDate();this.set();this.notifyChange()}}},actions:{incrementHours:function(){this._date.setUTCHours(this._date.getUTCHours()+1)},incrementMinutes:function(){this._date.setUTCMinutes(this._date.getUTCMinutes()+1)},incrementSeconds:function(){this._date.setUTCSeconds(this._date.getUTCSeconds()+1)},decrementHours:function(){this._date.setUTCHours(this._date.getUTCHours()-1)},decrementMinutes:function(){this._date.setUTCMinutes(this._date.getUTCMinutes()-1)},decrementSeconds:function(){this._date.setUTCSeconds(this._date.getUTCSeconds()-1)},togglePeriod:function(){var n=this._date.getUTCHours();n>=12?n-=12:n+=12;this._date.setUTCHours(n)},showPicker:function(){this.widget.find(".timepicker > div:not(.timepicker-picker)").hide();this.widget.find(".timepicker .timepicker-picker").show()},showHours:function(){this.widget.find(".timepicker .timepicker-picker").hide();this.widget.find(".timepicker .timepicker-hours").show()},showMinutes:function(){this.widget.find(".timepicker .timepicker-picker").hide();this.widget.find(".timepicker .timepicker-minutes").show()},showSeconds:function(){this.widget.find(".timepicker .timepicker-picker").hide();this.widget.find(".timepicker .timepicker-seconds").show()},selectHour:function(t){var u=n(t.target),i=parseInt(u.text(),10),r;this.options.pick12HourFormat&&(r=this._date.getUTCHours(),r>=12?i!=12&&(i=(i+12)%24):i=i===12?0:i%12);this._date.setUTCHours(i);this.actions.showPicker.call(this)},selectMinute:function(t){var i=n(t.target),r=parseInt(i.text(),10);this._date.setUTCMinutes(r);this.actions.showPicker.call(this)},selectSecond:function(t){var i=n(t.target),r=parseInt(i.text(),10);this._date.setUTCSeconds(r);this.actions.showPicker.call(this)}},doAction:function(t){t.stopPropagation();t.preventDefault();this._date||(this._date=i(1970,0,0,0,0,0,0));var r=n(t.currentTarget).data("action"),u=this.actions[r].apply(this,arguments);return this.set(),this.fillTime(),this.notifyChange(),u},stopEvent:function(n){n.stopPropagation();n.preventDefault()},keydown:function(t){var r=this,i=t.which,u=n(t.target);(i==8||i==46)&&setTimeout(function(){r._resetMaskPos(u)})},keypress:function(t){var f=t.which,r;if(f!=8&&f!=46){var u=n(t.target),e=String.fromCharCode(f),i=u.val()||"";if(i+=e,r=this._mask[this._maskPos],!r)return!1;if(r.end==i.length)if(r.pattern.test(i.slice(r.start)))this._maskPos++;else{for(i=i.slice(0,i.length-1);(r=this._mask[this._maskPos])&&r.character;)i+=r.character,this._maskPos++;return i+=e,r.end!=i.length?(u.val(i),!1):r.pattern.test(i.slice(r.start))?(u.val(i),this._maskPos++,!1):(u.val(i.slice(0,r.start)),!1)}}},change:function(t){var i=n(t.target),r=i.val();this._formatPattern.test(r)?(this.update(),this.setValue(this._date.getTime()),this.notifyChange(),this.set()):r&&r.trim()?(this.setValue(this._date.getTime()),this._date?this.set():i.val("")):this._date&&(this.setValue(null),this.notifyChange(),this._unset=!0);this._resetMaskPos(i)},showMode:function(n){n&&(this.viewMode=Math.max(this.minViewMode,Math.min(2,this.viewMode+n)));this.widget.find(".datepicker > div").hide().filter(".datepicker-"+t.modes[this.viewMode].clsName).show()},destroy:function(){this._detachDatePickerEvents();this._detachDatePickerGlobalEvents();this.widget.remove();this.$element.removeData("datetimepicker");this.component.removeData("datetimepicker")},formatDate:function(n){return this.format.replace(l,function(t){var f,e,i,o=t.length;if(t==="ms"&&(o=1),e=u[t].property,e==="Hours12")i=n.getUTCHours(),i===0?i=12:i!==12&&(i=i%12);else{if(e==="Period12")return n.getUTCHours()>=12?"PM":"AM";f="get"+e;i=n[f]()}return f==="getUTCMonth"&&(i=i+1),f==="getUTCYear"&&(i=i+1900-2e3),r(i.toString(),o,"0")})},parseDate:function(n){var r,t,u,i,f={};if(!(r=this._formatPattern.exec(n)))return null;for(t=1;t<r.length;t++)(u=this._propertiesByIndex[t],u)&&(i=r[t],/^\d+$/.test(i)&&(i=parseInt(i,10)),f[u]=i);return this._finishParsingDate(f)},_resetMaskPos:function(n){for(var i=n.val(),t=0;t<this._mask.length;t++)if(this._mask[t].end>i.length){this._maskPos=t;break}else if(this._mask[t].end===i.length){this._maskPos=t+1;break}},_finishParsingDate:function(n){var r,u,f,t,e,o,s;return r=n.UTCFullYear,n.UTCYear&&(r=2e3+n.UTCYear),r||(r=1970),u=n.UTCMonth?n.UTCMonth-1:0,f=n.UTCDate||1,t=n.UTCHours||0,e=n.UTCMinutes||0,o=n.UTCSeconds||0,s=n.UTCMilliseconds||0,n.Hours12&&(t=n.Hours12),n.Period12&&(/pm/i.test(n.Period12)?t!=12&&(t=(t+12)%24):t=t%12),i(r,u,f,t,e,o,s)},_compileFormat:function(){for(var e,n,i=[],r=[],f=this.format,o={},s=0,t=0;e=c.exec(f);)n=e[0],n in u?(s++,o[s]=u[n].property,i.push("\\s*"+u[n].getPattern(this)+"\\s*"),r.push({pattern:new RegExp(u[n].getPattern(this)),property:u[n].property,start:t,end:t+=n.length})):(i.push(a(n)),r.push({pattern:new RegExp(a(n)),character:n,start:t,end:++t})),f=f.slice(n.length);this._mask=r;this._maskPos=0;this._formatPattern=new RegExp("^\\s*"+i.join("")+"\\s*$");this._propertiesByIndex=o},_attachDatePickerEvents:function(){var t=this;this.widget.on("click",".datepicker *",n.proxy(this.click,this));this.widget.on("click","[data-action]",n.proxy(this.doAction,this));this.widget.on("mousedown",n.proxy(this.stopEvent,this));if(this.pickDate&&this.pickTime)this.widget.on("click.togglePicker",".accordion-toggle",function(i){var u;i.stopPropagation();var f=n(this),e=f.closest("ul"),r=e.find(".collapse.in"),o=e.find(".collapse:not(.in)");if(r&&r.length){if(u=r.data("collapse"),u&&u.transitioning)return;r.collapse("hide");o.collapse("show");f.find("i").toggleClass(t.timeIcon+" "+t.dateIcon);t.$element.find(".add-on i").toggleClass(t.timeIcon+" "+t.dateIcon)}});if(this.isInput){this.$element.on({focus:n.proxy(this.show,this),change:n.proxy(this.change,this)});if(this.options.maskInput)this.$element.on({keydown:n.proxy(this.keydown,this),keypress:n.proxy(this.keypress,this)})}else{this.$element.on({change:n.proxy(this.change,this)},"input");if(this.options.maskInput)this.$element.on({keydown:n.proxy(this.keydown,this),keypress:n.proxy(this.keypress,this)},"input");if(this.component)this.component.on("click",n.proxy(this.show,this));else this.$element.on("click",n.proxy(this.show,this))}},_attachDatePickerGlobalEvents:function(){n(window).on("resize.datetimepicker"+this.id,n.proxy(this.place,this));if(!this.isInput)n(document).on("mousedown.datetimepicker"+this.id,n.proxy(this.hide,this))},_detachDatePickerEvents:function(){this.widget.off("click",".datepicker *",this.click);this.widget.off("click","[data-action]");this.widget.off("mousedown",this.stopEvent);this.pickDate&&this.pickTime&&this.widget.off("click.togglePicker");this.isInput?(this.$element.off({focus:this.show,change:this.change}),this.options.maskInput&&this.$element.off({keydown:this.keydown,keypress:this.keypress})):(this.$element.off({change:this.change},"input"),this.options.maskInput&&this.$element.off({keydown:this.keydown,keypress:this.keypress},"input"),this.component?this.component.off("click",this.show):this.$element.off("click",this.show))},_detachDatePickerGlobalEvents:function(){n(window).off("resize.datetimepicker"+this.id);this.isInput||n(document).off("mousedown.datetimepicker"+this.id)},_isInFixed:function(){var i,r,t;if(this.$element){for(i=this.$element.parents(),r=!1,t=0;t<i.length;t++)if(n(i[t]).css("position")=="fixed"){r=!0;break}return r}return!1}};n.fn.datetimepicker=function(t,i){return this.each(function(){var u=n(this),r=u.data("datetimepicker"),f=typeof t=="object"&&t;r||u.data("datetimepicker",r=new o(this,n.extend({},n.fn.datetimepicker.defaults,f)));typeof t=="string"&&r[t](i)})};n.fn.datetimepicker.defaults={maskInput:!1,pickDate:!0,pickTime:!0,pick12HourFormat:!1,pickSeconds:!0,startDate:-Infinity,endDate:Infinity,collapse:!0};n.fn.datetimepicker.Constructor=o;var v=0,s=n.fn.datetimepicker.dates={en:{days:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],daysShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat","Sun"],daysMin:["Su","Mo","Tu","We","Th","Fr","Sa","Su"],months:["January","February","March","April","May","June","July","August","September","October","November","December"],monthsShort:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]}},u={dd:{property:"UTCDate",getPattern:function(){return"(0?[1-9]|[1-2][0-9]|3[0-1])\\b"}},MM:{property:"UTCMonth",getPattern:function(){return"(0?[1-9]|1[0-2])\\b"}},yy:{property:"UTCYear",getPattern:function(){return"(\\d{2})\\b"}},yyyy:{property:"UTCFullYear",getPattern:function(){return"(\\d{4})\\b"}},hh:{property:"UTCHours",getPattern:function(){return"(0?[0-9]|1[0-9]|2[0-3])\\b"}},mm:{property:"UTCMinutes",getPattern:function(){return"(0?[0-9]|[1-5][0-9])\\b"}},ss:{property:"UTCSeconds",getPattern:function(){return"(0?[0-9]|[1-5][0-9])\\b"}},ms:{property:"UTCMilliseconds",getPattern:function(){return"([0-9]{1,3})\\b"}},HH:{property:"Hours12",getPattern:function(){return"(0?[1-9]|1[0-2])\\b"}},PP:{property:"Period12",getPattern:function(){return"(AM|PM|am|pm|Am|aM|Pm|pM)\\b"}}},f=[];for(h in u)f.push(h);f[f.length-1]+="\\b";f.push(".");c=new RegExp(f.join("\\b|"));f.pop();l=new RegExp(f.join("\\b|"),"g");t={modes:[{clsName:"days",navFnc:"UTCMonth",navStep:1},{clsName:"months",navFnc:"UTCFullYear",navStep:1},{clsName:"years",navFnc:"UTCFullYear",navStep:10}],isLeapYear:function(n){return n%4==0&&n%100!=0||n%400==0},getDaysInMonth:function(n,i){return[31,t.isLeapYear(n)?29:28,31,30,31,30,31,31,30,31,30,31][i]},headTemplate:'<thead><tr><th class="prev">&lsaquo;<\/th><th colspan="5" class="switch"><\/th><th class="next">&rsaquo;<\/th><\/tr><\/thead>',contTemplate:'<tbody><tr><td colspan="7"><\/td><\/tr><\/tbody>'};t.template='<div class="datepicker-days"><table class="table-condensed">'+t.headTemplate+'<tbody><\/tbody><\/table><\/div><div class="datepicker-months"><table class="table-condensed">'+t.headTemplate+t.contTemplate+'<\/table><\/div><div class="datepicker-years"><table class="table-condensed">'+t.headTemplate+t.contTemplate+"<\/table><\/div>";e={hourTemplate:'<span data-action="showHours" data-time-component="hours" class="timepicker-hour"><\/span>',minuteTemplate:'<span data-action="showMinutes" data-time-component="minutes" class="timepicker-minute"><\/span>',secondTemplate:'<span data-action="showSeconds" data-time-component="seconds" class="timepicker-second"><\/span>'};e.getTemplate=function(n,t){return'<div class="timepicker-picker"><table class="table-condensed"'+(n?' data-hour-format="12"':"")+'><tr><td><a href="#" class="btn" data-action="incrementHours"><i class="icon-chevron-up"><\/i><\/a><\/td><td class="separator"><\/td><td><a href="#" class="btn" data-action="incrementMinutes"><i class="icon-chevron-up"><\/i><\/a><\/td>'+(t?'<td class="separator"><\/td><td><a href="#" class="btn" data-action="incrementSeconds"><i class="icon-chevron-up"><\/i><\/a><\/td>':"")+(n?'<td class="separator"><\/td>':"")+"<\/tr><tr><td>"+e.hourTemplate+'<\/td> <td class="separator">:<\/td><td>'+e.minuteTemplate+"<\/td> "+(t?'<td class="separator">:<\/td><td>'+e.secondTemplate+"<\/td>":"")+(n?'<td class="separator"><\/td><td><button type="button" class="btn btn-primary" data-action="togglePeriod"><\/button><\/td>':"")+'<\/tr><tr><td><a href="#" class="btn" data-action="decrementHours"><i class="icon-chevron-down"><\/i><\/a><\/td><td class="separator"><\/td><td><a href="#" class="btn" data-action="decrementMinutes"><i class="icon-chevron-down"><\/i><\/a><\/td>'+(t?'<td class="separator"><\/td><td><a href="#" class="btn" data-action="decrementSeconds"><i class="icon-chevron-down"><\/i><\/a><\/td>':"")+(n?'<td class="separator"><\/td>':"")+'<\/tr><\/table><\/div><div class="timepicker-hours" data-action="selectHour"><table class="table-condensed"><\/table><\/div><div class="timepicker-minutes" data-action="selectMinute"><table class="table-condensed"><\/table><\/div>'+(t?'<div class="timepicker-seconds" data-action="selectSecond"><table class="table-condensed"><\/table><\/div>':"")}})(window.jQuery)