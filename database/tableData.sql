use lifeline;

-- Inserimento categorie
INSERT INTO CATEGORY (name) VALUES
('Love'),
('Travel'),
('Fun'),
('Food'),
('Fashion'),
('Art'),
('Music'),
('Sport');

-- Inserimento utenti
INSERT INTO USER (username, passwordHash, name, email, profilePic, friendsCount) VALUES
('user1', '$2y$10$gSymACzkVWNOcgfuekbeqebM/faIRCUbsQHpOq9u53IREvZzwftBC', 'User One', 'user1@example.com', 'default.jpg', 4),
('user2', '$2y$10$JhR19ixeY/gTxhGeQ1R0tOluH97AImOe853fuGrEGcX8DaKa7vod6', 'User Two', 'user2@example.com', '1.jpg', 2),
('user3', '$2y$10$5uY9azSo4eTycQYJrwmMO./TQu6F4n7rqOUMci33dqENwRV7piFzu', 'User Three', 'user3@example.com', 'default.jpg', 3),
('user4', '$2y$10$oZzthyhxGGnf4/fU2Qf/rez4t4IkNEMccdxoZHUASK8a7v7g75R3i', 'User Four', 'user4@example.com', '2.jpg', 2),
('user5', '$2y$10$rYX/5TXUOtWNHu4YRqz0XOkcWtfWKJ2qF54dQTnUwJvOJ4P2P9TN.', 'User Five', 'user5@example.com', '3.jpg', 1);

-- Inserimento post
INSERT INTO POST (timestamp, title, description, location, image, starsCount, commentsCount, category, author) VALUES
(TIMESTAMP('2024-01-01 12:00:00'), 'Preferred outfit', 'This is my best gucci outfit of the show.', 'Milano', '4.jpg', 3, 2, 'Fashion', 'user1'),
(TIMESTAMP('2024-01-02 12:00:00'), 'What a view', "I don't think i ever slept with a view like this.", 'Padova', '5.jpg', 1, 0, 'Travel', 'user2'),
(TIMESTAMP('2024-01-03 12:00:00'), 'Blink 182', 'The concert is EPIC!!', 'Castiglione di Ravenna', '6.jpg', 1, 0, 'Music', 'user4');

INSERT INTO POST (timestamp, title, description, image, starsCount, commentsCount, category, author) VALUES
(TIMESTAMP('2024-01-05 12:00:00'), "That's a lunch!", "I don't think we can eat all this stuff, send help!", '7.jpg', 2, 2, 'Food', 'user3'),
(TIMESTAMP('2024-01-05 22:00:00'), 'Fantastic day', 'Today the weather is beautiful and this park even more.', '8.jpg', 0, 0, 'Fun', 'user2'),
(TIMESTAMP('2024-01-06 12:00:00'), 'A new champion', 'Today Jannik Sinner won his first ever grand slam against medvedev after 2 lost sets, FORZA SINNER!', '9.jpg', 1, 0, 'Sport', 'user3'),
(TIMESTAMP('2024-01-08 10:00:00'), 'Art gallery', 'This art gallery is so inspirational.', '10.jpg', 0, 0, 'Art', 'user4'),
(TIMESTAMP('2024-01-08 12:00:00'), 'Delicious pasta', 'I just cooked this pasta today and i swear it was soooo good.', '11.jpg', 1, 0, 'Food', 'user5');

INSERT INTO POST (timestamp, title, description, starsCount, commentsCount, category, author) VALUES
(TIMESTAMP('2024-01-09 12:00:00'), 'Sadness', "I just broke up with my girlfriend, i'm so sad right now.", 2, 0, 'Love', 'user1'),
(TIMESTAMP('2024-01-10 12:00:00'), 'Poor cat', 'I just realized that my cat has been locked in the bathroom for the past 5 hours!', 0, 0, 'Fun', 'user5');

-- Inserimento stelle (star)
INSERT INTO STAR (postId, username) VALUES
(1, 'user2'),
(1, 'user3'),
(1, 'user4'),
(2, 'user1'),
(3, 'user3'),
(4, 'user1'),
(4, 'user4'),
(6, 'user4'),
(8, 'user1'),
(9, 'user4'),
(9, 'user5');

