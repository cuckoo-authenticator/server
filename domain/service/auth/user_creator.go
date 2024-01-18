package auth

import (
	"cuckoo/domain/entity"
	"cuckoo/domain/valueobject"

	"github.com/google/uuid"
)

type UserCreator interface {
	Create(userUUID uuid.UUID, registrationToken, authenticationToken, wrappedVaultKey string) error
}
type userCreator struct {
	userRepository              UserRepository
	registrationTokenRepository RegistrationTokenRepository
}

func NewUserService(userRepository UserRepository, registrationTokenRepository RegistrationTokenRepository) UserCreator {
	return userCreator{
		userRepository:              userRepository,
		registrationTokenRepository: registrationTokenRepository,
	}
}

func (u userCreator) Create(userUUID uuid.UUID, registrationToken, authenticationToken, wrappedVaultKey string) error {
	token := valueobject.RegistrationToken{
		Token:    registrationToken,
		UserUUID: userUUID,
	}

	err := u.registrationTokenRepository.Validate(token)
	if err != nil {
		return err
	}

	user := entity.User{
		UUID:                userUUID,
		AuthenticationToken: authenticationToken,
		WrappedVaultKey:     wrappedVaultKey,
	}

	err = u.userRepository.Add(user)
	if err != nil {
		return err
	}

	return nil
}
