import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';
import { AclGuard } from '../../guards/acl.guard';
//import { Menu } from '../pages/menu/menu';
import { Principal } from './principal';

const routes: Routes = [
{
      path: 'principal',
      component: Principal,
      children: [
                    {
                        path: 'inicio',
                        loadChildren: () => import('../inicio/inicio.module').then(m => m.inicioModule)
                    },
                    {
                      path: 'buscar',
                      loadChildren: () => import('../buscar/buscar.module').then(m => m.BuscarModule),
                    },
                    {
                        path: 'eventos',
                        loadChildren: () => import('../eventos/eventos.module').then(m => m.EventosModule)
                    },
                    {
                      path: 'perfil',
                      loadChildren: () => import('../perfil/perfil.module').then(m => m.PerfilModule),
                    },  
                    {
                      path: 'temas',
                      loadChildren: () => import('../perfilchattema/perfilchattema.module').then(m => m.PerfilchattemaModule),
                    }
                ]   
  },
  {
    path: '',
    redirectTo: '/principal/perfil',
    pathMatch: 'full'
  }
];
@NgModule({
  imports: [
    RouterModule.forChild(routes)
  ],
  exports: [RouterModule]
})
export class PrincipalRoutingModule {}
