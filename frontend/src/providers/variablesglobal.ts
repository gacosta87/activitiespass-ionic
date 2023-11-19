import {Injectable} from '@angular/core';
@Injectable()

export class Variablesglobales {

  public Apivar:string;
  public Keyvar:string;
  public Servar:string;
  public Comvar:string;
  public Dowvar:string;
  public TokenIns:string;

  constructor() {
    this.TokenIns = localStorage.getItem('TokenInstalacion');
    if(this.TokenIns==null){
      this.TokenIns = "*13,.MI70$DK2n.lAZfBlgQqpfEwA4gu2/io%&/%DGa73408a97ron776mm"
    }
  	this.Keyvar   = "$2y$10$DKfEwA4gu2/io%&/%DGaaa97r2n.lAZfBlgQqpon776mm";

    //this.Apivar = "https://api.olympusapp.es/public/api/";
    //this.Servar = "https://dashboard.olympusapp.es/app/webroot/";
    //this.Comvar = "https://social.olympusapp.es/social/Social/";
    //this.Dowvar = "https://download.olympusapp.es/";


    this.Apivar = "https://api.olympusapp.es/public/api/";
    
    //this.Servar = "https://dashboard.olympusapp.es/app/webroot/";
    //this.Comvar = "https://social.olympusapp.es/social/Social/";
    //this.Dowvar = "https://download.olympusapp.es/";

    this.Servar = "https://dashboard.olympusapp.es/backend/app/webroot/";
    this.Comvar = "https://dashboard.olympusapp.es/social/Social/";
    this.Dowvar = "https://dashboard.olympusapp.es/download";


  }

  getKeyvar() {
    return this.Keyvar;
  }
  getApivar() {  
    return this.Apivar;
  }
  getServar() {
    return this.Servar; 
  } 
  getComvar() {
    return this.Comvar; 
  }
  getDow() {
    return this.Dowvar; 
  }
  getTokenIns() {
    return this.TokenIns; 
  }    

}