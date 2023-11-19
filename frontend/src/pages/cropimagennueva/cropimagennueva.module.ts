import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { IonicModule } from '@ionic/angular';
import { FormsModule } from '@angular/forms';
import { Cropimagennueva } from './cropimagennueva';
import { RouterModule } from '@angular/router';
import { ImageCropperModule } from 'ngx-image-cropper';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    ImageCropperModule,
    TranslateModule,
    RouterModule.forChild([{ path: 'cropimagennueva', component: Cropimagennueva }])
  ],
  declarations: [Cropimagennueva]
})
export class CropimagennuevaModule {}
