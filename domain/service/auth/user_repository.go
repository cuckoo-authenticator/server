package auth

import "cuckoo/domain/entity"

type UserRepository interface {
	Add(user entity.User) error
	GetByAuthenticationToken(authenticationToken string) (entity.User, error)
}
