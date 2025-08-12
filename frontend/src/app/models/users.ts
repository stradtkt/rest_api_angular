import {Comments, Posts} from './Blog';
import {Clients} from './clients';
import {Friendships} from './friendships';


export interface Users {
  id: number;
  avatar: string;
  username: string;
  name: string;
  email: string;
  password: string;
  bio: string;
  dob: Date;
  remember_token: string;
  email_verified_at: Date;
  created_at: Date;
  updated_at: Date;
  roles: UserRoles[];
  friendships: Friendships[];
  posts: Posts[];
  comments: Comments[];
  clients: Clients[];
}

export interface Role {
  id: string;
  name: string;
  description: string;
}

export interface UserRoles {
  id: number;
  user_id: number;
  user: Users;
  role_id: string;
  role: Role;
}
