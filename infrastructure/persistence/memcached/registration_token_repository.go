package memcached

import (
	domainError "cuckoo/domain/error"
	"cuckoo/domain/service/auth"
	"cuckoo/domain/valueobject"

	"github.com/bradfitz/gomemcache/memcache"
)

type RegistrationTokenRepository struct {
	mc     *memcache.Client
	expiry int32
}

func NewRegistrationTokenRepository(mc *memcache.Client, expiry int32) auth.RegistrationTokenRepository {
	return RegistrationTokenRepository{
		mc:     mc,
		expiry: expiry,
	}
}

func (r RegistrationTokenRepository) Add(token valueobject.RegistrationToken) error {
	err := r.mc.Set(&memcache.Item{Key: token.Token, Value: []byte(token.UserUUID.String()), Expiration: r.expiry})
	if err != nil {
		return err
	}

	return nil
}

func (r RegistrationTokenRepository) Validate(token valueobject.RegistrationToken) error {
	record, err := r.mc.Get(token.Token)
	if err != nil {
		return err
	}

	if string(record.Value) != token.UserUUID.String() {
		return domainError.NewRegistrationTokenNotValidErr().WithToken(token)
	}

	return nil
}
