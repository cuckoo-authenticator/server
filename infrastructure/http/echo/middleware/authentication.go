package middleware

import (
	"cuckoo/infrastructure/container"

	"github.com/labstack/echo/v4"
)

func Authentication(c container.Container) echo.MiddlewareFunc {
	return func(next echo.HandlerFunc) echo.HandlerFunc {
		return func(ctx echo.Context) error {
			authenticationToken := ctx.Request().Header.Get("Authentication-Token")
			if authenticationToken == "" {
				return echo.ErrUnauthorized
			}

			userRepository := c.GetUserRepository()

			user, err := userRepository.GetByAuthenticationToken(authenticationToken)
			if err != nil {
				return echo.ErrUnauthorized
			}

			ctx.Set("authenticated_user", user)

			return next(ctx)
		}
	}
}
