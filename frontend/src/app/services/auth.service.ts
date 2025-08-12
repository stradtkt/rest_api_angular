import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {environment} from '../../environments/environment';
import {map, Observable, tap} from 'rxjs';
import {Router} from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private apiUrlAuth = `${environment.apiUrl}/auth`;
  private apiUrlUsers = `${environment.apiUrl}/users`;
  constructor(private http: HttpClient, private router: Router) {}

  register(data: any) {
    return this.http.post(`${this.apiUrlAuth}/register`, data);
  }
  login(email: string, password: string) {
    return this.http.post<any>(`${this.apiUrlAuth}/login`, { email, password })
      .pipe(
        tap(response => {
          localStorage.setItem('auth_token', response.access_token);
        })
      );
  }

  logout(): void {
    this.http.post(`${this.apiUrlAuth}/logout`, {}).subscribe({
      next: (res) => {
        localStorage.removeItem('auth_token');
        this.router.navigate(['/login']).then(r => console.log('redirected to login'));
      },
      error: (err) => console.error(err)
    });
  }
/*  login(email: string, password: string): Observable<any> {
    return this.http.post(`${this.apiUrlAuth}/login`, { email, password });
  }*/

  isAuthenticated(): boolean {
    return !!localStorage.getItem('auth_token');
  }
/*

  logout(): void {
    localStorage.removeItem('auth_token');
  }
*/

  countUsers(): Observable<number> {
    return this.http.get<number>(`${this.apiUrlUsers}/count`);
  }
}
