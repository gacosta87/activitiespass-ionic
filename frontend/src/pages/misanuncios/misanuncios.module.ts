import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Misanuncios } from './misanuncios';
import { IonicRatingModule } from 'ionic4-rating';
import { TranslateModule } from '@ngx-translate/core';
@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    IonicRatingModule,
    TranslateModule,
    RouterModule.forChild([{ path: '', component: Misanuncios }])
  ],
  declarations: [Misanuncios]
})
export class MisanunciosModule {}
