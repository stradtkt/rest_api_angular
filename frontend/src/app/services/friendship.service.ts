import { Injectable } from '@angular/core';
import {map, Observable} from 'rxjs';
import {HttpClient} from '@angular/common/http';
import {environment} from '../../environments/environment';
import {Friendships} from '../models/friendships';
import {Users} from '../models/users';

@Injectable({
  providedIn: 'root'
})
export class FriendShipService {
  private apiUrl = `${environment.apiUrl}/friends`;

  constructor(private http: HttpClient) { }

  sendRequest(senderId: number, receiverId: number): Observable<Friendships> {
    return this.http.post<Friendships>(this.apiUrl, {
      sender_id: senderId,
      receiver_id: receiverId,
      status: 'pending'
    });
  }

  acceptRequest(id: number): Observable<Friendships> {
    return this.http.put<Friendships>(`${this.apiUrl}/${id}`, { status: 'accepted' });
  }

  declineRequest(id: number): Observable<Friendships> {
    return this.http.put<Friendships>(`${this.apiUrl}/${id}`, { status: 'declined' });
  }

  removeFriendship(id: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}/${id}`);
  }
  getAllFriendships(): Observable<Friendships[]> {
    return this.http.get<Friendships[]>(this.apiUrl);
  }

  getFriendshipsByUser(userId: number): Observable<Friendships[]> {
    return this.http.get<Friendships[]>(`${this.apiUrl}/user/${userId}`);
  }
  getAvailableFriends(userId: number): Observable<Users[]> {
    return this.http.get<Users[]>(`${this.apiUrl}/available/${userId}`);
  }
}
