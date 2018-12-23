# shop
An example backend shop written in PHP using Laravel &amp; JWT authentication

# Usage
1. Clone The project:
`git clone https://github.com/aanbar/shop`
1. Copy over .env.exaample to .env
`cp .env.example .env`
1. Run Composer
`composer install`
1. Generate JWT Token Secret Key `php artisan jwt:secret`
1. Edit your `.env` and provide your database settings. 
1. Run The migrations `php artisan migrate`
1. Run the system `php artisan serve`

>API Docs are available in public/docs & can be viewed through http by accessing http://127.0.0.1:8000/docs/
# What's Included?
- User Login (assumed admin only)
- Ability to add products with discount & discount type (percentage, fixed)
- Ability to create a product bundle (a product that contains a collection of other products)

# What's missing?
- Ability to change your password
- Standarized json response
