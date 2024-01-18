package error

import (
	"cuckoo/domain/valueobject"
	"fmt"
)

func NewRegistrationTokenNotValidErr() (err RegistrationTokenNotValidErr) {
	return err
}

type RegistrationTokenNotValidErr struct {
	message string
}

func (e RegistrationTokenNotValidErr) WithToken(token valueobject.RegistrationToken) RegistrationTokenNotValidErr {
	e.message = fmt.Sprintf("registration token: %s not valid for user id: %s", token.Token, token.UserUUID.String())
	return e
}

func (e RegistrationTokenNotValidErr) Error() string {
	return e.message
}
