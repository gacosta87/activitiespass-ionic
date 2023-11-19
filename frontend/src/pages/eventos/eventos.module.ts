import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { eventos } from './eventos';
import { MegafonosendModule } from '../megafonosend/megafonosend.module';
import { PerfilpromotextModule } from '../perfilpromotext/perfilpromotext.module';
import { PromocionviewModule } from '../promocionview/promocionview.module';
import { NgxProgressiveImageLoaderModule } from 'ngx-progressive-image-loader';
import { PublicmenuModule } from '../publicmenu/publicmenu.module';
import { ComentariosModule } from '../comentarios/comentarios.module';
import { TranslateModule } from '@ngx-translate/core';
import { IonicRatingModule } from 'ionic4-rating';
import { PerfilpostinfoModule } from '../perfilpostinfo/perfilpostinfo.module';
import { ImageCropperModule } from 'ngx-image-cropper';
import { CropimagennuevaModule } from '../cropimagennueva/cropimagennueva.module';
import { LazyLoadImageModule } from 'ng-lazyload-image';
import { SuperTabsModule } from '@ionic-super-tabs/angular';
@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    ReactiveFormsModule, 
    MegafonosendModule,
    PromocionviewModule,
    NgxProgressiveImageLoaderModule,
    PublicmenuModule,
    PerfilpostinfoModule,
    ComentariosModule,
    TranslateModule,
    PerfilpromotextModule,
    IonicRatingModule,
    ImageCropperModule,
    LazyLoadImageModule,
    CropimagennuevaModule,
    SuperTabsModule,
    RouterModule.forChild([{ path: '', component: eventos }]),
  ],
  declarations: [eventos]
})
export class EventosModule {}
