package mysql

import (
	"cuckoo/domain/entity"
	"gorm.io/gorm"
)

type UserRepository struct {
	db *gorm.DB
}

func NewUserRepository(db *gorm.DB) UserRepository {
	return UserRepository{
		db: db,
	}
}

func (u UserRepository) Add(user entity.User) error {
	result := u.db.Create(&user)
	if result.Error != nil {
		return result.Error
	}

	return nil
}

func (u UserRepository) GetByAuthenticationToken(authenticationToken string) (entity.User, error) {
	var user entity.User
	result := u.db.Where("authentication_token = ?", authenticationToken).First(&user)
	if result.Error != nil {
		return entity.User{}, result.Error
	}

	return user, nil
}
