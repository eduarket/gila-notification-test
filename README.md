
![Logo](https://gila.wanoot.com/assets/img/logo.jpg)


# gila Notification Test

Webapp for send notification messages

![App Screenshot](https://gila.wanoot.com/assets/img/screenshot.jpg)
## Run Locally

Clone the project

```bash
  git clone https://link-to-project
```

Go to the project directory

```bash
  cd my-project
```

Start Docker

```bash
  docker-compose up -d
```

## API Reference

#### Get mockup users

```http
  GET /user/read.php
```

#### Get notifications log

```http
  GET /notification/read.php
```

#### Create notification

```http
  POST /notification/create.php
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `messageType` | `string` | **Required**. |
| `message` | `string` | **Required**. |

#### Delete all notifications log

```http
  DELETE /notification/deleteAll.php
```

## Tech Stack

**Frontend:** PHP, MVC, CSS, Vue.js, Axios

**Backend:** PHP, MySQL

