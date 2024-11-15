I. Project Setup Guide
Prerequisites
	•	Docker and Docker Compose installed on your machine.
	•	Git for cloning the repository.
  1.	Clone the Project:
   git clone https://github.com/Danny2725/tender_codeIgniter
   cd tender_codeIgniter
	2.	Switch to the develop branch:
  git checkout develop
  3.  Navigate to the Docker Directory:
     cd docker
 	4.	Start the Docker Containers:
	•	This command will build and start the containers in detached mode.
	•	You can access the application at http://localhost (or another port if configured differently in docker-compose.yml).
 	5.	Stopping the Containers:
	•	When you’re done, stop the containers with:
    docker-compose down
 II. Curl

  1. Auth: 
- Register
```
curl --silent --location --request POST 'http://localhost/auth/register' \
--header 'Accept: */*' \
--header 'Accept-Language: en-US,en;q=0.9,vi;q=0.8' \
--header 'Cache-Control: no-cache' \
--header 'Connection: keep-alive' \
--header 'Content-Type: application/json' \
--header 'Origin: http://localhost' \
--header 'Pragma: no-cache' \
--header 'Referer: http://localhost/register' \
--header 'Sec-Fetch-Dest: empty' \
--header 'Sec-Fetch-Mode: cors' \
--header 'Sec-Fetch-Site: same-origin' \
--header 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36' \
--header 'X-Requested-With: XMLHttpRequest' \
--header 'sec-ch-ua: "Chromium";v="130", "Google Chrome";v="130", "Not?A_Brand";v="99"' \
--header 'sec-ch-ua-mobile: ?0' \
--header 'sec-ch-ua-platform: "macOS"'
```
- Login
```
curl --silent --location --request POST 'http://localhost/auth/login' \
--header 'Accept: */*' \
--header 'Accept-Language: en-US,en;q=0.9,vi;q=0.8' \
--header 'Cache-Control: no-cache' \
--header 'Connection: keep-alive' \
--header 'Content-Type: application/json' \
--header 'Origin: http://localhost' \
--header 'Pragma: no-cache' \
--header 'Referer: http://localhost/login' \
--header 'Sec-Fetch-Dest: empty' \
--header 'Sec-Fetch-Mode: cors' \
--header 'Sec-Fetch-Site: same-origin' \
--header 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36' \
--header 'X-Requested-With: XMLHttpRequest' \
--header 'sec-ch-ua: "Chromium";v="130", "Google Chrome";v="130", "Not?A_Brand";v="99"' \
--header 'sec-ch-ua-mobile: ?0' \
--header 'sec-ch-ua-platform: "macOS"' \
--data-raw '{"email":"testing1@gmail.com","password":"your_password"}'
````

2. Create Tender
```
curl --silent --location --request POST 'http://localhost/tender/createTender' \
--header 'Accept: */*' \
--header 'Accept-Language: en-US,en;q=0.9,vi;q=0.8' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJhdWQiOiJsb2NhbGhvc3QiLCJpYXQiOjE3MzEyNTA0NjksImV4cCI6MTczMTI1NDA2OSwiZGF0YSI6eyJpZCI6IjEiLCJlbWFpbCI6InRlc3RpbmcxQGdtYWlsLmNvbSIsInJvbGUiOiJjb250cmFjdG9yIn19.CJGbjasyavaEokcUZ7F7mpcjUv4cn9DEdcrpLl_vJ_0' \
--header 'Cache-Control: no-cache' \
--header 'Connection: keep-alive' \
--header 'Content-Type: application/json' \
--header 'Origin: http://localhost' \
--header 'Pragma: no-cache' \
--header 'Referer: http://localhost/tender/create' \
--header 'Sec-Fetch-Dest: empty' \
--header 'Sec-Fetch-Mode: cors' \
--header 'Sec-Fetch-Site: same-origin' \
--header 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36' \
--header 'sec-ch-ua: "Chromium";v="130", "Google Chrome";v="130", "Not?A_Brand";v="99"' \
--header 'sec-ch-ua-mobile: ?0' \
--header 'sec-ch-ua-platform: "macOS"' \
--data-raw '{"title":"demo","description":"demo test 123","visibility":"public","invited_suppliers":["demo1@gmail.com","demo2@gmail.com"]}'
```
3. get list contructor
```
curl --silent --location --request GET 'http://localhost/tender/list_contractor' \
--header 'Accept: */*' \
--header 'Accept-Language: en-US,en;q=0.9,vi;q=0.8' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJhdWQiOiJsb2NhbGhvc3QiLCJpYXQiOjE3MzEyNTE2OTIsImV4cCI6MTczMTI1NTI5MiwiZGF0YSI6eyJpZCI6IjEiLCJlbWFpbCI6InRlc3RpbmcxQGdtYWlsLmNvbSIsInJvbGUiOiJjb250cmFjdG9yIn19.B4aj3gbktq-EMqKqKefFtjwnAxVhu9CFRJck9-2dRO4' \
--header 'Cache-Control: no-cache' \
--header 'Connection: keep-alive' \
--header 'Content-Type: application/json' \
--header 'Origin: http://localhost' \
--header 'Pragma: no-cache' \
--header 'Referer: http://localhost/tender/create' \
--header 'Sec-Fetch-Dest: empty' \
--header 'Sec-Fetch-Mode: cors' \
--header 'Sec-Fetch-Site: same-origin' \
--header 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36' \
--header 'sec-ch-ua: "Chromium";v="130", "Google Chrome";v="130", "Not?A_Brand";v="99"' \
--header 'sec-ch-ua-mobile: ?0' \
--header 'sec-ch-ua-platform: "macOS"' \
--data-raw '{"title":"demo","description":"demo test 123","visibility":"public","invited_suppliers":["demo1@gmail.com","demo2@gmail.com"]}'
```
4. Edit tender
```
curl 'http://localhost/tender/update/4' \
  -X 'PUT' \
  -H 'Accept: */*' \
  -H 'Accept-Language: en-US,en;q=0.9,vi;q=0.8' \
  -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJhdWQiOiJsb2NhbGhvc3QiLCJpYXQiOjE3MzEyNTE2OTIsImV4cCI6MTczMTI1NTI5MiwiZGF0YSI6eyJpZCI6IjEiLCJlbWFpbCI6InRlc3RpbmcxQGdtYWlsLmNvbSIsInJvbGUiOiJjb250cmFjdG9yIn19.B4aj3gbktq-EMqKqKefFtjwnAxVhu9CFRJck9-2dRO4' \
  -H 'Cache-Control: no-cache' \
  -H 'Connection: keep-alive' \
  -H 'Content-Type: application/json' \
  -H 'Cookie: token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJhdWQiOiJsb2NhbGhvc3QiLCJpYXQiOjE3MzEyNTE2OTIsImV4cCI6MTczMTI1NTI5MiwiZGF0YSI6eyJpZCI6IjEiLCJlbWFpbCI6InRlc3RpbmcxQGdtYWlsLmNvbSIsInJvbGUiOiJjb250cmFjdG9yIn19.B4aj3gbktq-EMqKqKefFtjwnAxVhu9CFRJck9-2dRO4; ci_session=fab81aa1515a988b605833605d7aee30abcff2ea' \
  -H 'Origin: http://localhost' \
  -H 'Pragma: no-cache' \
  -H 'Referer: http://localhost/tender/edit/4' \
  -H 'Sec-Fetch-Dest: empty' \
  -H 'Sec-Fetch-Mode: cors' \
  -H 'Sec-Fetch-Site: same-origin' \
  -H 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36' \
  -H 'sec-ch-ua: "Chromium";v="130", "Google Chrome";v="130", "Not?A_Brand";v="99"' \
  -H 'sec-ch-ua-mobile: ?0' \
  -H 'sec-ch-ua-platform: "macOS"' \
  --data-raw '{"title":"testing public 1","description":"testing public 1","visibility":"public","invited_suppliers":["testing2@gmail.com","qunat4@gmail.com","test1@gmail.com"]}'
