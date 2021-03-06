define({ "api": [
  {
    "type": "get",
    "url": "/admin/products",
    "title": "list products",
    "permission": [
      {
        "name": "authenticated"
      }
    ],
    "name": "ListProducts",
    "group": "Admin",
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Admin/ProductsController.php",
    "groupTitle": "Admin"
  },
  {
    "type": "post",
    "url": "/admin/products",
    "title": "add a new product",
    "permission": [
      {
        "name": "authenticated"
      }
    ],
    "name": "addProduct",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "name",
            "description": "<p>Mandatory Product Name</p>"
          },
          {
            "group": "Parameter",
            "type": "decimal",
            "optional": false,
            "field": "price",
            "description": "<p>Mandatory Product Price</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "discount_type",
            "description": "<p>One of the following ['None', 'Percentage', 'Fixed']</p>"
          },
          {
            "group": "Parameter",
            "type": "decimal",
            "optional": false,
            "field": "discount",
            "description": ""
          }
        ]
      }
    },
    "group": "Admin",
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Admin/ProductsController.php",
    "groupTitle": "Admin"
  },
  {
    "type": "post",
    "url": "/admin/products/:id/attach",
    "title": "bundle products with existing product",
    "permission": [
      {
        "name": "authenticated"
      }
    ],
    "name": "attachProducts",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id",
            "description": "<p>the id of the product you are updating</p>"
          },
          {
            "group": "Parameter",
            "type": "array",
            "optional": false,
            "field": "products",
            "description": "<p>array containing products ids you want to associate with this product</p>"
          }
        ]
      }
    },
    "group": "Admin",
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Admin/ProductsController.php",
    "groupTitle": "Admin"
  },
  {
    "type": "delete",
    "url": "/admin/products/:id",
    "title": "delete a product",
    "permission": [
      {
        "name": "authenticated"
      }
    ],
    "name": "deleteProduct",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id",
            "description": "<p>product id</p>"
          }
        ]
      }
    },
    "group": "Admin",
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Admin/ProductsController.php",
    "groupTitle": "Admin"
  },
  {
    "type": "post",
    "url": "/admin/products/:id/detach",
    "title": "remove products from bundled product",
    "permission": [
      {
        "name": "authenticated"
      }
    ],
    "name": "detachProduct",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id",
            "description": "<p>the id of the product you are updating</p>"
          },
          {
            "group": "Parameter",
            "type": "array",
            "optional": false,
            "field": "products",
            "description": "<p>array containing products ids you want to associate with this product</p>"
          }
        ]
      }
    },
    "group": "Admin",
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Admin/ProductsController.php",
    "groupTitle": "Admin"
  },
  {
    "type": "get",
    "url": "/admin/products/:id",
    "title": "display a single product",
    "permission": [
      {
        "name": "authenticated"
      }
    ],
    "name": "showProduct",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id",
            "description": "<p>product id</p>"
          }
        ]
      }
    },
    "group": "Admin",
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Admin/ProductsController.php",
    "groupTitle": "Admin"
  },
  {
    "type": "patch",
    "url": "/admin/products/:id",
    "title": "update existing product",
    "permission": [
      {
        "name": "authenticated"
      }
    ],
    "name": "updateProduct",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id",
            "description": "<p>product id</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "name",
            "description": "<p>Product Name</p>"
          },
          {
            "group": "Parameter",
            "type": "decimal",
            "optional": false,
            "field": "price",
            "description": "<p>Product Price</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "discount_type",
            "description": "<p>One of the following ['None', 'Percentage', 'Fixed']</p>"
          },
          {
            "group": "Parameter",
            "type": "decimal",
            "optional": false,
            "field": "discount",
            "description": ""
          }
        ]
      }
    },
    "group": "Admin",
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Admin/ProductsController.php",
    "groupTitle": "Admin"
  },
  {
    "type": "post",
    "url": "/auth/me",
    "title": "fetch currently logged in user info",
    "permission": [
      {
        "name": "authenticated"
      }
    ],
    "name": "Me",
    "group": "Auth",
    "version": "0.0.0",
    "filename": "app/Http/Controllers/AuthController.php",
    "groupTitle": "Auth"
  },
  {
    "type": "post",
    "url": "/auth/login",
    "title": "authenticate yourself to the system",
    "permission": [
      {
        "name": "None"
      }
    ],
    "name": "login",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>your email address</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password",
            "description": "<p>your password</p>"
          }
        ]
      }
    },
    "group": "Auth",
    "version": "0.0.0",
    "filename": "app/Http/Controllers/AuthController.php",
    "groupTitle": "Auth"
  },
  {
    "type": "post",
    "url": "/auth/logout",
    "title": "log user out of the system",
    "permission": [
      {
        "name": "authenticated"
      }
    ],
    "name": "logout",
    "group": "Auth",
    "version": "0.0.0",
    "filename": "app/Http/Controllers/AuthController.php",
    "groupTitle": "Auth"
  },
  {
    "type": "post",
    "url": "/auth/refresh",
    "title": "fetch a new auth token for currently logged-in user",
    "permission": [
      {
        "name": "authenticated"
      }
    ],
    "name": "refresh",
    "group": "Auth",
    "version": "0.0.0",
    "filename": "app/Http/Controllers/AuthController.php",
    "groupTitle": "Auth"
  },
  {
    "type": "get",
    "url": "/products",
    "title": "list products",
    "name": "listProducts",
    "permission": [
      {
        "name": "None"
      }
    ],
    "group": "Products",
    "version": "0.0.0",
    "filename": "app/Http/Controllers/ProductsController.php",
    "groupTitle": "Products"
  },
  {
    "type": "post",
    "url": "/order",
    "title": "place your order",
    "permission": [
      {
        "name": "None"
      }
    ],
    "name": "placeOrder",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "first_name",
            "description": "<p>First Name</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "last_name",
            "description": "<p>Last Name</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>Email Address</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "phone",
            "description": "<p>Phone Number</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "address",
            "description": "<p>Address</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "city",
            "description": "<p>City</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "country",
            "description": "<p>Country</p>"
          },
          {
            "group": "Parameter",
            "type": "array",
            "optional": false,
            "field": "products",
            "description": "<p>Products you are ordering e.g: [{id: 1, quantity: 4}, {id: 2, quantity: 1}]</p>"
          }
        ]
      }
    },
    "group": "Products",
    "version": "0.0.0",
    "filename": "app/Http/Controllers/OrdersController.php",
    "groupTitle": "Products"
  },
  {
    "type": "get",
    "url": "/products/:id",
    "title": "display a single product",
    "permission": [
      {
        "name": "None"
      }
    ],
    "name": "showProduct",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id",
            "description": "<p>product id</p>"
          }
        ]
      }
    },
    "group": "Products",
    "version": "0.0.0",
    "filename": "app/Http/Controllers/ProductsController.php",
    "groupTitle": "Products"
  }
] });
