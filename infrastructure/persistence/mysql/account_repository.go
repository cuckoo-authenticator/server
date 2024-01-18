package mysql

import (
	"cuckoo/domain/entity"
	domainError "cuckoo/domain/error"
	"errors"
	"github.com/google/uuid"
	"gorm.io/gorm"
)

type AccountRepository struct {
	db *gorm.DB
}

func NewAccountRepository(db *gorm.DB) AccountRepository {
	return AccountRepository{
		db: db,
	}
}

func (a AccountRepository) Add(account entity.Account) error {
	result := a.db.Create(&account)
	if result.Error != nil {
		return result.Error
	}

	return nil
}

func (a AccountRepository) Remove(account entity.Account) error {
	result := a.db.Delete(&account)
	if result.Error != nil {
		return result.Error
	}

	return nil
}

func (a AccountRepository) GetByUUID(UUID uuid.UUID) (entity.Account, error) {
	var account entity.Account
	result := a.db.Where("uuid = ?", UUID).First(&account)

	if errors.Is(result.Error, gorm.ErrRecordNotFound) {
		return account, domainError.NewAccountNotFoundErr().WithUUID(UUID)
	}

	if result.Error != nil {
		return account, result.Error
	}

	return account, nil
}

func (a AccountRepository) GetByUser(user entity.User) ([]entity.Account, error) {
	var accounts []entity.Account
	result := a.db.Where("user_id = ?", user.ID).Find(&accounts)
	if result.Error != nil {
		return accounts, result.Error
	}

	return accounts, nil
}
