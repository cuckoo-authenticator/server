package controller

import (
	"cuckoo/domain/entity"
	"cuckoo/infrastructure/container"
	"github.com/google/uuid"
	"github.com/labstack/echo/v4"
	"net/http"
)

type User struct {
}

func NewUser() User {
	return User{}
}

func (r User) Register(ctx echo.Context, c container.Container) error {
	request := registerUserRequest{}
	err := ctx.Bind(&request)
	if err != nil {
		return echo.ErrBadRequest.SetInternal(err)
	}

	userUUID, err := uuid.Parse(request.UserUUID)
	if err != nil {
		return echo.ErrBadRequest.SetInternal(err)
	}

	command := c.GetCreateUserCommand()
	err = command.Do(userUUID, request.RegistrationToken, request.AuthenticationToken, request.WrappedVaultKey)
	if err != nil {
		return echo.ErrInternalServerError.SetInternal(err)
	}

	return ctx.JSON(http.StatusCreated, nil)
}

type registerUserRequest struct {
	UserUUID            string `json:"user_uuid"`
	RegistrationToken   string `json:"registration_token"`
	AuthenticationToken string `json:"authentication_token"`
	WrappedVaultKey     string `json:"wrapped_vault_key"`
}

func (r User) Login(ctx echo.Context, c container.Container, user entity.User) error {
	return ctx.JSON(http.StatusOK, loginUserResponse{WrappedVaultKey: user.WrappedVaultKey})
}

type loginUserResponse struct {
	WrappedVaultKey string `json:"wrapped_vault_key"`
}
