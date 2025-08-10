import {WindowService} from './window.service';
import {AuthService} from './auth.service';
import {BlogService} from './blog.service';

export const services: any[] = [
  WindowService,
  AuthService,
  BlogService
];

export * from './auth.service';
export * from './window.service';
export * from './blog.service';
