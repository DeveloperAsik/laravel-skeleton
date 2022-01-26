## How to Run locally

Dump mysql database for data

- rename .env.example to .env
- change database param at this file
- make sure db connection and project is connected
- dump mysql file (at /database/db/ecommerce.sql)

Run project locally

- extract project to your directory works e.g C:/Projects/ecommerce
- open terminal/cmd/ or if you using git bash here at the root of project
- type "php artisan serve --port=1000" 

## E-Commerce Problem when stock is unavailable

1. Cart item quantity is not sync with quantity at item stock and the result is misreported when checkout item quantity is not available

    This case making table item stock quantity not match with table cart item detail or stock available is less than quantity request by customer.
Because it is possibly the item stock is decrease or hit to 0 when customer continue to checkout they cart and it maybe took by another customer who 
making checkout order first.


2. Solution

    Making every times before checkout cart is happened, run some function to verify quantity is available at the moment. return the value true if stock is within quantity request
or return false when quantity request is exceed from item quantity at DB.
    
3. Proof of concept

- open your postmen or api rest view
- first get token by accesing : 

    type => POST

    url => http://localhost:1000/api/v1/auth/get-token

    param raw body with type json => 

    {
        "email": "ariffirmansyah.begin@gmail.com",
        "password": "P@ssw0rd"
    }

    response => 

    {
        "status": {
            "code": 200,
            "message": "Successfully generate token user"
        },
        "options": {
            "valid": true,
            "meta": []
        },
        "data": {
            "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoyLCJncm91cF9pZCI6MywiY3JlYXRlX2RhdGUiOjE2MzUxNDE2NTYsImV4cGlyZWRfZGF0ZSI6MTYzNTE2MzI1Nn0.1DHsBueFTERG4BXkMxt43n3HIaw_V3fo9wDt8TGnLC8"
        }
    }


- then access cart list of product that already add to by accessing :

    type => GET

    url => http://localhost:1000/api/v1/cart/get-list?offset=0&limit=24

    param headers with =>

    {
        "Authorization": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoyLCJncm91cF9pZCI6MywiY3JlYXRlX2RhdGUiOjE2MzUxNDE2NTYsImV4cGlyZWRfZGF0ZSI6MTYzNTE2MzI1Nn0.1DHsBueFTERG4BXkMxt43n3HIaw_V3fo9wDt8TGnLC8"
    }

    response => 

    {
        "status": {
            "code": 200,
            "message": "successfully fetching data"
        },
        "options": {
            "valid": true,
            "meta": {
                "total": 1,
                "offset": 0,
                "limit": "24",
                "query_param": "/api/v1/cart/get-list?offset=0&limit=24"
            }
        },
        "data": [
            {
                "id": 2,
                "code": "B9FDcZficstlwXiB",
                "subtotal_tax": 0,
                "grandtotal_price": 960000,
                "is_active": 1,
                "created_date": "2021-10-24 21:22:35",
                "items": [
                    {
                        "cart_item_id": 4,
                        "sku": "ITN_SH_00291278",
                        "qty": 1,
                        "price": 160000,
                        "total_price": 160000,
                        "discount_price": 0,
                        "tax_price": 0
                    },
                    {
                        "cart_item_id": 5,
                        "sku": "ITN_SH_00291279",
                        "qty": 3,
                        "price": 160000,
                        "total_price": 480000,
                        "discount_price": 0,
                        "tax_price": 0
                    },
                    {
                        "cart_item_id": 6,
                        "sku": "ITN_SH_00291275",
                        "qty": 2,
                        "price": 160000,
                        "total_price": 320000,
                        "discount_price": 0,
                        "tax_price": 0
                    }
                ]
            }
        ]
    }

