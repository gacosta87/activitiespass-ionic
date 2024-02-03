import { NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouteReuseStrategy } from '@angular/router';
import { IonicModule, IonicRouteStrategy } from '@ionic/angular';
import { SplashScreen } from '@ionic-native/splash-screen/ngx';
import { StatusBar } from '@ionic-native/status-bar/ngx';
import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';
import { HttpClientModule, HttpClient } from '@angular/common/http';
import { Home } from '../providers/home';
import { HelperService } from '../services/helper.service';
import { Usuario } from '../providers/usuario';
import { SuperTabsModule } from '@ionic-super-tabs/angular';
import { NgxProgressiveImageLoaderModule, IImageLoaderOptions } from 'ngx-progressive-image-loader';
import { TranslateModule, TranslateLoader } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { FileTransfer } from '@ionic-native/file-transfer/ngx';
//import {NgxMaskIonicModule} from 'ngx-mask-ionic';
import { NgxCurrencyModule } from "ngx-currency";
import { OneSignal } from '@ionic-native/onesignal/ngx';
import { PrincipalModule } from '../pages/principal/principal.module';

//import { BackgroundMode } from '@ionic-native/background-mode/ngx';

@NgModule({
  declarations: [ 
    AppComponent,
    Home,
    Usuario,
  ],
  entryComponents: [],
  imports: [
    BrowserModule,
    IonicModule.forRoot(),
    AppRoutingModule,    
    HttpClientModule,
    NgxCurrencyModule,
    PrincipalModule,
    //NgxMaskIonicModule.forRoot(),
    NgxProgressiveImageLoaderModule.forRoot(<IImageLoaderOptions>{
      threshold: 0.1,
      placeholderImageSrc: './assets/fondos/placeholder.png'
    }),
    TranslateModule.forRoot({
        loader: {
          provide: TranslateLoader,
          useFactory: (createTranslateLoader),
          deps: [HttpClient]
        }
    }),
    SuperTabsModule.forRoot(), 
  ],
  providers: [
    StatusBar,
    SplashScreen,
    FileTransfer,  
    OneSignal,  
    Usuario,
    HelperService,
    { provide: RouteReuseStrategy, useClass: IonicRouteStrategy }
  ],
  bootstrap: [AppComponent],
  schemas: [CUSTOM_ELEMENTS_SCHEMA] // Agrega este schema
})
export class AppModule {}

export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/', '.json');
}
