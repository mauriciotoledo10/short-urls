# short-urls

[![N|Solid](https://www.anexia-it.com/blog/wp-content/uploads/2015/01/codeigniter_logo.png)](https://codeigniter.com/)

short-urls é um encurtador de url rápido e prático escrito em PHP utilizando a framework CodeIgniter. O projeto nada mais é do que uma experiência para aprender alguns conceitos básicos do framework.

# Funcionalidades

  - Login e Registro de usuários.
  - Alterar Senha.
  - Visualizar Minhas URLs.


# Vantagens
  - Orientado a objetos.
  - Pode ser adaptado para o desenvolvimento de apps híbridos.
  - Padrão MVC.

### Instalação

Crie um banco de dados MySql e edite o arquivo database.php com as opções do banco de dados
```sh
config\database.php
```

## Tabelas
```sql
CREATE DATABASE `short_urls`;
```

```sql
CREATE TABLE `users` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(255) DEFAULT '',
`email` varchar(255) NOT NULL DEFAULT '',
12.2 CRIANDO A ESTRUTURA DO PROJETO E O BANCO DE DADOS 149
`passw` varchar(255) NOT NULL DEFAULT '',
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
```

```sql
CREATE TABLE `urls` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`code` varchar(10) NOT NULL,
`address` text NOT NULL,
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`user_id` int(11) DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `user_id` (`user_id`),
CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (
`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
```

Feito isto, é só acessar e ser feliz!


**Free Software, Hell Yeah!**

