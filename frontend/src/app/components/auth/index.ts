import {RegisterComponent} from './register/register.component';
import {LoginComponent} from './login/login.component';
import {LogoutComponent} from './logout/logout.component';
import {UserListComponent} from './users/user-list/user-list.component';
import {UserDetailComponent} from './users/user-detail/user-detail.component';
import {UserCreateComponent} from './users/user-create/user-create.component';
import {UserUpdateComponent} from './users/user-update/user-update.component';

export const components: any[] = [
  RegisterComponent,
  LoginComponent,
  LogoutComponent,
  UserListComponent,
  UserDetailComponent,
  UserCreateComponent,
  UserUpdateComponent,
];


export * from './register/register.component';
export * from './login/login.component';
export * from './logout/logout.component';
export * from './users/user-list/user-list.component';
export * from './users/user-detail/user-detail.component';
export * from './users/user-create/user-create.component';
export * from './users/user-update/user-update.component';
