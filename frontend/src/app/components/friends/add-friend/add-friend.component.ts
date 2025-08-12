import {Component, OnInit} from '@angular/core';
import {Friendships} from '../../../models/friendships';
import {FriendShipService} from '../../../services';
import {Router} from '@angular/router';
import {Users} from '../../../models/users';

@Component({
  selector: 'app-add-friend',
  standalone: false,
  templateUrl: './add-friend.component.html',
  styleUrl: './add-friend.component.css'
})
export class AddFriendComponent implements OnInit {
  availableUsers: Users[] = [];
  selectedUserId: number | null = null;
  currentUserId: number = 1;
  message: string = '';
  isLoading: boolean = false;

  constructor(
    private friendshipService: FriendShipService,
    private router: Router
  ) {}

  ngOnInit() {
    this.loadAvailableUsers();
  }

  loadAvailableUsers() {
    this.friendshipService.getAvailableFriends(this.currentUserId).subscribe({
      next: (data) => {
        this.availableUsers = data;
      },
      error: (err) => {
        console.error(err);
      }
    })

  }

  addFriend() {
    if (!this.selectedUserId) {
      this.message = 'Please select a user to add';
      return;
    }

    this.isLoading = true;
    this.message = '';

    this.friendshipService.sendRequest(this.currentUserId, this.selectedUserId)
      .subscribe({
        next: (response: Friendships) => {
          this.isLoading = false;
          this.message = `Friend request sent to user ID ${this.selectedUserId}`;
          this.selectedUserId = null;
          this.loadAvailableUsers();
        },
        error: (err) => {
          this.isLoading = false;
          console.error(err);
          this.message = 'Error sending friend request';
        }
      });
  }
}
