package account

import "cuckoo/domain/entity"

type Remover interface {
	Remove(account entity.Account) error
}

func NewRemover(repository Repository) Remover {
	return &remover{
		repository: repository,
	}
}

type remover struct {
	repository Repository
}

func (r remover) Remove(account entity.Account) error {
	err := r.repository.Remove(account)
	if err != nil {
		return err
	}

	return nil
}
