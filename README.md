# SYSTEM-RESERVATION

A web application built with the Laravel framework that facilitates the reservation of spaces (salles, conférences, amphithéâtres). The system provides separate interfaces for administrators and students, allowing for efficient management of available locaux and reservations.

## 👩‍💻 Membres du Groupe

* **Oussama EL_BATTEOUI**
* **Basma EL HLAFI**
* **Maryem EL YAZGHI**
* **Soukayna EL FERCHOUNI**
* **Zakaria FAROUK**

## 🚀 Features

**Admin Features:**
- Admin Login and Logout
- Admin Dashboard (overview of locaux and recent reservations)
- Manage Locaux (view, add, edit, delete spaces)
- Manage Reservations (view all reservations, validate or refuse pending reservations)

**Student Features:**
- Student Login and Logout
- Student Dashboard (view upcoming reservations)
- View Available Locaux (search by date, time, type, and name)
- Create New Reservations
- Cancel Pending Reservations

## 🛠️ Technology Stack

- **Framework**: Laravel
- **Language**: PHP
- **Database**: MySQL
- **Frontend**: Blade Templates, Bootstrap, JavaScript

## 📁 Project Structure

```
system-reservation/
├── app/                    # Application core files
│   ├── Http/
│   │   ├── Controllers/    # Request handlers
│   │   │   ├── AdminController.php      # Admin-specific logic
│   │   │   ├── AuthController.php       # Authentication logic
│   │   │   ├── ReservationController.php # Reservation management
│   │   │   └── locauxController.php     # Local-related logic
│   │   └── Middleware/     # HTTP middleware for authentication
│   └── Models/             # Eloquent models for database entities
├── config/                 # Configuration files
├── database/               # Database related files
│   ├── migrations/         # Database schema migrations
│   └── seeders/           # Database seeders for initial data
├── resources/              # Views, assets, and language files
│   └── views/             # Blade templates for UI
└── routes/                 # Application routes
    ├── web.php            # Web routes
    └── api.php            # API routes
```

## 🔐 Login Information

For initial testing after seeding the database, you can use the following credentials:

- **Admin**: Email: `admin@ensa.ma`, Password: `password`
- **Student**: Email: `mohamed@etu.uae.ac.ma`, Password: `password`

## 🔧 Installation

### Prerequisites

- PHP (version specified in composer.json, usually 7.4 or higher)
- Composer (for managing PHP dependencies)
- Database Server (MySQL or PostgreSQL)

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/batteoui123/system-reservation.git
   cd system-reservation
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   ```
   
   Edit the `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=YOUR_DATABASE_NAME
   DB_USERNAME=YOUR_USERNAME
   DB_PASSWORD=YOUR_PASSWORD
   ```

4. **Generate application key**
   ```bash
   php artisan key:generate
   ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Seed the database (recommended for initial setup)**
   ```bash
   php artisan db:seed
   ```
   This will populate the `utilisateurs`, `admins`, `etudiants`, and `locaux` tables with initial data.

7. **Start the development server**
   ```bash
   php artisan serve
   ```

The application will be available at `http://localhost:8000`

## 📊 Database Schema

### Core Tables

- **utilisateurs**: Stores user information (name, email, password, role)
- **admins**: Links users with the 'admin' role to additional admin-specific data (currently just `utilisateur_id`)
- **etudiants**: Links users with the 'etudiant' role to student-specific data (`utilisateur_id`, `code`)
- **locaux**: Stores information about reservable spaces (nom, type, capacite, status - libre/occupé)
- **reservations**: Records reservation details (date, heure_debut, heure_fin, statut - en attente/accepte/refuse/termine, motif_reservation, motif_refus, message_annulation, etudiant_id, local_id)

## 🎯 Key Components

### Controllers
- `AuthController`: Handles authentication logic for both admin and student login
- `AdminController`: Admin dashboard and management functionality
- `ReservationController`: Manages reservation CRUD operations and validation
- `locauxController`: Handles local (space) management operations

### Authentication Routes
- `/login-admin`: Admin login interface
- `/login-etudiant`: Student login interface
- Logout functionality for both user types

## 🔐 Authentication & Authorization

The system implements role-based access control with two main roles:

- **Admin**: Full system access including locaux management, reservation oversight, and user management
- **Etudiant (Student)**: Limited access to view available spaces, create reservations, and manage their own bookings

## 📱 Functionalities and Screenshots

### Authentication

The application provides separate login interfaces for administrators and students.

