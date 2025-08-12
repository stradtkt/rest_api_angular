import { Injectable } from '@angular/core';
import {environment} from '../../environments/environment';
import {HttpClient} from '@angular/common/http';
import {Posts} from '../models/Blog';
import {Observable} from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class BlogService {
  private apiUrlPosts = `${environment.apiUrl}/posts`;
  private apiUrlComments = `${environment.apiUrl}/comments`;
  constructor(private http: HttpClient) { }


  countPosts() {
    return this.http.get<number>(`${this.apiUrlPosts}/count`);
  }

  countComments() {
    return this.http.get<number>(`${this.apiUrlComments}/count`);
  }
  createPost(postData: { user_id: number; title: string; content: string }): Observable<any> {
    return this.http.post<Posts>(this.apiUrlPosts, postData);
  }
  showPost(id: number) {
    return this.http.get<Posts>(`${this.apiUrlPosts}/${id}`);
  }
  listPosts() {
    return this.http.get<Posts[]>(`${this.apiUrlPosts}`);
  }
}
