import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import {QuillModule} from 'ngx-quill';
import * as fromPages from './components/pages';
import * as fromAuth from './components/auth';
import * as fromBlog from './components/blog';
import * as fromDashboard from './components/dashboard';
import * as fromLayout from './components/layout';
import * as fromServices from './services';
import {NgOptimizedImage} from "@angular/common";

@NgModule({
  declarations: [
    AppComponent,
    ...fromLayout.components,
    ...fromPages.components,
    ...fromAuth.components,
    ...fromBlog.components,
    ...fromDashboard.components,
  ],
    imports: [
        BrowserModule,
        FormsModule,
        AppRoutingModule,
        ReactiveFormsModule,
        HttpClientModule,
        QuillModule.forRoot(),
        NgOptimizedImage
    ],
  providers: [...fromServices.services],
  bootstrap: [AppComponent]
})
export class AppModule { }
