import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Perfilinfo } from './perfilinfo';
import { IonicRatingModule } from 'ionic4-rating';
import { SuperTabsModule } from '@ionic-super-tabs/angular';
import { PerfilpostverModule } from '../perfilpostver/perfilpostver.module';
import { PublicmenuModule } from '../publicmenu/publicmenu.module';
import { NgxProgressiveImageLoaderModule } from 'ngx-progressive-image-loader';
import { PerfilseguiModule } from '../perfilsegui/perfilsegui.module';
import { TranslateModule } from '@ngx-translate/core';
import { CropimagennuevaModule } from '../cropimagennueva/cropimagennueva.module';
import { ImageCropperModule } from 'ngx-image-cropper';
import { PerfilpromotextModule } from '../perfilpromotext/perfilpromotext.module';
import { PromocionviewModule } from '../promocionview/promocionview.module';
@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    SuperTabsModule,
    ImageCropperModule,
    IonicRatingModule,
    PerfilpostverModule,
    PerfilseguiModule,
    PublicmenuModule,
    TranslateModule,
    PerfilpromotextModule,
    NgxProgressiveImageLoaderModule,
    CropimagennuevaModule,
    PromocionviewModule,
    RouterModule.forChild([{ path: '', component: Perfilinfo }])
  ],
  declarations: [Perfilinfo]
})
export class PerfilinfoModule {}
