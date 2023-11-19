import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Inicioparati } from './inicioparati';
import { IonicRatingModule } from 'ionic4-rating';
import { TranslateModule } from '@ngx-translate/core';
//import { NgxMaskIonicModule} from 'ngx-mask-ionic';
import { NgxCurrencyModule } from "ngx-currency";
import { ImageCropperModule } from 'ngx-image-cropper';
import { CropimagennuevaModule } from '../cropimagennueva/cropimagennueva.module';
import { SafePipe } from './safe.pipe';
import { NgxProgressiveImageLoaderModule } from 'ngx-progressive-image-loader';

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
    NgxProgressiveImageLoaderModule,
    RouterModule.forChild([{ path: '', component: Inicioparati }])
  ],
  declarations: [Inicioparati, SafePipe],
  exports: [
        SafePipe
  ]
})
export class InicioparatiModule {}