-- Inserimento commenti
INSERT INTO COMMENT (postId, username, text, timestamp) VALUES
(1, 'user2', 'Great post!', TIMESTAMP('2024-01-02 12:15:00')),
(1, 'user5', 'Nice one!', TIMESTAMP('2024-01-03 12:30:00')),
(5, 'user1', 'Amazing!', TIMESTAMP('2024-01-07 17:00:00')),
(5, 'user4', 'Delicious!', TIMESTAMP('2024-01-08 10:30:00'));

-- Inserimento tag
INSERT INTO TAG (postId, username) VALUES
(1, 'user2'),
(1, 'user4'),
(5, 'user1');

-- Inserimento notifiche star, commenti e tag
INSERT INTO NOTIFICATION (timestamp, type, sender, receiver, postId) VALUES
(TIMESTAMP('2024-01-02 12:40:00'), 1, 'user2', 'user1', 1),
(TIMESTAMP('2024-01-02 12:50:00'), 1, 'user3', 'user1', 1),
(TIMESTAMP('2024-01-02 17:30:00'), 1, 'user4', 'user1', 1),
(TIMESTAMP('2024-01-10 11:00:00'), 1, 'user4', 'user1', 9),
(TIMESTAMP('2024-01-10 19:15:00'), 1, 'user5', 'user1', 9),
(TIMESTAMP('2024-01-03 10:30:00'), 1, 'user1', 'user2', 2),
(TIMESTAMP('2024-01-06 12:40:00'), 1, 'user1', 'user3', 5),
(TIMESTAMP('2024-01-06 12:50:00'), 1, 'user4', 'user3', 5),
(TIMESTAMP('2024-01-07 17:30:00'), 1, 'user4', 'user3', 6),
(TIMESTAMP('2024-01-03 11:00:00'), 1, 'user3', 'user4', 3),
(TIMESTAMP('2024-01-08 19:15:00'), 1, 'user1', 'user5', 8),

(TIMESTAMP('2024-01-02 12:15:00'), 2, 'user2', 'user1', 1),
(TIMESTAMP('2024-01-03 12:30:00'), 2, 'user5', 'user1', 1),
(TIMESTAMP('2024-01-07 17:00:00'), 2, 'user1', 'user3', 5),
(TIMESTAMP('2024-01-08 10:30:00'), 2, 'user4', 'user3', 5),

(TIMESTAMP('2024-01-01 12:00:00'), 4, 'user1', 'user2', 1),
(TIMESTAMP('2024-01-01 12:00:00'), 4, 'user1', 'user4', 1),
(TIMESTAMP('2024-01-05 12:00:00'), 4, 'user3', 'user1', 5);

INSERT INTO NOTIFICATION (timestamp, type, sender, receiver) VALUES
(TIMESTAMP('2023-01-01 12:40:00'), 3, 'user1', 'user2'),
(TIMESTAMP('2023-01-01 12:50:00'), 3, 'user1', 'user3'),
(TIMESTAMP('2023-01-03 17:30:00'), 3, 'user1', 'user4'),
(TIMESTAMP('2023-01-04 11:00:00'), 3, 'user1', 'user5'),
(TIMESTAMP('2023-01-05 19:15:00'), 3, 'user2', 'user3'),
(TIMESTAMP('2023-01-07 10:30:00'), 3, 'user3', 'user4'),
(TIMESTAMP('2023-01-01 12:40:00'), 3, 'user4', 'user5');

-- Amicizie
INSERT INTO FRIENDSHIP (accepted, receiver, sender) VALUES
(TRUE, 'user1', 'user2'),
(TRUE, 'user1', 'user3'),
(TRUE, 'user1', 'user4'),
(TRUE, 'user1', 'user5'),
(TRUE, 'user2', 'user3'),
(TRUE, 'user3', 'user4'),
(FALSE, 'user4', 'user5');