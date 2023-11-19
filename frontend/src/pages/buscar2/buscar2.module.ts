import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Buscar2 } from './buscar2';
import { PerfilpostverModule } from '../perfilpostver/perfilpostver.module';
//import  {  NgxProgressiveImgLoaderModule  }  from  'ngx-progressive-img-loader';
import { NgxProgressiveImageLoaderModule } from 'ngx-progressive-image-loader';
import { TranslateModule } from '@ngx-translate/core';
import { IonicRatingModule } from 'ionic4-rating';

@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    PerfilpostverModule,
  //  NgxProgressiveImgLoaderModule,
    NgxProgressiveImageLoaderModule,
    TranslateModule,
    IonicRatingModule,
    RouterModule.forChild([{ path: '', component: Buscar2}])
  ],
  declarations: [Buscar2]
})
export class Buscar2Module {}
