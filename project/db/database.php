<?php
class DatabaseHelper {
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: ".$db->connect_error);
        }
    }

    /*Public functions */

    /**
     * Return true if username is already in the database, false otherwise
     */
    public function checkUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE user.username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return mysqli_num_rows($result) == 1;
    }
    
    /**
     * Return true if email is already in the database, false otherwise
     */
    public function checkEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE user.email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return mysqli_num_rows($result) == 1;
    }

    /**
     * Return false if email or username already taken, false otherwise
     */
    public function createAccount($username, $name, $email, $password) {
        if ($this->checkUsername($username) || $this->checkEmail($email)) {
            return false;
        }

        $stmt = $this->db->prepare("INSERT INTO USER (username, password, name, email) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $username, $password, $name, $email);
        return $stmt->execute();
    }

    /**
     * Return the user if values are correct
     */
    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE user.email = ? AND user.password = ?");
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createPost($username, $title, $description, $location, $category, $taggedUsernameList, $image = null) {
        if(is_null($image)) {
            $stmt = $this->db->prepare("INSERT INTO post (title, description, location, category, author) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('sssss', $title, $description, $location, $category, $username);
        }
        else {
            $stmt = $this->db->prepare("INSERT INTO post (title, description, location, image, category, author) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('ssssss', $title, $description, $location, $image, $category, $username);
        }
        $stmt->execute();
        $postId = $stmt->insert_id;

        foreach ($taggedUsernameList as $taggedUsername) {
            $stmt = $this->db->prepare("INSERT INTO tag (postId, username) VALUES (?, ?)");
            $stmt->bind_param('is', $postId, $taggedUsername);
            $stmt->execute();

            $this->createNotification(4, $username, $taggedUsername, $postId);
        }
        return true;//TODO: modifica
    }

    public function loadHomePage($username) {
        $stmt = $this->db->prepare("SELECT * FROM post WHERE post.author IN (SELECT friendship.sender FROM friendship WHERE friendship.receiver = ? AND friendship.accepted = TRUE UNION SELECT friendship.receiver FROM friendship WHERE friendship.sender = ? AND friendship.accepted = TRUE) ORDER BY datetime DESC");
        $stmt->bind_param('ss', $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get all the post of a user.
     */
    public function getUserPosts($username) {
        $stmt = $this->db->prepare("SELECT * FROM post WHERE post.author = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get a user information.
     */
    public function getUser($username) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE user.username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC)[0];
    }

    /**
     * Return true if the users are friends, false otherwise
     */
    public function areFriends($username1, $username2) {
        $stmt = $this->db->prepare("SELECT * FROM friendship WHERE friendship.accepted = 1 AND ((friendship.sender = ? AND friendship.receiver = ?) OR (friendship.sender = ? AND friendship.receiver = ?))");
        $stmt->bind_param('ssss', $username1, $username2, $username2, $username1);
        $stmt->execute();
        $result = $stmt->get_result();

        return mysqli_num_rows($result) >= 1;
    }

    /**
     * Get a post.
     */
    public function getPost($postId) {
        $stmt = $this->db->prepare("SELECT * FROM post WHERE post.id = ?");
        $stmt->bind_param('s', $postId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC)[0];
    }

    /**
     * Get all the users tagged in a post.
     */
    public function getPostTaggedUsers($postId) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE user.username IN (SELECT tag.username FROM tag WHERE tag.postId = ?)");
        $stmt->bind_param('i', $postId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get all the post comments
     */
    public function getComments($postId) {
        $stmt = $this->db->prepare("SELECT * FROM comment WHERE comment.postId = ?");
        $stmt->bind_param('i', $postId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createComment($username, $postId, $text) {
        $postAuthor = getPost($postId)["author"];

        $stmt = $this->db->prepare("INSERT INTO COMMENT (postId, username, text) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $postId, $username, $text);
        $stmt->execute();

        $this->createNotification(2, $username, $postAuthor, $postId);
        return $stmt->affected_rows > 0;
    }

    /**
     * Put a star on a post and create a notification about it.
     * Return true if success, false otherwise
     */
    public function createStar($username, $postId) {
        $postAuthor = getPost($postId)["author"];

        $stmt = $this->db->prepare("INSERT INTO star (postId, username) VALUES (?, ?)");
        $stmt->bind_param('is', $postId, $username);
        $stmt->execute();

        $this->createNotification(1, $username, $postAuthor, $postId);
        return $stmt->affected_rows > 0;
    }

    /**
     * Remove a star from a post
     */
    public function removeStar($username, $postId) {
        $stmt = $this->db->prepare("DELETE FROM star WHERE star.postId = ? AND star.username = ?");
        $stmt->bind_param('is', $postId, $username);
        $stmt->execute();

        return null;
    }

    /**
     * Get all the user friends
     * Return the friends
     */
    public function getFriends($username) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE user.username in (SELECT friendship.sender as friend FROM friendship WHERE friendship.receiver = ? AND friendship.accepted = TRUE UNION SELECT friendship.receiver FROM friendship WHERE friendship.sender = ? AND friendship.accepted = TRUE)");
        $stmt->bind_param('ss', $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get all the usernames matching a text
     */
    public function searchUsers($username) {
        $username = "%$username%";
        $stmt = $this->db->prepare("SELECT * FROM user WHERE user.username LIKE ? ORDER BY username");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get all the user notifications
     * Return the notifications
     */
    public function getNotifications($username) {
        $stmt = $this->db->prepare("SELECT * FROM notification WHERE notification.receiver = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get the number of new notifications for a user
     */
    public function getNewNotificationNumber($username) {
        $stmt = $this->db->prepare("SELECT * FROM notification WHERE notification.readState = 0 AND notification.receiver = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return mysqli_num_rows($result);
    }

    /**
     * Read all user notifications
     * Returns nothing
     */
    public function readAllNotifications($username) {
        $stmt = $this->db->prepare("UPDATE notification SET notification.readState = 1 WHERE notification.receiver = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
    }

    /**
     * Send a friendship request and create a notification about it.
     * Return true if success, false otherwise
     */
    public function sendFriendship($senderUsername, $receiverUsername) {
        $stmt = $this->db->prepare("INSERT INTO FRIENDSHIP (sender, receiver) VALUES (?, ?)");
        $stmt->bind_param('ss', $sender, $receiver);
        $stmt->execute();

        $this->createNotification(3, $senderUsername, $receiverUsername);
        return $stmt->affected_rows > 0;
    }

    /**
     * Get all the categories name.
     */
    public function getAllCategories() {
        $stmt = $this->db->prepare("SELECT category.name FROM category");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /*Private functions */

    /**
     * Send a new notification to a user.
     * Return true if success, false otherwise
     */
    private function createNotification($type, $sender, $receiver, $postId = null) {
        if($type == 3) {
            $stmt = $this->db->prepare("INSERT INTO NOTIFICATION (type, sender, receiver) VALUES (?, ?, ?)");
            $stmt->bind_param('iss', $type, $sender, $receiver);
        }
        else {
            $stmt = $this->db->prepare("INSERT INTO NOTIFICATION (type, sender, receiver, postId) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('issi', $type, $sender, $receiver, $postId);
        }
        
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }
}
?>