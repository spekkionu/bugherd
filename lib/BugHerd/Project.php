<?php

/**
 * BugHerd Project object
 *
 * @property int $id Project ID
 * @property string $name Project name
 * @property string $devurl Project url
 * @property bool $active Project status
 * @property DateTime $created Date project was created
 * @property DateTime $updated Date project was last updated
 *
 * @author Jonathan Bernardi <spekkionu@gmail.com>
 * @license New BSD http://www.opensource.org/licenses/bsd-license.php
 * @package BugHerd
 */
class BugHerd_Project
{

  /**
   * Project ID
   * @var int $id
   */
  private $id = null;

  /**
   * Project name
   * @var string $name
   */
  private $name = null;

  /**
   * Project dev url
   * @var string $devurl
   */
  private $devurl = null;

  /**
   * Project active status
   * @var bool $active
   */
  private $active = true;

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
   * Gets project id
   * @return int Project ID
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Sets project id
   * @param int $id The project id
   * @return BugHerd_Project
   */
  public function setId($id) {
    $this->id = (int) $id;
    return $this;
  }

  /**
   * Gets project name
   * @return string Project name
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Sets project name
   * @param string $name Project name
   * @return BugHerd_Project
   */
  public function setName($name) {
    $this->name = (string) $name;
    return $this;
  }

  /**
   * Gets Dev URL
   * @return string Dev URL
   */
  public function getDevUrl() {
    return $this->devurl;
  }

  /**
   * Sets Dev URL
   * @param string $url Dev URL
   * @return BugHerd_Project
   */
  public function setDevUrl($url) {
    $this->devurl = (string) $url;
    return $this;
  }

  /**
   * Gets Active status
   * @return bool Status
   */
  public function getActive() {
    return $this->active;
  }

  /**
   * Sets active status
   * @param bool $active
   * @return BugHerd_Project
   */
  public function setActive($active) {
    $this->active = (bool) $active;
    return $this;
  }

  /**
   * Gets date the project was last created
   * @return DateTime Project creation date
   */
  public function getCreated() {
    return $this->created;
  }

  /**
   * Sets the date the project was created
   * @param string|DateTime $date Creation date
   * @return BugHerd_Project
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
   * Gets date the project was last updated
   * @return DateTime Project last updated date
   */
  public function getUpdated() {
    return $this->updated;
  }

  /**
   * Sets the date the project was last updated
   * @param string|DateTime $date Last updated date
   * @return BugHerd_Project
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
   * @throws Exception
   */
  public function __get($name) {
    switch ($name) {
      case "id":
      case "project-id":
      case "project_id":
        return $this->getId();
        break;
      case "name":
        return $this->getName();
        break;
      case "devurl":
      case "dev_url":
      case "dev-url":
        return $this->getDevUrl();
        break;
      case "active":
      case "is_active":
      case "is-active":
        return $this->getActive();
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
        throw new Exception("Invalid property {$name}");
        break;
    }
  }

  /**
   * Magic setter
   * @param string $name
   * @param mixed $value
   * @throws Exception
   */
  public function __set($name, $value) {
    switch ($name) {
      case "id":
      case "project-id":
      case "project_id":
        $this->setId($value);
        break;
      case "name":
        $this->setName($value);
        break;
      case "devurl":
      case "dev_url":
      case "dev-url":
        $this->setDevUrl($value);
        break;
      case "active":
      case "is_active":
      case "is-active":
        $this->setActive($value);
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
        throw new Exception("Invalid property {$name}");
        break;
    }
  }

  /**
   * Returns project as xml string
   * @return string XML string
   */
  public function toXml() {
    $xml = new SimpleXMLElement('<project></project>');
    $xml->addChild('name', $this->getName());
    $xml->addChild('devurl', $this->getName());
    return $xml->asXML();
  }

  /**
   * Creates from xml
   * @param string|SimpleXMLElement $xml Xml string or SimpleXMLElement object
   * @return BugHerd_Project
   */
  public static function fromXml($xml) {
    $project = new BugHerd_Project();
    if (!($xml instanceof SimpleXMLElement)) {
      $xml = @simplexml_load_string($xml);
      if ($xml === false) {
        throw new Exception("Invalid XML");
      }
    }
    $project->setId($xml->id);
    $project->setName($xml->name);
    $project->setDevUrl($xml->devurl);
    if (isset($xml['is-active'])) {
      $project->setActive($xml['is-active']);
    }
    if (property_exists($xml,'created-at')) {
      $property = 'created-at';
      $project->setCreated($xml->$property);
    }
    if (property_exists($xml,'updated-at')) {
      $property = 'created-at';
      $project->setUpdated($xml->$property);
    }
    return $project;
  }

}