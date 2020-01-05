import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { LoginComponent } from '../components/auth/login/login.component';
import { ProfileComponent } from "../components/profile/profile.component";

const  Routes: Routes = [
  { path: 'login', component: LoginComponent },
  { path: 'profile', component: ProfileComponent },
];

@NgModule({
  declarations: [],
  imports: [
    RouterModule.forRoot(Routes)
  ]
})
export class AppRoutingModule { }
