
export type Ticket = {
  id: number;
  title: string;
  category: Array<number>;
  status: string;
  created_by: string;
  created_on: string;
  updated_on: string;
  assigned_to: number;
};