- or you can check item stock available :

    type => GET

    url => http://localhost:1000/api/v1/product/get-stock-list?offset=0&limit=24

    param headers with =>

    {
        "Authorization": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoyLCJncm91cF9pZCI6MywiY3JlYXRlX2RhdGUiOjE2MzUxNDE2NTYsImV4cGlyZWRfZGF0ZSI6MTYzNTE2MzI1Nn0.1DHsBueFTERG4BXkMxt43n3HIaw_V3fo9wDt8TGnLC8"
    }

    response =>

    {
        "status": {
            "code": 200,
            "message": "successfully fetching data"
        },
        "options": {
            "valid": true,
            "meta": {
                "total": 5,
                "offset": 0,
                "limit": "24",
                "query_param": "/api/v1/product/get-stock-list?offset=0&limit=24"
            }
        },
        "data": [
            {
                "id": 1,
                "sku": "ITN_SH_00291279",
                "stock": 0,
                "price_off": 180000,
                "price_on": 160000,
                "weight": 200,
                "length": 47,
                "width": 20,
                "product_id": 1,
                "product_name": "Rex T-Shirt",
                "base_price": 120000,
                "color_id": 1,
                "color_name": "white",
                "size_id": 31,
                "size_name": "S",
                "image_id": null,
                "path_48": null,
                "path_128": null,
                "path_640": null,
                "path_1024": null,
                "path_original": null,
                "category_id": 17,
                "category_name": "Shirt",
                "gender_id": 1,
                "gender_name": "Male"
            },
            {
                "id": 2,
                "sku": "ITN_SH_00291278",
                "stock": 0,
                "price_off": 180000,
                "price_on": 160000,
                "weight": 200,
                "length": 47,
                "width": 20,
                "product_id": 1,
                "product_name": "Rex T-Shirt",
                "base_price": 120000,
                "color_id": 2,
                "color_name": "black",
                "size_id": 31,
                "size_name": "S",
                "image_id": null,
                "path_48": null,
                "path_128": null,
                "path_640": null,
                "path_1024": null,
                "path_original": null,
                "category_id": 17,
                "category_name": "Shirt",
                "gender_id": 1,
                "gender_name": "Male"
            },
            {
                "id": 3,
                "sku": "ITN_SH_00291277",
                "stock": 120,
                "price_off": 180000,
                "price_on": 160000,
                "weight": 200,
                "length": 47,
                "width": 20,
                "product_id": 1,
                "product_name": "Rex T-Shirt",
                "base_price": 120000,
                "color_id": 3,
                "color_name": "grey",
                "size_id": 31,
                "size_name": "S",
                "image_id": null,
                "path_48": null,
                "path_128": null,
                "path_640": null,
                "path_1024": null,
                "path_original": null,
                "category_id": 17,
                "category_name": "Shirt",
                "gender_id": 1,
                "gender_name": "Male"
            },
            {
                "id": 4,
                "sku": "ITN_SH_00291276",
                "stock": 120,
                "price_off": 180000,
                "price_on": 160000,
                "weight": 200,
                "length": 47,
                "width": 20,
                "product_id": 1,
                "product_name": "Rex T-Shirt",
                "base_price": 120000,
                "color_id": 4,
                "color_name": "dark-red",
                "size_id": 31,
                "size_name": "S",
                "image_id": null,
                "path_48": null,
                "path_128": null,
                "path_640": null,
                "path_1024": null,
                "path_original": null,
                "category_id": 17,
                "category_name": "Shirt",
                "gender_id": 1,
                "gender_name": "Male"
            },
            {
                "id": 5,
                "sku": "ITN_SH_00291275",
                "stock": 120,
                "price_off": 180000,
                "price_on": 160000,
                "weight": 200,
                "length": 47,
                "width": 20,
                "product_id": 1,
                "product_name": "Rex T-Shirt",
                "base_price": 120000,
                "color_id": 5,
                "color_name": "blue",
                "size_id": 31,
                "size_name": "S",
                "image_id": null,
                "path_48": null,
                "path_128": null,
                "path_640": null,
                "path_1024": null,
                "path_original": null,
                "category_id": 17,
                "category_name": "Shirt",
                "gender_id": 1,
                "gender_name": "Male"
            }
        ]
    }

- or you can add item into cart :

    type => POST

    url => http://localhost:1000/api/v1/product/get-stock-list?offset=0&limit=24

    param headers with =>

    {
        "Authorization": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoyLCJncm91cF9pZCI6MywiY3JlYXRlX2RhdGUiOjE2MzUxNDE2NTYsImV4cGlyZWRfZGF0ZSI6MTYzNTE2MzI1Nn0.1DHsBueFTERG4BXkMxt43n3HIaw_V3fo9wDt8TGnLC8"
    }

    param raw body with type json => 

    [{
            "sku":"ITN_SH_00291275",
            "qty":2,
            "price":160000,
            "discount_price":0,
            "tax_price":0
    }]

    response =>

    {
        "status": {
            "code": 200,
            "message": "successfully insert data"
        },
        "options": {
            "valid": true,
            "meta": []
        },
        "data": {
            "id": 6
        }
    }

- if you make checkout with this cart item and using case :

    a. product with sku ITN_SH_00291279 stock is = 0
    b. product with sku ITN_SH_00291278 stock is = 0
    c. product with sku ITN_SH_00291275 stock is > 0


    type => POST

    url => http://localhost:1000/api/v1/cart/checkout

    param headers with =>

    {
        "Authorization": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoyLCJncm91cF9pZCI6MywiY3JlYXRlX2RhdGUiOjE2MzUxNDE2NTYsImV4cGlyZWRfZGF0ZSI6MTYzNTE2MzI1Nn0.1DHsBueFTERG4BXkMxt43n3HIaw_V3fo9wDt8TGnLC8"
    }

    param raw body with type json => 

    {
        "shipping_address": "kp kedung waringin rt 02 rw 04",
        "shipping_bill": "",
        "subtotal_tax": 0,
        "grandtotal_price": 960000,
        "shipping_vendor_id": 1,
        "shipping_cost_id": 1,
        "payment_id" : 1,
        "items" : [
            {
                "sku":"ITN_SH_00291278",
                "qty":1,
                "price":160000,
                "discount_price":0,
                "tax_price":0
            },
            {
                "sku":"ITN_SH_00291279",
                "qty":3,
                "price":160000,
                "discount_price":0,
                "tax_price":0
            },
            {
                "sku":"00291275",
                "qty":3,
                "price":160000,
                "discount_price":0,
                "tax_price":0
            }
        ]
    }

    response =>

    {
        "status": {
            "code": 200,
            "message": "Warning! Product with sku : ITN_SH_00291278 is unavailable at the moment, please contact administrator or change product to another.Warning! Product with sku : ITN_SH_00291279 is unavailable at the moment, please contact administrator or change product to another."
        },
        "options": {
            "valid": false,
            "meta": []
        },
        "data": []
    }

- It will give us response options -> value = false, and will set response status -> message with information which one or what is make api stop run