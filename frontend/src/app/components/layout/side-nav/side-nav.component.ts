import {Component, OnInit} from '@angular/core';
import {AuthService} from '../../../services';

@Component({
  selector: 'app-side-nav',
  standalone: false,
  templateUrl: './side-nav.component.html',
  styleUrl: './side-nav.component.css'
})
export class SideNavComponent implements OnInit {
  today = new Date();
  authenticated: boolean = false;
  constructor(private authService: AuthService) {
  }
  ngOnInit() {
    this.isLoggedIn();
  }
  isLoggedIn() {
    return this.authService.isAuthenticated()
  }
  onLogout() {
    this.authService.logout();
  }
}
