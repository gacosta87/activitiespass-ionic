import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Perfilpostedit } from './perfilpostedit';
import { IonicRatingModule } from 'ionic4-rating';
import { TranslateModule } from '@ngx-translate/core';
//import { NgxMaskIonicModule} from 'ngx-mask-ionic';
import { NgxCurrencyModule } from "ngx-currency";

@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    IonicRatingModule,
    TranslateModule,
    //NgxMaskIonicModule,
    NgxCurrencyModule,
    RouterModule.forChild([{ path: 'perfilpostedit', component: Perfilpostedit }])
  ],
  declarations: [Perfilpostedit]
})
export class PerfilposteditModule {}
