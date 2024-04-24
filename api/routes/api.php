<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//ORDENES


Route::get('consultarordenes',      ['uses'=> 'OrdenesController@consultarordenes']);
Route::get('disponibilidad',        ['uses'=> 'OrdenesController@disponibilidad']);


//PROMOCIONES


Route::get('actualizarfotosusuarios/{id}',      ['uses'=> 'ActualizarController@actualizarfotosusuarios']);
Route::get('actualizarfotosusuarios_respaldo',  ['uses'=> 'ActualizarController@actualizarfotosusuarios_respaldo']);
Route::get('actualizarfotospost/{id}',          ['uses'=> 'ActualizarController@actualizarfotospost']);

Route::get('saludar',        ['uses'=> 'CompartirController@saludar']);	
Route::get('converte1',        ['uses'=> 'ConverterController@converte1']);	

Route::post('readscraper',      ['uses'=> 'ScraperController@readscraper']);


Route::get('webhooksenterprise1',      ['uses'=> 'WebhooksenterpriseController@webhooks1']);
Route::post('webhooksenterprise1',     ['uses'=> 'WebhooksenterpriseController@webhooks1']);
Route::get('webhooksenterprise2',      ['uses'=> 'WebhooksenterpriseController@webhooks2']);
Route::post('webhooksenterprise2',     ['uses'=> 'WebhooksenterpriseController@webhooks2']);
Route::get('webhooksenterprise3',      ['uses'=> 'WebhooksenterpriseController@webhooks3']);
Route::post('webhooksenterprise3',     ['uses'=> 'WebhooksenterpriseController@webhooks3']);
Route::get('webhooksenterprise4',      ['uses'=> 'WebhooksenterpriseController@webhooks4']);
Route::post('webhooksenterprise4',     ['uses'=> 'WebhooksenterpriseController@webhooks4']);



Route::post('asistente_scrapping',['uses'=> 'ScraperController@asistente_scrapping']);
Route::post('asistente_scrapping_delete',['uses'=> 'ScraperController@asistente_scrapping_delete']);



Route::get('whatsap_iniciar',   ['uses'=> 'WhatsappController@whatsap_iniciar']);
Route::get('whatsap_qr_created',['uses'=> 'WhatsappController@whatsap_qr_created']);



Route::get('subirfile',     ['uses'=> 'OpeniaController@subirfile']);
Route::get('leerfile/{task_id}',      ['uses'=> 'OpeniaController@leerfile']);
	
