import {Component, Input, OnInit} from '@angular/core';
import {FormBuilder, FormGroup, Validators} from '@angular/forms';
import {HttpClient} from '@angular/common/http';
import {BlogService} from '../../../../services';
import {Router} from '@angular/router';

@Component({
  selector: 'app-post-create',
  standalone: false,
  templateUrl: './post-create.component.html',
  styleUrl: './post-create.component.css'
})
export class PostCreateComponent implements OnInit{
  @Input() userId!: number;

  postForm!: FormGroup;
  submitting = false;
  successMessage = '';
  errorMessage = '';
  toolbarOptions = {};
  constructor(private fb: FormBuilder, private blogService: BlogService, private router: Router) {}

  ngOnInit() {
    this.postForm = this.fb.group({
      title: ['', [Validators.required, Validators.minLength(3)]],
      content: ['', Validators.required]
    });
    this.toolbarOptions = [
      ['bold', 'italic', 'underline', 'strike'],
      ['blockquote', 'code-block'],
      [{ 'header': 1 }, { 'header': 2 }],
      [{ 'list': 'ordered'}, { 'list': 'bullet' }],
      [{ 'script': 'sub'}, { 'script': 'super' }],
      [{ 'indent': '-1'}, { 'indent': '+1' }],
      [{ 'direction': 'rtl' }],

      [{ 'size': ['small', false, 'large', 'huge'] }],
      [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

      [{ 'color': [] }, { 'background': [] }],
      [{ 'font': [] }],
      [{ 'align': [] }],

      ['clean'],

      ['link', 'image', 'video']
    ];
  }

  onSubmit() {
    if (this.postForm.invalid) {
      this.errorMessage = 'Please fill all required fields correctly.';
      return;
    }

    this.submitting = true;
    this.errorMessage = '';
    this.successMessage = '';

    const postData = {
      user_id: this.userId,
      title: this.postForm.value.title,
      content: this.postForm.value.content
    };

    this.blogService.createPost(postData).subscribe({
      next: (data) => {
        console.log(`Created post: \n Title:  ${data.title} \n Content: ${data.content} \n User ID: ${data.user_id}`);
        this.successMessage = 'Post created successfully!';
        this.postForm.reset(
          {
            title: '',
            content: ''
          }
        );
        this.router.navigate(['/dashboard'])
          .then(r => console.log('Successfully added post, navigating to post now.'));
        this.submitting = false;
      },
      error: (err) => {
        this.errorMessage = err.error?.message || 'Error creating post.';
        this.submitting = false;
      }
    });
  }
}
