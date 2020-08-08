package main

import (
	"fmt"
)

func main() {
	c := 0
	for i := 1000; i < 10000; i++ {
		for j := i; j < 10000; j++ {
			x := i * j
			s := fmt.Sprintf("%d", x)
			if s[0] == s[len(s)-1] {
				c++
			}
		}
	}
	fmt.Printf("%d", c)
}
