import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Perfilregistrocompletar1 } from './perfilregistrocompletar1';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    TranslateModule,
    RouterModule.forChild([{ path: '', component: Perfilregistrocompletar1 }])
  ],
  declarations: [Perfilregistrocompletar1]
})
export class Perfilregistrocompletar1Module {}
