package account

import (
	"cuckoo/domain/entity"
	"github.com/google/uuid"
)

type Creator interface {
	Create(user entity.User, uuid uuid.UUID, secretKey, name, url string) error
}

type creator struct {
	repository Repository
}

func NewCreator(repository Repository) Creator {
	return creator{
		repository: repository,
	}
}

func (c creator) Create(user entity.User, uuid uuid.UUID, secretKey, name, url string) error {
	account := entity.Account{
		User:      user,
		UUID:      uuid,
		SecretKey: secretKey,
		Name:      name,
		URL:       url,
	}

	err := c.repository.Add(account)
	if err != nil {
		return err
	}

	return nil
}
