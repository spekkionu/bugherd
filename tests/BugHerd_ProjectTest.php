<?php

// Include Library classes
require_once(dirname(__FILE__) . '/../lib/BugHerd/Project.php');

/**
 * Test class for BugHerd_Project.
 * Generated by PHPUnit on 2012-05-10 at 20:03:50.
 */
class BugHerd_ProjectTest extends PHPUnit_Framework_TestCase
{


  /**
   * BugHerd_Project::setId
   * BugHerd_Project::getId
   * BugHerd_Project::__set
   */
  public function testSetId() {
    $project = new BugHerd_Project();
    $project->id = 5123;
    $id = $project->getId();
    $this->assertEquals(5123, $id);
  }

  /**
   * BugHerd_Project::getName
   * BugHerd_Project::setName
   * BugHerd_Project::__set
   */
  public function testSetName() {
    $project = new BugHerd_Project();
    $project->name = 'project name';
    $value = $project->getName();
    $this->assertEquals('project name', $value);
  }

  /**
   * BugHerd_Project::getDevUrl
   * BugHerd_Project::setDevUrl
   * BugHerd_Project::__set
   */
  public function testSetDevUrl() {
    $project = new BugHerd_Project();
    $project->devurl = 'http://devurl.com';
    $value = $project->getDevUrl();
    $this->assertEquals('http://devurl.com', $value);
  }

  /**
   * BugHerd_Project::getActive
   * BugHerd_Project::setActive
   * BugHerd_Project::__set
   */
  public function testSetActive() {
    $project = new BugHerd_Project();
    $project->active = 'true';
    $value = $project->getActive();
    $this->assertTrue($value);
  }

  /**
   * BugHerd_Project::getCreated
   * BugHerd_Project::setCreated
   * BugHerd_Project::__set
   */
  public function testSetCreated() {
    $project = new BugHerd_Project();
    $date = date('c');
    $project->created = $date;
    $value = $project->getCreated();
    $this->assertInstanceOf('DateTime', $value);
  }

  /**
   * BugHerd_Project::getUpdated
   * BugHerd_Project::setUpdated
   * BugHerd_Project::__set
   */
  public function testSetUpdated() {
    $project = new BugHerd_Project();
    $date = date('c');
    $project->updated = $date;
    $value = $project->getUpdated();
    $this->assertInstanceOf('DateTime', $value);
  }

  /**
   * BugHerd_Project::toXml
   */
  public function testToXml() {
    $xml = simplexml_load_string('<project></project>');
    $xml->addChild('name', 'project name');
    $xml->addChild('devurl', 'http://devurl.com');
    $project = new BugHerd_Project();
    $project->setName('project name');
    $project->setDevUrl('http://devurl.com');
    $project_xml = $project->toXml();
    $this->assertXmlStringEqualsXmlString($xml->asXML(), $project_xml);
  }

  /**
   * BugHerd_Project::fromXml
   * BugHerd_Project::__get
   * BugHerd_Project::setActive
   */
  public function testFromXml() {
    $xml = simplexml_load_string('<project></project>');
    $xml->addChild('id', 1234);
    $xml->addChild('name', 'project name');
    $xml->addChild('devurl', 'http://devurl.com');
    $xml->addChild('is-active', 'true')->addAttribute('type', 'boolean');
    $xml->addChild('created-at', date('c'));
    $xml->addChild('updated-at', date('c'));
    $xml = $xml->asXML();
    $project = BugHerd_Project::fromXml($xml);
    $this->assertEquals(1234, $project->id);
    $this->assertEquals('http://devurl.com', $project->devurl);
    $this->assertEquals('project name', $project->name);
    $this->assertTrue($project->active);
    $this->assertInstanceOf('DateTime', $project->created);
    $this->assertInstanceOf('DateTime', $project->updated);
  }

  /**
   * BugHerd_Project::__set
   * @expectedException InvalidArgumentException
   */
  public function testBadPropertySet(){
    $comment = new BugHerd_Project();
    $comment->bad_property = 'value';
  }

  /**
   * BugHerd_Project::__get
   * @expectedException InvalidArgumentException
   */
  public function testBadPropertyGet(){
    $comment = new BugHerd_Project();
    $value = $comment->bad_property;
  }


  /**
   * BugHerd_Project::fromXml
   * @expectedException InvalidArgumentException
   */
  public function testInvalidXml(){
    $xml = 'this is not valid xml';
    $user = BugHerd_Project::fromXml($xml);
  }

  /**
   * BugHerd_Project::setUpdated
   */
  public function testBadUpdatedDate(){
    $comment = new BugHerd_Project();
    $date = 'bad date';
    $comment->updated = $date;
    $value = $comment->updated;
    $this->assertNull($value);
  }

  /**
   * BugHerd_Project::setCreated
   */
  public function testBadCreationDate(){
    $comment = new BugHerd_Project();
    $date = 'bad date';
    $comment->created = $date;
    $value = $comment->created;
    $this->assertNull($value);
  }
}

