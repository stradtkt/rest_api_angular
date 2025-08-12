import {Users} from './users';


export interface Posts {
  id: number;
   title: string;
   content: string;
   user_id: number;
   user: Users;
   created_at: Date;
   updated_at: Date;
   comments: Comments[];
}

export interface Comments {
  id: number;
  post_id: number;
  post: Posts;
  user_id: number;
  user: Users;
  content: string;
  created_at: Date;
  updated_at: Date;
}
