# Intuition

# Granular Permission System

This document describes a granular permission system designed to control CRUD operations on models and their attributes and relations in a Laravel-based application.

---

## 1. **Read Operations**

To read any informations on a model resource the user need to access the listing access to that model: `ModelName:list`. The idea behind that is the simple consideration that the informations comme from the database as a list. This create a total access control. What is a user can't list of the items but just part of depending on some criteria. A user may not have access to the posts but can see his own posts. To Solve this problem we define filters. Hence a user can list posts with a filter name `mine` that refer to his posts. There is not a convention for filter naming. And for this to work we add a query filters to the model.

```php
Class Post {
    public static function queryFilters(): array
    {
        return [
            'mine' => function (Builder $query, $user) {
                $query->where('user_id', $user->id);
            },
        ];
    }
}
```

The function closure there will always receive the query builder instance that the user instance. The user that logged user what we checking the permission. In summary:

-   `Model:list` -> list of the instances of model
-   `Model:list:filter_name` -> list all the instance of a model under some conditions

### 🧩 Attribute-Level Permissions

Now that the user can list the model instance we now took at the attribute level. What are the attributes that the user can view.

-   To access a specific attribute, the user must have the permission:
    `Model:view:attribute_name`
    e.g., `Model:view:email`, `Model:view:password`

-   To access all the user attributes -> `Model:view:*`

-   To access all attributes of a model, the user must have either:

    -   All the individual `Model:view:attribute_name` permissions, or
    -   A wildcard permission: `Model:view:*`

### 🔗 Relationship Permissions

To access relationships, permissions follow the same naming convention.
The relations of the models should be specifiy inside the model. Otherwise the permission for the relations will not be generated.

```php
class User extends Model {
    public $rels = ['posts'];
}
```

#### Simple Relationship

Example: Accessing the posts of a user:

-   Required permission: `user:view:posts`

To access specific attributes of related models:

-   Example: Getting a user’s posts and the title of each post:

    -   Required permissions: `User:view:posts`, `Post:view:title`

To access the author of a post and the author’s name:

-   Required permissions: `Post:view:author`, `Author:view:name` (or `Post:view:*`, `author:view:*`)

The intuition behing relationship access is that if we need to check the access for posts of user. First we show be able to get the posts of a user: `User:view:posts` and once we got thoses posts we need to be able to view the attribute of each instance `Post:view:*` or `Post:view:attribute_name, ...`

**IMPORTANT**: We should always have permissions for attributes that are involve in the relation as foreign keys.

#### Nested Relationship

Accessing nested data follows the same logic.
Example: Fetching a user’s posts with each post’s author and the author's name:

-   Required permissions: `User:view:posts`, `Post:view:author`, `Author:view:name`

#### Relationship listing filter.

Same as for list. We can't have the access to view all posts of a user. But have access to posts of a user under certains conditions. In this case we use the queryFilters logic: `User:view:posts:filter_name`.

## 2. **Create and Update Operations**

To **create** a model:

1. The base permission is required: `Model:create`
2. Additionally, the user must have permission to **assign values** to individual attributes:

    - e.g., to create a user with name and email:
      Required permissions: `User:create`, `User:create:name`, `User:create:email`
    - Or alternatively: `User:create`, `User:create:*`

To **update** a model:

-   Same logic as creation, replacing `create` with `update`:
    e.g., `User:update:name`, `User:update:*`

---

## 3. **Delete Operation**

To delete a model:

-   Required permission: `Model:delete`
    e.g., `User:delete`

---

## 4. **Validation in Controllers**

We enforce both **input validation** and **permission checking** during **create** and **update** operations using a custom request validator.

### Example

```php
class UserController extends Controller
{
    use PermissionValidator;

    public function store(Request $request)
    {
        $validated = $this->validateWithPermissions($request, [
            'User:create' => [
                'email' => ['required', 'email'],
                'password' => ['required', 'string', 'min:8'],
            ],
            'Profile:create' => [
                'name' => ['required', 'string', 'max:255'],
            ],
            'meta' => [
                'ref_code' => ['nullable', 'string'],
                'send_email' => ['boolean'],
            ],
        ]);

        // Proceed with database operations...
    }
}
```

### 🔍 Explanation

-   The permission keys like `User:create`, `Profile:create` are called **permission roots**.
-   These define which **model** is being targeted for creation and what attributes are involved.
-   For `User:create`:

    -   The system checks if the user has the permission to create a user.
    -   Then it checks if the user has the permission to assign values to `email` and `password`:

        -   Required: `User:create:email`, `User:create:password`

#### Special Block: `meta`

Sometimes, a request may include inputs that:

-   Are not directly tied to a model, and
-   Should not require permission checks.

For these cases, we use the **`meta` block**:

-   Define validation rules only.
-   No permissions are enforced.
-   Example use: `ref_code`, `send_email`

This allows you to combine permission-based validation with traditional input validation in the same request.

---
