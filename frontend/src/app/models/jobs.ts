import {Users} from './users';
import {Clients} from './clients';


export interface Jobs {
  id: number;
  user_id: number;
  user: Users;
  client_id: number;
  client: Clients;
  title: string;
  description: string;
  status: 'pending' | 'completed' | 'cancelled';
  start_date: Date;
  due_date: Date;
  budget: number;
  amount_spent: number;
  priority: 'low' | 'medium' | 'high';
  location: string;
  created_at: Date;
}