```
5. Delete tender
```
curl 'http://localhost/tender/delete/4' \
  -X 'DELETE' \
  -H 'Accept: */*' \
  -H 'Accept-Language: en-US,en;q=0.9,vi;q=0.8' \
  -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJhdWQiOiJsb2NhbGhvc3QiLCJpYXQiOjE3MzEyNTE2OTIsImV4cCI6MTczMTI1NTI5MiwiZGF0YSI6eyJpZCI6IjEiLCJlbWFpbCI6InRlc3RpbmcxQGdtYWlsLmNvbSIsInJvbGUiOiJjb250cmFjdG9yIn19.B4aj3gbktq-EMqKqKefFtjwnAxVhu9CFRJck9-2dRO4' \
  -H 'Cache-Control: no-cache' \
  -H 'Connection: keep-alive' \
  -H 'Cookie: token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJhdWQiOiJsb2NhbGhvc3QiLCJpYXQiOjE3MzEyNTE2OTIsImV4cCI6MTczMTI1NTI5MiwiZGF0YSI6eyJpZCI6IjEiLCJlbWFpbCI6InRlc3RpbmcxQGdtYWlsLmNvbSIsInJvbGUiOiJjb250cmFjdG9yIn19.B4aj3gbktq-EMqKqKefFtjwnAxVhu9CFRJck9-2dRO4; ci_session=b3f5f52b469dfcb628657e415026692849b8653c' \
  -H 'Origin: http://localhost' \
  -H 'Pragma: no-cache' \
  -H 'Referer: http://localhost/tender/list_contractor' \
  -H 'Sec-Fetch-Dest: empty' \
  -H 'Sec-Fetch-Mode: cors' \
  -H 'Sec-Fetch-Site: same-origin' \
  -H 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36' \
  -H 'sec-ch-ua: "Chromium";v="130", "Google Chrome";v="130", "Not?A_Brand";v="99"' \
  -H 'sec-ch-ua-mobile: ?0' \
  -H 'sec-ch-ua-platform: "macOS"'
