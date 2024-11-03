## Employee Directory
# Introduction

- This project is a simple REST API for an Employee Directory system developed using Laravel. The objective is to build secure, efficient, and performant APIs with proper database design, SQL querying, and caching. Security measures such as IP whitelisting and rate limiting have also been implemented.
Features

   - Database models and migrations for departments and employees.
   - RESTful API endpoints to manage departments and employees.
   - Custom SQL queries for specific data retrieval.
   - Performance optimization with caching.
   - Security layer with IP whitelisting.
   - Rate limiting to prevent abuse.
   - Validation for data integrity.
   - Comprehensive tests for each endpoint.

## Setup Instructions
1. Clone the Repository
   - git clone https://github.com/your-username/employee-directory.git
   - cd employee-directory
2. Run Migrations
   - php artisan migrate
## API Documentation
# Endpoints
# List Departments
    - URL: GET /api/departments
    - Description: Retrieves a list of all departments.
    - Caching: 10 minutes

# List Employees by Department

    - URL: GET /api/departments/{id}/employees
    - Description: Retrieves a list of employees in a specific department.

# Add a New Employee

    - URL: POST /api/employees
    - Description: Adds a new employee to the directory.
    - Request Body:
- json
{
    "first_name": "Amira",
    "last_name": "Alaa",
    "email": "ameraalaa641@gmail.com",
    "phone_number": "01005729533",
    "hire_date": "2024-01-10",
    "salary": "8000.00",
    "department_id": 1
}
# Update Employee Details

    - URL: PUT /api/employees/{id}
    - Description: Updates the details of an existing employee.
    - Request Body: (same as Add a New Employee)
# Delete an Employee

    - URL: DELETE /api/employees/{id}
    - Description: Deletes an employee from the directory.

# Count Employees by Department

    - URL: GET /api/departments/employees/count
    - Description: Retrieves the total number of employees in each department.
    - Caching: 5 minutes
# Highest Salary Information

    - URL: GET /api/employees/highest-salary
    - Description: Retrieves the highest salary across all employees along with the employee's name, department, and hire date.

# Average Salary by Department

    - URL: GET /api/departments/average-salary
    - Description: Calculates and returns the average salary for each department.
