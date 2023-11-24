import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';
import { AclGuard } from '../guards/acl.guard';
//import { Menu } from '../pages/menu/menu';

const routes: Routes = [
  {
    path: 'inforpoliticas',  
    loadChildren: () => import('../pages/inforpoliticas/inforpoliticas.module').then(m => m.InforpoliticasModule)
  },
  {
    path: 'inforcondiciones',  
    loadChildren: () => import('../pages/inforcondiciones/inforcondiciones.module').then(m => m.InforcondicionesModule)
  },
  {
    path: 'estadistica1',  
    loadChildren: () => import('../pages/estadistica1/estadistica1.module').then(m => m.Estadistica1Module)
  },
  {
    path: 'estadistica2/:tipofaceinst/:idfaceinst',  
    loadChildren: () => import('../pages/estadistica2/estadistica2.module').then(m => m.Estadistica2Module)
  },
  {
      path: 'comentarios',
      loadChildren: () => import('../pages/comentarios/comentarios.module').then(m => m.ComentariosModule)
  },
  {
      path: 'suscripcion',
      loadChildren: () => import('../pages/suscripcion/suscripcion.module').then(m => m.SuscripcionModule)
  },
  {
      path: 'obtenerPerfilesUsuario',
      loadChildren: () => import('../pages/obtenerPerfilesUsuario/obtenerPerfilesUsuario.module').then(m => m.obtenerPerfilesUsuarioModule)
  },
  {
    path: 'buscar2/:id',
    loadChildren: () => import('../pages/buscar2/buscar2.module').then(m => m.Buscar2Module),
    //canActivate:[AclGuard]
  },
  {
    path: 'sugerencias',
    loadChildren: () => import('../pages/sugerencias/sugerencias.module').then(m => m.SugerenciasModule),
    //canActivate:[AclGuard]
  },
  {
    path: 'perfilpost',
    loadChildren: () => import('../pages/perfilpost/perfilpost.module').then(m => m.PerfilpostModule),
    //canActivate:[AclGuard]
  },
   {
    path: 'perfilchat',
    loadChildren: () => import('../pages/perfilchat/perfilchat.module').then(m => m.PerfilchatModule),
    //canActivate:[AclGuard]
  },  
  {
    path: 'inicioparati/:paraticategoria_id',
    loadChildren: () => import('../pages/inicioparati/inicioparati.module').then(m => m.InicioparatiModule),
    canActivate:[AclGuard]
  },
  {
    path: 'perfilchattema',
    loadChildren: () => import('../pages/perfilchattema/perfilchattema.module').then(m => m.PerfilchattemaModule),
    canActivate:[AclGuard]
  },
  {
    path: 'inicioparatidetalle/:id',
    loadChildren: () => import('../pages/inicioparatidetalle/inicioparatidetalle.module').then(m => m.InicioparatidetalleModule),
    canActivate:[AclGuard]
  },
  {
    path: 'perfilchatedit/:chatlistid',
    loadChildren: () => import('../pages/perfilchatedit/perfilchatedit.module').then(m => m.PerfilchateditModule),
    canActivate:[AclGuard]
  },
  {
    path: 'perfilchatnew/:chatcategoriaid/:chatlistid',
    loadChildren: () => import('../pages/perfilchatnew/perfilchatnew.module').then(m => m.PerfilchatnewModule),
    canActivate:[AclGuard]
  },
  {
    path: 'asistentechat/:asistente_usuario_id/:asistente_mymotor_id',
    loadChildren: () => import('../pages/asistentechat/asistentechat.module').then(m => m.AsistentechatModule),
    canActivate:[AclGuard]
  },
  {
    path: 'perfilverificar',
    loadChildren: () => import('../pages/perfilverificar/perfilverificar.module').then(m => m.PerfilverificarModule),
    canActivate:[AclGuard]
  },
  {
    path: 'perfilverificar1',
    loadChildren: () => import('../pages/perfilverificar1/perfilverificar1.module').then(m => m.Perfilverificar1Module),
    canActivate:[AclGuard]
  },
  {
    path: 'perfilverificar2',
    loadChildren: () => import('../pages/perfilverificar2/perfilverificar2.module').then(m => m.Perfilverificar2Module),
    canActivate:[AclGuard]
  },
  {
    path: 'perfilverificar3',
    loadChildren: () => import('../pages/perfilverificar3/perfilverificar3.module').then(m => m.Perfilverificar3Module),
    canActivate:[AclGuard]
  },
  {
    path: 'perfilverificar4',
    loadChildren: () => import('../pages/perfilverificar4/perfilverificar4.module').then(m => m.Perfilverificar4Module),
    canActivate:[AclGuard]
  },
  {
    path: 'perfilverificar5',
    loadChildren: () => import('../pages/perfilverificar5/perfilverificar5.module').then(m => m.Perfilverificar5Module),
    canActivate:[AclGuard]
  },
  {
    path: 'misanuncios',
    loadChildren: () => import('../pages/misanuncios/misanuncios.module').then(m => m.MisanunciosModule),
    canActivate:[AclGuard]
  },
  {
    path: 'misproveedores',
    loadChildren: () => import('../pages/misproveedores/misproveedores.module').then(m => m.MisproveedoresModule),
    canActivate:[AclGuard]
  },
  {
    path: 'misproveedoresadd',
    loadChildren: () => import('../pages/misproveedoresadd/misproveedoresadd.module').then(m => m.MisproveedoresaddModule),
    canActivate:[AclGuard]
  },
  {
    path: 'perfileditar',
    loadChildren: () => import('../pages/perfileditar/perfileditar.module').then(m => m.PerfileditarModule),
    canActivate:[AclGuard]
  },
  {
    path: 'perfilinfo',
    loadChildren: () => import('../pages/perfilinfo/perfilinfo.module').then(m => m.PerfilinfoModule),
    canActivate:[AclGuard]
  },
  {
    path: 'perfileditarwhatsapp',
    loadChildren: () => import('../pages/perfileditarwhatsapp/perfileditarwhatsapp.module').then(m => m.PerfileditarwhatsappModule),
    canActivate:[AclGuard]
  },
  {
    path: 'asistenteconfig',
    loadChildren: () => import('../pages/asistenteconfig/asistenteconfig.module').then(m => m.AsistenteconfigModule),
    canActivate:[AclGuard]
  },
  {
    path: 'asistentealimentar',
    loadChildren: () => import('../pages/asistentealimentar/asistentealimentar.module').then(m => m.AsistentealimentarModule),
    canActivate:[AclGuard]
  },
  {
    path: 'asistentealimentarscrapping',
    loadChildren: () => import('../pages/asistentealimentarscrapping/asistentealimentarscrapping.module').then(m => m.AsistentealimentarscrappingModule),
    canActivate:[AclGuard]
  },  
  {
    path: 'facebooksignin',
    loadChildren: () => import('../pages/facebooksignin/facebooksignin.module').then(m => m.FacebooksigninModule),
    canActivate:[AclGuard]
  },
  {
    path: 'perfileditarmapa',
    loadChildren: () => import('../pages/perfileditarmapa/perfileditarmapa.module').then(m => m.PerfileditarmapaModule),
    canActivate:[AclGuard]
  },
  {
    path: 'perfilregistrocompletar1/:id',
    loadChildren: () => import('../pages/perfilregistrocompletar1/perfilregistrocompletar1.module').then(m => m.Perfilregistrocompletar1Module),
    //canActivate:[AclGuard]
  },
  {
    path: 'perfilregistrocompletar2/:id',
    loadChildren: () => import('../pages/perfilregistrocompletar2/perfilregistrocompletar2.module').then(m => m.Perfilregistrocompletar2Module),
    //canActivate:[AclGuard]
  },
  {
    path: 'perfilregistrocompletar3/:id',
    loadChildren: () => import('../pages/perfilregistrocompletar3/perfilregistrocompletar3.module').then(m => m.Perfilregistrocompletar3Module),
    //canActivate:[AclGuard]
  },
  {
    path: 'perfilregistrocompletar4/:id',
    loadChildren: () => import('../pages/perfilregistrocompletar4/perfilregistrocompletar4.module').then(m => m.Perfilregistrocompletar4Module),
    //canActivate:[AclGuard]
  },
  {
      path: 'perfilsegui',
      loadChildren: () => import('../pages/perfilsegui/perfilsegui.module').then(m => m.PerfilseguiModule)
  },
  {
    path: 'mapa',
    loadChildren: () => import('../pages/mapa/mapa.module').then(m => m.MapaModule),
    //canActivate:[AclGuard]
  },
  {
    path: 'perfilconfreserva',
    loadChildren: () => import('../pages/perfilconfreserva/perfilconfreserva.module').then(m => m.PerfilconfreservaModule),
    //canActivate:[AclGuard]
  },  
  {
    path: 'reservasconfig',
    loadChildren: () => import('../pages/reservasconfig/reservasconfig.module').then(m => m.ReservasconfigModule),
    //canActivate:[AclGuard]
  },
  {
    path: 'buscarcategorias/:busqueda/:id',
    loadChildren: () => import('../pages/buscarcategorias/buscarcategorias.module').then(m => m.BuscarcategoriasModule),
    //canActivate:[AclGuard]
  },
  
  {
    path: 'perfilpostverall/:id/:usuarioid',
    loadChildren: () => import('../pages/perfilpostverall/perfilpostverall.module').then(m => m.PerfilpostverallModule),
  },
  {
    path: 'perfilmycar/:id',
    loadChildren: () => import('../pages/perfilmycar/perfilmycar.module').then(m => m.PerfilmycarModule),
  },    
 {
    path: 'perfilregistro',
    loadChildren: () => import('../pages/perfilregistro/perfilregistro.module').then(m => m.PerfilregistroModule),
    //canActivate:[AclGuard]
  }, 
  {
    path: 'perfilinicio',
    loadChildren: () => import('../pages/perfilinicio/perfilinicio.module').then(m => m.PerfilinicioModule),
    //canActivate:[AclGuard]
  }, 

   {
      path: 'notificaciones',
      loadChildren: () => import('../pages/notificaciones/notificaciones.module').then(m => m.NotificacionesModule)
  },
  
  {
    path: 'megafono',
    loadChildren: () => import('../pages/megafono/megafono.module').then(m => m.MegafonoModule),
    //canActivate:[AclGuard]
  },
  {
    path: 'megafonomsj/:usuarioid_desty/:usuarioid_from/:usuarioid_buscar',
    loadChildren: () => import('../pages/megafonomsj/megafonomsj.module').then(m => m.MegafonomsjModule),
    //canActivate:[AclGuard]
  },
  {
    path: 'login1',
    loadChildren: () => import('../pages/login1/login1.module').then(m => m.Login1Module),
    //canActivate:[AclGuard]
  },
  {
    path: 'registro1',
    loadChildren: () => import('../pages/registro1/registro1.module').then(m => m.Registro1Module),
    //canActivate:[AclGuard]
  },
  {
    path: 'registro2',
    loadChildren: () => import('../pages/registro2/registro2.module').then(m => m.Registro2Module),
    //canActivate:[AclGuard]
  },
  {
    path: 'registro3',
    loadChildren: () => import('../pages/registro3/registro3.module').then(m => m.Registro3Module),
    //canActivate:[AclGuard]
  },
  {
    path: 'loginrecuperar1',  
    loadChildren: () => import('../pages/loginrecuperar1/loginrecuperar1.module').then(m => m.Loginrecuperar1Module)
  },
  {
    path: 'loginrecuperar2',  
    loadChildren: () => import('../pages/loginrecuperar2/loginrecuperar2.module').then(m => m.Loginrecuperar2Module)
  },
  {
    path: 'loginrecuperar3',  
    loadChildren: () => import('../pages/loginrecuperar3/loginrecuperar3.module').then(m => m.Loginrecuperar3Module)
  },
  {
    path: 'principal',  
    loadChildren: () => import('../pages/principal/principal.module').then(m => m.PrincipalModule),
  },
  {
    path: '',
    redirectTo: 'principal',
    pathMatch: 'full'
  },
  {
    path: '/perfilmycar/:id',
    redirectTo: '/perfilmycar/:id',
    pathMatch: 'full'
  }
];
@NgModule({
  imports: [
    //RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
    RouterModule.forRoot(routes, { useHash: true, preloadingStrategy: PreloadAllModules  })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule {}
