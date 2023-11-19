import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Perfilregistrocompletar3 } from './perfilregistrocompletar3';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    TranslateModule,
    RouterModule.forChild([{ path: '', component: Perfilregistrocompletar3 }])
  ],
  declarations: [Perfilregistrocompletar3]
})
export class Perfilregistrocompletar3Module {}
