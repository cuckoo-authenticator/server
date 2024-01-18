package command

import (
	"cuckoo/domain/entity"
	"cuckoo/domain/service/account"
	"github.com/google/uuid"
)

type CreateAccount struct {
	accountCreator account.Creator
}

func NewCreateAccount(accountCreator account.Creator) CreateAccount {
	return CreateAccount{
		accountCreator: accountCreator,
	}
}

func (c CreateAccount) Do(user entity.User, uuid uuid.UUID, secretKey, name, url string) error {
	err := c.accountCreator.Create(user, uuid, secretKey, name, url)
	if err != nil {
		return err
	}

	return nil
}
