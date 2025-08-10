import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {environment} from '../../environments/environment';
import {map, Observable} from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private apiUrlAuth = `${environment.apiUrl}/auth`;
  private apiUrlUsers = `${environment.apiUrl}/users`;
  constructor(private http: HttpClient) {}

  register(data: any) {
    return this.http.post(`${this.apiUrlAuth}/register`, data);
  }

  login(email: string, password: string): Observable<any> {
    return this.http.post(`${this.apiUrlAuth}/login`, { email, password });
  }

  isAuthenticated(): boolean {
    return !!localStorage.getItem('auth_token');
  }

  logout(): void {
    localStorage.removeItem('auth_token');
  }

  countUsers(): Observable<number> {
    return this.http.get<{ count: number }>(`${this.apiUrlUsers}/count`)
      .pipe(map(response => response.count));
  }
}
