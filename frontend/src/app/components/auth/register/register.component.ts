import {Component, OnInit} from '@angular/core';
import {AuthService} from '../../../services';
import {FormBuilder, FormGroup, Validators} from '@angular/forms';
import {ActivatedRoute, Router} from '@angular/router';

@Component({
  selector: 'app-register',
  standalone: false,
  templateUrl: './register.component.html',
  styleUrl: './register.component.css'
})
export class RegisterComponent implements OnInit {
  registerForm: FormGroup;
  showPassword = false;
  showConfirmPassword = false;
  passwordMismatch = false;
  password: string = '';
  confirmPassword: string = '';


  constructor(private fb: FormBuilder, private authService: AuthService, private router: Router) {
    this.registerForm = this.fb.group({
      name: ['', Validators.required],
      username: ['', Validators.required],
      email: ['', [Validators.required, Validators.email]],
      password: ['', [Validators.required, Validators.minLength(6)]],
      confirm_password: ['', Validators.required]
    });
  }

  ngOnInit(): void {
  }
  togglePassword() {
    this.showPassword = !this.showPassword;
  }
  toggleConfirmPasswordVisibility() {
    this.showConfirmPassword = !this.showConfirmPassword;
  }
  passwordsMatch(): boolean {
    const password = this.registerForm.get('password')?.value;
    const confirmPassword = this.registerForm.get('confirm_password')?.value;
    return password && confirmPassword && password === confirmPassword;
  }

  onSubmit() {
    const {password, confirm_password} = this.registerForm.value;

    if (password !== confirm_password) {
      this.passwordMismatch = true;
      return;
    }

    this.passwordMismatch = false;
    const formData = {...this.registerForm.value};
    delete formData.confirm_password;
    console.log('Registering user:', formData);

    this.authService.register(formData).subscribe({
      next: res => {
        console.log('Registered user!', res);
        this.router.navigate(['/login']).then(l => console.log('Navigated to login page!'));
      },
      error: err => console.error(err)
    })
  }
}
