
# Running

1. Run environment.  
    This creates docker containers that spin up php, apache and mysql.
    ```bash
    cd <into this directory>
    docker-compose up
    ```
2. Open the web page: [http://localhost:8000/index.php](http://localhost:8000)

# Configuration

* accessing from your dev machine:
    * The Apache WebServer is bound on `http://localhost:8000`.
    * MySQL is bound on `mysql://localhost:3306`.
* accessing from php:
    * to access the MySQL db from php use `mysql://test-db:3306`,
        this is because docker runs on its own network with its own hostnames
* MySQL
    * the `root` user has the password `hilariouslyinsecure`
    * an additional `test` user has the password `hilariouslyinsecure`
        * for security reasons its best practice to not use the `root` user
 
        