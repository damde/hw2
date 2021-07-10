CREATE DATABASE db;

USE db;

CREATE TABLE Hotels(
  id int NOT NULL AUTO_INCREMENT,
  denomination VARCHAR(128),
  description VARCHAR(512),
  address VARCHAR(128),
  image VARCHAR(128),
  updated_at DATE,
  created_at DATE,
  PRIMARY KEY(id)
);

CREATE TABLE Rooms(
  IDRoom int NOT NULL AUTO_INCREMENT,
  hotel int,
  number int,
  price float,
  type VARCHAR(32),
  image VARCHAR(32),
  updated_at DATETIME,
  created_at DATETIME,
  FOREIGN KEY(hotel) REFERENCES Hotels(id),
  PRIMARY KEY(IDRoom)
);

CREATE TABLE Customers(
  username VARCHAR(32),
  name VARCHAR(32),
  surname VARCHAR(32),
  email VARCHAR(128),
  password VARCHAR(128),
  updated_at DATE,
  created_at DATE,
  PRIMARY KEY(username)
);

CREATE TABLE Reservations(
  IDReservation int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  customers VARCHAR(32),
  dateReservation date NOT NULL DEFAULT NOW(),
  startDate date,
  endDate date,
  totalPrice float,
  updated_at DATE,
  created_at DATE,
  FOREIGN KEY (customers) REFERENCES Customers(username)
);

CREATE TABLE Reserve(
  reservation int NOT NULL,
  room int NOT NULL,
  updated_at DATE,
  created_at DATE,
  FOREIGN KEY(reservation) REFERENCES Reservations(IDReservation),
  FOREIGN KEY(room) REFERENCES Rooms(IDRoom),
  PRIMARY KEY(reservation, room)
);

CREATE TABLE Reviews(
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  customer VARCHAR(32),
  hotel int,
  text VARCHAR(512),
  updated_at DATETIME,
  created_at DATETIME,
  FOREIGN KEY(hotel) REFERENCES Hotels(id),
  FOREIGN KEY (customer) REFERENCES Customers(username)
);

INSERT INTO Hotels(denomination, description, address, image)
VALUES(
    'Hotel 1',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris risus ex, semper in semper quis, molestie quis justo. Nunc cursus tempor feugiat. Nulla nec convallis diam, quis egestas nulla. Fusce elementum dictum dignissim. Donec at metus id massa rutrum commodo.',
    'VIA DELLE VIE, CATANIA',
    '/images/one.png'
  ),
  (
    'Hotel 2',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris risus ex, semper in semper quis, molestie quis justo. Nunc cursus tempor feugiat. Nulla nec convallis diam, quis egestas nulla. Fusce elementum dictum dignissim. Donec at metus id massa rutrum commodo.',
    'VIALE DEI VIALI, MESSINA',
    '/images/two.png'
  ),
  (
    'Hotel 4',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris risus ex, semper in semper quis, molestie quis justo. Nunc cursus tempor feugiat. Nulla nec convallis diam, quis egestas nulla. Fusce elementum dictum dignissim. Donec at metus id massa rutrum commodo.',
    'PIAZZA X, PALERMO',
    '/images/three.png'
  ),
  (
    'Hotel 5',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris risus ex, semper in semper quis, molestie quis justo. Nunc cursus tempor feugiat. Nulla nec convallis diam, quis egestas nulla. Fusce elementum dictum dignissim. Donec at metus id massa rutrum commodo.',
    'VIA Y, PALERMO',
    '/images/threeh.png'
  );

INSERT INTO Rooms(hotel, price, type)
VALUES (1, 50, "Singola"),
  (1, 100, "Doppia"),
  (1, 150, "Matrimoniale"),
  (1, 50, "Singola"),
  (1, 100, "Doppia"),
  (1, 150, "Matrimoniale"),
  (1, 50, "Singola"),
  (1, 100, "Doppia"),
  (1, 150, "Matrimoniale"),
  (1, 50, "Singola"),
  (1, 100, "Doppia"),
  (1, 150, "Matrimoniale"),
  (2, 50, "Singola"),
  (2, 100, "Doppia"),
  (2, 150, "Matrimoniale"),
  (3, 50, "Singola"),
  (3, 100, "Doppia"),
  (3, 150, "Matrimoniale"),
  (2, 50, "Singola"),
  (2, 100, "Doppia"),
  (2, 150, "Matrimoniale"),
  (3, 50, "Singola"),
  (3, 100, "Doppia"),
  (3, 150, "Matrimoniale"),
  (2, 50, "Singola"),
  (2, 100, "Doppia"),
  (2, 150, "Matrimoniale"),
  (3, 50, "Singola"),
  (3, 100, "Doppia"),
  (3, 150, "Matrimoniale");