```
6. get list supplier
```
curl --silent --location --request GET 'http://localhost/tender/list_supplier' \
--header 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7' \
--header 'Accept-Language: en-US,en;q=0.9,vi;q=0.8' \
--header 'Cache-Control: no-cache' \
--header 'Connection: keep-alive' \
--header 'Cookie: token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJhdWQiOiJsb2NhbGhvc3QiLCJpYXQiOjE3MzEyNTE2OTIsImV4cCI6MTczMTI1NTI5MiwiZGF0YSI6eyJpZCI6IjEiLCJlbWFpbCI6InRlc3RpbmcxQGdtYWlsLmNvbSIsInJvbGUiOiJjb250cmFjdG9yIn19.B4aj3gbktq-EMqKqKefFtjwnAxVhu9CFRJck9-2dRO4; ci_session=b3f5f52b469dfcb628657e415026692849b8653c' \
--header 'Pragma: no-cache' \
--header 'Referer: http://localhost/tender/list_contractor' \
--header 'Sec-Fetch-Dest: document' \
--header 'Sec-Fetch-Mode: navigate' \
--header 'Sec-Fetch-Site: same-origin' \
--header 'Sec-Fetch-User: ?1' \
--header 'Upgrade-Insecure-Requests: 1' \
--header 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36' \
--header 'sec-ch-ua: "Chromium";v="130", "Google Chrome";v="130", "Not?A_Brand";v="99"' \
--header 'sec-ch-ua-mobile: ?0' \
--header 'sec-ch-ua-platform: "macOS"'
```
7. get supplier detail
```
|curl 'http://localhost/tender/view/9' \
  -H 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7' \
  -H 'Accept-Language: en-US,en;q=0.9,vi;q=0.8' \
  -H 'Cache-Control: no-cache' \
  -H 'Connection: keep-alive' \
  -H 'Cookie: token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJhdWQiOiJsb2NhbGhvc3QiLCJpYXQiOjE3MzEyNTE2OTIsImV4cCI6MTczMTI1NTI5MiwiZGF0YSI6eyJpZCI6IjEiLCJlbWFpbCI6InRlc3RpbmcxQGdtYWlsLmNvbSIsInJvbGUiOiJjb250cmFjdG9yIn19.B4aj3gbktq-EMqKqKefFtjwnAxVhu9CFRJck9-2dRO4; ci_session=b3f5f52b469dfcb628657e415026692849b8653c' \
  -H 'Pragma: no-cache' \
  -H 'Referer: http://localhost/tender/list_supplier' \
  -H 'Sec-Fetch-Dest: document' \
  -H 'Sec-Fetch-Mode: navigate' \
  -H 'Sec-Fetch-Site: same-origin' \
  -H 'Sec-Fetch-User: ?1' \
  -H 'Upgrade-Insecure-Requests: 1' \
  -H 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36' \
  -H 'sec-ch-ua: "Chromium";v="130", "Google Chrome";v="130", "Not?A_Brand";v="99"' \
  -H 'sec-ch-ua-mobile: ?0' \
  -H 'sec-ch-ua-platform: "macOS"'
