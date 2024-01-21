package container

import "os"

type Config struct {
	DBConfig
}

type DBConfig struct {
	DatabaseHost     string
	DatabasePort     string
	DatabaseUser     string
	DatabasePassword string
	DatabaseName     string
}

func getConfig() *Config {
	return &Config{
		DBConfig: DBConfig{
			DatabaseHost:     os.Getenv("CUCKOO_DATABASE_HOST"),
			DatabasePort:     os.Getenv("CUCKOO_DATABASE_PORT"),
			DatabaseUser:     os.Getenv("CUCKOO_DATABASE_USER"),
			DatabasePassword: os.Getenv("CUCKOO_DATABASE_PASSWORD"),
			DatabaseName:     os.Getenv("CUCKOO_DATABASE_NAME"),
		},
	}
}
