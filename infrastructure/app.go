package infrastructure

import (
	"cuckoo/infrastructure/container"
	"cuckoo/infrastructure/route"
	"github.com/labstack/echo/v4"
)

func Start(container container.Container) error {
	e := echo.New()

	route.PrepareRoutes(e, container)

	e.Logger.Fatal(e.Start(":80"))

	return nil
}
