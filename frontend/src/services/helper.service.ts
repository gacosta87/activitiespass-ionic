import { Injectable } from '@angular/core';
import { BehaviorSubject, ReplaySubject } from 'rxjs';

@Injectable()

export class HelperService {
 
  private mensajero1 = new ReplaySubject<number>(1);
  private mensajero2 = new ReplaySubject<number>(1);
  private mensajero3 = new ReplaySubject<number>(1);
  private mensajero4 = new ReplaySubject<number>(1);

  constructor() {}
  
  public get recibir1() {
    return this.mensajero1.asObservable()
  }

  public get recibir2() {
    return this.mensajero2.asObservable()
  }

  public get recibir3() {
    return this.mensajero3.asObservable()
  }

  public get recibir4() {
    return this.mensajero4.asObservable()
  }




  public enviar1(id: number): void {
    this.mensajero1.next(id);
  }

  public enviar2(id: number): void {
    this.mensajero2.next(id);
  }

  public enviar3(id: number): void {
    this.mensajero3.next(id);
  }

  public enviar4(id: number): void {
    this.mensajero4.next(id);
  }
}