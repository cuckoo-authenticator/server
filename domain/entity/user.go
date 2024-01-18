package entity

import (
	"github.com/google/uuid"
)

type User struct {
	ID                  int
	UUID                uuid.UUID
	AuthenticationToken string
	WrappedVaultKey     string

	Accounts []Account
}
