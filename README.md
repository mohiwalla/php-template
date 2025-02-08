# PHP Template

[![PHP Version](https://img.shields.io/badge/PHP-8%2B-blue)](https://www.php.net/)
[![License](https://img.shields.io/badge/License-MIT-green)](https://github.com/mohiwalla/php-template/blob/master/LICENSE)
[![Tailwind CSS](https://img.shields.io/badge/TailwindCSS-v4-blueviolet)](https://tailwindcss.com/)
[![Issues](https://img.shields.io/github/issues/mohiwalla/php-template)](https://github.com/mohiwalla/php-template/issues)
[![Stars](https://img.shields.io/github/stars/mohiwalla/php-template?style=social)](https://github.com/mohiwalla/php-template/stargazers)

Welcome to PHP Template—a streamlined PHP starter kit designed to kickstart your projects with essential features and a clean directory structure. This template offers basic routing capabilities and integrates Tailwind CSS for styling, ensuring a modern and responsive design. It also includes a lightweight database class for simplified interactions with MySQL and MSSQL databases. The project is tailored for PHP 8 and above and maintains zero third-party dependencies in the production environment.

## Features

- **Basic Routing**: Effortlessly define and manage routes for your application.
- **Tailwind CSS Integration**: Utilize the utility-first CSS framework for rapid UI development.
- **Lightweight Database Class**: Simplify database operations without delving into low-level functions.
- **Modern PHP Practices**: Leverage the latest features and improvements in PHP 8.

## Prerequisites

Before setting up the project, ensure you have the following installed:

- **Node.js**: [Download Node.js](https://nodejs.org/)
- **PHP 8 or above**: [Download PHP](https://www.php.net/)

## Setup Instructions

```bash
npm init php
```

After installation, navigate to [localhost:8000](http://localhost:8000) in your browser to view the application.

## Available Scripts

The following npm scripts are available for your use:

- `build`: Compiles Tailwind CSS from input.css to style.css.
- `start`: Builds the CSS and starts the development server.

## Project Structure

The project follows a clear and organized structure:

- `public/`: Contains publicly accessible files, including the entry point index.php.
- `src/`: Houses the core application code, such as routing and database classes.
- `tailwind.config.js`: Configuration file for Tailwind CSS.
- `.env`: Environment variables configuration file.

## Contributing

Contributions are welcome! If you have suggestions or improvements, feel free to open an issue or submit a pull request.

## License

This project is licensed under the ISC License. See the [LICENSE](https://github.com/mohiwalla/php-template/blob/master/LICENSE) file for more details.
