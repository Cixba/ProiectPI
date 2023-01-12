<?php
    require_once("connection.php");

    $query_delete = "DROP TABLE IF EXISTS locatii, users, bookings, comments";
    $query_create = "
        CREATE TABLE users (
            id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(50) NOT NULL,
            password VARCHAR(300) NOT NULL,
            token VARCHAR(50) NOT NULL,
            type VARCHAR(10) NOT NULL
        );
    ";

    $query_insert = "
        INSERT INTO users(email, password, token, type) VALUES
        (
            'admin@hoteltest.com', 
            '37268335dd6931045bdcdf92623ff819a64244b53d0e746d438797349d4da578', 
            'mn7fzgdL6wWVJrJugWMrx4VBBDx1UnpQIC8J9D5cJAYbZtnVY7', 
            'admin'
        ),
        (
            'alex@email.com', 
            '37268335dd6931045bdcdf92623ff819a64244b53d0e746d438797349d4da578', 
            'asfsgsgfgsdgwry4574tsgsrgshsrhsrhddhsrbseggesrhhgd', 
            'user'
        )
    ";

    $query_locatii_create = "
        CREATE TABLE locatii (
            id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            titlu VARCHAR(50) NOT NULL,
            pret INT(10) NOT NULL,
            locatie VARCHAR(100) NOT NULL,
            suprafata INT(10) NOT NULL,
            servicii VARCHAR(100) NOT NULL,
            capacitate INT(10) NOT NULL,
            id_creator INT(10) UNSIGNED NOT NULL,
            CONSTRAINT FK_Creator FOREIGN KEY (id_creator) REFERENCES users(id)
        );
    ";

    $query_locatii_insert = "
        INSERT INTO locatii (titlu, pret, locatie, suprafata, servicii, capacitate, id_creator) VALUES 
        ('Ramada Plaza by Wyndham Bucharest', 100, 'Bucuresti', 40, 'Room service, sampanie, fructe, piscina, aer conditionat', 3, 1),
        ('RIN Central Hotel', 85, 'Bucuresti', 37, 'Room service, aer conditionat', 2, 1),
        ('Orhideea Residence and spa', 77, 'Bucuresti', 37, 'Room service, aer conditionat, spa', 2, 1),
        ('Hotel Riviera', 128, 'Plaja Mamaia', 45, 'Room service, aer conditionat, plaja', 4, 1),
        ('Hotel Malibu', 115, 'Plaja Mamaia', 41, 'Room service, aer conditionat, plaja, parcare, wifi', 4, 1)
    ";

    $query_bookings_create = "
        CREATE TABLE bookings (
            id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            client_id INT(10) UNSIGNED,
            location_id INT(10) UNSIGNED,
            start_date DATE,
            end_date DATE
        )
    ";

    $query_comments_create = "
        CREATE TABLE comments (
            id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(50),
            parere VARCHAR(1000),
            location_id INT(10) UNSIGNED
        )
    ";

    mysqli_query($conn, $query_delete);
    mysqli_query($conn, $query_create);
    mysqli_query($conn, $query_insert);
    mysqli_query($conn, $query_locatii_create);
    mysqli_query($conn, $query_locatii_insert);
    mysqli_query($conn, $query_bookings_create);
    mysqli_query($conn, $query_comments_create);
?>