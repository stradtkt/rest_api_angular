import {Component, OnInit} from '@angular/core';
import {FormBuilder, FormGroup, Validators} from '@angular/forms';
import {AuthService} from '../../../services/auth.service';
import {Router} from '@angular/router';

@Component({
  selector: 'app-login',
  standalone: false,
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent implements OnInit {
  loginForm!: FormGroup;
  showPassword = false;
  loginError: string = '';
  constructor(private fb: FormBuilder, private authService: AuthService, private router: Router) {}

  ngOnInit(): void {
    this.loginForm = this.fb.group({
      email: ['', [Validators.required, Validators.email]],
      password: ['', Validators.required]
    });
  }
  togglePassword() {
    this.showPassword = !this.showPassword;
  }
  onSubmit(): void {
    if (this.loginForm.invalid) {
      return;
    }

    const { email, password } = this.loginForm.value;

    this.authService.login(email, password).subscribe({
      next: (response) => {
        localStorage.setItem('token', response.token); // assuming { token: '...' }
        this.router.navigate(['/dashboard']).then(d => console.log('Successfully logged in, sending you to dashboard.')); // redirect to protected route
      },
      error: (err) => {
        this.loginError = 'Invalid email or password';
        console.error(err);
      }
    });
  }
}
