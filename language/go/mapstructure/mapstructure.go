package main

import (
	"fmt"

	"github.com/spf13/viper"
)

type Obj struct {
	Name string
	Els  []string
}

type HostInfo struct {
	Name string
	Port int
	Key  string
	Objs []Obj
}

type Host struct {
	HostInfo `mapstructure:",squash"`
}

type Config struct {
	Hosts []Host
}

func main() {
	viper.AddConfigPath("./")
	viper.SetConfigName("test")
	err := viper.ReadInConfig()
	if err != nil {
		fmt.Println(err)
	}
	var config Config
	err = viper.Unmarshal(&config)
	fmt.Printf("%#v\n", err)
	if err != nil {
		panic("Unable to unmarshal config")
	}
	fmt.Printf("%#v\n\n", config)
	for _, h := range config.Hosts {
		fmt.Printf("%#v\n", h)
	}
}