```

III> Migration

1. users table
```
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('contractor','supplier') DEFAULT 'supplier',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;
```

2. Tender table
```
DROP TABLE IF EXISTS `tenders`;
CREATE TABLE `tenders` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `visibility` enum('public','private') DEFAULT 'public',
  `creator_id` int(5) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `creator_id` (`creator_id`),
  CONSTRAINT `tenders_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;
```

3. invents table

```
DROP TABLE IF EXISTS `invites`;
CREATE TABLE `invites` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `tender_id` int(5) unsigned NOT NULL,
  `supplier_email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `tender_id` (`tender_id`),
  CONSTRAINT `invites_ibfk_1` FOREIGN KEY (`tender_id`) REFERENCES `tenders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;
```

Why Choose CodeIgniter for Your Project

1.	Simplicity: CodeIgniter’s simple setup, minimal configuration, and easy-to-understand structure make it an ideal choice for small to medium-sized applications. It’s also highly beginner-friendly and can help developers learn web development quickly.
2.	Performance and Speed: With its lightweight nature, CodeIgniter is optimized for performance and speed, making it a good choice for applications where response time is critical.
3.	Flexibility and Customization: CodeIgniter does not enforce strict coding standards or heavy dependencies, giving developers the freedom to implement their custom solutions and integrate only what’s needed for the project.
4.	Ideal for Simple Projects: CodeIgniter is well-suited for straightforward applications with less complex requirements. It provides a good balance between features and simplicity, enabling developers to build applications efficiently.
5.	Documentation and Community Support: CodeIgniter has extensive documentation and a supportive community, making it easy to find tutorials, examples, and solutions for common issues. This makes CodeIgniter accessible to new developers and helpful for troubleshooting.



## Comparison: CodeIgniter vs Laravel

| Feature               | CodeIgniter                          | Laravel                                      |
|-----------------------|--------------------------------------|----------------------------------------------|
| **Complexity**        | Simple, easy to learn                | More complex, with many built-in features    |
| **Performance**       | Fast, lightweight, few dependencies  | Slightly heavier but ideal for larger apps   |
| **Routing**           | Basic                                | Advanced, supports RESTful and middleware    |
| **ORM**               | Basic Active Record                  | Powerful Eloquent ORM                        |
| **Built-In Features** | Requires additional setup for extras | Includes authentication, authorization, caching |
| **Testing**           | Limited testing support              | Comprehensive testing tools                  |
| **Community**         | Smaller, fewer resources available   | Large, active community, extensive resources |

## When to Choose CodeIgniter vs Laravel

- **Choose CodeIgniter** if:
  - You need a fast, lightweight application with simple requirements.
  - You’re a beginner wanting a quick way to learn PHP development.
  - Performance and minimal setup are your top priorities.

- **Choose Laravel** if:
  - You’re building a feature-rich, complex application.
  - You need built-in features like authentication, authorization, and RESTful API support.
  - You’re planning for a scalable, maintainable system that might grow in the future.
