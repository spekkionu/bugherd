<?php

/**
 * BugHerd Task object
 *
 * @property int $id Task ID
 * @property string $description Task description
 * @property string $url Task URL
 * @property int $local_id Local task id
 * @property int $assigned_to Assigned to user id
 * @property int $priority_id Task Priority
 * @property int $status_id Task Status
 * @property string $screenshot_window Window screenshot url
 * @property string $screenshot_target Target screenshot url
 * @property DateTime $created Date task was created
 * @property DateTime $updated Date task was last updated
 *
 * @author Jonathan Bernardi <spekkionu@gmail.com>
 * @license New BSD http://www.opensource.org/licenses/bsd-license.php
 * @package BugHerd
 */
class BugHerd_Task
{
  /**
   * Priority not set
   */

  const PRIORITY_NOT_SET = 0;

  /**
   * Critical priority
   */
  const PRIORITY_CRITICAL = 1;

  /**
   * Important priority
   */
  const PRIORITY_IMPORTANT = 2;

  /**
   * Normal priority
   */
  const PRIORITY_NORMAL = 3;

  /**
   * Minor priority
   */
  const PRIORITY_MINOR = 4;

  /**
   * Backlog status
   */
  const STATUS_BACKLOG = 0;

  /**
   * Todo status
   */
  const STATUS_TODO = 1;

  /**
   * Doing status
   */
  const STATUS_DOING = 2;

  /**
   * Done status
   */
  const STATUS_DONE = 4;

  /**
   * Closed status
   */
  const STATUS_CLOSED = 5;

  /**
   * Task ID
   * @var int $id
   */
  private $id = null;

  /**
   * Local task ID
   * @var int $local_id
   */
  private $local_id = null;

  /**
   * User ID the task is assigned to
   * @var int $assigned_to
   */
  private $assigned_to = null;

  /**
   * Task description
   * @var string $description
   */
  private $description = null;

  /**
   * Task Priority
   * @var int $priority_id
   */
  private $priority_id = self::PRIORITY_NOT_SET;

  /**
   * Task status
   * @var int $status_id
   */
  private $status_id = self::STATUS_BACKLOG;

  /**
   * Task url
   * @var string $url
   */
  private $url = null;

  /**
   * Task window screenshot
   * @var string $screenshot_window
   */
  private $screenshot_window = null;

  /**
   * Task target screenshot
   * @var string $screenshot_target
   */
  private $screenshot_target = null;

  /**
   * Date the task was created
   * @var string $created
   */
  private $created = null;

  /**
   * Date the task was last updated
   * @var string $updated
   */
  private $updated = null;

  /**
   * Gets task id
   * @return int Task ID
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Sets task id
   * @param int $id The task id
   * @return BugHerd_Task
   */
  public function setId($id) {
    $this->id = (int) $id;
    return $this;
  }

  /**
   * Gets local id
   * @return int local ID
   */
  public function getLocalId() {
    return $this->local_id;
  }

  /**
   * Sets local id
   * @param int $id The local id
   * @return BugHerd_Task
   */
  public function setLocalId($local_id) {
    $this->local_id = (int) $local_id;
    return $this;
  }

  /**
   * Gets assigned to user id
   * @return int User ID
   */
  public function getAssignedTo() {
    return $this->assigned_to;
  }

  /**
   * Sets assigned to user id
   * @param int $id The user id
   * @return BugHerd_Task
   */
  public function setAssignedTo($user_id) {
    $this->assigned_to = (int) $user_id;
    return $this;
  }

  /**
   * Gets task description
   * @return string Task description
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * Sets task description
   * @param string $name User first name
   * @return BugHerd_Task
   */
  public function setDescription($description) {
    $this->description = (string) $description;
    return $this;
  }

  /**
   * Gets task priority
   * @return int Task priority id
   */
  public function getPriority() {
    return $this->priority_id;
  }

  /**
   * Sets task priority
   * @param int $id The task priority id
   * @return BugHerd_Task
   */
  public function setPriority($priority) {
    if (!in_array($priority, array(self::PRIORITY_CRITICAL, self::PRIORITY_IMPORTANT, self::PRIORITY_MINOR, self::PRIORITY_NORMAL, self::PRIORITY_NOT_SET))) {
      $priority = self::PRIORITY_NOT_SET;
    }
    $this->priority_id = (int) $priority;
    return $this;
  }

  /**
   * Gets task status
   * @return int Task status id
   */
  public function getStatus() {
    return $this->status_id;
  }

  /**
   * Sets task status
   * @param int $id The task status id
   * @return BugHerd_Task
   */
  public function setStatus($status) {
    if (!in_array($status, array(self::STATUS_BACKLOG, self::STATUS_CLOSED, self::STATUS_DOING, self::STATUS_DONE, self::STATUS_TODO))) {
      $status = self::STATUS_BACKLOG;
    }
    $this->status_id = (int) $status;
    return $this;
  }

  /**
   * Gets task url
   * @return string Task url
   */
  public function getUrl() {
    return $this->url;
  }

  /**
   * Sets task url
   * @param string $name Task url
   * @return BugHerd_Task
   */
  public function setUrl($url) {
    $this->url = (string) $url;
    return $this;
  }

  /**
   * Gets window screenshot
   * @return string window screenshot
   */
  public function getWindowScreenshot() {
    return $this->screenshot_window;
  }

