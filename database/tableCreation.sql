CREATE DATABASE IF NOT EXISTS lifeline;

USE lifeline;

-- DBSpace Section
-- _______________

-- Tables Section
-- _____________

CREATE TABLE IF NOT EXISTS CATEGORY (
    name VARCHAR(32) NOT NULL,
    PRIMARY KEY (name)
);

CREATE TABLE IF NOT EXISTS USER (
    username VARCHAR(25) NOT NULL,
    password VARCHAR(128) NOT NULL,
    name VARCHAR(64) NOT NULL,
    email VARCHAR(64) NOT NULL,
    birthDate DATETIME NOT NULL,
    profilePic VARCHAR(255) NOT NULL,
    friendsCount INT NOT NULL DEFAULT 0,
    PRIMARY KEY (username),
    UNIQUE (email)
);

CREATE TABLE IF NOT EXISTS POST (
    id INT NOT NULL AUTO_INCREMENT,
    datetime DATETIME NOT NULL,
    title VARCHAR(64) NOT NULL,
    description VARCHAR(255),
    location VARCHAR(64),
    image VARCHAR(255),
    starsCount INT NOT NULL DEFAULT 0,
    commentsCount INT NOT NULL DEFAULT 0,
    category VARCHAR(32) NOT NULL,
    username VARCHAR(25) NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT REF_POST_CATEG_FK FOREIGN KEY (category) REFERENCES CATEGORY(name),
    CONSTRAINT REF_POST_USER_FK FOREIGN KEY (username) REFERENCES USER(username)
);

CREATE TABLE IF NOT EXISTS STAR (
    postId INT NOT NULL,
    username VARCHAR(25) NOT NULL,
    PRIMARY KEY (postId, username),
    CONSTRAINT REF_STAR_USER_FK FOREIGN KEY (username) REFERENCES USER(username),
    CONSTRAINT REF_STAR_POST FOREIGN KEY (postId) REFERENCES POST(id)
);

CREATE TABLE IF NOT EXISTS TAG (
    postId INT NOT NULL,
    username VARCHAR(25) NOT NULL,
    PRIMARY KEY (username, postId),
    CONSTRAINT REF_TAG_USER FOREIGN KEY (username) REFERENCES USER(username),
    CONSTRAINT REF_TAG_POST_FK FOREIGN KEY (postId) REFERENCES POST(id)
);

CREATE TABLE IF NOT EXISTS FRIENDSHIP (
    sender VARCHAR(25) NOT NULL,
    receiver VARCHAR(25) NOT NULL,
    accepted BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY (receiver, sender),
    CONSTRAINT REF_FRIEN_USER_1 FOREIGN KEY (receiver) REFERENCES USER(username),
    CONSTRAINT REF_FRIEN_USER_FK FOREIGN KEY (sender) REFERENCES USER(username)
);

CREATE TABLE IF NOT EXISTS NOTIFICATION (
    id INT NOT NULL AUTO_INCREMENT,
    datetime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    text VARCHAR(255) NOT NULL,
    read BOOLEAN NOT NULL DEFAULT FALSE,
    username VARCHAR(25) NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT REF_NOTIF_USER_FK FOREIGN KEY (username) REFERENCES USER(username)
);

CREATE TABLE IF NOT EXISTS COMMENT (
    postId INT NOT NULL,
    username VARCHAR(25) NOT NULL,
    text VARCHAR(255) NOT NULL,
    datetime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (postId, username),
    CONSTRAINT REF_COMME_USER_FK FOREIGN KEY (username) REFERENCES USER(username),
    CONSTRAINT REF_COMME_POST FOREIGN KEY (postId) REFERENCES POST(id)
);