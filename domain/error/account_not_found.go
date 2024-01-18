package error

import (
	"fmt"
	"github.com/google/uuid"
)

func NewAccountNotFoundErr() (err AccountNotFoundErr) {
	return err
}

type AccountNotFoundErr struct {
	message string
}

func (e AccountNotFoundErr) WithUUID(UUID uuid.UUID) AccountNotFoundErr {
	e.message = fmt.Sprintf("account with uuid: %s not found", UUID.String())
	return e
}

func (e AccountNotFoundErr) Error() string {
	return e.message
}
