import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Perfilpostver } from './perfilpostver';
import { IonicRatingModule } from 'ionic4-rating';
//import { NgxProgressiveImgLoaderModule }  from  'ngx-progressive-img-loader';
import { NgxProgressiveImageLoaderModule } from 'ngx-progressive-image-loader';
import { PublicmenuModule } from '../publicmenu/publicmenu.module';
import { ComentariosModule } from '../comentarios/comentarios.module';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    IonicRatingModule,
    //NgxProgressiveImgLoaderModule,
    NgxProgressiveImageLoaderModule,
    PublicmenuModule,
    ComentariosModule,
    TranslateModule,
    RouterModule.forChild([{ path: 'perfilpostver', component: Perfilpostver }])
  ],
  declarations: [Perfilpostver]
})
export class PerfilpostverModule {}
