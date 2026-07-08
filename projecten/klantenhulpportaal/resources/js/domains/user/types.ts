export type User = {
    id: number,
    name: string,
    surname: string,
    email: string,
    email_verified_at: string,
    phone_number: string,
    role: "user" | "admin",
    created_at: string,
    updated_at: string
}