import { Injectable } from '@angular/core';
import { HttpRequest, HttpHandler, HttpEvent, HttpInterceptor } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { LogoutService } from '../services/auth/logout.service';


@Injectable()
export class ErrorInterceptor implements HttpInterceptor {
  constructor(
    private Logout: LogoutService
  ) { }

  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    return next.handle(request).pipe(catchError(err => {
      if (err.status === 401) {
        this.Logout.handleResponse();
      }
      return throwError(err);
    }))
  }
}
