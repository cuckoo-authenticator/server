package valueobject

import "github.com/google/uuid"

type RegistrationToken struct {
	Token    string
	UserUUID uuid.UUID
}
