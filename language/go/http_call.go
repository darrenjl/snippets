package main

import (
	"encoding/json"
	"fmt"
	"io/ioutil"
	"log"
	"net/http"
	"strings"
)

type User struct {
	Name        string `json:name`
	PublicRepos int    `json:public_repos`
}

func userInfo(login string) (*User, error) {
	resp, err := http.Get("https://api.github.com/users/" + login)
	if err != nil {
		return nil, err
	}
	defer resp.Body.Close()
	user := &User{}
	dec := json.NewDecoder(resp.Body)
	if err := dec.Decode(user); err != nil {
		return nil, err
	}
	return user, nil
}

func httpPost() string {
	requestBody := strings.NewReader(`
		hello world
	`)

	// post some data
	req, err := http.NewRequest(
		"POST",
		"https://postman-echo.com/post",
		requestBody,
	)

	req.Header = map[string][]string {
		"Content-Type": { "application/text;" },
	}

	if err != nil {
		log.Fatal( err )
	}

	response, err := http.DefaultClient.Do(req)
	// check for response error
	if err != nil {
		log.Fatal( err )
	}

	// read response data
	data, _ := ioutil.ReadAll( response.Body )

	// close response body
	response.Body.Close()

	// print request `Content-Type` header
	requestContentType := response.Request.Header.Get( "Content-Type" )
	fmt.Println( "Request content-type:", requestContentType )

	return string(data)
}

func main() {
	usr, err := userInfo("darrenjl")
	if err != nil {
		log.Fatalf("Error: %s", err)
	}
	fmt.Printf("%+v\n", usr)

	postResponse := httpPost()
	fmt.Printf(postResponse)
}
