import {Users} from './users';


export interface Friendships {
  id: number;
  sender_id: number;
  sender: Users;
  receiver_id: number;
  receiver: Users;
  status: 'pending' | 'accepted' | 'denied';
  created_at: Date;
  updated_at: Date;
}
