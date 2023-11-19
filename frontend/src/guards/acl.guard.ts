import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, UrlTree, Router } from '@angular/router';
import { Observable } from 'rxjs';
import { NavController } from '@ionic/angular';

@Injectable({
  providedIn: 'root'
})
export class AclGuard implements CanActivate {

  constructor(
    private router: Router,
    private navController: NavController
  ){

  }

  async canActivate(){
    const checkinLogin = await localStorage.getItem('SESSIONACTIVA_OLYMPUS_9');
    if(checkinLogin == 'true'){
      //console.log('checkinLogin:', checkinLogin);
      return true;
    }else{
      //console.log('checkinLogin2:', checkinLogin);
      this.navController.navigateRoot('/principal/perfil');
      return false;
    }
  }
  
}
