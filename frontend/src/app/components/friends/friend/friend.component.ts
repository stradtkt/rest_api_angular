import {Component, OnInit} from '@angular/core';
import {FriendShipService} from '../../../services';
import {FriendShips} from '../../../models/users';

@Component({
  selector: 'app-friend',
  standalone: false,
  templateUrl: './friend.component.html',
  styleUrl: './friend.component.css'
})
export class FriendComponent implements OnInit {
  friends: FriendShips[] = [];
  pendingRequests: FriendShips[] = [];
  newFriendId: number | null = null;
  errorMessage: string = '';
  successMessage: string = '';

  constructor(private friendshipService: FriendShipService) {}

  ngOnInit() {
    this.loadFriends();
    this.loadPendingRequests();
  }

  loadFriends() {
    this.friendshipService.listFriends().subscribe({
      next: data => this.friends = data,
      error: err => console.error(err)
    });
  }

  loadPendingRequests() {
    this.friendshipService.listPendingRequests().subscribe({
      next: data => this.pendingRequests = data,
      error: err => console.error(err)
    });
  }

  sendFriendRequest() {
    if (!this.newFriendId) {
      this.errorMessage = 'Please enter a valid user ID';
      return;
    }
    this.errorMessage = '';
    this.successMessage = '';
    this.friendshipService.sendRequest(0, this.newFriendId).subscribe({
      next: res => {
        this.successMessage = 'Friend request sent';
        this.newFriendId = null;
        this.loadPendingRequests();
      },
      error: err => this.errorMessage = err.error?.message || 'Error sending request'
    });
  }

  acceptRequest(friendshipId: number) {
    this.friendshipService.acceptRequest(friendshipId).subscribe({
      next: () => {
        this.loadFriends();
        this.loadPendingRequests();
      },
      error: err => console.error(err)
    });
  }

  denyRequest(friendshipId: number) {
    this.friendshipService.denyRequest(friendshipId).subscribe({
      next: () => this.loadPendingRequests(),
      error: err => console.error(err)
    });
  }
}
