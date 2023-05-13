## How to run

1. Configure the values in .env file (Project Monitor and Redmine URL);
2. You need to have `php 8` and `composer` installed; 
3. After the clone, in the project's folder, you need to run `composer install`;
4. To start the server, just run `symfony server:start`.

## Request explanation

#### Creating the project

<details><summary><code>POST</code><code><b>/create-project</b></code><code>(Get the projects from Project Monitor and create it in Redmine)</code></summary>

##### Body

`Doesn't need to send anything.`

##### Responses

> | http code     | content-type        | response                                          |
> |---------------|---------------------------------------------------|---------------------------------------------------------------------| 
> | `201`         | `application/json`  | `null`                                            |
> | `400`         | `application/json`  | `{"errors": [{"message": "", "error_code": ""}]}` |

</details>
