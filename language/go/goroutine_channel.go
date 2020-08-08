// Get content type of sites
package main

import (
	"fmt"
	"net/http"
)

func returnType(url string, out chan string) {
	resp, err := http.Get(url)
	if err != nil {
		out <- fmt.Sprintf("error: %s\n", err)
		return
	}

	defer resp.Body.Close()
	ctype := resp.Header.Get("content-type")
	out <- fmt.Sprintf("%s -> %s\n", url, ctype)
}

func main() {
	ch := make(chan string)
	urls := []string{
		"https://golang.org",
		"https://api.github.com",
		"https://httpbin.org/xml",
	}

	// var wg sync.WaitGroup
	for _, url := range urls {
		// wg.Add(1)
		go func(url string) {
			returnType(url, ch)
			// wg.Done()
		}(url)
	}
	for range urls {
		out := <-ch
		fmt.Printf(out)
	}
}
