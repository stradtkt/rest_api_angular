import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import * as fromPages from './components/pages';
import * as fromAuth from './components/auth';
import * as fromBlog from './components/blog';
import * as fromDashboard from './components/dashboard';
import {AuthGuard} from './auth.guard';

const routes: Routes = [
  {path: '', component: fromPages.HomeComponent, pathMatch: 'full'},
  {path: 'login', component: fromAuth.LoginComponent},
  {path: 'register', component: fromAuth.RegisterComponent},
  {path: 'pricing', component: fromPages.PricingComponent},
  {path: 'about', component: fromPages.AboutComponent},
  {path: 'contact', component: fromPages.ContactComponent},
  {path: 'privacy-policy', component: fromPages.PrivacyPolicyComponent},
  {path: 'terms-and-conditions', component: fromPages.TermsAndConditionsComponent},
  {path: 'blog', canActivate: [AuthGuard], children: [
      {path: 'posts', children: [
          {path: '', component: fromBlog.PostListComponent},
          {path: ':id', component: fromBlog.PostDetailComponent},
          {path: 'create', component: fromBlog.PostCreateComponent},
          {path: 'update/:id', component: fromBlog.PostUpdateComponent},
        ]},
      {path: 'comments', children: [
        {path: '', component: fromBlog.CommentListComponent},
          {path: ':id', component: fromBlog.CommentDetailComponent},
          {path: 'create', component: fromBlog.CommentCreateComponent},
          {path: 'update/:id', component: fromBlog.CommentUpdateComponent},
        ]}
    ]},
  {path: 'dashboard', canActivate: [AuthGuard], children: [
      {path: '', component: fromDashboard.DashboardComponent},
    ]},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
