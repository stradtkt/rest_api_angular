import {Component, OnInit} from '@angular/core';
import {Router} from '@angular/router';
import {AuthService, BlogService} from '../../../services';

@Component({
  selector: 'app-dashboard',
  standalone: false,
  templateUrl: './dashboard.component.html',
  styleUrl: './dashboard.component.css'
})
export class DashboardComponent implements OnInit {
  userCount: number = 0;
  postCount = 0;
  commentCount: number = 0;
  constructor(private authService: AuthService, private blogService: BlogService, private route: Router) { }
  ngOnInit() {
    this.countAppUsers();
    this.countPosts();
    this.countComments();
  }

  countAppUsers() {
    this.authService.countUsers().subscribe({
      next: (data) => {
        this.userCount = data;
      },
      error: (err) => {
        console.log(err);
      },
    })
  }

  countPosts() {
    this.blogService.countPosts().subscribe({
      next: (data) => {
        this.postCount = data;
      },
      error: (err) => {
        console.log(err);
      },
    })
  }

  countComments() {
    this.blogService.countComments().subscribe({
      next: (data) => {
        this.commentCount = data;
      },
      error: (err) => {
        console.log(err);
      },
    })
  }
}
