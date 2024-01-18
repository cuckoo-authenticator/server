package auth

import "cuckoo/domain/valueobject"

type RegistrationTokenRepository interface {
	Add(token valueobject.RegistrationToken) error
	Validate(token valueobject.RegistrationToken) error
}
