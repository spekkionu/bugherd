<?php

// Include Library classes
require_once(dirname(__FILE__) . '/../lib/BugHerd/Comment.php');

/**
 * Test class for BugHerd_Comment.
 * Generated by PHPUnit on 2012-05-10 at 20:03:50.
 */
class BugHerd_CommentTest extends PHPUnit_Framework_TestCase
{


  /**
   * BugHerd_Comment::setId
   * BugHerd_Comment::getId
   */
  public function testSetId() {
    $comment = new BugHerd_Comment();
    $comment->id = 5123;
    $id = $comment->id;
    $this->assertEquals(5123, $id);
  }

  /**
   * BugHerd_Comment::getText
   * BugHerd_Comment::setText
   */
  public function testSetText() {
    $comment = new BugHerd_Comment();
    $comment->text = 'text';
    $value = $comment->text;
    $this->assertEquals('text', $value);
  }

  /**
   * BugHerd_Comment::getUserId
   * BugHerd_Comment::setUserId
   */
  public function testSetUserId() {
    $comment = new BugHerd_Comment();
    $comment->user_id = 5;
    $value = $comment->user_id;
    $this->assertEquals(5, $value);
  }

  /**
   * BugHerd_Comment::getCreated
   * BugHerd_Comment::setCreated
   */
  public function testSetCreated() {
    $comment = new BugHerd_Comment();
    $date = date('c');
    $comment->created = $date;
    $value = $comment->created;
    $this->assertInstanceOf('DateTime', $value);
  }

  /**
   * BugHerd_Comment::setCreated
   */
  public function testBadCreationDate(){
    $comment = new BugHerd_Comment();
    $date = 'bad date';
    $comment->created = $date;
    $value = $comment->created;
    $this->assertNull($value);
  }

  /**
   * BugHerd_Comment::getUpdated
   * BugHerd_Comment::setUpdated
   */
  public function testSetUpdated() {
    $comment = new BugHerd_Comment();
    $date = date('c');
    $comment->updated = $date;
    $value = $comment->updated;
    $this->assertInstanceOf('DateTime', $value);
  }

  /**
   * BugHerd_Comment::setUpdated
   */
  public function testBadUpdatedDate(){
    $comment = new BugHerd_Comment();
    $date = 'bad date';
    $comment->updated = $date;
    $value = $comment->updated;
    $this->assertNull($value);
  }

  /**
   * BugHerd_Comment::__set
   * @expectedException InvalidArgumentException
   */
  public function testBadPropertySet(){
    $comment = new BugHerd_Comment();
    $comment->bad_property = 'value';
  }

  /**
   * BugHerd_Comment::__get
   * @expectedException InvalidArgumentException
   */
  public function testBadPropertyGet(){
    $comment = new BugHerd_Comment();
    $value = $comment->bad_property;
  }

  /**
   * BugHerd_Comment::toXml
   */
  public function testToXml() {
    $xml = simplexml_load_string('<comment></comment>');
    $xml->addChild('text', 'text');
    $comment = new BugHerd_Comment();
    $comment->text = 'text';
    $comment_xml = $comment->toXml();
    $this->assertXmlStringEqualsXmlString($xml->asXML(), $comment_xml);
  }

  /**
   * BugHerd_Comment::fromXml
   */
  public function testFromXml() {
    $xml = simplexml_load_string('<comment></comment>');
    $xml->addChild('id', 1234);
    $xml->addChild('text', 'text');
    $xml->addChild('user-id', 5);
    $xml->addChild('created-at', date('c'));
    $xml->addChild('updated-at', date('c'));
    $xml = $xml->asXML();
    $comment = BugHerd_Comment::fromXml($xml);
    $this->assertEquals(1234, $comment->id);
    $this->assertEquals(5, $comment->user_id);
    $this->assertEquals('text', $comment->text);
    $this->assertInstanceOf('DateTime', $comment->created);
    $this->assertInstanceOf('DateTime', $comment->updated);
  }

  /**
   * BugHerd_Comment::fromXml
   * @expectedException InvalidArgumentException
   */
  public function testInvalidXml(){
    $xml = 'this is not valid xml';
    $comment = BugHerd_Comment::fromXml($xml);
  }
}

