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
        $stmt = $this->db->prepare("SELECT COUNT(*) = 0 FROM user WHERE user.username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return mysqli_num_rows($result) == 1;
    }
    
    /**
     * Return true if email is already in the database, false otherwise
     */
    public function checkEmail($email) {
        $stmt = $this->db->prepare("SELECT COUNT(*) = 0 FROM user WHERE user.email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return mysqli_num_rows($result) == 1;
    }

    /**
     * Return false if email or username already taken, false otherwise
     */
    public function createAccount($username, $name, $birthdate, $email, $password) {
        if (checkUsername($username) || checkEmail($email)) {
            return false;
        }

        $stmt = $this->db->prepare("INSERT INTO USER (username, password, name, email, birthDate) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssss', $username, $password, $name, $email, $birthdate);
        return $stmt->execute();
    }

    /**
     * Return true if email and password are correct, false otherwise
     */
    public function login($email, $password) {
        if (checkEmail($email) == false) {
            return false; //email not found
        }
        $stmt = $this->db->prepare("SELECT * FROM user WHERE user.username = ? AND user.password = ?");
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return mysqli_num_rows($result) == 1;
    }

    public function createPost() {
        
    }

    public function loadHomePage() {
        
    }

    /**
     * Get all the post of a user.
     */
    public function getUserPosts($username) {
        $stmt = $this->db->prepare("SELECT * FROM post WHERE post.username = ?");
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

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function areFriends($username1, $username2) {
        
    }

    /**
     * Get a post.
     */
    public function getPost($postId) {
        $stmt = $this->db->prepare("SELECT * FROM post WHERE post.id = ?");
        $stmt->bind_param('i', $postId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
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

    public function createComment() {
        
    }

    /**
     * Put a star on a post and create a notification about it.
     * Return true if success, false otherwise
     */
    public function createStar($username, $postId) {
        $stmt = $this->db->prepare("INSERT INTO star (postId, username) VALUES (?, ?)");
        $stmt->bind_param('is', $postId, $username);
        $stmt->execute();

        // createNotification($receiverUsername, "$senderUsername sent you a friend request.");
        return $stmt->affected_rows > 0;
    }

    /**
     * Get all the user friends
     * Return the friends
     */
    public function getFriends($username) {
        $stmt = $this->db->prepare("SELECT friendship.sender FROM friendship WHERE friendship.receiver = ? UNION SELECT friendship.receiver FROM friendship WHERE friendship.sender = ?");
        $stmt->bind_param('ss', $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get all the user notifications
     * Return the notifications
     */
    public function getNotifications($username) {
        $stmt = $this->db->prepare("SELECT * FROM notification WHERE notification.username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Read all user notifications
     * Returns nothing
     */
    public function readAllNotifications($username) {
        $stmt = $this->db->prepare("UPDATE notification SET notification.read = 1 WHERE notification.username = ?");
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

        createNotification($receiverUsername, "$senderUsername sent you a friend request.");
        return $stmt->affected_rows > 0;
    }

    /*Private functions */

    /**
     * Send a new notification to a user.
     * Return true if success, false otherwise
     */
    private function createNotification($username, $text) {
        $stmt = $this->db->prepare("INSERT INTO NOTIFICATION (datetime, text, username) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', date('Y-m-d H:i:s'), $text, $username);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }
}
?>