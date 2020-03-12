import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { BeforeloginGuard } from "../guards/beforelogin.guard";
import { AfterloginGuard } from "../guards/afterlogin.guard";
import { AdminGuard } from "../guards/admin.guard";

import { LoginComponent } from '../components/auth/login/login.component';
import { ProfileComponent } from '../components/profile/profile.component';
import { RegisterComponent } from '../components/auth/register/register.component';
import { RequestPasswordResetComponent } from '../components/auth/request-password-reset/request-password-reset.component';
import { ResponsePasswordResetComponent } from '../components/auth/response-password-reset/response-password-reset.component';
import { UsersComponent } from "../components/admin/users/users.component";

const  RouteList: Routes = [
  { path: 'login', component: LoginComponent,  canActivate: [BeforeloginGuard]  },
  { path: 'register', component: RegisterComponent,  canActivate: [BeforeloginGuard]  },
  { path: 'request-password-reset', component: RequestPasswordResetComponent, canActivate: [BeforeloginGuard]  },
  { path: 'response-password-reset', component: ResponsePasswordResetComponent, canActivate: [BeforeloginGuard]  },
  { path: 'profile', component: ProfileComponent, canActivate: [AfterloginGuard] },
  { path: 'admin/users', component: UsersComponent, canActivate: [AfterloginGuard, AdminGuard], data: {roles: ['super-admin', 'admin']}},
];

@NgModule({
  declarations: [],
  imports: [
    RouterModule.forRoot(RouteList)
  ]
})
export class AppRoutingModule { }
