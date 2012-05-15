<?php

// Include Library classes
require_once(dirname(__FILE__) . '/../lib/BugHerd/Task.php');

/**
 * Test class for BugHerd_Task.
 * Generated by PHPUnit on 2012-05-10 at 20:03:50.
 */
class BugHerd_TaskTest extends PHPUnit_Framework_TestCase
{


  /**
   * @covers BugHerd_Task::setId()
   * @covers BugHerd_Task::getId()
   */
  public function testSetId() {
    $task = new BugHerd_Task();
    $task->setId(5123);
    $id = $task->getId();
    $this->assertEquals(5123, $id);
  }

  /**
   * @covers BugHerd_Task::setLocalId()
   * @covers BugHerd_Task::getLocalId()
   */
  public function testSetLocalId() {
    $task = new BugHerd_Task();
    $task->setLocalId(5123);
    $id = $task->getLocalId();
    $this->assertEquals(5123, $id);
  }

  /**
   * @covers BugHerd_Task::getDescription()
   * @covers BugHerd_Task::setDescription()
   */
  public function testSetDescription() {
    $task = new BugHerd_Task();
    $task->setDescription('description');
    $value = $task->getDescription();
    $this->assertEquals('description', $value);
  }

  /**
   * @covers BugHerd_Task::getUrl()
   * @covers BugHerd_Task::setUrl()
   */
  public function testSetUrl() {
    $task = new BugHerd_Task();
    $task->setUrl('http://www.task-url.com');
    $value = $task->getUrl();
    $this->assertEquals('http://www.task-url.com', $value);
  }

  /**
   * @covers BugHerd_Task::getWindowScreenshot()
   * @covers BugHerd_Task::setWindowScreenshot()
   */
  public function testSetWindowScreenshot() {
    $task = new BugHerd_Task();
    $task->setWindowScreenshot('http://www.example.com/window.png');
    $value = $task->getWindowScreenshot();
    $this->assertEquals('http://www.example.com/window.png', $value);
  }

  /**
   * @covers BugHerd_Task::getTargetScreenshot()
   * @covers BugHerd_Task::setTargetScreenshot()
   */
  public function testSetTargetScreenshot() {
    $task = new BugHerd_Task();
    $task->setTargetScreenshot('http://www.example.com/target.png');
    $value = $task->getTargetScreenshot();
    $this->assertEquals('http://www.example.com/target.png', $value);
  }

  /**
   * @covers BugHerd_Task::getAssignedTo()
   * @covers BugHerd_Task::setAssignedTo()
   */
  public function testSetAssignedTo() {
    $task = new BugHerd_Task();
    $task->setAssignedTo(51);
    $value = $task->getAssignedTo();
    $this->assertEquals(51, $value);
  }

  /**
   * @covers BugHerd_Task::getPriority()
   * @covers BugHerd_Task::setPriority()
   */
  public function testSetPriority() {
    $task = new BugHerd_Task();
    $task->setPriority(BugHerd_Task::PRIORITY_IMPORTANT);
    $value = $task->getPriority();
    $this->assertEquals(BugHerd_Task::PRIORITY_IMPORTANT, $value);
  }

  /**
   * @covers BugHerd_Task::getStatus()
   * @covers BugHerd_Task::setStatus()
   */
  public function testSetStatus() {
    $task = new BugHerd_Task();
    $task->setStatus(BugHerd_Task::STATUS_DOING);
    $value = $task->getStatus();
    $this->assertEquals(BugHerd_Task::STATUS_DOING, $value);
  }

  /**
   * @covers BugHerd_Task::getName()
   * @covers BugHerd_Task::setName()
   */
  public function testSetCreated() {
    $task = new BugHerd_Task();
    $date = new DateTime();
    $task->setCreated($date);
    $value = $task->getCreated();
    $this->assertEquals($date, $value);
  }

  /**
   * @covers BugHerd_Task::getName()
   * @covers BugHerd_Task::setName()
   */
  public function testSetUpdated() {
    $task = new BugHerd_Task();
    $date = new DateTime();
    $task->setUpdated($date);
    $value = $task->getUpdated();
    $this->assertEquals($date, $value);
  }

  /**
   * @covers BugHerd_Task::toXml()
   */
  public function testToXml() {
    $xml = simplexml_load_string('<task></task>');
    $xml->addChild('description', 'description');
    $xml->addChild('url', 'http://url.com');
    $xml->addChild('assigned-to-id', 50);
    $xml->addChild('local-task-id', 100);
    $xml->addChild('priority-id', BugHerd_Task::PRIORITY_CRITICAL);
    $xml->addChild('status-id', BugHerd_Task::STATUS_DOING);
    $xml->addChild('window-screenshot')->addChild('url', 'http://url.com/window.png');
    $xml->addChild('target-screenshot')->addChild('url', 'http://url.com/target.png');
    $task = new BugHerd_Task();
    $task->setDescription('description');
    $task->setUrl('http://url.com');
    $task->setAssignedTo(50);
    $task->setLocalId(100);
    $task->setPriority(BugHerd_Task::PRIORITY_CRITICAL);
    $task->setStatus(BugHerd_Task::STATUS_DOING);
    $task->setWindowScreenshot('http://url.com/window.png');
    $task->setTargetScreenshot('http://url.com/target.png');
    $task_xml = $task->toXml();
    $this->assertEquals($xml->asXML(), $task_xml);
  }

  /**
   * @covers BugHerd_Task::fromXml()
   */
  public function testFromXml() {
    $xml = simplexml_load_string('<task></task>');
    $xml->addChild('id', 1234);
    $xml->addChild('description', 'description');
    $xml->addChild('url', 'http://url.com');
    $xml->addChild('assigned-to-id', 50);
    $xml->addChild('local-task-id', 100);
    $xml->addChild('priority-id', BugHerd_Task::PRIORITY_CRITICAL);
    $xml->addChild('status-id', BugHerd_Task::STATUS_DOING);
    $xml->addChild('window-screenshot')->addChild('url', 'http://url.com/window.png');
    $xml->addChild('target-screenshot')->addChild('url', 'http://url.com/target.png');
    $xml = $xml->asXML();
    $task = BugHerd_Task::fromXml($xml);
    $this->assertEquals(1234, $task->id);
    $this->assertEquals('description', $task->description);
    $this->assertEquals(50, $task->assigned_to);
    $this->assertEquals(100, $task->local_id);
    $this->assertEquals(BugHerd_Task::PRIORITY_CRITICAL, $task->priority_id);
    $this->assertEquals(BugHerd_Task::STATUS_DOING, $task->status_id);
    $this->assertEquals('http://url.com/window.png', $task->screenshot_window);
    $this->assertEquals('http://url.com/target.png', $task->screenshot_target);
    $this->assertEquals('http://url.com', $task->url);
  }
}

