<?php

/**
 * BugHerd User object
 *
 * @property int $id User ID
 * @property string $name User first name
 * @property string $surname User last name
 * @property string $email User email
 * @property DateTime $created Date user was created
 * @property DateTime $updated Date user was last updated
 *
 * @author Jonathan Bernardi <spekkionu@gmail.com>
 * @license New BSD http://www.opensource.org/licenses/bsd-license.php
 * @package BugHerd
 */
class BugHerd_User
{

  /**
   * User ID
   * @var int $id
   */
  private $id = null;

  /**
   * User first name
   * @var string $name
   */
  private $name = null;

  /**
   * User last name
   * @var string $surname
   */
  private $surname = null;

  /**
   * User email address
   * @var string $email
   */
  private $email = null;

  /**
   * Date the project was created
   * @var string $created
   */
  private $created = null;

  /**
   * Date the project was last updated
   * @var string $updated
   */
  private $updated = null;

  /**
   * Gets user id
   * @return int User ID
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Sets user id
   * @param int $id The user id
   * @return BugHerd_User
   */
  public function setId($id) {
    $this->id = (int) $id;
    return $this;
  }

  /**
   * Gets user first name
   * @return string User first name
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Sets user first name
   * @param string $name User first name
   * @return BugHerd_User
   */
  public function setName($name) {
    $this->name = (string) $name;
    return $this;
  }

  /**
   * Gets User last name
   * @return string User last name
   */
  public function getSurName() {
    return $this->surname;
  }

  /**
   * Sets User last name
   * @param string $name User last name
   * @return BugHerd_User
   */
  public function setSurName($name) {
    $this->surname = (string) $name;
    return $this;
  }

  /**
   * Gets User email
   * @return string User email
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * Sets user email
   * @param string $email
   * @return BugHerd_User
   */
  public function setEmail($email) {
    $this->email = (string) $email;
    return $this;
  }

  /**
   * Gets date the user was last created
   * @return DateTime User creation date
   */
  public function getCreated() {
    return $this->created;
  }

  /**
   * Sets the date the user was created
   * @param string|DateTime $date Creation date
   * @return BugHerd_User
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
   * Gets date the user was last updated
   * @return DateTime User last updated date
   */
  public function getUpdated() {
    return $this->updated;
  }

  /**
   * Sets the date the user was last updated
   * @param string|DateTime $date Last updated date
   * @return BugHerd_User
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
      case "user-id":
      case "user_id":
        return $this->getId();
        break;
      case "name":
        return $this->getName();
        break;
      case "surname":
        return $this->getSurName();
        break;
      case "email":
        return $this->getEmail();
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
      case "user-id":
      case "user_id":
        $this->setId($value);
        break;
      case "name":
        $this->setName($value);
        break;
      case "surname":
        $this->setSurname($value);
        break;
      case "email":
        $this->setEmail($value);
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
    $xml = new SimpleXMLElement('<user></user>');
    $xml->addChild('name', $this->getName());
    $xml->addChild('surname', $this->getSurName());
    $xml->addChild('email', $this->getEmail());
    return $xml->asXML();
  }

  /**
   * Creates from xml
   * @param string|SimpleXMLElement $xml Xml string or SimpleXMLElement object
   * @return BugHerd_User
   * @throws InvalidArgumentException
   */
  public static function fromXml($xml) {
    $user = new BugHerd_User();
    if (!($xml instanceof SimpleXMLElement)) {
      $xml = @simplexml_load_string($xml);
      if ($xml === false) {
        throw new InvalidArgumentException("Invalid XML");
      }
    }
    $user->setId($xml->id);
    $user->setName($xml->name);
    $user->setSurName($xml->surname);
    $user->setEmail($xml->email);
    if (property_exists($xml, 'created-at')) {
      $property = 'created-at';
      $user->setCreated($xml->$property);
    }
    if (property_exists($xml, 'updated-at')) {
      $property = 'created-at';
      $user->setUpdated($xml->$property);
    }
    return $user;
  }

}