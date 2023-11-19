import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Perfilpostinfo } from './perfilpostinfo';
import { NgxProgressiveImageLoaderModule } from 'ngx-progressive-image-loader';
import { PublicmenuModule } from '../publicmenu/publicmenu.module';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    NgxProgressiveImageLoaderModule,
    PublicmenuModule,
    TranslateModule,
    RouterModule.forChild([{ path: 'perfilpostinfo', component: Perfilpostinfo }]),
  ],
  declarations: [Perfilpostinfo]
})
export class PerfilpostinfoModule {}
