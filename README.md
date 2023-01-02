# A small prototype based on Bexio's interview

## Goal

My idea with this project was just to demonstrate a little understanding of relevant topics that were discussed in the interview. If necessary, I can evolve a little more any of the subjects.

## Topics
- Symfony structure
- Doctrine and entities
- API
- Tests
- Performance using asynchronous strategies 
- Docker/Docker-compose  
- Command (Design Pattern) 
- Deploy on Google cloud 

## Deployment
The Prototype is working on a google cloud instance
http://34.175.190.187/api

## Notes 

### Access to API

- if you want to access this using any external client (Example: postman) you need to put the token in your header:

key: x-api-key
value: myapitoken


### asynchronous flow

Access http://34.175.117.110/api/buy to run asynchronous

I've created a mail catcher (Only on local machine)



### Development helpers

- php bin/console --env=test hautelook:fixtures:load
- symfony console --env=test do:mi:mi
- symfony console messenger:consume async -vv