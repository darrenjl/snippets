package main

import (
	"github.com/spf13/viper"
	"log"
	"strings"
)


type Configuration struct {
	Name string
	Server ServerConfiguration
	Database DatabaseConfiguration
}

type DatabaseConfiguration struct {
	ConnectionUri string
}

type ServerConfiguration struct {
	Port int
}

func main() {
	viper.SetConfigName("config")
	viper.AddConfigPath(".")
	viper.SetEnvPrefix("APP")
	viper.SetEnvKeyReplacer(strings.NewReplacer(".", "_"))
	viper.AutomaticEnv()
	var configuration Configuration

	if err := viper.ReadInConfig(); err != nil {
		log.Fatalf("Error reading config file, %s", err)
	}
	err := viper.Unmarshal(&configuration)
	if err != nil {
		log.Fatalf("unable to decode into struct, %v", err)
	}
	log.Printf("database uri is %s", configuration.Database.ConnectionUri)
	log.Printf("port for this application is %d", configuration.Server.Port)
	log.Printf("name is %s", configuration.Name)
}