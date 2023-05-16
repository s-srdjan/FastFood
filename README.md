# FastFood

FastFood is a simple PHP web application developed as a project for the application software development course at the university. Its main purpose is food ordering, providing a welcome page, a food menu page, an admin panel with CRUD operations, and a functional cart. The application is styled using pure CSS.

## Features

- Welcome page: Introduces users to the FastFood application.
- Food menu page: Displays a list of available food items for ordering.
- Admin panel: Allows administrators to perform CRUD (Create, Read, Update, Delete) operations on the food menu and manage orders.
- Cart functionality: Users can add food items to their cart and place orders.
- Styling: The application is styled using pure CSS for a visually appealing user interface.

## Database

The application uses a MySQL database named `fast_food`, which consists of the following tables:

- `jelovnik`: Stores information about the food items available for ordering.
- `korisnici`: Contains user information.
- `narudzbe`: Stores order details.

## Usage

To run the FastFood application on your local machine, follow these steps:

1. Install a local server environment like XAMPP (https://www.apachefriends.org/) that supports PHP and MySQL.
2. Clone this repository: `git clone https://github.com/s-srdjan/FastFood.git`
3. Place the cloned files in the appropriate directory of your local server.
4. Import the database structure and data by executing the SQL file `fast_food.sql` in your MySQL server.
5. Start your local server (e.g., XAMPP) and ensure that the Apache and MySQL services are running.
6. Access the application through your web browser using the URL: `http://localhost/FastFood`

Feel free to explore the different pages of the FastFood application and place food orders through the cart.

## License

This project is licensed under the [MIT License](LICENSE).

