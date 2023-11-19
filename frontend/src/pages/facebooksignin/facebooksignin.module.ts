import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Facebooksignin } from './facebooksignin';
import { IonicRatingModule } from 'ionic4-rating';
import { TranslateModule } from '@ngx-translate/core';
import { ImageCropperModule } from 'ngx-image-cropper';
import { CropimagennuevaModule } from '../cropimagennueva/cropimagennueva.module';


@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    ImageCropperModule,
    CropimagennuevaModule,
    RouterModule.forChild([{ path: '', component: Facebooksignin }]),
    IonicRatingModule,
    TranslateModule
  ],
  declarations: [Facebooksignin]
})
export class FacebooksigninModule {}
