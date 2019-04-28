<?php

/**
 * Class App_Model_Comment
 */
class App_Model_Comment {

    public $id;
    public $name;
    public $email;
    public $message;

    const  REGEX_URL = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

    public function __construct($comment = null) {
        if (!empty($comment)) {
            $this->name = isset($comment->name) ? $comment->name : '';
            $this->email = isset($comment->email) ? $comment->email : '';
            $this->message = isset($comment->message) ? $comment->message : '';
        }
    }

    /**
     * Getting all comments
     * @return array
     */
    public static function getAll()
    {
        $db = \CS\Db::get();
        $query = 'SELECT * FROM comment ORDER BY id DESC';

        $comments = array();

        if ($result = $db->query($query)){
            while ($comment = $result->fetch_object('App_Model_Comment')) {

                $comment->formatMessage();

                $comments []= $comment;
            }
        }

        return $comments;
    }

    /**
     * convert text url to hyperlinks on comment message
     */
    public function formatMessage() {
        preg_match_all(self::REGEX_URL, $this->message, $matches);

        $hyperlinked = array();

        foreach ($matches[0] as $url) {
            if (!array_key_exists($url, $hyperlinked)) {
                $hyperlinked[$url] = true;
                $this->message = str_replace($url, '<a href="' . $url . '">' . $url . '</a>', $this->message);
            }
        }
    }

    /**
     * Saving the comment and get return it back to show on view
     * @return object
     */
    public function save()
    {
        $result = array();

        if (empty($this->_validate())) { // because php 5.5 can :)

            $db = \CS\Db::get();
            $sql = "INSERT INTO comment (name, email, message) VALUES (?, ?, ?)";
            $query = $db->prepare($sql);
            $query->bind_param('sss', $this->name, $this->email, $this->message);

            $result['success'] = $query->execute();

            $this->formatMessage();
            $result['comment'] = $this;

        } else {
                $result['comment'] = $this;
                $result['errors'] = $this->_validate();
        }

        return (object) $result;
    }

    /**
     * Comment validation and error messages
     * @return array
     */
    private function _validate()
    {
        $errors = array();

        if (empty($this->name)) {
            $errors []= 'Name required';
        }

        if (empty($this->email)) {
            $errors []= 'Email required';
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors []= 'Email is not valid';
        }

        if (empty($this->message)) {
            $errors []= 'Message required';
        }

        return $errors;
    }
} 