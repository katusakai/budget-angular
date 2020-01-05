import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { BeforeLoginService } from "../services/auth/before-login.service";
import { AfterLoginService } from "../services/auth/after-login.service";

import { LoginComponent } from '../components/auth/login/login.component';
import { ProfileComponent } from "../components/profile/profile.component";

const  Routes: Routes = [
  { path: 'login', component: LoginComponent,  canActivate: [BeforeLoginService]  },
  { path: 'profile', component: ProfileComponent, canActivate: [AfterLoginService] },
];

@NgModule({
  declarations: [],
  imports: [
    RouterModule.forRoot(Routes)
  ]
})
export class AppRoutingModule { }
