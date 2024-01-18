package command

import (
	"cuckoo/domain/service/auth"
	"github.com/google/uuid"
)

type CreateUser struct {
	UserCreator auth.UserCreator
}

func NewCreateUser(userCreator auth.UserCreator) CreateUser {
	return CreateUser{
		UserCreator: userCreator,
	}
}

func (c CreateUser) Do(userUUID uuid.UUID, registrationToken, authenticationToken, wrappedVaultKey string) error {
	err := c.UserCreator.Create(userUUID, registrationToken, authenticationToken, wrappedVaultKey)
	if err != nil {
		return err
	}

	return nil
}
