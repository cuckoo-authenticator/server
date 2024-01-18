package account

import (
	"cuckoo/domain/entity"
	"github.com/google/uuid"
)

type Repository interface {
	Add(account entity.Account) error
	Remove(account entity.Account) error
	GetByUUID(UUID uuid.UUID) (entity.Account, error)
	GetByUser(user entity.User) ([]entity.Account, error)
}
