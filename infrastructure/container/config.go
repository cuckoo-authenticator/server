package container

type Config struct {
	DBConfig
}
type DBConfig struct {
	DatabaseHost     string `required:"true" envconfig:"database_host"`
	DatabasePort     int    `required:"true" envconfig:"database_port"`
	DatabaseUsername string `required:"true" envconfig:"database_username"`
	DatabasePassword string `required:"true" envconfig:"database_password"`
	DatabaseName     string `required:"true" envconfig:"database_name"`
}

func getConfig() *Config {
	return &Config{
		DBConfig: DBConfig{
			DatabaseHost:     "localhost",
			DatabasePort:     3306,
			DatabaseUsername: "root",
			DatabasePassword: "",
			DatabaseName:     "cuckoo",
		},
	}
}
