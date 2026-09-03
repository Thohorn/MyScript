
export type Ticket = {
  id?: number;
  title: string;
  body: string;
  category_id: number;
  status?: string;
  user_id: number;
  created_at?: string;
  updated_at?: string;
  assigned_to?: number;
};