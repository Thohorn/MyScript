/**
 * Represents a single todo item.
 */
export interface Todo {
  /** Unique numeric identifier for the todo */
  id: number;
  /** The todo text content */
  text: string;
  /** Completion status */
  completed: boolean;
}
