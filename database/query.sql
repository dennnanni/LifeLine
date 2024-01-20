-- query di creazione account

SELECT COUNT(*) = 0 FROM user WHERE user.email = "?"; --check unicità email
SELECT COUNT(*) = 0 FROM user WHERE user.username = "?"; --check unicità username
INSERT INTO USER (username, password, name, email, birthDate, profilePic) VALUES 
('?', '?', '?', '?', '?', '?');

-- query di login

SELECT COUNT(*) = 1 FROM user WHERE user.username = "?" AND user.password = "?";

-- query di creazione post

INSERT INTO POST (datetime, title, description, location, image, category, username) VALUES
('?', '?', '?', '?', '?', '?', '?');

-- query di caricamento homepage

SELECT * FROM post WHERE post.username  IN
    (SELECT friendship.sender FROM friendship WHERE friendship.receiver = "?"
    UNION
    SELECT friendship.receiver FROM friendship WHERE friendship.sender = "?"); -- utilizzare la query per ottenere tutti gli amici di un profilo ( la stessa usata per i taggabili)

-- query di visualizzazione di un profilo

SELECT * FROM user WHERE user.username = "?"; --informazioni profilo
SELECT * FROM post WHERE post.username = "?"; --tutti i post
SELECT COUNT(*) = 1 as amici FROM
(
SELECT friendship.sender FROM friendship WHERE friendship.receiver = "?1" and friendship.sender = "?2"
UNION
SELECT friendship.receiver FROM friendship WHERE friendship.sender = "?1" and friendship.receiver = "?2"
) amicizia; --vedere se sei amico o meno
--si potrebbe anche solo ottenere la lista di amici e controllare, da php, se l'username è nella lista, da valutare.

-- query di visualizzazione di un post

SELECT * FROM post WHERE post.id = ?;
SELECT * FROM user WHERE user.username IN (SELECT tag.username FROM tag WHERE tag.postId = ?);

-- query di visualizzazione commenti
SELECT * FROM comment WHERE comment.postId = ?;

-- query di aggiunta commento

INSERT INTO COMMENT (postId, username, text, datetime) VALUES
(?, '?', '?', '?');

INSERT INTO NOTIFICATION (datetime, text, username) VALUES
('?', '?', '?');

-- query di aggiunta like

INSERT INTO STAR (postId, username) VALUES
(?, '?');

INSERT INTO NOTIFICATION (datetime, text, username) VALUES
('?', '?', '?');

-- query di visualizzazione persone da taggare (tutti gli amici di una persona)

SELECT friendship.sender FROM friendship WHERE friendship.receiver = "?"
UNION
SELECT friendship.receiver FROM friendship WHERE friendship.sender = "?";

-- query di visualizzazione notifiche

SELECT * FROM notification WHERE notification.username = "?";

UPDATE notification
SET notification.read = TRUE
WHERE notification.read = FALSE and notification.username = "?"; --imposta tutte le notifiche a lette quando viene caricata la pagina delle notifiche.

--invio richiesta d'amicizia

INSERT INTO FRIENDSHIP (receiver, sender) VALUES
('user1', 'user2'),
('user1', 'user3');

INSERT INTO NOTIFICATION (datetime, text, username) VALUES
('?', '?', '?');