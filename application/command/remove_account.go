package command

import (
	"cuckoo/domain/entity"
	"cuckoo/domain/service/account"
)

type RemoveAccount struct {
	accountRemover account.Remover
}

func NewRemoveAccount(accountRemover account.Remover) RemoveAccount {
	return RemoveAccount{
		accountRemover: accountRemover,
	}
}

func (r RemoveAccount) Do(a entity.Account) error {
	err := r.accountRemover.Remove(a)
	if err != nil {
		return err
	}

	return nil
}
