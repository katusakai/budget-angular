import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { BeforeLoginService } from "../services/auth/before-login.service";
import { AfterLoginService } from "../services/auth/after-login.service";

import { LoginComponent } from '../components/auth/login/login.component';
import { ProfileComponent } from "../components/profile/profile.component";
import { RegisterComponent } from "../components/auth/register/register.component";
import { RequestPasswordResetComponent } from "../components/auth/request-password-reset/request-password-reset.component";
import { ResponsePasswordResetComponent } from "../components/auth/response-password-reset/response-password-reset.component"

const  RouteList: Routes = [
  { path: 'login', component: LoginComponent,  canActivate: [BeforeLoginService]  },
  { path: 'register', component: RegisterComponent,  canActivate: [BeforeLoginService]  },
  { path: 'request-password-reset', component: RequestPasswordResetComponent, canActivate: [BeforeLoginService]  },
  { path: 'response-password-reset', component: ResponsePasswordResetComponent, canActivate: [BeforeLoginService]  },
  { path: 'profile', component: ProfileComponent, canActivate: [AfterLoginService] },
];

@NgModule({
  declarations: [],
  imports: [
    RouterModule.forRoot(RouteList)
  ]
})
export class AppRoutingModule { }
