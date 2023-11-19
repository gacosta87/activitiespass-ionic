import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Megafonomsjimg } from './megafonomsjimg';
import { IonicRatingModule } from 'ionic4-rating';
//import { NgxProgressiveImgLoaderModule }  from  'ngx-progressive-img-loader';
import { NgxProgressiveImageLoaderModule } from 'ngx-progressive-image-loader';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    IonicRatingModule,
//    NgxProgressiveImgLoaderModule,
    NgxProgressiveImageLoaderModule,
    TranslateModule,
    RouterModule.forChild([{ path: 'megafonomsjimg', component: Megafonomsjimg }])
  ],
  declarations: [Megafonomsjimg]
})
export class MegafonomsjimgModule {}
