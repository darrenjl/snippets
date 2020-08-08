// Example of "if" statement
package main

import (
	"fmt"
)

func main() {
	fizz, buzz, fizzbuzz := "fizz", "buzz", "fizzbuzz"

	for i := 1; i <= 20; i++ {
		switch {
		case i%15 == 0:
			fmt.Println(fizzbuzz)
		case i%5 == 0:
			fmt.Println(buzz)
		case i%3 == 0:
			fmt.Println(fizz)
		default:
			fmt.Println(i)
		}
	}
}
