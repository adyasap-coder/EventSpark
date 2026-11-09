
USE eventspark;

-- ADMIN
CREATE TABLE ADMIN(
Admin_ID INT PRIMARY KEY,
Admin_Name VARCHAR(100),
Email VARCHAR(100),
Password VARCHAR(100)
);

INSERT INTO ADMIN VALUES
(1,'Admin1','admin1@gmail.com','admin123'),
(2,'Admin2','admin2@gmail.com','admin123'),
(3,'Admin3','admin3@gmail.com','admin123'),
(4,'Admin4','admin4@gmail.com','admin123');

-- CATEGORY
CREATE TABLE EVENT_CATEGORY(
Category_ID INT PRIMARY KEY,
Category_Name VARCHAR(100),
Description VARCHAR(255),
Admin_ID INT,
FOREIGN KEY (Admin_ID) REFERENCES ADMIN(Admin_ID)
);

INSERT INTO EVENT_CATEGORY VALUES
(101,'Concert','Music Events',1),
(102,'Sports','Sports Matches',1),
(103,'Theatre','Drama & Plays',2),
(104,'Comedy','Stand-up Shows',2),
(105,'Tech','Tech Conferences',3),
(106,'Festival','Cultural Festivals',4);

-- EVENT
CREATE TABLE EVENT(
E_ID INT PRIMARY KEY,
E_Name VARCHAR(150),
E_Date DATE,
E_Time TIME,
Venue VARCHAR(200),
Total_Seat INT,
Ticket_Price DECIMAL(10,2),
Category_ID INT,
FOREIGN KEY (Category_ID) REFERENCES EVENT_CATEGORY(Category_ID)
);

INSERT INTO EVENT VALUES
(1001,'Arijit Singh Live','2026-04-15','19:00:00','Kolkata Stadium',100,1500,101),
(1002,'IPL Match KKR vs MI','2026-04-20','18:00:00','Eden Gardens',120,2000,102),
(1003,'Hamlet Play','2026-04-25','17:00:00','City Theatre',80,800,103),
(1004,'Standup by Zakir Khan','2026-04-28','20:00:00','Auditorium Hall',90,1000,104),
(1005,'Rock Concert Night','2026-05-02','19:30:00','Open Arena',110,1200,101),
(1006,'Startup Summit','2026-05-05','10:00:00','Tech Park',150,500,105),
(1007,'Durga Puja Festival','2026-10-10','09:00:00','City Grounds',200,300,106);

-- USER
CREATE TABLE USER(
User_ID INT PRIMARY KEY AUTO_INCREMENT,
Name VARCHAR(100),
Email VARCHAR(100) UNIQUE,
Password VARCHAR(100),
Street VARCHAR(100),
City VARCHAR(50),
Zip_Code VARCHAR(10),
Registration_Date DATE
);

INSERT INTO USER(Name,Email,Password,Street,City,Zip_Code,Registration_Date) VALUES
('Rahul','rahul@gmail.com','1234','Street1','Kolkata','700001','2026-03-01'),
('Priya','priya@gmail.com','1234','Street2','Delhi','110001','2026-03-02'),
('Amit','amit@gmail.com','1234','Street3','Mumbai','400001','2026-03-03'),
('Sneha','sneha@gmail.com','1234','Street4','Chennai','600001','2026-03-04'),
('Rohit','rohit@gmail.com','1234','Street5','Bangalore','560001','2026-03-05'),
('Neha','neha@gmail.com','1234','Street6','Hyderabad','500001','2026-03-06'),
('Karan','karan@gmail.com','1234','Street7','Pune','411001','2026-03-07'),
('Anjali','anjali@gmail.com','1234','Street8','Jaipur','302001','2026-03-08'),
('Vikram','vikram@gmail.com','1234','Street9','Lucknow','226001','2026-03-09'),
('Meera','meera@gmail.com','1234','Street10','Ahmedabad','380001','2026-03-10');

-- BOOKING
CREATE TABLE BOOKING(
B_ID INT AUTO_INCREMENT PRIMARY KEY,
B_Date DATE,
B_Status VARCHAR(20),
User_ID INT,
E_ID INT,
FOREIGN KEY (User_ID) REFERENCES USER(User_ID),
FOREIGN KEY (E_ID) REFERENCES EVENT(E_ID)
);

-- SEAT
CREATE TABLE SEAT(
Seat_ID INT AUTO_INCREMENT PRIMARY KEY,
E_ID INT,
Seat_No VARCHAR(10),
Seat_Type VARCHAR(30),
Seat_Status VARCHAR(20),
B_ID INT,
FOREIGN KEY (E_ID) REFERENCES EVENT(E_ID),
FOREIGN KEY (B_ID) REFERENCES BOOKING(B_ID)
);

-- TICKET
CREATE TABLE TICKET(
Ticket_ID INT AUTO_INCREMENT PRIMARY KEY,
Seat_ID INT,
B_ID INT,
Ticket_Status VARCHAR(20),
FOREIGN KEY (Seat_ID) REFERENCES SEAT(Seat_ID),
FOREIGN KEY (B_ID) REFERENCES BOOKING(B_ID)
);

-- PAYMENT
CREATE TABLE PAYMENT(
P_ID INT AUTO_INCREMENT PRIMARY KEY,
B_ID INT,
P_Date DATE,
P_Status VARCHAR(20),
Amount DECIMAL(10,2),
Payment_Method VARCHAR(30),
FOREIGN KEY (B_ID) REFERENCES BOOKING(B_ID)
);

-- BASIC SEATS (AUTO WORKING)
INSERT INTO SEAT(E_ID,Seat_No,Seat_Type,Seat_Status) VALUES
(1001,'A1','VIP','Available'),
(1001,'A2','VIP','Available'),
(1001,'A3','VIP','Available'),
(1002,'A1','VIP','Available'),
(1003,'A1','VIP','Available'),
(1004,'A1','VIP','Available');