import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { BeforeLoginService } from "../services/auth/before-login.service";
import { AfterLoginService } from "../services/auth/after-login.service";

import { LoginComponent } from '../components/auth/login/login.component';
import { ProfileComponent } from "../components/profile/profile.component";
import { RegisterComponent } from "../components/auth/register/register.component";

const  RouteList: Routes = [
  { path: 'login', component: LoginComponent,  canActivate: [BeforeLoginService]  },
  { path: 'register', component: RegisterComponent,  canActivate: [BeforeLoginService]  },
  { path: 'profile', component: ProfileComponent, canActivate: [AfterLoginService] },
];

@NgModule({
  declarations: [],
  imports: [
    RouterModule.forRoot(RouteList)
  ]
})
export class AppRoutingModule { }
