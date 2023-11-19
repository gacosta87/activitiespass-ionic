import { Component, OnInit, ViewChild, Input } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';

import { Router } from '@angular/router';
import { Platform, NavController, LoadingController, AlertController } from '@ionic/angular';
 
import { GooglePlus } from '@ionic-native/google-plus/ngx';
import {FacebookLoginResponse, Facebook} from "@ionic-native/facebook/ngx";
import { Instagram } from '@ionic-native/instagram/ngx';

import { Usuario } from '../../providers/usuario';

import { Geolocation } from '@ionic-native/geolocation/ngx';
import { Camera, CameraOptions } from '@ionic-native/camera/ngx';
import { Crop, CropOptions } from '@ionic-native/crop/ngx';
import { File } from '@ionic-native/file/ngx';

import { Home } from '../../providers/home';

declare var google;
@Component({
  selector: 'app-reservasconfig',
  templateUrl: 'reservasconfig.html',
  styleUrls: ['reservasconfig.scss'],
  providers:[Usuario, Home, Camera, File, Crop, GooglePlus, Facebook, Instagram, Geolocation]
})

export class Reservasconfig {


}