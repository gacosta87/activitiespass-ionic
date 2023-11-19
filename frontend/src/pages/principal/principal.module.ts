import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Principal } from './principal';
import { IonicRatingModule } from 'ionic4-rating';
import { NgxProgressiveImageLoaderModule } from 'ngx-progressive-image-loader';
import { TranslateModule } from '@ngx-translate/core';
import { FileTransfer } from '@ionic-native/file-transfer/ngx';
//import { NgxMaskIonicModule } from 'ngx-mask-ionic';
import { NgxCurrencyModule } from "ngx-currency";
import { MegafonosendModule } from '../megafonosend/megafonosend.module';
import { PrincipalRoutingModule } from './principal-routing.module';
import { CropimagennuevaModule } from '../cropimagennueva/cropimagennueva.module';
import { InvitaramigosModule } from '../invitaramigos/invitaramigos.module';
import { PerfilubucacioninfoModule } from '../perfilubucacioninfo/perfilubucacioninfo.module';
import { inicioModule } from '../inicio/inicio.module';

@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    IonicRatingModule,
    NgxProgressiveImageLoaderModule,
    TranslateModule,
    MegafonosendModule,
    InvitaramigosModule,
    PrincipalRoutingModule,
    PerfilubucacioninfoModule,
    CropimagennuevaModule,
    inicioModule
  ],
  declarations: [Principal]
})
export class PrincipalModule {}
