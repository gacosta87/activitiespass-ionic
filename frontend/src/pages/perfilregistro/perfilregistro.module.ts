import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Perfilregistro } from './perfilregistro';
import { TranslateModule } from '@ngx-translate/core';
//import { GooglePlus } from '@ionic-native/google-plus/ngx';
///import { Facebook } from "@ionic-native/facebook/ngx"; 
//import { Instagram } from '@ionic-native/instagram/ngx';


@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
  //  GooglePlus,
    //Facebook,
    //Instagram,
    TranslateModule,
    RouterModule.forChild([{ path: '', component: Perfilregistro }])
  ],
  declarations: [Perfilregistro]
})
export class PerfilregistroModule {}
