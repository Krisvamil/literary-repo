📚 Literary Repo
    Literary Repo is a PHP-based web application designed to manage and showcase literary works. It facilitates user authentication, author and reader profiles, commenting, and more. The application follows a modular architecture to ensure scalability and maintainability.

🚀 Features
    - User Authentication (Login, Registration, Logout)
    - Author and Reader Profiles
    - CRUD Operations for Literary Works
    - Commenting System
    - File Uploads for User Content
    - MVC Architecture
    - Environment Configuration via .env
    - Routing and Request Handling
    - Unit and Integration Testing with PHPUnit

🛠️ Getting Started
    Prerequisites
        - PHP 7.4 or higher
        - Composer
        - MySQL or compatible database
        - Web server (e.g., Apache or Nginx)

    Installation
        1. Clone the Repository
            git clone https://github.com/Krisvamil/literary-repo.git
            cd literary-repo
        
        2. Install Dependencies
            composer install

        3. Set Up Environment Variables
            - Copy the example environment file and configure it:
                cp .env.example .env

            - Update the .env file with your database credentials and other settings.
        
        4. Run Migrations
            - Execute the migration scripts to set up the database schema:
                php database/migrate.php
            
        5. Configure Web Server
            - Set the public/ directory as the web root.
            - Ensure URL rewriting is enabled (see .htaccess for Apache).

📂 Directory Structure
    literary-repo/
    ├── app/                            # Application logic (non-web-accessible)
    │   ├── Controllers/                # Handle HTTP requests and route to business logic
    │   │   ├── BaseController.php
    │   │   ├── AuthController.php
    │   │   ├── WorkController.php
    │   │   ├── CommentController.php
    │   │   ├── AuthorController.php
    │   │   └── ReaderController.php
    │   ├── Models/                     # ORM-like classes representing DB entities
    │   │   ├── Model.php
    │   │   ├── User.php
    │   │   ├── Work.php
    │   │   ├── Comment.php
    │   │   ├── Author.php
    │   │   └── Reader.php
    │   ├── Routes/                     # Route definitions for each module
    │   │   ├── auth.php
    │   │   ├── works.php
    │   │   ├── comments.php
    │   │   ├── authors.php
    │   │   └── readers.php
    │   ├── Utils/                      # Helper utilities and reusable logic
    │   │   ├── FileCache.php
    │   │   └── Logger.php
    │   └── Views/                      # PHP-based UI templates
    │       ├── layout.php
    │       ├── login.php
    │       ├── dashboard.php
    │       ├── authors/
    │       ├── readers/
    │       ├── partials/
    │       └── errors/
    ├── bootstrap/
    │   └── app.php                     # Bootstrap file to init configs, routes, autoload
    ├── config/                         # Configuration and environment-specific setup
    │   ├── config.php
    │   └── db.php
    ├── database/                       # Migration and versioned schema scripts
    │   ├── migrations/
    │   │   ├── 001_create_users_table.up.sql
    │   │   ├── 001_create_users_table.down.sql
    │   │   ├── 002_create_works_table.up.sql
    │   │   ├── 002_create_works_table.down.sql
    │   │   └── ...
    │   ├── migrate.php
    │   ├── rollback.php
    │   └── README.md
    ├── public/                         # Web root (only accessible directory from browser)
    │   ├── css/
    │   ├── js/
    │   ├── images/
    │   ├── uploads/
    │   ├── .htaccess
    │   └── index.php
    ├── storage/                        # Runtime storage (NEVER exposed publicly)
    │   ├── cache/
    │   ├── logs/
    │   │   └── app.log
    │   └── sessions/
    ├── tests/                          # Unit and integration tests
    │   ├── bootstrap.php
    │   ├── phpunit.xml
    │   ├── Models/
    │   │   ├── UserTest.php
    │   │   ├── WorkTest.php
    │   │   └── ...
    │   ├── Controllers/
    │   │   ├── AuthControllerTest.php
    │   │   └── ...
    │   └── Views/
    │       ├── DashboardViewTest.php
    │       └── ...
    ├── vendor/                         # Composer-managed dependencies
    ├── .env.example                    # Example environment config (copy to `.env`)
    ├── .gitignore                      # Files and folders to ignore in Git
    ├── composer.json                   # PHP package dependencies and autoload settings
    └── README.md                       # Project description and setup instructions

⚙️ Configuration
    - Environment Variables: Managed via the .env file.
    - Database Configuration: Defined in config/db.php, utilizing environment variables.
    - Application Settings: Located in config/config.php.

🧪 Testing
    - Testing Framework: PHPUnit
    - Test Directory: tests/
    - Configuration File: tests/phpunit.xml

    To run tests:
        vendor/bin/phpunit

📝 License
    This project is licensed under the MIT License.

🤝 Contributing
    Contributions are welcome! Please fork the repository and submit a pull request.

📞 Contact
    For questions or support, please contact kristjanivanmickaeldiva@gmail.com.

