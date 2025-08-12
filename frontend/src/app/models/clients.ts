import {Users} from './users';
import {Jobs} from './jobs';


export interface Clients {
  id: number;
  user_id: number;
  user: Users;
  name: string;
  email: string;
  phone: string;
  company_name: string;
  industry: string;
  address: string;
  city: string;
  state: string;
  postal_code: string;
  country: string;
  notes: string;
  created_at: Date;
  updated_at: Date;
  jobs: Jobs[];
}
