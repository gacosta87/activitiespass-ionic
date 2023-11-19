import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Promocionview } from './promocionview';
import { TranslateModule } from '@ngx-translate/core';
import { NgxProgressiveImageLoaderModule } from 'ngx-progressive-image-loader';

@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    TranslateModule,
    NgxProgressiveImageLoaderModule,
    RouterModule.forChild([{ path: 'promocionview', component: Promocionview }])
  ],
  declarations: [Promocionview]
})
export class PromocionviewModule {}
