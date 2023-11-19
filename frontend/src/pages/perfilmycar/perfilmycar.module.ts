import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Perfilmycar } from './perfilmycar';
import { IonicRatingModule } from 'ionic4-rating';
import { SuperTabsModule } from '@ionic-super-tabs/angular';
import { PerfilmycarsfavcalifModule } from '../perfilmycarsfavcalif/perfilmycarsfavcalif.module';
import { PerfilpostverModule } from '../perfilpostver/perfilpostver.module';
//import  {  NgxProgressiveImgLoaderModule  }  from  'ngx-progressive-img-loader';
import { NgxProgressiveImageLoaderModule } from 'ngx-progressive-image-loader';
import { PublicmenuModule } from '../publicmenu/publicmenu.module';
import { PerfilseguiModule } from '../perfilsegui/perfilsegui.module';
import { ReservasaddModule } from '../reservasadd/reservasadd.module';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    PerfilmycarsfavcalifModule,
    IonicRatingModule,
    SuperTabsModule,
    PerfilpostverModule,
    PublicmenuModule,
    TranslateModule,
    PerfilseguiModule,
    ReservasaddModule,
    NgxProgressiveImageLoaderModule,
    RouterModule.forChild([{ path: '', component: Perfilmycar }])
    
  ],
  declarations: [Perfilmycar]
})
export class PerfilmycarModule {}
