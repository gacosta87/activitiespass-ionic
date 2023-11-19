import { Component, Input, OnInit } from '@angular/core';
import { NavController, ModalController, LoadingController } from '@ionic/angular';
 
import { Camera,CameraOptions } from "@ionic-native/camera/ngx";
import { File } from "@ionic-native/file/ngx";

import { Dimensions, ImageCroppedEvent, ImageTransform } from 'ngx-image-cropper';
import { Variablesglobales } from '../../providers/variablesglobal';
import Cropper from 'cropperjs';

@Component({
  selector: 'app-cropimagennueva',
  templateUrl: 'cropimagennueva.html',
  styleUrls: ['cropimagennueva.scss'],
  providers:[Variablesglobales, Camera, File]
})
export class Cropimagennueva implements  OnInit{
          @Input('dataimagen1') dataimagen1: string;
          @Input('list') list: string;
          @Input('aspectRationew') aspectRationew: string;
          public imgUrl: string; // Dirección de imagen 
          public infoArry=[];

          public imageChangedEvent: any = '';
          public croppedImage: any = '';
          public canvasRotation = 0;
          public rotation?: number;
          public translateH = 0;
          public translateV = 0;
          public scale = 1;
          public aspectRatio = 3/4;
          public showCropper = false;
          public containWithinAspectRatio = false;
          public transform: ImageTransform = {};
          public imageURL?: string;
          public loading = false;
          public salir_de_loading = new Promise((resolve, reject) => {
              this.loadingCtrl.getTop().then(loader => {
                    if (loader!=undefined) {
                        this.loadingCtrl.dismiss();
                        resolve(123);
                    }else{
                        resolve(123);
                    }
              });
          });
         
          constructor(public navCtrl: NavController,
                      private camera:Camera,
                      private file:File,
                      public modalController: ModalController,
                      public loadingCtrl: LoadingController,
                    ) {
                  
          }

         salirdecargando(){
      this.loadingCtrl.getTop().then(loader => {
        if (loader!=undefined) {
          console.log('sali',loader);
          this.loadingCtrl.dismiss();
        }
      });
  }
 

          ngOnInit(){

            this.loadingCtrl.getTop().then(loader => {
              if (loader!=undefined) {
                console.log('sali',loader);
                this.loadingCtrl.dismiss();
              }
            });

          }
          clear(){
              this.modalController.dismiss({data:['no']});
          }
          save(){
                //this.croppedImage
                //this.list
                this.modalController.dismiss({data:['si', this.croppedImage, this.list]});
          }
           ionViewDidEnter(){ 

                  //this.loadingCtrl.getTop().then(loader => {if(loader!=undefined) {this.loadingCtrl.dismiss();} });
                  this.loading           = true;
                  this.imageChangedEvent = this.dataimagen1;
                  this.imageURL          = 'data:image/jpeg;base64,' + this.dataimagen1;
                  this.scale -= .2;
                  if(this.aspectRationew=='1/1'){
                    this.aspectRatio = 1/1;  
                  }
                  
          }
           // enciende la cámara

          fileChangeEvent(event: any): void {
            this.loading = true;
            this.imageChangedEvent = event;
          }

          imageCropped(event: ImageCroppedEvent) {
            this.croppedImage = event.base64;
            console.log(event);
          }

          imageLoaded() {
            this.showCropper = true;
            console.log('Image loaded');
          }

          cropperReady(sourceImageDimensions: Dimensions) {
            console.log('Cropper ready', sourceImageDimensions);
            this.loading = false;
          }

          loadImageFailed() {
            console.error('Load image failed');
          }

          rotateLeft() {
            this.loading = true;
            setTimeout(() => { // Use timeout because rotating image is a heavy operation and will block the ui thread
              this.canvasRotation--;
              this.flipAfterRotate();
            });
          }

          rotateRight() {
            this.loading = true;
            setTimeout(() => {
              this.canvasRotation++;
              this.flipAfterRotate();
            });
          }

          moveLeft() {
            this.transform = {
              ...this.transform,
              translateH: ++this.translateH
            };
          }

          moveRight() {
            this.transform = {
              ...this.transform,
              translateH: --this.translateH
            };
          }

          moveTop() {
            this.transform = {
              ...this.transform,
              translateV: ++this.translateV
            };
          }

          moveBottom() {
            this.transform = {
              ...this.transform,
              translateV: --this.translateV
            };
          }

          private flipAfterRotate() {
            const flippedH = this.transform.flipH;
            const flippedV = this.transform.flipV;
            this.transform = {
              ...this.transform,
              flipH: flippedV,
              flipV: flippedH
            };
            this.translateH = 0;
            this.translateV = 0;
          }

          flipHorizontal() {
            this.transform = {
              ...this.transform,
              flipH: !this.transform.flipH
            };
          }

          flipVertical() {
            this.transform = {
              ...this.transform,
              flipV: !this.transform.flipV
            };
          }

          resetImage() {
            this.scale = 1;
            this.rotation = 0;
            this.canvasRotation = 0;
            this.transform = {};
          }

          zoomOut() {
            this.scale -= .1;
            this.transform = {
              ...this.transform,
              scale: this.scale
            };
          }

          zoomIn() {
            this.scale += .1;
            this.transform = {
              ...this.transform,
              scale: this.scale
            };
          }

          toggleContainWithinAspectRatio() {
            this.containWithinAspectRatio = !this.containWithinAspectRatio;
          }

          updateRotation() {
            this.transform = {
              ...this.transform,
              rotate: this.rotation
            };
          }

          toggleAspectRatio() {
            this.aspectRatio = this.aspectRatio === 4/3?16/5: 4/3;
          }

    
 
 
      
 

}
