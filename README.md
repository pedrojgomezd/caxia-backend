Hi.

For the backend this is the repository https://github.com/pedrojgomezd/caxia-backend.

For the frontend https://github.com/pedrojgomezd/caxia-front

### Guide for backend

How the authentication system is being used Sanctum, remember to make the corresponding configuration.

1. Clone repository
2. Configure .env
3. php artisan migrate --seed
4. php artisan storage: link
5. php artisan serve

### Guide for Frontend

The frontend is made with react using NextJs

1. Clone repository.
2. yarn or npm install
3. yarn dev or npm run dev

I uploaded the project, but I did not manage to configure the file upload issue correctly, but you can still try the following link.
http://caxia.devwithme.site

### Routes

#### Frontend routes

/ o home = Works as guest registration

/login

/ customers

/ customers / {id}

/ customers / {id} / edit

/ customers / create

#### Api Backend Routes

POST: / login

POST: / logout

POST: / customers / register

GET: / customers

GET: / customers / {id}

PUT: / customers / {id}

Email: admin@gmail.com

Password: password
