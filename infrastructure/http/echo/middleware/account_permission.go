package middleware

import (
	"cuckoo/domain/entity"
	domainError "cuckoo/domain/error"
	"cuckoo/infrastructure/container"
	"errors"
	"github.com/google/uuid"

	"github.com/labstack/echo/v4"
)

func AccountPermission(c container.Container) echo.MiddlewareFunc {
	return func(next echo.HandlerFunc) echo.HandlerFunc {
		return func(ctx echo.Context) error {
			UUID, err := uuid.Parse(ctx.Param("uuid"))
			if err != nil {
				return echo.ErrBadRequest.SetInternal(err)
			}

			accountRepository := c.GetAccountRepository()

			account, err := accountRepository.GetByUUID(UUID)

			if errors.As(err, new(domainError.AccountNotFoundErr)) {
				return echo.ErrNotFound
			}

			user := ctx.Get("authenticated_user").(entity.User)

			if user.ID != account.UserID {
				return echo.ErrUnauthorized
			}

			if err != nil {
				return echo.ErrInternalServerError
			}

			ctx.Set("account", account)

			return next(ctx)
		}
	}
}
