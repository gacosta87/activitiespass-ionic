import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Megafonomsj } from './megafonomsj';
import { MegafonomsjimgModule } from '../megafonomsjimg/megafonomsjimg.module';
///import { NgxProgressiveImgLoaderModule }  from  'ngx-progressive-img-loader';
import { NgxProgressiveImageLoaderModule } from 'ngx-progressive-image-loader';
import { TranslateModule } from '@ngx-translate/core';
import { CropimagennuevaModule } from '../cropimagennueva/cropimagennueva.module';

@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    MegafonomsjimgModule,
   //NgxProgressiveImgLoaderModule,
    NgxProgressiveImageLoaderModule,
    TranslateModule,
    CropimagennuevaModule,
    RouterModule.forChild([{ path: '', component: Megafonomsj }])
  ],
  declarations: [Megafonomsj]
})
export class MegafonomsjModule {}
