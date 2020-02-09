import { Injectable } from '@angular/core';
import { HttpRequest, HttpHandler, HttpEvent, HttpInterceptor } from '@angular/common/http';
import { Observable } from 'rxjs';
import { TokenService } from '../services/auth/token.service';


@Injectable()
export class JwtInterceptor implements HttpInterceptor {
  constructor(
      private Token: TokenService
  ) {}

  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {

    if (this.Token.loggedIn() && this.Token.get()) {
      request = request.clone({
        setHeaders: {
          Authorization: `Bearer ${this.Token.get()}`
        }
      });
    }

    return next.handle(request);
  }
}
