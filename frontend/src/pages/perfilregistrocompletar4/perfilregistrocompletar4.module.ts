import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Perfilregistrocompletar4 } from './perfilregistrocompletar4';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    TranslateModule,
    RouterModule.forChild([{ path: '', component: Perfilregistrocompletar4 }])
  ],
  declarations: [Perfilregistrocompletar4]
})
export class Perfilregistrocompletar4Module {}
