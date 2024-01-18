package route

import (
	"cuckoo/domain/entity"
	"cuckoo/infrastructure/container"
	"cuckoo/infrastructure/controller"
	"cuckoo/infrastructure/http/echo/middleware"
	"github.com/labstack/echo/v4"
)

func PrepareRoutes(e *echo.Echo, container container.Container) {
	registrationTokenController := controller.NewRegistrationToken()
	userController := controller.NewUser()
	accountController := controller.NewAccount()

	authentication := middleware.Authentication(container)
	accountPermission := middleware.AccountPermission(container)

	e.POST("/registration-tokens", func(ctx echo.Context) error {
		return registrationTokenController.Create(ctx, container)
	})

	e.POST("/register", func(ctx echo.Context) error {
		return userController.Register(ctx, container)
	})

	e.POST("/login", func(ctx echo.Context) error {
		user := ctx.Get("authenticated_user").(entity.User)
		return userController.Login(ctx, container, user)
	}, authentication)

	e.POST("/accounts", func(ctx echo.Context) error {
		user := ctx.Get("authenticated_user").(entity.User)
		return accountController.Create(ctx, container, user)
	}, authentication)

	e.DELETE("/accounts/:uuid", func(ctx echo.Context) error {
		account := ctx.Get("account").(entity.Account)
		return accountController.Remove(ctx, container, account)
	}, authentication, accountPermission)

	e.GET("/accounts", func(ctx echo.Context) error {
		user := ctx.Get("authenticated_user").(entity.User)
		return accountController.GetAccounts(ctx, container, user)
	}, authentication)
}
