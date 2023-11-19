import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Misproveedores } from './misproveedores';
import { NgxProgressiveImageLoaderModule } from 'ngx-progressive-image-loader';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    NgxProgressiveImageLoaderModule,
    TranslateModule,
    RouterModule.forChild([{ path: '', component: Misproveedores }]),
  ],
  declarations: [Misproveedores]
})
export class MisproveedoresModule {}
