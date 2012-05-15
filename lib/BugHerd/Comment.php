<?php

/**
 * BugHerd Comment object
 *
 * @property int $id Comment ID
 * @property string $text Comment text
 * @property int $user_id User ID of the user than made the comment
 * @property DateTime $created Date user was created
 * @property DateTime $updated Date user was last updated
 *
 * @author Jonathan Bernardi <spekkionu@gmail.com>
 * @license New BSD http://www.opensource.org/licenses/bsd-license.php
 * @package BugHerd
 */
class BugHerd_Comment
{

  /**
   * Comment ID
   * @var int $id
   */
  private $id = null;

  /**
   * Comment text
   * @var string $name
   */
  private $text = null;

  /**
   * User id
   * @var int $user_id
   */
  private $user_id = null;

  /**
   * Date the comment was created
   * @var string $created
   */
  private $created = null;

  /**
   * Date the comment was last updated
   * @var string $updated
   */
  private $updated = null;

  /**
   * Gets comment id
   * @return int Comment ID
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Sets comment id
   * @param int $id The comment id
   * @return BugHerd_Comment
   */
  public function setId($id) {
    $this->id = (int) $id;
    return $this;
  }

  /**
   * Gets comment text
   * @return string Comment text
   */
  public function getText() {
    return $this->text;
  }

  /**
   * Sets comment text
   * @param string $text Comment text
   * @return BugHerd_Comment
   */
  public function setText($text) {
    $this->text = (string) $text;
    return $this;
  }

  /**
   * Gets User id
   * @return int User id
   */
  public function getUserId() {
    return $this->user_id;
  }

  /**
   * Sets User id
   * @param id $user_id User id
   * @return BugHerd_Comment
   */
  public function setUserId($user_id) {
    $this->user_id = (int) $user_id;
    return $this;
  }

  /**
   * Gets date the comment was created
   * @return DateTime Comment creation date
   */
  public function getCreated() {
    return $this->created;
  }

  /**
   * Sets the date the comment was created
   * @param string|DateTime $date Creation date
   * @return BugHerd_Comment
   */
  public function setCreated($date) {
    if (!($date instanceof DateTime)) {
      $date = date_create($date);
      if ($date === false) {
        $date = null;
      }
    }
    $this->created = $date;
    return $this;
  }

  /**
   * Gets date the comment was last updated
   * @return DateTime Comment last updated date
   */
  public function getUpdated() {
    return $this->updated;
  }

  /**
   * Sets the date the comment was last updated
   * @param string|DateTime $date Last updated date
   * @return BugHerd_Comment
   */
  public function setUpdated($date) {
    if (!($date instanceof DateTime)) {
      $date = date_create($date);
      if ($date === false) {
        $date = null;
      }
    }
    $this->updated = $date;
    return $this;
  }

  /**
   * Magic getter
   * @param string $name
   * @return mixed
   * @throws InvalidArgumentException
   */
  public function __get($name) {
    switch ($name) {
      case "id":
      case "comment-id":
      case "comment_id":
        return $this->getId();
        break;
      case "text":
        return $this->getText();
        break;
      case "user-id":
      case "user_id":
        return $this->getUserId();
        break;
      case "created":
      case "created_at":
      case "created-at":
        return $this->getCreated();
        break;
      case "updated":
      case "updated-at":
      case "updated_at":
        return $this->getUpdated();
        break;
      default:
        throw new InvalidArgumentException("Invalid property {$name}");
        break;
    }
  }

  /**
   * Magic setter
   * @param string $name
   * @param mixed $value
   * @throws InvalidArgumentException
   */
  public function __set($name, $value) {
    switch ($name) {
      case "id":
      case "comment-id":
      case "comment_id":
        $this->setId($value);
        break;
      case "text":
        $this->setText($value);
        break;
      case "user-id":
      case "user_id":
        $this->setUserId($value);
        break;
      case "created":
      case "created_at":
      case "created-at":
        $this->setCreated($value);
        break;
      case "updated":
      case "updated-at":
      case "updated_at":
        $this->setUpdated($value);
        break;
      default:
        throw new InvalidArgumentException("Invalid property {$name}");
        break;
    }
  }

  /**
   * Returns user as xml string
   * @return string XML string
   */
  public function toXml() {
    $xml = new SimpleXMLElement('<comment></comment>');
    $xml->addChild('text', $this->getText());
    return $xml->asXML();
  }

  /**
   * Creates from xml
   * @param string|SimpleXMLElement $xml Xml string or SimpleXMLElement object
   * @return BugHerd_Comment
   * @throws InvalidArgumentException
   */
  public static function fromXml($xml) {
    $comment = new BugHerd_Comment();
    if (!($xml instanceof SimpleXMLElement)) {
      $xml = @simplexml_load_string($xml);
      if ($xml === false) {
        throw new InvalidArgumentException("Invalid XML");
      }
    }
    $comment->setId($xml->id);
    $comment->setText($xml->text);
    if (property_exists($xml, 'user-id')) {
      $property = 'user-id';
      $comment->setUserId($xml->$property);
    }
    if (property_exists($xml, 'created-at')) {
      $property = 'created-at';
      $comment->setCreated($xml->$property);
    }
    if (property_exists($xml, 'updated-at')) {
      $property = 'created-at';
      $comment->setUpdated($xml->$property);
    }
    return $comment;
  }

}