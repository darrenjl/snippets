package main

import (
	"fmt"
	"net/http"
)

func getContentType(url string) (string, error) {
	resp, err := http.Get(url)
	defer resp.Body.Close()
	if err != nil {
		return "", err
	}
	ctype := resp.Header.Get("Content-Type")
	if ctype == "" {
		return "", fmt.Errorf("Cannot find content type")
	}
	return ctype, nil

}

func main() {
	fmt.Println(getContentType("https://www.google.com"))
}
