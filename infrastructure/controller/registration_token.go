package controller

import (
	"github.com/google/uuid"
	"net/http"

	"cuckoo/infrastructure/container"

	"github.com/labstack/echo/v4"
)

type RegistrationToken struct {
}

func NewRegistrationToken() RegistrationToken {
	return RegistrationToken{}
}

func (r RegistrationToken) Create(ctx echo.Context, c container.Container) error {
	request := registrationTokenRequest{}
	err := ctx.Bind(&request)
	if err != nil {
		return echo.ErrBadRequest.SetInternal(err)
	}

	userUUID, err := uuid.Parse(request.UUID)
	if err != nil {
		return echo.ErrBadRequest.SetInternal(err)
	}

	command := c.GetCreateRegistrationTokenCommand()
	token, err := command.Do(userUUID)
	if err != nil {
		return echo.ErrInternalServerError.SetInternal(err)
	}

	return ctx.JSON(http.StatusCreated, registrationTokenResponse{
		RegistrationToken: token.Token,
	})
}

type registrationTokenRequest struct {
	UUID string `json:"uuid"`
}

type registrationTokenResponse struct {
	RegistrationToken string `json:"registration_token"`
}
