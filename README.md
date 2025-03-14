# Simple Blog Application (PHP + MVC)

This is a simple blog application built with PHP and follows the MVC (Model-View-Controller) architecture. The project integrates [Tailwind CSS](https://tailwindcss.com/) for styling and is currently under construction. The application allows users to add, view, and manage blog posts, with several key features already implemented.

---

## Features

### Implemented:
- **Layout**: A reusable layout file that maintains consistency across views.
- **Views**: Dynamic and organized templates for rendering pages.
- **Routing**: Defined routes for handling requests and navigation.
- **Authentication**: User login and registration functionality.
- **Posts**: Adding and displaying posts.

### Under Construction:
- **Delete and Update Posts**: Functionality to delete and update blog posts.

---

## Installation

1. Clone the repository:
   ```bash
   git clone <repository_url>
   cd <repository_directory>

2. Install dependencies:
``bash
composer install
npm install

3. Compile Tailwind CSS (for development):
``bash
npx tailwindcss -i ./src/Tailwind/input.css -o ./public/css/output.css --watch

4. Set up the database:
Import the provided .sql file into your database.
Update database configuration in the config/ directory.

5. Start the development server:
``bash
php -S localhost:8000 -t public

6. Folder Structure
```plaintext
root/
├── app/                # Controllers, Models, and business logic
├── config/             # Configuration files (e.g., database settings)
├── public/             # Public assets (CSS, JS, images)
├── routes/             # Application routing
├── src/                # Core development files (e.g., Tailwind input/output)
├── views/              # Templates for rendering pages
├── index.php           # Application entry point
├── package.json        # Node.js package metadata
├── composer.json       # PHP dependencies configuration
└── README.md           # Project documentation```

7. Technologies Used
Backend: PHP
Frontend: Tailwind CSS
Architecture: MVC (Model-View-Controller)
Package Management: Composer (PHP) and npm (Node.js)

8. Contribution
This project is still under development. Contributions are welcome to enhance functionality or improve the structure. To contribute:
Fork the repository.
Create a new branch (feature/your-feature-name).
Commit and push your changes.
Open a pull request.

9. License
This project is open-source and available under the MIT License.

10. Current Status
🚧 Under Construction!
The following features are pending development:
Post Deletion
Post Updates
Feel free to reach out with suggestions or feedback. Happy coding!
