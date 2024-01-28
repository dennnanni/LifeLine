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
INSERT INTO USER (username, passwordHash, name, email, profilePic, friendsCount) VALUES
('user1', '$2y$10$gSymACzkVWNOcgfuekbeqebM/faIRCUbsQHpOq9u53IREvZzwftBC', 'User One', 'user1@example.com', 'default.jpg', 4),
('user2', '$2y$10$JhR19ixeY/gTxhGeQ1R0tOluH97AImOe853fuGrEGcX8DaKa7vod6', 'User Two', 'user2@example.com', 'user2.jpg', 2),
('user3', '$2y$10$5uY9azSo4eTycQYJrwmMO./TQu6F4n7rqOUMci33dqENwRV7piFzu', 'User Three', 'user3@example.com', 'default.jpg', 3),
('user4', '$2y$10$oZzthyhxGGnf4/fU2Qf/rez4t4IkNEMccdxoZHUASK8a7v7g75R3i', 'User Four', 'user4@example.com', 'user4.jpg', 2),
('user5', '$2y$10$rYX/5TXUOtWNHu4YRqz0XOkcWtfWKJ2qF54dQTnUwJvOJ4P2P9TN.', 'User Five', 'user5@example.com', 'user5.jpg', 1);

-- Inserimento post
INSERT INTO POST (datetime, title, description, location, image, starsCount, commentsCount, category, author) VALUES
('2024-01-01 12:00:00', 'Post 11', 'Description 11', 'Milano', '1.jpg', 3, 2, 'Fashion', 'user1'),
('2024-01-02 12:00:00', 'Post 22', 'Description 22', 'Padova', '2.jpg', 1, 0, 'Travel', 'user2'),
('2024-01-03 12:00:00', 'Post 41', 'Description 41', 'Castiglione di Ravenna', '3.jpg', 1, 0, 'Music', 'user4');

INSERT INTO POST (datetime, title, description, image, starsCount, commentsCount, category, author) VALUES
('2024-01-05 22:00:00', 'Post 21', 'Description 21', '4.jpg', 0, 0, 'Fun', 'user2'),
('2024-01-05 12:00:00', 'Post 31', 'Description 31', '5.jpg', 2, 2, 'Food', 'user3'),
('2024-01-06 12:00:00', 'Post 32', 'Description 32', '6.jpg', 1, 0, 'Fashion', 'user3'),
('2024-01-08 10:00:00', 'Post 42', 'Description 42', '7.jpg', 0, 0, 'Art', 'user4'),
('2024-01-08 12:00:00', 'Post 51', 'Description 51', '8.jpg', 1, 0, 'Food', 'user5');

INSERT INTO POST (datetime, title, description, starsCount, commentsCount, category, author) VALUES
('2024-01-09 12:00:00', 'Post 12', 'Description 12', 2, 0, 'Love', 'user1'),
('2024-01-10 12:00:00', 'Post 52', 'Description 52', 0, 0, 'Fun', 'user5');

-- Inserimento stelle (star)
INSERT INTO STAR (postId, username) VALUES
(1, 'user2'),
(1, 'user3'),
(1, 'user4'),
(2, 'user1'),
(3, 'user3'),
(5, 'user1'),
(5, 'user4'),
(6, 'user4'),
(8, 'user1'),
(9, 'user4'),
(9, 'user5');

-- Inserimento commenti
INSERT INTO COMMENT (postId, username, text, datetime) VALUES
(1, 'user2', 'Great post!', '2024-01-02 12:15:00'),
(1, 'user5', 'Nice one!', '2024-01-03 12:30:00'),
(5, 'user1', 'Amazing!', '2024-01-07 17:00:00'),
(5, 'user4', 'Delicious!', '2024-01-08 10:30:00');

-- Inserimento tag
INSERT INTO TAG (postId, username) VALUES
(1, 'user2'),
(1, 'user4'),
(5, 'user1');

-- Inserimento notifiche star, commenti e tag
INSERT INTO NOTIFICATION (datetime, type, sender, receiver, postId) VALUES
('2024-01-02 12:40:00', 1, 'user2', 'user1', 1),
('2024-01-02 12:50:00', 1, 'user3', 'user1', 1),
('2024-01-02 17:30:00', 1, 'user4', 'user1', 1),
('2024-01-10 11:00:00', 1, 'user4', 'user1', 9),
('2024-01-10 19:15:00', 1, 'user5', 'user1', 9),
('2024-01-03 10:30:00', 1, 'user1', 'user2', 2),
('2024-01-06 12:40:00', 1, 'user1', 'user3', 5),
('2024-01-06 12:50:00', 1, 'user4', 'user3', 5),
('2024-01-07 17:30:00', 1, 'user4', 'user3', 6),
('2024-01-03 11:00:00', 1, 'user3', 'user4', 3),
('2024-01-08 19:15:00', 1, 'user1', 'user5', 8),

('2024-01-02 12:15:00', 2, 'user2', 'user1', 1),
('2024-01-03 12:30:00', 2, 'user5', 'user1', 1),
('2024-01-07 17:00:00', 2, 'user1', 'user3', 5),
('2024-01-08 10:30:00', 2, 'user4', 'user3', 5),

('2024-01-01 12:00:00', 4, 'user1', 'user2', 1),
('2024-01-01 12:00:00', 4, 'user1', 'user4', 1),
('2024-01-05 12:00:00', 4, 'user3', 'user1', 5);

INSERT INTO NOTIFICATION (datetime, type, sender, receiver) VALUES
('2023-01-01 12:40:00', 3, 'user1', 'user2'),
('2023-01-01 12:50:00', 3, 'user1', 'user3'),
('2023-01-03 17:30:00', 3, 'user1', 'user4'),
('2023-01-04 11:00:00', 3, 'user1', 'user5'),
('2023-01-05 19:15:00', 3, 'user2', 'user3'),
('2023-01-07 10:30:00', 3, 'user3', 'user4'),
('2023-01-01 12:40:00', 3, 'user4', 'user5');

-- Amicizie
INSERT INTO FRIENDSHIP (accepted, receiver, sender) VALUES
(TRUE, 'user1', 'user2'),
(TRUE, 'user1', 'user3'),
(TRUE, 'user1', 'user4'),
(TRUE, 'user1', 'user5'),
(TRUE, 'user2', 'user3'),
(TRUE, 'user3', 'user4'),
(FALSE, 'user4', 'user5');