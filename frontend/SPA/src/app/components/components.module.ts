import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { CardComponent } from './card/card.component';

@NgModule({
    declarations: [
        CardComponent,
    ],
    imports: [
      CommonModule,
      RouterModule
    ],
    exports: [
        CardComponent
    ]
})
export class ComponentsModule { }