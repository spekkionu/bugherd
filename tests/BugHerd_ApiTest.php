<?php

// Include Library classes
require_once(dirname(__FILE__) . '/../lib/BugHerd/Project.php');
require_once(dirname(__FILE__) . '/../lib/BugHerd/Task.php');
require_once(dirname(__FILE__) . '/../lib/BugHerd/User.php');
require_once(dirname(__FILE__) . '/../lib/BugHerd/Comment.php');
require_once(dirname(__FILE__) . '/../lib/BugHerd/Exception.php');
require_once(dirname(__FILE__) . '/../lib/BugHerd/API.php');

/**
 * Test class for BugHerd_Api.
 * Generated by PHPUnit on 2012-05-10 at 20:03:50.
 */
class BugHerd_ApiTest extends PHPUnit_Framework_TestCase
{

  /**
   * Account config
   * Should have email address and password
   *
   * @var array $config
   */
  private $config;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    if (!file_exists(dirname(__FILE__) . '/config.ini')) {
      throw new Exception("Missing BugHerd account credentials config file.");
    }
    $this->config = parse_ini_file(dirname(__FILE__) . '/config.ini');
  }

  /**
   * @covers BugHerd_Api::__construct
   */
  public function testConstructor() {
    $api = new BugHerd_Api('email@address.com', 'password');
    $this->assertInstanceOf('BugHerd_Api', $api);
  }

  /**
   * @covers BugHerd_Api::getAccountCredentials
   */
  public function testGetAccountCredentials() {
    $api = new BugHerd_Api('email@address.com', 'password');
    $credentials = $api->getAccountCredentials();
    $this->assertEquals($credentials, array('email' => 'email@address.com', 'password' => 'password'));
  }

  /**
   * @covers BugHerd_Api::setAccountCredentials
   */
  public function testSetAccountCredentials() {
    $api = new BugHerd_Api('email@address.com', 'password');
    // Assert that the api credentials are the initial values
    $credentials = $api->getAccountCredentials();
    $this->assertEquals($credentials, array('email' => 'email@address.com', 'password' => 'password'));
    // Set new credential values
    $api->setAccountCredentials('email2@address.com', 'password2');
    // Assert that the credentials changed to the new values
    $credentials = $api->getAccountCredentials();
    $this->assertEquals($credentials, array('email' => 'email2@address.com', 'password' => 'password2'));
  }

  /**
   * @covers BugHerd_Api::listUsers
   */
  public function testListUsers() {
    $api = new BugHerd_Api($this->config['email'], $this->config['password']);
    $users = $api->listUsers();
    $this->assertInternalType('array', $users);
  }

  /**
   * @covers BugHerd_Api::listProjects
   */
  public function testListProjects() {
    $api = new BugHerd_Api($this->config['email'], $this->config['password']);
    $projects = $api->listProjects();
    $this->assertInternalType('array', $projects);
  }

  /**
   * @covers BugHerd_Api::showProject
   */
  public function testShowProject() {
    $project = new BugHerd_Project();
    $project->setName('Test Project');
    $project->setDevUrl('http://devurl.com');
    $api = new BugHerd_Api($this->config['email'], $this->config['password']);
    $result = $api->createProject($project);
    $this->assertInstanceOf('BugHerd_Project', $result);
    $project = $api->showProject($result->getId());
    $this->assertInstanceOf('BugHerd_Project', $project);
    // Delete the created project
    $api->deleteProject($result->getId());
  }

  /**
   * @covers BugHerd_Api::createProject
   */
  public function testCreateProject() {
    $project = new BugHerd_Project();
    $project->setName('Test Project');
    $project->setDevUrl('http://devurl.com');
    $api = new BugHerd_Api($this->config['email'], $this->config['password']);
    $result = $api->createProject($project);
    $this->assertInstanceOf('BugHerd_Project', $result);
    // Delete the created project
    $api->deleteProject($result->getId());
  }

  /**
   * @covers BugHerd_Api::updateProject
   */
  public function testUpdateProject() {
    $project = new BugHerd_Project();
    // Add a project to test with
    $project->setName('Test Project');
    $project->setDevUrl('http://devurl.com');
    $api = new BugHerd_Api($this->config['email'], $this->config['password']);
    $project = $api->createProject($project);
    $this->assertInstanceOf('BugHerd_Project', $project);
    // Update project name
    $project->setName("New Name");
    $api->updateProject($project->getId(), $project);
    // Pull the project to ensure data changed
    $project = $api->showProject($project->getId());
    $this->assertEquals('New Name', $project->getName());
    // Delete the created project
    $api->deleteProject($project->getId());
  }

  /**
   * @covers BugHerd_Api::deleteProject
   */
  public function testDeleteProject() {
    $project = new BugHerd_Project();
    $project->setName('Test Project');
    $project->setDevUrl('http://devurl.com');
    $api = new BugHerd_Api($this->config['email'], $this->config['password']);
    $result = $api->createProject($project);
    $this->assertInstanceOf('BugHerd_Project', $result);
    // Delete the created project
    $api->deleteProject($result->getId());
    try {
      $project = $api->showProject($project->getId());
      $this->assertNotInstanceOf('BugHerd_Project', $project);
    } catch (Exception $e) {
      // Exception should be thrown
    }
  }

  /**
   * @covers BugHerd_Api::listTasks
   */
  public function testListTasks() {
    $project = new BugHerd_Project();
    $project->setName('Test List Tasks');
    $project->setDevUrl('http://devurl.com');
    $api = new BugHerd_Api($this->config['email'], $this->config['password']);
    $project = $api->createProject($project);
    $this->assertInstanceOf('BugHerd_Project', $project);
    $task = new BugHerd_Task();
    $task->setDescription("Task Description");
    $task->setPriority(BugHerd_Task::PRIORITY_NORMAL);
    $task = $api->createTask($project->getId(), $task);
    $this->assertInstanceOf('BugHerd_Task', $task);
    $tasks = $api->listTasks($project->getId());
    $this->assertInternalType('array', $tasks);
    $task = array_shift($tasks);
    $this->assertInstanceOf('BugHerd_Task', $task);
    // Delete the created project
    $api->deleteProject($project->getId());
  }

  /**
   * @covers BugHerd_Api::showTask
   */
  public function testShowTask() {
    $project = new BugHerd_Project();
    $project->setName('Test Show Task');
    $project->setDevUrl('http://devurl.com');
    $api = new BugHerd_Api($this->config['email'], $this->config['password']);
    $project = $api->createProject($project);
    $this->assertInstanceOf('BugHerd_Project', $project);
    $task = new BugHerd_Task();
    $task->setDescription("Task Description");
    $task->setPriority(BugHerd_Task::PRIORITY_NORMAL);
    $task = $api->createTask($project->getId(), $task);
    $this->assertInstanceOf('BugHerd_Task', $task);
    $task = $api->showTask($project->getId(), $task->getId());
    $this->assertInstanceOf('BugHerd_Task', $task);
    // Delete the created project
    $api->deleteProject($project->getId());
  }

  /**
   * @covers BugHerd_Api::createTask
   */
  public function testCreateTask() {
    $project = new BugHerd_Project();
    $project->setName('Test Create Task');
    $project->setDevUrl('http://devurl.com');
    $api = new BugHerd_Api($this->config['email'], $this->config['password']);
    $project = $api->createProject($project);
    $this->assertInstanceOf('BugHerd_Project', $project);
    $task = new BugHerd_Task();
    $task->setDescription("Task Description");
    $task->setPriority(BugHerd_Task::PRIORITY_NORMAL);
    $task = $api->createTask($project->getId(), $task);
    $this->assertInstanceOf('BugHerd_Task', $task);
    // Delete the created project
    $api->deleteProject($project->getId());
  }

  /**
   * @covers BugHerd_Api::updateTask
   */
  public function testUpdateTask() {
    $project = new BugHerd_Project();
    $project->setName('Test Update Task');
    $project->setDevUrl('http://devurl.com');
    $api = new BugHerd_Api($this->config['email'], $this->config['password']);
    $project = $api->createProject($project);
    $this->assertInstanceOf('BugHerd_Project', $project);
    $task = new BugHerd_Task();
    $task->setDescription("Task Description");
    $task->setPriority(BugHerd_Task::PRIORITY_NORMAL);
    $task = $api->createTask($project->getId(), $task);
    $this->assertInstanceOf('BugHerd_Task', $task);
    $task->setDescription("New Description");
    $api->updateTask($project->getId(), $task->getId(), $task);
    $task = $api->showTask($project->getId(), $task->getId());
    $this->assertEquals('New Description', $task->getDescription());
    // Delete the created project
    $api->deleteProject($project->getId());
  }

  /**
   * @covers BugHerd_Api::listComments
   */
  public function testListComments() {
    $project = new BugHerd_Project();
    $project->setName('Test Create Comment');
    $project->setDevUrl('http://devurl.com');
    $api = new BugHerd_Api($this->config['email'], $this->config['password']);
    $project = $api->createProject($project);
    $this->assertInstanceOf('BugHerd_Project', $project);
    $task = new BugHerd_Task();
    $task->setDescription("Task Description");
    $task->setPriority(BugHerd_Task::PRIORITY_NORMAL);
    $task = $api->createTask($project->getId(), $task);
    $this->assertInstanceOf('BugHerd_Task', $task);
    $comment = new BugHerd_Comment();
    $comment->setText("Test Comment");
    $comment = $api->createComment($project->getId(), $task->getId(), $comment);
    $this->assertInstanceOf('BugHerd_Comment', $comment);
    $comments = $api->listComments($project->getId(), $task->getId());
    $comment = array_shift($comments);
    $this->assertInstanceOf('BugHerd_Comment', $comment);
    // Delete the created project
    $api->deleteProject($project->getId());
  }

  /**
   * @covers BugHerd_Api::showComment
   */
  public function testShowComment() {
    $project = new BugHerd_Project();
    $project->setName('Test Create Comment');
    $project->setDevUrl('http://devurl.com');
    $api = new BugHerd_Api($this->config['email'], $this->config['password']);
    $project = $api->createProject($project);
    $this->assertInstanceOf('BugHerd_Project', $project);
    $task = new BugHerd_Task();
    $task->setDescription("Task Description");
    $task->setPriority(BugHerd_Task::PRIORITY_NORMAL);
    $task = $api->createTask($project->getId(), $task);
    $this->assertInstanceOf('BugHerd_Task', $task);
    $comment = new BugHerd_Comment();
    $comment->setText("Test Comment");
    $comment = $api->createComment($project->getId(), $task->getId(), $comment);
    $this->assertInstanceOf('BugHerd_Comment', $comment);
    $comment = $api->showComment($project->getId(), $task->getId(), $comment->getId());
    // Delete the created project
    $api->deleteProject($project->getId());
  }

  /**
   * @covers BugHerd_Api::createComment
   */
  public function testCreateComment() {
    $project = new BugHerd_Project();
    $project->setName('Test Create Comment');
    $project->setDevUrl('http://devurl.com');
    $api = new BugHerd_Api($this->config['email'], $this->config['password']);
    $project = $api->createProject($project);
    $this->assertInstanceOf('BugHerd_Project', $project);
    $task = new BugHerd_Task();
    $task->setDescription("Task Description");
    $task->setPriority(BugHerd_Task::PRIORITY_NORMAL);
    $task = $api->createTask($project->getId(), $task);
    $this->assertInstanceOf('BugHerd_Task', $task);
    $comment = new BugHerd_Comment();
    $comment->setText("Test Comment");
    $comment = $api->createComment($project->getId(), $task->getId(), $comment);
    $this->assertInstanceOf('BugHerd_Comment', $comment);
    // Delete the created project
    $api->deleteProject($project->getId());
  }

}

