package entity

import "github.com/google/uuid"

type Account struct {
	ID        int
	UUID      uuid.UUID
	Name      string
	SecretKey string
	URL       string

	UserID int
	User   User
}