**Admin Login:**
- Accessible via the `/login-admin` route
- Uses email and password for authentication
- Redirects to the admin dashboard upon successful login

![Screenshot of Admin Login Page](Screenshots/Admin%20Login%20Page.png)

**Student Login:**
- Accessible via the `/login-etudiant` route
- Uses email and password for authentication
- Redirects to the student dashboard upon successful login

![Screenshot of Student Login Page](Screenshots/Student%20Login%20Page.png)

### Admin Panel

Administrators have full control over the application's data and settings.

**Admin Dashboard:**
- Provides an overview of the system, including total number of locaux, available locaux, occupied locaux, and recent reservations

![Screenshot of Admin Dashboard](Screenshots/Admin%20Dashboard.png)

**Manage Locaux:**
- Admins can view a list of all reservable spaces (locaux)
- Add new locaux, specifying the name, type (Salle, Conférence, Amphi), and capacity
- Edit or delete existing locaux

![Screenshot of Manage Locaux - View](Screenshots/Manage%20Locaux%20-%20View.png)
![Screenshot of Manage Locaux - Add](Screenshots/Manage%20Locaux%20-%20Add.png)
![Screenshot of Manage Locaux - Edit](Screenshots/Manage%20Locaux%20-%20Edit.png)
![Screenshot of Manage Locaux - Delete](Screenshots/Manage%20Locaux%20-%20Delete.png)

**Manage Reservations:**
- View all reservations made by students
- Filter reservations by date and status (en attente, accepte, refuse, termine)
- Validate or refuse pending reservations with optional reason for refusal

![Screenshot of Manage Reservations - View](Screenshots/Manage%20Reservations%20-%20View.png)
![Screenshot of Manage Reservations - Filter](Screenshots/Manage%20Reservations%20-%20Filter.png)
![Screenshot of Manage Reservations - Validate](Screenshots/Manage%20Reservations%20-%20Validate.png)
![Screenshot of Manage Reservations - Refuse](Screenshots/Manage%20Reservations%20-%20Refuse.png)

### Student Panel

Students can view available locaux and manage their own reservations.

**Student Dashboard:**
- Displays the student's upcoming reservations, excluding those that are finished

![Screenshot of Student Dashboard](Screenshots/Student%20Dashboard.png)

**View Available Locaux:**
- Search for available locaux based on date, start time, end time, type, and name
- Results show available locaux for the specified criteria

![Screenshot of View Available Locaux - Search Form & Results](Screenshots/Available%20Locaux%20-%20Search%20Form&Results.png)

**Create New Reservations:**
- Initiate reservations for specific locaux from the available list
- Provide desired date, time slot, and reservation motive
- System validates requests, checking for conflicts and ensuring 24-hour advance booking

![Screenshot of Create New Reservation - Form Part 1](Screenshots/Available%20Locaux%20-%20Search%20Form&Results.png)
![Screenshot of Create New Reservation - Form Part 2](Screenshots/New%20Reservation%20-%20Form-suite.png)
![Screenshot of Create New Reservation - Validation Errors](Screenshots/New%20Reservation%20-%20Validation%20Errors.png)

**Cancel Pending Reservations:**
- Students can cancel their pending reservations from their dashboard

![Screenshot of Cancel Pending Reservation](Screenshots/New%20Reservation%20-%20Cancel%20Pending%20Reservation.png)

## 💻 Development Notes

- The application uses Blade templating engine for views
- Controllers are located in `app/Http/Controllers`
- Models are in `app/Models`
- Database migrations are in `database/migrations`
- Database seeders are in `database/seeders`
- Web routes are defined in `routes/web.php`, and API routes in `routes/api.php`
- Authentication logic is handled by the `AuthController`
- Admin-specific logic is in `AdminController`
- Reservation logic is in `ReservationController`
- Local-related logic is in `locauxController`
- Middleware for authentication and other HTTP handling are in `app/Http/Middleware`

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👥 Support

For support and questions:
- Create an issue in the GitHub repository
- Contact the development team
- Check the documentation in the `/docs` folder

## 🔄 Version

**Version 1.0.0**
- Initial release of SYSTEM-RESERVATION with core admin and student functionalities
- Locaux management system
- Comprehensive reservation system with validation
- Separate dashboards for admin and student users
- Role-based authentication and authorization

---

**Note**: This README is based on the actual SYSTEM-RESERVATION implementation. For specific technical details, please refer to the source code in the respective directories.