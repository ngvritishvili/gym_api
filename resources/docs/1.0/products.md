# Event

---

- [All Product](#all-product)
- [Show Product](#show-product)
- [Store Product](#store-product)
- [Update Product](#update-product)
- [Delete Product](#delete-product)


<a name="all-product"></a>
## All Product
### GET api/products
show all product with details

#### Fields
* `` - ,

#### Response
* ``

<a name="show-product"></a>
## Show Product
### GET api/products/{id}
Show events with id

#### Fields
* `id` - integer, mandatory

#### Response
* `name`
* `description`
* `weight`
* `price`
* `image`

<a name="store-product"></a>
## Store (Create) Product
### POST api/products
On this endpoint admin can create Product (only super admin)

#### Fields
* `name` - string, mandatory
* `description` - string, nullable
* `weight` - float, mandatory
* `price` - decimal, mandatory
* `image` - date, nullable

#### Response
* `name`
* `description`
* `weight`
* `price`
* `image`


<a name="update-product"></a>
## Update Product
### PATCH api/products
On this endpoint super admin can update Product (only super admin)

#### Fields
* `name`
* `description`
* `weight`
* `price`
* `image`


#### Response
##### `Updated Product`

<a name="delete-product"></a>
## Delete Product
### DELETE api/products
On this endpoint super admin can delete Product (Only Super Admin)

#### Fields
* `id` - id, mandatory Product id

#### Response
* `status`
