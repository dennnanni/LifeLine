<?php
class DatabaseHelper {
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: ".$this->db->connect_error);
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

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("INSERT INTO USER (username, passwordHash, name, email) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $username, $passwordHash, $name, $email);
        return $stmt->execute();
    }

    /**
     * Return the user if values are correct
     */
    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE user.email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        
        return (count($result) == 0 ? null : (password_verify($password, $result[0]["passwordHash"]) ? $result[0] : null));
    }

    /**
     * Change a user photo url
     */
    public function changeUserPhoto($username, $photo) {
        $stmt = $this->db->prepare("UPDATE user SET user.profilePic = ? WHERE user.username = ?");
        $stmt->bind_param('ss', $photo, $username);
        $stmt->execute();
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
    }


    /**
     * Deletes the given post from database
     */
    public function deletePost($postId) {
        $stmt = $this->db->prepare("DELETE FROM post WHERE id = ?");
        $stmt->bind_param("i", $postId);
        $stmt->execute();

        return;
    }

    /**
     * Deletes the comment from database
     */
    public function deleteComment($postId, $username, $timestamp) {
        $stmt = $this->db->prepare("DELETE FROM comment WHERE postId = ? AND username = ? AND timestamp = ?");
        $stmt->bind_param("iss", $postId, $username, $timestamp);
        $stmt->execute();

        return;
    }

    public function loadHomePage($username, $categoryFilter = null) {
        $query =    "SELECT * ".
                    "FROM post ".
                    "WHERE post.author IN (SELECT friendship.sender ".
                                        "FROM friendship ".
                                        "WHERE friendship.receiver = ? AND friendship.accepted = TRUE ".
                                        "UNION ".
                                        "SELECT friendship.receiver ".
                                        "FROM friendship ".
                                        "WHERE friendship.sender = ? AND friendship.accepted = TRUE) ";
    
        if (!is_null($categoryFilter) && !empty($categoryFilter)) {
            $filterList = implode("', '", $categoryFilter);
            $query .= "AND post.category IN ('$filterList') ";
        }
    
        $query .= "ORDER BY timestamp DESC";
    
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get all posts shown in the personal diary page
     */
    public function getDiary($username) {
        $stmt = $this->db->prepare('SELECT * FROM post WHERE post.author = ? OR EXISTS (SELECT * FROM tag WHERE post.id = tag.postId AND tag.username = ?) ORDER BY post.timestamp DESC');
        $stmt->bind_param('ss', $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get all posts shown in the diary page
     */
    public function getFriendDiary($username, $friend) {
        $stmt = $this->db->prepare('SELECT * FROM post LEFT JOIN tag ON post.author = tag.username WHERE post.author = ? OR tag.username = ? AND EXISTS (SELECT * FROM friendship WHERE (sender = ? AND receiver = ?) OR (sender = ? AND receiver = ?)) ORDER BY post.timestamp DESC');
        $stmt->bind_param('ssssss', $friend, $friend, $friend, $username, $username, $friend);
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
     * Return the friendship status: 1 if the users are friends, 0 if the request is pending, -1 if they are not
     */
    public function getFriendshipStatus($username1, $username2) {
        $stmt = $this->db->prepare("SELECT * FROM friendship WHERE (friendship.sender = ? AND friendship.receiver = ?) OR (friendship.sender = ? AND friendship.receiver = ?)");
        $stmt->bind_param('ssss', $username1, $username2, $username2, $username1);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    /**
     * Removes a friendship
     */
    public function removeFriend($username1, $username2) {
        $stmt = $this->db->prepare("DELETE FROM friendship WHERE (friendship.sender = ? AND friendship.receiver = ?) OR (friendship.sender = ? AND friendship.receiver = ?)");
        $stmt->bind_param('ssss', $username1, $username2, $username2, $username1);
        $stmt->execute();
        $stmt->get_result();

        $this->updateFriendsCount($username1, -1);
        $this->updateFriendsCount($username2, -1);
    }

    /**
     * Removes a request
     */
    public function removeRequest($username1, $username2) {
        $stmt = $this->db->prepare("DELETE FROM friendship WHERE (friendship.sender = ? AND friendship.receiver = ?) OR (friendship.sender = ? AND friendship.receiver = ?)");
        $stmt->bind_param('ssss', $username1, $username2, $username2, $username1);
        
        return $stmt->execute();
    }

    /**
     * Accepts friendship request and updates user's friends count
     * 
     */
    public function acceptRequest($senderUsername, $receiverUsername) {
        $stmt = $this->db->prepare('UPDATE friendship SET accepted = 1 WHERE sender = ? AND receiver = ?');
        $stmt->bind_param('ss', $senderUsername, $receiverUsername);
        $stmt->execute();
        $stmt->get_result();

        $this->updateFriendsCount($senderUsername);
        $this->updateFriendsCount($receiverUsername);
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
        $stmt = $this->db->prepare("SELECT username FROM user WHERE user.username IN (SELECT tag.username FROM tag WHERE tag.postId = ?)");
        $stmt->bind_param('i', $postId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get all the post comments
     */
    public function getStars($postId) {
        $stmt = $this->db->prepare("SELECT star.username FROM star WHERE star.postId = ?");
        $stmt->bind_param('i', $postId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get all the post comments
     */
    public function getComments($postId) {
        $stmt = $this->db->prepare("SELECT * FROM comment WHERE comment.postId = ? ORDER BY comment.timestamp");
        $stmt->bind_param('i', $postId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get last comment from a given user in a given post.
     */
    public function getLastCommentInPost($postId) {
        $stmt = $this->db->prepare('SELECT * FROM comment WHERE comment.postId = ? ORDER BY comment.timestamp DESC LIMIT 1');
        $stmt->bind_param('i', $postId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    /**
     * Writes a comment 
     */
    public function createComment($username, $postId, $text) {
        $postAuthor = $this->getPost($postId)["author"];

        $stmt = $this->db->prepare("INSERT INTO COMMENT (postId, username, text) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $postId, $username, $text);
        $stmt->execute();

        $this->updateCommentsCounter($postId);
        $this->createNotification(2, $username, $postAuthor, $postId);
        return $stmt->affected_rows > 0;
    }

    /**
     * Returns true if the given post is starred by the given user, false otherwise
     */
    public function isPostStarredByUser($postId, $username) {
        $stmt = $this->db->prepare("SELECT * FROM star WHERE postId = ? AND username = ?");
        $stmt->bind_param("is", $postId, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

    /**
     * Put a star on a post and create a notification about it.
     * Return true if success, false otherwise
     */
    public function addStar($username, $postId) {
        $postAuthor = $this->getPost($postId)["author"];

        $stmt = $this->db->prepare("INSERT INTO star (postId, username) VALUES (?, ?)");
        $stmt->bind_param('is', $postId, $username);
        $stmt->execute();

        if($stmt->affected_rows > 0) {
            $this->updateStarsCounter($postId);

            $this->createNotification(1, $username, $postAuthor, $postId);
        }
        return $stmt->affected_rows > 0;
    }

    /**
     * Remove a star from a post
     */
    public function removeStar($username, $postId) {
        $postAuthor = $this->getPost($postId)["author"];

        $stmt = $this->db->prepare("DELETE FROM star WHERE star.postId = ? AND star.username = ?");
        $stmt->bind_param('is', $postId, $username);
        $stmt->execute();

        if($stmt->affected_rows > 0) {
            $this->updateStarsCounter($postId, -1);

            $this->deleteNotification(1, $username, $postAuthor, $postId);
        }

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
    public function searchUsers($currentUserUsername, $username) {
        $username = "%$username%";
        $stmt = $this->db->prepare("SELECT * FROM user WHERE user.username LIKE ? AND user.username <> ? ORDER BY username");
        $stmt->bind_param('ss', $username, $currentUserUsername);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get all the user notifications
     * Return the notifications
     */
    public function getNotifications($username) {
        $stmt = $this->db->prepare("SELECT * FROM notification WHERE notification.receiver = ? ORDER BY notification.timestamp DESC");
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
        $stmt->bind_param('ss', $senderUsername, $receiverUsername);
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

    /**
     * Delete a notification.
     * Return true if success, false otherwise
     */
    private function deleteNotification($type, $sender, $receiver, $postId = null) {
        if($type == 3) {
            $stmt = $this->db->prepare("DELETE FROM notification WHERE notification.type = ? AND notification.sender = ? AND notification.receiver = ?");
            $stmt->bind_param('iss', $type, $sender, $receiver);
        }
        else {
            $stmt = $this->db->prepare("DELETE FROM notification WHERE notification.type = ? AND notification.sender = ? AND notification.receiver = ? AND notification.postId = ?");
            $stmt->bind_param('issi', $type, $sender, $receiver, $postId);
        }
        
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    /** 
     * Updates friendsCount of the given username
     * Default value of the increment is 1, 
     * negative increment decrease friends number
     */
    private function updateFriendsCount($username, $increment = 1) {
        $stmt = $this->db->prepare('UPDATE user SET user.friendsCount = user.friendsCount + ? WHERE user.username = ?');
        $stmt->bind_param('is', $increment, $username);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    /** 
     * Updates the stars counter of the given post
     * Default value of the increment is 1, 
     * negative increment decrease star counter
     */
    private function updateStarsCounter($postId, $increment = 1) {
        $stmt = $this->db->prepare('UPDATE post SET post.starsCount = post.starsCount + ? WHERE post.id = ?');
        $stmt->bind_param('is', $increment, $postId);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    /** 
     * Updates the comments counter of the given post
     * Default value of the increment is 1, 
     * negative increment decrease comments counter
     */
    private function updateCommentsCounter($postId, $increment = 1) {
        $stmt = $this->db->prepare('UPDATE post SET post.commentsCount = post.commentsCount + ? WHERE post.id = ?');
        $stmt->bind_param('is', $increment, $postId);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }
}
?>