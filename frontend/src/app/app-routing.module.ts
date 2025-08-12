import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import * as fromPages from './components/pages';
import * as fromAuth from './components/auth';
import * as fromBlog from './components/blog';
import * as fromDashboard from './components/dashboard';
import * as fromFriends from './components/friends';
import * as fromJobs from './components/jobs';
import * as fromClients from './components/clients';
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
          {path: 'create', component: fromBlog.PostCreateComponent},
          {path: ':id', component: fromBlog.PostDetailComponent},
          {path: 'update/:id', component: fromBlog.PostUpdateComponent},
        ]},
      {path: 'comments', children: [
        {path: '', component: fromBlog.CommentListComponent},
          {path: 'create', component: fromBlog.CommentCreateComponent},
          {path: ':id', component: fromBlog.CommentDetailComponent},
          {path: 'update/:id', component: fromBlog.CommentUpdateComponent},
        ]}
    ]},
  {path: 'dashboard', canActivate: [AuthGuard], children: [
      {path: '', component: fromDashboard.DashboardComponent},
      {path: 'users', children: [
          {path: '', component: fromAuth.UserListComponent},
          {path: 'create', component: fromAuth.UserCreateComponent},
          {path: ':id', component: fromAuth.UserDetailComponent},
          {path: 'update/:id', component: fromAuth.UserUpdateComponent},
        ]},
      {path: 'friends', children: [
        {path: '', component: fromFriends.FriendListComponent},
          {path: 'pending', component: fromFriends.FriendPendingComponent},
        ]},
      {path: 'jobs', children: [
        {path: '', component: fromJobs.JobListComponent},
          {path: ':id', component: fromJobs.JobDetailComponent},
          {path: 'create', component: fromJobs.JobCreateComponent},
          {path: 'update/:id', component: fromJobs.JobUpdateComponent},
        ]},
      {path: 'clients', children: [
        {path: '', component: fromClients.ClientListComponent},
          {path: ':id', component: fromClients.ClientDetailComponent},
          {path: 'create', component: fromClients.ClientCreateComponent},
          {path: 'update/:id', component: fromClients.ClientUpdateComponent},
          {path: ':id/jobs', component: fromClients.ClientJobListComponent},
        ]}
    ]},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
