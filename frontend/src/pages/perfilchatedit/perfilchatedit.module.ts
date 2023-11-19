import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Perfilchatedit } from './perfilchatedit';
import { IonicRatingModule } from 'ionic4-rating';
import { TranslateModule } from '@ngx-translate/core';
//import { NgxMaskIonicModule} from 'ngx-mask-ionic';
import { NgxCurrencyModule } from "ngx-currency";
import { ImageCropperModule } from 'ngx-image-cropper';
import { CropimagennuevaModule } from '../cropimagennueva/cropimagennueva.module';


@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    IonicRatingModule,
    TranslateModule,
    //NgxMaskIonicModule,
    NgxCurrencyModule,
    ImageCropperModule,
    CropimagennuevaModule,
    RouterModule.forChild([{ path: '', component: Perfilchatedit }])
  ],
  declarations: [Perfilchatedit]
})
export class PerfilchateditModule {}
