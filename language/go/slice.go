package main

import (
	"fmt"
)

func main() {
	nums := []int{16, 8, 42, 4, 23, 15}
	max := nums[0]
	for _, val := range nums[1:] {
		if val > max {
			max = val
		}
	}

	fmt.Println(max)
}
