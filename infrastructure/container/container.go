package container

import (
	"cuckoo/application/command"
	"cuckoo/domain/service/account"
	"cuckoo/domain/service/auth"
	"cuckoo/infrastructure/persistence/memcached"
	"cuckoo/infrastructure/persistence/mysql"

	"github.com/bradfitz/gomemcache/memcache"
	"gorm.io/gorm"
)

type Container interface {
	GetCreateRegistrationTokenCommand() command.CreateRegistrationToken
	GetCreateUserCommand() command.CreateUser
	GetCreateAccountCommand() command.CreateAccount
	GetRemoveAccountCommand() command.RemoveAccount

	GetRegistrationTokenCreator() auth.RegistrationTokenCreator
	GetUserCreator() auth.UserCreator
	GetAccountCreator() account.Creator
	GetAccountRemover() account.Remover

	GetRegistrationTokenRepository() auth.RegistrationTokenRepository
	GetUserRepository() auth.UserRepository
	GetAccountRepository() account.Repository
}

var instance *container

type container struct {
	mc     *memcache.Client
	db     *gorm.DB
	config *Config
}

func GetContainer() (Container, error) {
	instance = &container{}
	instance.config = getConfig()
	instance.mc = createMemcachedClient("127.0.0.1", "11211")
	instance.db = createDBConnection(instance.config)

	return instance, nil
}

func (c *container) GetRegistrationTokenCreator() auth.RegistrationTokenCreator {
	return auth.NewRegistrationTokenCreator(c.GetRegistrationTokenRepository())
}

func (c *container) GetRegistrationTokenRepository() auth.RegistrationTokenRepository {
	return memcached.NewRegistrationTokenRepository(c.mc, 30)
}

func (c *container) GetUserCreator() auth.UserCreator {
	return auth.NewUserService(
		c.GetUserRepository(),
		c.GetRegistrationTokenRepository(),
	)
}

func (c *container) GetUserRepository() auth.UserRepository {
	return mysql.NewUserRepository(c.db)
}

func (c *container) GetCreateRegistrationTokenCommand() command.CreateRegistrationToken {
	return command.NewCreateRegistrationToken(
		c.GetRegistrationTokenCreator(),
	)
}

func (c *container) GetCreateUserCommand() command.CreateUser {
	return command.NewCreateUser(c.GetUserCreator())
}

func (c *container) GetCreateAccountCommand() command.CreateAccount {
	return command.NewCreateAccount(c.GetAccountCreator())
}

func (c *container) GetAccountCreator() account.Creator {
	return account.NewCreator(c.GetAccountRepository())
}

func (c *container) GetAccountRepository() account.Repository {
	return mysql.NewAccountRepository(c.db)
}

func (c *container) GetAccountRemover() account.Remover {
	return account.NewRemover(c.GetAccountRepository())
}

func (c *container) GetRemoveAccountCommand() command.RemoveAccount {
	return command.NewRemoveAccount(c.GetAccountRemover())
}
