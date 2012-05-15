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
   * BugHerd_Task::setId
   * BugHerd_Task::getId
   */
  public function testSetId() {
    $task = new BugHerd_Task();
    $task->id = 5123;
    $id = $task->id;
    $this->assertEquals(5123, $id);
  }

  /**
   * BugHerd_Task::setLocalId
   * BugHerd_Task::getLocalId
   */
  public function testSetLocalId() {
    $task = new BugHerd_Task();
    $task->local_id = 5123;
    $id = $task->getLocalId();
    $this->assertEquals(5123, $id);
  }

  /**
   * BugHerd_Task::getDescription
   * BugHerd_Task::setDescription
   */
  public function testSetDescription() {
    $task = new BugHerd_Task();
    $task->description = 'description';
    $value = $task->getDescription();
    $this->assertEquals('description', $value);
  }

  /**
   * BugHerd_Task::getUrl
   * BugHerd_Task::setUrl
   */
  public function testSetUrl() {
    $task = new BugHerd_Task();
    $task->url = 'http://www.task-url.com';
    $value = $task->getUrl();
    $this->assertEquals('http://www.task-url.com', $value);
  }

  /**
   * BugHerd_Task::getWindowScreenshot
   * BugHerd_Task::setWindowScreenshot
   */
  public function testSetWindowScreenshot() {
    $task = new BugHerd_Task();
    $task->screenshot_window = 'http://www.example.com/window.png';
    $value = $task->getWindowScreenshot();
    $this->assertEquals('http://www.example.com/window.png', $value);
  }

  /**
   * BugHerd_Task::getTargetScreenshot
   * BugHerd_Task::setTargetScreenshot
   */
  public function testSetTargetScreenshot() {
    $task = new BugHerd_Task();
    $task->screenshot_target = 'http://www.example.com/target.png';
    $value = $task->getTargetScreenshot();
    $this->assertEquals('http://www.example.com/target.png', $value);
  }

  /**
   * BugHerd_Task::getAssignedTo
   * BugHerd_Task::setAssignedTo
   * BugHerd_Task::__set
   */
  public function testSetAssignedTo() {
    $task = new BugHerd_Task();
    $task->assigned_to = 51;
    $value = $task->getAssignedTo();
    $this->assertEquals(51, $value);
  }

  /**
   * BugHerd_Task::getPriority
   * BugHerd_Task::setPriority
   */
  public function testSetPriority() {
    $task = new BugHerd_Task();
    $task->priority_id = BugHerd_Task::PRIORITY_IMPORTANT;
    $value = $task->getPriority();
    $this->assertEquals(BugHerd_Task::PRIORITY_IMPORTANT, $value);
  }

  /**
   * BugHerd_Task::getStatus
   * BugHerd_Task::setStatus
   */
  public function testSetStatus() {
    $task = new BugHerd_Task();
    $task->status_id = BugHerd_Task::STATUS_DOING;
    $value = $task->getStatus();
    $this->assertEquals(BugHerd_Task::STATUS_DOING, $value);
  }

  /**
   * BugHerd_Task::getCreated
   * BugHerd_Task::setCreated
   */
  public function testSetCreated() {
    $task = new BugHerd_Task();
    $date = date('c');
    $task->created = $date;
    $value = $task->getCreated();
    $this->assertInstanceOf('DateTime', $value);
  }

  /**
   * BugHerd_Task::getUpdated
   * BugHerd_Task::setUpdated
   */
  public function testSetUpdated() {
    $task = new BugHerd_Task();
    $date = date('c');
    $task->updated = $date;
    $value = $task->getUpdated();
    $this->assertInstanceOf('DateTime', $value);
  }

  /**
   * BugHerd_Task::toXml
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
   * BugHerd_Task::fromXml
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
    $xml->addChild('created-at', date('c'));
    $xml->addChild('updated-at', date('c'));
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
    $this->assertInstanceOf('DateTime', $task->created);
    $this->assertInstanceOf('DateTime', $task->updated);
  }

  /**
   * BugHerd_Task::setPriority
   */
  public function testBadPrioritySet(){
    $task = new BugHerd_Task();
    $task->priority_id = 5436;
    $this->assertEquals(BugHerd_Task::PRIORITY_NOT_SET, $task->priority_id);
  }

  /**
   * BugHerd_Task::setStatus
   */
  public function testBadStatusSet(){
    $task = new BugHerd_Task();
    $task->status_id = 64785;
    $this->assertEquals(BugHerd_Task::STATUS_BACKLOG, $task->status_id);
  }

  /**
   * BugHerd_Task::__set
   * @expectedException InvalidArgumentException
   */
  public function testBadPropertySet(){
    $task = new BugHerd_Task();
    $task->bad_property = 'value';
  }

  /**
   * BugHerd_Task::__get
   * @expectedException InvalidArgumentException
   */
  public function testBadPropertyGet(){
    $task = new BugHerd_Task();
    $value = $task->bad_property;
  }


  /**
   * BugHerd_Task::fromXml
   * @expectedException InvalidArgumentException
   */
  public function testInvalidXml(){
    $xml = 'this is not valid xml';
    $user = BugHerd_Task::fromXml($xml);
  }

  /**
   * BugHerd_Task::setUpdated
   */
  public function testBadUpdatedDate(){
    $task = new BugHerd_Task();
    $date = 'bad date';
    $task->updated = $date;
    $value = $task->updated;
    $this->assertNull($value);
  }

  /**
   * BugHerd_Task::setCreated
   */
  public function testBadCreationDate(){
    $task = new BugHerd_Task();
    $date = 'bad date';
    $task->created = $date;
    $value = $task->created;
    $this->assertNull($value);
  }
}

