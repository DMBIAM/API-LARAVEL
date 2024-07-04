import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { IonicModule } from '@ionic/angular';
import { FormsModule } from '@angular/forms'; 
import { ModalComponent } from './modal/modal.component';

@NgModule({
    declarations: [
        ModalComponent,
    ],
    imports: [
      CommonModule,
      RouterModule,
      IonicModule,
      FormsModule
    ],
    exports: [
        ModalComponent,
        IonicModule 
    ]
})
export class ComponentsModule { }