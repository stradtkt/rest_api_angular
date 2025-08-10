import {Component, OnInit} from '@angular/core';
import {Router} from '@angular/router';
import {AuthService} from '../../../services';

@Component({
  selector: 'app-dashboard',
  standalone: false,
  templateUrl: './dashboard.component.html',
  styleUrl: './dashboard.component.css'
})
export class DashboardComponent implements OnInit {
  userCount!: number;
  constructor(private authService: AuthService, private route: Router) { }
  ngOnInit() {
    this.countAppUsers();
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
}
