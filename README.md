<div style="display: flex; align-items: center; justify-content-center; margin-bottom: 30px">
  <img src="public/assets/img/icon.png" alt="Project Logo" height="100" style="float: left; margin-right: 10px;">

  <div>
    <h1 style="font-size: 50px; margin-bottom: -15px; border-bottom: 0;">GNA - Timetabling System</h1>
    <p style="font-size: 15.85px; margin-top: 0;">Automated Timetabling System with Artificial Neural Networks and Genetic Algorithm</p>
  </div>
</div>

## Description

This project is an implementation of an automated scheduling system for the Faculty of Engineering at the University of Cirebon. The methods employed include predicting course demand using Artificial Neural Networks (ANN) and optimal scheduling using the Genetic Algorithm.

## Key Features

- Course demand prediction using Artificial Neural Networks (ANN).
- Optimal class scheduling using the Genetic Algorithm.
- Generation of class schedules, assignment of teaching staff, and scheduling that adheres to specific constraints.
- Application development using CodeIgniter 4, PHP 8.2, and PostgreSQL 15.

## User Guide

1. **Installation:**

   - Clone this repository:

   ```shell
   git clone https://github.com/ranggamyd/ANN_x_GA_Timetabling_system.git
   ```

   - Navigate to the project directory:

   ```shell
   cd ANN_x_GA_Timetabling_system
   ```

   - Install dependencies:

   ```shell
   composer install
   ```

   - Copy the configuration file:

   ```shell
   cp .env.example .env
   ```

   - Configure the database in the `.env` file.

2. **Running the Application:**

   - Run database migrations:

   ```shell
   php spark migrate:fresh
   ```

   - Run database seeders:

   ```shell
   php spark db:seed DatabaseSeeder
   ```

   - Run the application:

   ```shell
   php spark serve
   ```

   - Access the application through the browser: http://localhost:8080

3. **Contribution:**
   - Fork this repository.
   - Create a new branch: `git checkout -b new-feature`
   - Commit changes: `git commit -m "Add new feature"`
   - Push to the branch: `git push origin new-feature`
   - Create a Pull Request.

## Directory Structure

- `/app`: Main application code.
- `/public`: Public files such as CSS, JS, and images.
- `/database`: Database migrations and seeds.
- `/docs`: Project documentation.
- `/tests`: Unit tests.

## Contributors

- Rangga Manggala Yudha <br>
  200511129 - Informatics Engineering <br>
  Muhammadiyah University of Cirebon

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for more details.
