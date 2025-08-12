import {WindowService} from './window.service';
import {AuthService} from './auth.service';
import {BlogService} from './blog.service';
import {FriendShipService} from './friendship.service';
import {ClientService} from './client.service';
import {JobService} from './job.service';


export const services: any[] = [
  WindowService,
  AuthService,
  BlogService,
  FriendShipService,
  ClientService,
  JobService,
];

export * from './auth.service';
export * from './window.service';
export * from './blog.service';
export * from './friendship.service';
export * from './client.service';
export * from './job.service';
