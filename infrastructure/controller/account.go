package controller

import (
	"cuckoo/domain/entity"
	"cuckoo/infrastructure/container"
	"github.com/google/uuid"
	"github.com/labstack/echo/v4"
	"net/http"
)

type Account struct {
}

func NewAccount() Account {
	return Account{}
}

func (a Account) Create(ctx echo.Context, c container.Container, user entity.User) error {
	request := createAccountRequest{}
	err := ctx.Bind(&request)
	if err != nil {
		return echo.ErrBadRequest.SetInternal(err)
	}

	UUID, err := uuid.Parse(request.UUID)
	if err != nil {
		return echo.ErrBadRequest.SetInternal(err)
	}

	command := c.GetCreateAccountCommand()

	err = command.Do(user, UUID, request.SecretKey, request.Name, request.URL)
	if err != nil {
		return err
	}

	return ctx.JSON(http.StatusCreated, nil)
}

type createAccountRequest struct {
	UUID      string `json:"id"`
	SecretKey string `json:"secret_key"`
	Name      string `json:"name"`
	URL       string `json:"url"`
}

func (a Account) Remove(ctx echo.Context, c container.Container, account entity.Account) error {
	command := c.GetRemoveAccountCommand()

	err := command.Do(account)
	if err != nil {
		return err
	}

	return ctx.JSON(http.StatusNoContent, nil)
}

func (a Account) GetAccounts(ctx echo.Context, c container.Container, user entity.User) error {
	accountRepository := c.GetAccountRepository()

	accounts, err := accountRepository.GetByUser(user)
	if err != nil {
		return err
	}

	response := buildGetAccountsResponse(accounts)

	return ctx.JSON(http.StatusOK, response)
}

type getAccountsResponse struct {
	UUID      string `json:"id"`
	Name      string `json:"name"`
	SecretKey string `json:"secret_key"`
	URL       string `json:"url"`
}

func buildGetAccountsResponse(accounts []entity.Account) []getAccountsResponse {
	var response []getAccountsResponse = make([]getAccountsResponse, 0, len(accounts))

	for _, account := range accounts {
		response = append(response, getAccountsResponse{
			UUID:      account.UUID.String(),
			Name:      account.Name,
			SecretKey: account.SecretKey,
			URL:       account.URL,
		})
	}

	return response
}
