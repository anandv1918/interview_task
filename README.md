# PHP Admin Portal

A simple admin portal with authentication, customer management, and invoice tracking built with CodeIgniter 3.s

## Requirements

- PHP 7.2+ (Compatible with PHP 8.0)
- MySQL 5.7+
- Apache/Nginx
- CodeIgniter 3.1.11

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/anandv1918/interview_task.git
   cd interview_task

2. Set up the database:
   Run interview_task.sql file

3. Configure the application:

   Update database credentials in application/config/database.php

   Set base_url in application/config/config.php


## Usage

1. Access the login page:
   
   http://localhost/php-admin-portal/auth/login

   Username: test
   Password: 123

2. Admin Portal Features:

   1. Customers Section

      View all customers

      Add/edit/delete customer details

   2. Invoices Section

      View all invoices

      Add/edit/delete invoice details

   3. API Endpoints:

      GET /api/{type} - Retrieve customers/invoices

      GET /api/{type}/{id} - Retrieve customers/invoices by id

      POST /api/{type} - Create new record

      PUT /api/{type} - Update record

      DELETE /api/{type} - Delete record