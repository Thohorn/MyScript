
export type Ticket = {
  id: number;
  title: string;
  category: number;
  status: string;
  created_by: number;
  created_at: Date;
  updated_at: Date;
  assigned_to: number;
};