Route::group(['middleware' => 'token'], function () {


	Route::post('listtours',       ['uses'=> 'ToursController@listtours']);
	Route::post('listtoursfilter', ['uses'=> 'ToursController@listtoursfilter']);
	Route::post('listtoursid',  ['uses'=> 'ToursController@listtoursid']);
	Route::post('obtenerPerfilesUsuario',['uses'=> 'UsuariosController@obtenerPerfilesUsuario']);

///Stipe business///

	Route::post('checkout',              ['uses'=> 'StripeController@checkout']);
	Route::post('success',               ['uses'=> 'StripeController@success']);
	Route::post('cancel',                ['uses'=> 'StripeController@cancel']);
	Route::post('precios',               ['uses'=> 'StripeController@precios']);
	Route::post('cancelar_suscripcion',  ['uses'=> 'StripeController@cancelar_suscripcion']);


///Facebook business///

	Route::post('pages_show_list',            ['uses'=> 'FacebookconectController@pages_show_list']);
	Route::post('read_insights',              ['uses'=> 'FacebookconectController@read_insights']);
	Route::post('debug_token',                ['uses'=> 'FacebookconectController@debug_token']);
	Route::post('instagram_manage_insights',  ['uses'=> 'FacebookconectController@instagram_manage_insights']);

	Route::post('estadisticasprincipal',      ['uses'=> 'EstadisticaController@estadisticasprincipal']);

///FinFacebook business///


	Route::post('optimizar1',               ['uses'=> 'OptimizarController@optimizar1']);
	Route::post('categorias',               ['uses'=> 'ParatiController@categorias']);
	Route::post('reservahorarioconfig',     ['uses'=> 'ReservasController@reservahorarioconfig']);
	Route::post('reservahorariolistconfig', ['uses'=> 'ReservasController@reservahorariolistconfig']);

	//Chats
	Route::post('paratiid',      ['uses'=> 'ParatiController@paratiid']);
	Route::post('paratilist',    ['uses'=> 'ParatiController@paratilist']);
	Route::post('paratilistall', ['uses'=> 'ParatiController@paratilistall']);


	//asistente

	Route::post('asistentechatlist',   ['uses'=> 'AsistenteController@asistentechatlist']);
	Route::post('asistentechatadd',    ['uses'=> 'AsistenteController@asistentechatadd']);

	//Chats
	Route::post('chatid',            ['uses'=> 'ChatController@chatid']);
	Route::post('chatadd',           ['uses'=> 'ChatController@chatadd']);
	Route::post('chatdel',           ['uses'=> 'ChatController@chatdel']);
	Route::post('chatlist',          ['uses'=> 'ChatController@chatlist']);
	Route::post('chatedit',          ['uses'=> 'ChatController@chatedit']);
	Route::post('chatmensajeadd',    ['uses'=> 'ChatController@chatmensajeadd']);
	Route::post('chatmensajelist',   ['uses'=> 'ChatController@chatmensajelist']);
	Route::post('chatcategorialist', ['uses'=> 'ChatController@chatcategorialist']);
	Route::post('chatpromtist',      ['uses'=> 'ChatController@chatpromtist']);



	//Compartir
	Route::post('compartirpromocionate',  ['uses'=> 'CompartirController@compartirpromocionate']);
	Route::post('compartirperfil',        ['uses'=> 'CompartirController@compartirperfil']);
	//Configuraciones
	Route::post('consultarconfiguraciones',    ['uses'=> 'ConfiguracionesController@consultarconfiguraciones']);
	//Sugerencias
	Route::post('sugerenciasadd',    ['uses'=> 'SugerenciasController@sugerenciasadd']);
	//Denuncuas
	Route::post('denunciasadd',   ['uses'=> 'DenunciasController@denunciasadd']);
	Route::post('bloquear',       ['uses'=> 'DenunciasController@bloquear']);
	Route::post('desbloquear',    ['uses'=> 'DenunciasController@desbloquear']);
	//Reservar
	Route::post('reservaadd',    ['uses'=> 'ReservasController@reservaadd']);
	Route::post('reservadel',    ['uses'=> 'ReservasController@reservadel']);
	Route::post('reservalist',   ['uses'=> 'ReservasController@reservalist']);
	Route::post('reservaconfig',     ['uses'=> 'ReservasController@reservaconfig']);
	Route::post('reservaferiadd',    ['uses'=> 'ReservasController@reservaferiad']);
	Route::post('reservaferidel',    ['uses'=> 'ReservasController@reservaferidel']);
	Route::post('reservaviews',      ['uses'=> 'ReservasController@reservaviews']);
	Route::post('reservalistconfig', ['uses'=> 'ReservasController@reservalistconfig']);
	

	///Agregar Videos
	Route::post('promoadd',                ['uses'=> 'AgregarvideosController@promoadd']);

	Route::post('mipromocionadd',          ['uses'=> 'NotificacionesController@mipromocionadd']);


	///Proveedores
	Route::post('misproveedoresadd',       ['uses'=> 'ProveedoresController@misproveedoresadd']);
	Route::post('misproveedoresdel',       ['uses'=> 'ProveedoresController@misproveedoresdel']);
	Route::post('misproveedoreslis',       ['uses'=> 'ProveedoresController@misproveedoreslis']);



	//Promociones
	Route::post('promocionesimgadd',       ['uses'=> 'PromocionesController@promocionesimgadd']);
	Route::post('promocionestextadd',      ['uses'=> 'PromocionesController@promocionestextadd']);
	Route::post('promoviews',              ['uses'=> 'PromocionesController@promoviews']);
	Route::post('promocionesinicio',       ['uses'=> 'PromocionesController@promocionesinicio']);
	Route::post('promocioneslistinupdate', ['uses'=> 'PromocionesController@promocioneslistinupdate']);
	Route::post('promocionesupdatevisto',  ['uses'=> 'PromocionesController@promocionesupdatevisto']);
	//Buscar
	Route::post('buscar',        ['uses'=> 'BuscarController@buscar']);
	Route::post('buscarreload',  ['uses'=> 'BuscarController@buscarreload']);
	Route::post('buscarcategoria',  ['uses'=> 'BuscarController@buscarcategoria']);
	
	//MENSAJES
	Route::post('mensajeadd',       ['uses'=> 'MensajeriaController@mensajeadd']);
	Route::post('mensajelist',      ['uses'=> 'MensajeriaController@mensajelist']);
	Route::post('megafonodelete',   ['uses'=> 'MensajeriaController@megafonodelete']);
	Route::post('mensajemsjdelete', ['uses'=> 'MensajeriaController@mensajemsjdelete']);
	Route::post('mensajemsj',       ['uses'=> 'MensajeriaController@mensajemsj']);
	Route::post('mensajemsjimg',    ['uses'=> 'MensajeriaController@mensajemsjimg']);
	//HOME
	Route::post('home',                ['uses'=> 'HomeController@home']);	
	Route::post('home_para_ti',        ['uses'=> 'HomeController@home_para_ti']);

	Route::post('home1_solicitudes',  ['uses'=> 'HomeController@home1_solicitudes']);
	Route::post('home_solicitudes',   ['uses'=> 'HomeController@home_solicitudes']);

	Route::post('homesinregistro',                ['uses'=> 'HomesinsessionController@homesinregistro']);	
	Route::post('homesinregistro_para_ti',        ['uses'=> 'HomesinsessionController@homesinregistro_para_ti']);

	Route::post('home1sinregistro_solicitudes',   ['uses'=> 'HomesinsessionController@home1sinregistro_solicitudes']);
	Route::post('homesinregistro_solicitudes',    ['uses'=> 'HomesinsessionController@homesinregistro_solicitudes']);
	
	Route::post('comprobarmensajes',  ['uses'=> 'HomeController@comprobarmensajes']);
	Route::post('perfildata',         ['uses'=> 'HomeController@perfildata']);
	Route::post('publicaciondata',    ['uses'=> 'HomeController@publicaciondata']);
	//Notificaciones
	Route::post('notifilist',         ['uses'=> 'NotificacionesController@notifilist']);
	//Seguidores y Seguidos
	Route::post('listarsegui',        ['uses'=> 'SeguiController@listarsegui']);

	//Post megusta
	Route::post('listarpostmegusta',        ['uses'=> 'SeguiController@listarpostmegusta']);

	//SESSSION ACTIVA
	Route::post('sessionactiva',      ['uses'=> 'UsuariosController@sessionactiva']);
	//USUARIOS
	Route::post('loginregistronacimiento',  ['uses'=> 'UsuariosController@loginregistro']);
	Route::post('loginregistro',            ['uses'=> 'UsuariosController@loginregistro']);
	Route::post('actualizarpush',           ['uses'=> 'UsuariosController@actualizarpush']);
	//SOLICITUDES
	Route::post('solicitudesadd',     ['uses'=> 'SoliciudesController@solicitudesadd']);
	//POST
	//Route::post('postadd',          ['uses'=> 'PostController@postadd']);
	Route::post('postadd',            ['uses'=> 'PostwebpController@postaddwebp']);
	Route::post('postaddwebp',        ['uses'=> 'PostwebpController@postaddwebp']);
	Route::post('postadd_webp_video', ['uses'=> 'AgregarvideosController@postadd_webp_video']);
	//PUBLICACIONES
	Route::post('publilike',        ['uses'=> 'PublicacionesController@publilike']);
	
	Route::post('elminarcomentario',  ['uses'=> 'PublicacionesController@elminarcomentario']);
	Route::post('publicomenta',       ['uses'=> 'PublicacionesController@publicomenta']);
	Route::post('publicomentalist',   ['uses'=> 'PublicacionesController@publicomentalist']);
	Route::post('publidelete',        ['uses'=> 'PublicacionesController@publidelete']);
	Route::post('publiupdate',        ['uses'=> 'PublicacionesController@publiupdate']);
	Route::post('publiver',           ['uses'=> 'PublicacionesController@publiver']);
	Route::post('publicompartir',     ['uses'=> 'PublicacionesController@publicompartir']);
	
	//PERFIL MycAR
	Route::post('perfilmycar',           ['uses'=> 'MiperfilmycarController@perfilmycar']);
	Route::post('perfilmycarcompartir',  ['uses'=> 'MiperfilmycarController@perfilmycarcompartir']);
	Route::post('perfilmycarsfavcalif',  ['uses'=> 'MiperfilmycarController@perfilmycarsfavcalif']);
	Route::post('listapaises',           ['uses'=> 'MiperfilmycarController@listapaises']);
	

	//FAVORITO
	Route::post('favadd',      ['uses'=> 'FavoritoController@add']);
	Route::post('favdel',      ['uses'=> 'FavoritoController@del']);
	Route::post('favlis',      ['uses'=> 'FavoritoController@lis']);

	//Recenttours
	Route::post('recentadd',      ['uses'=> 'RecenttoursController@add']);
	Route::post('recentdel',      ['uses'=> 'RecenttoursController@del']);
	Route::post('recentlis',      ['uses'=> 'RecenttoursController@lis']);

	//LOGEAR
	Route::post('login1',                ['uses'=> 'UsuariosController@login1']);
	

	//PERFIL
	Route::post('miperfil_usuario',        ['uses'=> 'MiperfilController@miperfil_usuario']);
	Route::post('miperfil',                ['uses'=> 'MiperfilController@miperfil']);
	Route::post('miperfilsmall',           ['uses'=> 'MiperfilController@miperfilsmall']);
	Route::post('miperfilupdate',          ['uses'=> 'MiperfilController@miperfilupdate']);
	Route::post('miperfilupdate_asistente',['uses'=> 'MiperfilController@miperfilupdate_asistente']);
	Route::post('miperfilupdate_delete',   ['uses'=> 'MiperfilController@miperfilupdate_delete']);
	Route::post('miperfilupdatemapa',      ['uses'=> 'MiperfilController@miperfilupdatemapa']);
	Route::post('miperfilfotoupdate',      ['uses'=> 'MiperfilController@miperfilfotoupdate']);
	Route::post('enviarcodigowhatsapp',    ['uses'=> 'MiperfilController@enviarcodigowhatsapp']);

	Route::post('miperfilfacebooksignin',  ['uses'=> 'MiperfilController@miperfilfacebooksignin']);
	Route::post('miperfilfacebooklogout',  ['uses'=> 'MiperfilController@miperfilfacebooklogout']);


	Route::post('perfilregistrocompletar', ['uses'=> 'UsuariosController@perfilregistrocompletar']);

	Route::post('perfilverificar1',   ['uses'=> 'UsuariosController@perfilverificar1']);
	Route::post('perfilverificar2',   ['uses'=> 'UsuariosController@perfilverificar2']);
	Route::post('perfilverificar2_1', ['uses'=> 'UsuariosController@perfilverificar2_1']);
	Route::post('perfilverificar3',   ['uses'=> 'UsuariosController@perfilverificar3']);
	Route::post('perfilverificar4',   ['uses'=> 'UsuariosController@perfilverificar4']);
	Route::post('perfilverificar5',   ['uses'=> 'UsuariosController@perfilverificar5']);

	//REGISTRO
	Route::post('loginemail',            ['uses'=> 'UsuariosController@loginemail']);
	//RECUPERAR CONTRASEÑA
	Route::post('loginrecuperar1',       ['uses'=> 'UsuariosController@loginrecuperar1']);
	Route::post('loginrecuperar2',       ['uses'=> 'UsuariosController@loginrecuperar2']);
	Route::post('loginrecuperar3',       ['uses'=> 'UsuariosController@loginrecuperar3']);
	//INFORMACION
	Route::post('inforpoliticas',        ['uses'=> 'InformacionesController@inforpoliticas']);
	Route::post('inforcondiciones',      ['uses'=> 'InformacionesController@inforcondiciones']);
	//MAPA
	Route::post('mapalistar',            ['uses'=> 'MapaController@mapalistar']);
	//REGISTRO
	Route::post('instalacionapp',        ['uses'=> 'UsuariosController@instalacionapp']);
});   


?>