# php-template

A simple PHP template with basic routing functionality and directory structure to get started on a new project quickly. It has zero third-party dependencies except in the development environment. This project is meant to be used with PHP 8 and above.

It uses Tailwind CSS for styling and a sleek DB class for database interaction so that you don't have to use low-level functions (only MySQL and MSSQL for now).

## Prerequisites

1. [Node.js](https://nodejs.org/)
2. [PHP 8 or above](https://www.php.net/)

## Setup

```bash
npx @mohiwalla/php .
```

Visit [http://localhost:8000](http://localhost:8000).

## Scripts

The following npm scripts are available:

- `build`: Compiles the Tailwind CSS from `input.css` to `style.css`.
- `start`: Builds the CSS and starts the development server.
- `dev`: Starts the PHP built-in server on `localhost:8000`.
- `css`: Watches for changes in `input.css` and rebuilds `style.css`.

## License

This project is licensed under the ISC License. See the [LICENSE](LICENSE) file for more details.

## Author

- **mohiwalla**
