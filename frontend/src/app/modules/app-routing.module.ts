import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { LoginComponent } from '../components/auth/login/login.component';

const  Routes: Routes = [
  { path: 'login', component: LoginComponent },
];

@NgModule({
  declarations: [],
  imports: [
    RouterModule.forRoot(Routes)
  ]
})
export class AppRoutingModule { }
