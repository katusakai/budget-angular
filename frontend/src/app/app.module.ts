import { BrowserModule, Title } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import { HTTP_INTERCEPTORS, HttpClientModule } from '@angular/common/http';
import { AppRoutingModule } from './modules/app-routing.module';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap'
import { MoneyModule} from './modules/money.module';

import { AppComponent } from './app.component';
import { NavbarComponent } from './components/navbar/navbar.component';
import { LoginComponent } from './components/auth/login/login.component';
import { ProfileComponent } from './components/profile/profile.component';
import { RegisterComponent } from './components/auth/register/register.component';
import { JwtInterceptor } from './helpers/jwt.interceptor';
import { ErrorInterceptor } from './helpers/error.interceptor';
import { RequestPasswordResetComponent } from './components/auth/request-password-reset/request-password-reset.component';
import { ResponsePasswordResetComponent } from './components/auth/response-password-reset/response-password-reset.component';
import { AppSocialLoginModule } from './modules/app-social-login.module';
import { GoogleComponent } from './components/auth/social/google/google.component';
import { UsersComponent } from './components/admin/users/users.component';
import { RolesComponent } from './components/admin/users/roles/roles.component';
import { ConfigurationComponent } from './components/admin/configuration/configuration.component';
import { TrueFalseConfigurationComponent } from './components/admin/configuration/true-false-configuration/true-false-configuration.component';
import { FacebookComponent } from './components/auth/social/facebook/facebook.component';
import { AppFormModule } from './modules/app-form.module';


@NgModule({
  declarations: [
    AppComponent,
    NavbarComponent,
    LoginComponent,
    ProfileComponent,
    RegisterComponent,
    RequestPasswordResetComponent,
    ResponsePasswordResetComponent,
    GoogleComponent,
    UsersComponent,
    RolesComponent,
    ConfigurationComponent,
    TrueFalseConfigurationComponent,
    FacebookComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    RouterModule,
    HttpClientModule,
    AppSocialLoginModule,
    NgbModule,
    MoneyModule,
    AppFormModule
  ],
  providers: [
    Title,
    {provide: HTTP_INTERCEPTORS, useClass: JwtInterceptor, multi: true},
    {provide: HTTP_INTERCEPTORS, useClass: ErrorInterceptor, multi: true},
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
