<div align="center">
    <p align="center"><b>EVsolaris</b></p>
    <p align="center"><img  src="https://github.com/AbirBokhtiar/EVsolaris/blob/main/image/EVsolaris_prev.png" height="240px" width="420px"></p>
    <p>The Bright Way to Charge Your EV!</p>
</div>
<div align="left">
    <h3><u>Project description:</u></h3>
    <p>A web application that allows users to find, book, and monitor solar-powered vehicle charging stations in real-time. Users can view the availability of charging stations, reserve     a spot, and track their charging sessions.</p>
</div>
<br>

## Installation

1. Clone the repository into your local server directory:
   ```bash
   git clone https://github.com/AbirBokhtiar/EVsolaris.git
   ```

2. Start the XAMPP server and ensure Apache and MySQL are running.

3. Import the database:
   - Open `phpMyAdmin` in your browser.
   - Create a new database named `project`.
   - Import the SQL file provided in the repository.

4. Update database credentials:
   - Open the `db.php` files in the `model` folders for each module.
   - Ensure the database credentials match your local setup:
     ```php
     $dbhost = "localhost";
     $dbusername = "root";
     $dbpassword = "";
     $dbname = "project";
     ```

5. Access the application:
   - Open your browser and navigate to `http://localhost/Web_Project`.

---

## User Roles and features

### Admin
- Manage charging stations.
- Monitor user activities and reservations.

### EV Customer
- Locate nearby charging stations on a map.
- Reserve a spot at a charging station.
- Track the charging status in real-time.

### Station Manager
- Manage availability of charging stations.
- View and update charging session statuses.

---

## Contributing

1. Fork the repository.
2. Create a new branch:
   ```bash
   git checkout -b feature/your-feature-name
   ```
3. Commit your changes:
   ```bash
   git commit -m "Add your message here"
   ```
4. Push to the branch:
   ```bash
   git push origin feature/your-feature-name
   ```
5. Open a pull request.

---
