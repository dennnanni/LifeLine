use lifeline;

-- Inserimento categorie
INSERT INTO CATEGORY (name) VALUES
('Love'),
('Travel'),
('Fun'),
('Food'),
('Fashion'),
('Art'),
('Music');

-- Inserimento utenti
INSERT INTO USER (username, password, name, email, birthDate, profilePic) VALUES
('user1', '1', 'User One', 'user1@example.com', '1990-01-01', 'profile1.jpg'),
('user2', '2', 'User Two', 'user2@example.com', '1995-02-15', 'profile2.jpg'),
('user3', '3', 'User Three', 'user3@example.com', '1988-08-10', 'profile3.jpg');

-- Inserimento post
INSERT INTO POST (datetime, title, description, location, image, starsCount, commentsCount, category, username) VALUES
('2024-01-01 12:00:00', 'Post 1', 'Description 1', 'Location 1', 'image1.jpg', 5, 3, 'Love', 'user1'),
('2024-01-02 14:30:00', 'Post 2', 'Description 2', 'Location 2', 'image2.jpg', 8, 2, 'Travel', 'user2'),
('2024-01-03 16:45:00', 'Post 3', 'Description 3', 'Location 3', 'image3.jpg', 12, 4, 'Fun', 'user3'),
('2024-01-04 10:15:00', 'Post 4', 'Description 4', 'Location 4', 'image4.jpg', 3, 1, 'Food', 'user1'),
('2024-01-05 18:20:00', 'Post 5', 'Description 5', 'Location 5', 'image5.jpg', 6, 5, 'Fashion', 'user2'),
('2024-01-06 22:00:00', 'Post 6', 'Description 6', 'Location 6', 'image6.jpg', 10, 2, 'Art', 'user3'),
('2024-01-07 09:30:00', 'Post 7', 'Description 7', 'Location 7', 'image7.jpg', 7, 3, 'Music', 'user1'),
('2024-01-08 15:45:00', 'Post 8', 'Description 8', 'Location 8', 'image8.jpg', 4, 2, 'Love', 'user2');

-- Inserimento stelle (star)
INSERT INTO STAR (postId, username) VALUES
(1, 'user2'),
(1, 'user3'),
(3, 'user1'),
(3, 'user2'),
(4, 'user3'),
(5, 'user1'),
(6, 'user2'),
(7, 'user3');

-- Inserimento commenti
INSERT INTO COMMENT (postId, username, text, datetime) VALUES
(1, 'user2', 'Great post!', '2024-01-01 12:15:00'),
(1, 'user3', 'Nice one!', '2024-01-01 12:30:00'),
(3, 'user1', 'Amazing!', '2024-01-03 17:00:00'),
(4, 'user2', 'Delicious!', '2024-01-04 10:30:00'),
(5, 'user3', 'Love the outfit!', '2024-01-05 18:45:00'),
(7, 'user1', 'Awesome music!', '2024-01-07 10:00:00'),
(8, 'user2', 'Beautiful photo!', '2024-01-08 16:00:00');

-- Inserimento tag
INSERT INTO TAG (postId, username) VALUES
(2, 'user1'),
(2, 'user3'),
(4, 'user1'),
(5, 'user2'),
(6, 'user3'),
(8, 'user1');

-- Inserimento notifiche
-- Notifiche per stelle (star)
INSERT INTO NOTIFICATION (datetime, type, sender, receiver) VALUES
('2024-01-01 12:40:00', 1, 'user2', 'user1'),
('2024-01-01 12:50:00', 1, 'user3', 'user1'),
('2024-01-03 17:30:00', 1, 'user1', 'user3'),
('2024-01-04 11:00:00', 1, 'user2', 'user3'),
('2024-01-05 19:15:00', 1, 'user3', 'user2'),
('2024-01-07 10:30:00', 1, 'user1', 'user3');

-- Notifiche per commenti
INSERT INTO NOTIFICATION (datetime, type, sender, receiver) VALUES
('2024-01-01 12:40:00', 2, 'user2', 'user1'),
('2024-01-01 12:50:00', 2, 'user3', 'user1'),
('2024-01-03 17:30:00', 2, 'user1', 'user3'),
('2024-01-04 11:00:00', 2, 'user2', 'user3'),
('2024-01-05 19:15:00', 2, 'user3', 'user2'),
('2024-01-07 10:30:00', 2, 'user1', 'user3');

-- Amicizie
INSERT INTO FRIENDSHIP (accepted, receiver, sender) VALUES
(TRUE, 'user1', 'user2'),
(TRUE, 'user1', 'user3');