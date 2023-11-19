import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Perfilchatnew } from './perfilchatnew';
import { IonicRatingModule } from 'ionic4-rating';
import { TranslateModule } from '@ngx-translate/core';
//import { NgxMaskIonicModule} from 'ngx-mask-ionic';
import { NgxCurrencyModule } from "ngx-currency";
import { ImageCropperModule } from 'ngx-image-cropper';
import { CropimagennuevaModule } from '../cropimagennueva/cropimagennueva.module';
import { PerfilchatinfoModule } from '../perfilchatinfo/perfilchatinfo.module';


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
    PerfilchatinfoModule,
    RouterModule.forChild([{ path: '', component: Perfilchatnew }])
  ],
  declarations: [Perfilchatnew]
})
export class PerfilchatnewModule {}
