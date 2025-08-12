import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {HTTP_INTERCEPTORS, HttpClientModule} from '@angular/common/http';
import {QuillModule} from 'ngx-quill';
import * as fromPages from './components/pages';
import * as fromAuth from './components/auth';
import * as fromBlog from './components/blog';
import * as fromDashboard from './components/dashboard';
import * as fromFriends from './components/friends';
import * as fromJobs from './components/jobs';
import * as fromClients from './components/clients';
import * as fromLayout from './components/layout';
import * as fromServices from './services';
import {NgOptimizedImage} from "@angular/common";
import {AuthInterceptor} from './auth.interceptor';
import {ToastrModule} from 'ngx-toastr';


@NgModule({
  declarations: [
    AppComponent,
    ...fromLayout.components,
    ...fromPages.components,
    ...fromAuth.components,
    ...fromBlog.components,
    ...fromDashboard.components,
    ...fromFriends.components,
    ...fromJobs.components,
    ...fromClients.components,
  ],
    imports: [
        BrowserModule,
        FormsModule,
        AppRoutingModule,
        ReactiveFormsModule,
        HttpClientModule,
        QuillModule.forRoot(),
        ToastrModule.forRoot(),
        NgOptimizedImage
    ],
  providers: [
    ...fromServices.services,
    { provide: HTTP_INTERCEPTORS, useClass: AuthInterceptor, multi: true }
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
