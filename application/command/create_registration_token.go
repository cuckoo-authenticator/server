package command

import (
	"cuckoo/domain/service/auth"
	"cuckoo/domain/valueobject"
	"github.com/google/uuid"
)

type CreateRegistrationToken struct {
	tokenCreator auth.RegistrationTokenCreator
}

func NewCreateRegistrationToken(tokenCreator auth.RegistrationTokenCreator) CreateRegistrationToken {
	return CreateRegistrationToken{
		tokenCreator: tokenCreator,
	}
}

func (c CreateRegistrationToken) Do(userUUID uuid.UUID) (valueobject.RegistrationToken, error) {
	token, err := c.tokenCreator.Create(userUUID)
	if err != nil {
		return valueobject.RegistrationToken{}, err
	}

	return token, nil
}
