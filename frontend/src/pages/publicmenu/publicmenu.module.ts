import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Publicmenu } from './publicmenu';
import { IonicRatingModule } from 'ionic4-rating';
import { TranslateModule } from '@ngx-translate/core';
import { PerfilposteditModule } from '../perfilpostedit/perfilpostedit.module';

@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    TranslateModule,
    PerfilposteditModule,
    RouterModule.forChild([{ path: 'perfilpopoverModule', component: Publicmenu }]),
    IonicRatingModule,
  ],
  declarations: [Publicmenu]
})
export class PublicmenuModule {}