  /**
   * Sets window screenshot
   * @param string $url
   * @return BugHerd_Task
   */
  public function setWindowScreenshot($url) {
    $this->screenshot_window = (string) $url;
    return $this;
  }

  /**
   * Gets target screenshot
   * @return string target screenshot
   */
  public function getTargetScreenshot() {
    return $this->screenshot_target;
  }

  /**
   * Sets target screenshot
   * @param string $url
   * @return BugHerd_Task
   */
  public function setTargetScreenshot($url) {
    $this->screenshot_target = (string) $url;
    return $this;
  }

  /**
   * Gets date the task was last created
   * @return DateTime Task creation date
   */
  public function getCreated() {
    return $this->created;
  }

  /**
   * Sets the date the task was created
   * @param string|DateTime $date Creation date
   * @return BugHerd_Task
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
   * Gets date the task was last updated
   * @return DateTime Task last updated date
   */
  public function getUpdated() {
    return $this->updated;
  }

  /**
   * Sets the date the task was last updated
   * @param string|DateTime $date Last updated date
   * @return BugHerd_Task
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
      case "task-id":
      case "task_id":
        return $this->getId();
        break;
      case "description":
        return $this->getDescription();
        break;
      case "assigned":
      case "assigned_to":
      case "assigned-to":
      case "assigned-to-id":
        return $this->getAssignedTo();
        break;
      case "local":
      case "local_id":
      case "local-id":
      case "local-task-id":
        return $this->getLocalId();
        break;
      case "priority":
      case "priority_id":
      case "priority-id":
        return $this->getPriority();
        break;
      case "status":
      case "status_id":
      case "status-id":
        return $this->getStatus();
        break;
      case "url":
        return $this->getUrl();
        break;
      case "window":
      case "screenshot_window":
      case "window-screenshot":
        return $this->getWindowScreenshot();
        break;
      case "target":
      case "screenshot_target":
      case "target-screenshot":
        return $this->getTargetScreenshot();
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
   * @throws Exception
   */
  public function __set($name, $value) {
    switch ($name) {
      case "id":
      case "task-id":
      case "task_id":
        $this->setId($value);
        break;
      case "description":
        $this->setDescription($value);
        break;
      case "assigned":
      case "assigned_to":
      case "assigned-to":
      case "assigned-to-id":
        $this->setAssignedTo($value);
        break;
      case "local":
      case "local_id":
      case "local-id":
      case "local-task-id":
        $this->setLocalId($value);
        break;
      case "priority":
      case "priority_id":
      case "priority-id":
        $this->setPriority($value);
        break;
      case "status":
      case "status_id":
      case "status-id":
        $this->setStatus($value);
        break;
      case "url":
        $this->setUrl($value);
        break;
      case "window":
      case "screenshot_window":
      case "window-screenshot":
        $this->setWindowScreenshot($value);
        break;
      case "target":
      case "screenshot_target":
      case "target-screenshot":
        $this->setTargetScreenshot($value);
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
    $xml = new SimpleXMLElement('<task></task>');
    $xml->addChild('description', $this->getDescription());
    if ($this->getUrl()) {
      $xml->addChild('url', $this->getUrl());
    }
    if ($this->getAssignedTo()) {
      $xml->addChild('assigned-to-id', $this->getAssignedTo());
    }
    if ($this->getLocalId()) {
      $xml->addChild('local-task-id', $this->getLocalId());
    }
    $xml->addChild('priority-id', $this->getPriority());
    if ($this->getStatus()) {
      $xml->addChild('status-id', $this->getStatus());
    }
    if ($this->getWindowScreenshot()) {
      $screenshot = $xml->addChild('window-screenshot')->addChild('url', $this->getWindowScreenshot());
    }
    if ($this->getTargetScreenshot()) {
      $screenshot = $xml->addChild('target-screenshot')->addChild('url', $this->getTargetScreenshot());
    }
    return $xml->asXML();
  }

  /**
   * Creates from xml
   * @param string|SimpleXMLElement $xml Xml string or SimpleXMLElement object
   * @return BugHerd_Task
   */
  public static function fromXml($xml) {
    $task = new BugHerd_Task();
    if (!($xml instanceof SimpleXMLElement)) {
      $xml = @simplexml_load_string($xml);
      if ($xml === false) {
        throw new InvalidArgumentException("Invalid XML");
      }
    }
    $task->setId($xml->id);
    $task->setDescription($xml->description);
    $task->setUrl($xml->url);
    $property = 'local-task-id';
    $task->setLocalId($xml->$property);
    $property = 'priority-id';
    $task->setPriority($xml->$property);
    $property = 'status-id';
    $task->setStatus($xml->$property);
    $property = 'assigned-to-id';
    $task->setAssignedTo($xml->$property);
    $property = 'window-screenshot';
    if (property_exists($xml, 'window-screenshot')) {
      $task->setWindowScreenshot($xml->$property->url);
    }
    $property = 'target-screenshot';
    if (property_exists($xml, 'target-screenshot')) {
      $task->setTargetScreenshot($xml->$property->url);
    }
    $property = 'created-at';
    if (property_exists($xml, 'created-at')) {
      $task->setCreated($xml->$property);
    }
    $property = 'updated-at';
    if (property_exists($xml, 'updated-at')) {
      $task->setUpdated($xml->$property);
    }
    return $task;
  }

}