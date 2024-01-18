package query

type GetAccount struct {
}

func NewGetAccount() GetAccount {
	return GetAccount{}
}

func (g GetAccount) Do() error {
	return nil
}
