package container

import (
	"gorm.io/driver/mysql"
	"gorm.io/gorm"
)

func createDBConnection(config *Config) *gorm.DB {
	db, err := gorm.Open(mysql.Open(buildDSN(config)), &gorm.Config{})
	if err != nil {
		panic("failed to connect database")
	}

	return db
}

func buildDSN(config *Config) string {
	return config.DBConfig.DatabaseUser + ":" + config.DBConfig.DatabasePassword + "@tcp(" + config.DBConfig.DatabaseHost + ":" + config.DBConfig.DatabasePort + ")/" + config.DBConfig.DatabaseName + "?charset=utf8mb4&parseTime=True&loc=Local"
}
