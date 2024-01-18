package auth

import (
	"cuckoo/domain/valueobject"
	"github.com/google/uuid"
	"math/rand"
	"time"
	"unsafe"
)

func NewRegistrationTokenCreator(repository RegistrationTokenRepository) RegistrationTokenCreator {
	return registrationTokenCreator{
		repository: repository,
	}
}

type RegistrationTokenCreator interface {
	Create(userUUID uuid.UUID) (valueobject.RegistrationToken, error)
}

type registrationTokenCreator struct {
	repository RegistrationTokenRepository
}

func (r registrationTokenCreator) Create(userUUID uuid.UUID) (valueobject.RegistrationToken, error) {
	token := valueobject.RegistrationToken{
		Token:    randString(16),
		UserUUID: userUUID,
	}

	err := r.repository.Add(token)
	if err != nil {
		return valueobject.RegistrationToken{}, err
	}

	return token, nil
}

func randString(n int) string {
	const letterBytes = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"
	const (
		letterIdxBits = 6                    // 6 bits to represent a letter index
		letterIdxMask = 1<<letterIdxBits - 1 // All 1-bits, as many as letterIdxBits
		letterIdxMax  = 63 / letterIdxBits   // # of letter indices fitting in 63 bits
	)
	var src = rand.NewSource(time.Now().UnixNano())

	b := make([]byte, n)
	// A src.Int63() generates 63 random bits, enough for letterIdxMax characters!
	for i, cache, remain := n-1, src.Int63(), letterIdxMax; i >= 0; {
		if remain == 0 {
			cache, remain = src.Int63(), letterIdxMax
		}
		if idx := int(cache & letterIdxMask); idx < len(letterBytes) {
			b[i] = letterBytes[idx]
			i--
		}
		cache >>= letterIdxBits
		remain--
	}

	return *(*string)(unsafe.Pointer(&b))
}
