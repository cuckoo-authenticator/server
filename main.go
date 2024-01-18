package main

import (
	"cuckoo/infrastructure"
	"cuckoo/infrastructure/container"
)

func main() {
	c, err := container.GetContainer()
	if err != nil {
		panic(err)
	}

	err = infrastructure.Start(c)
	if err != nil {
		panic(err.Error())
	}
}
