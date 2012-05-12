<?php

/**
 * Bugherd REST API Class
 *
 * @see http://www.bugherd.com/api
 * @author Jonathan Bernardi <spekkionu@gmail.com>
 * @license New BSD http://www.opensource.org/licenses/bsd-license.php
 * @package BugHerd
 */
class BugHerd_Api
{
  /**
   * Base url for api calls
   */

  const URL = 'http://www.bugherd.com';

  /**
   * API Version
   */
  const VERSION = 'api_v1';

  /**
   * Account credentials
   * @var array $_credentials
   */
  protected $_credentials = array(
    'email' => null,
    'password' => null
  );

  /**
   * Class constructor
   *
   * @param string $email Account email address
   * @param string $password Account password
   */
  public function __construct($email, $password) {
    if (!extension_loaded('simplexml')) {
      throw new BugHerd_Exception("SimpleXML extension is missing.", BugHerd_Exception::CODE_NO_SIMPLEXML);
    }
    $this->setAccountCredentials($email, $password);
  }

  /**
   * Sets account credentials
   *
   * @param string $email Account email address
   * @param string $password Account password
   * @return BugHerd_Api
   */
  public function setAccountCredentials($email, $password) {
    $this->_credentials['email'] = $email;
    $this->_credentials['password'] = $password;
    return $this;
  }

  /**
   * Returns account credentials
   *
   * @return array Array with email and password keys
   */
  public function getAccountCredentials() {
    return $this->_credentials;
  }

  /**
   * Get a list of users in your plan.
   *
   * This is you plus any invited users in projects you created.
   *
   * @return array
   */
  public function listUsers() {
    $url = self::URL."/".self::VERSION."/users.xml";
    $method = "GET";
    $xml = $this->_sendRequest($url, $method);
    $users = array();
    foreach($xml->user as $user){
      $users[] = BugHerd_User::fromXml($user);
    }
    return $users;
  }

  /**
   * Get a list of all active and inactive projects you are a member of.
   *
   * @return array
   */
  public function listProjects() {
    $url = self::URL."/".self::VERSION."/projects.xml";
    $method = "GET";
    $xml = $this->_sendRequest($url, $method);
    $projects = array();
    foreach($xml->project as $project){
      $projects[] = BugHerd_Project::fromXml($project);
    }
    return $projects;
  }

  /**
   * Show details for a specific project.
   *
   * Note: if you'd like to see the tasks in the project, refer to section 'List tasks'.
   *
   * @param int $project_id ID of project
   * @return BugHerd_Project
   */
  public function showProject($project_id) {
    $url = self::URL."/".self::VERSION."/projects/{$project_id}.xml";
    $method = "GET";
    $xml = $this->_sendRequest($url, $method);
    return  BugHerd_Project::fromXml($xml);
  }

  /**
   * Create a new project.
   *
   * Note: this is subject to plan limits.
   *
   * @param BugHerd_Project $project Project object
   * @return BugHerd_Project Added project
   */
  public function createProject(BugHerd_Project $project) {
    $url = self::URL."/".self::VERSION."/projects.xml";
    $method = "POST";
    $xml = $project->toXml();
    $xml = $this->_sendRequest($url, $method, $xml);
    return BugHerd_Project::fromXml($xml);
  }

  /**
   * Update settings for an existing project under your control (ie: only the ones you own).
   *
   * When you set the status to inactive, the project will no longer count towards your plan limit (the sidebar will be disabled, but data is kept).
   *
   * @param int $project_id ID of project
   * @param array $project
   * @return boolean True if successful
   */
  public function updateProject($project_id, BugHerd_Project $project) {
    $url = self::URL."/".self::VERSION."/projects/{$project_id}.xml";
    $method = "PUT";
    $xml = $project->toXml();
    return $this->_sendRequest($url, $method, $xml);
  }

  /**
   * Permanently delete a project and all associated data. Use with care...!
   *
   * @param int $project_id ID of project
   * @return boolean True if sucessful
   */
  public function deleteProject($project_id) {
    $url = self::URL."/".self::VERSION."/projects/{$project_id}.xml";
    $method = "DELETE";
    return $this->_sendRequest($url, $method);
  }

  /**
   * Get a full list of tasks for a project, including archived tasks.
   *
   * @param int $project_id ID of project
   * @return array
   */
  public function listTasks($project_id) {
    $url = self::URL."/".self::VERSION."/projects/{$project_id}/tasks.xml";
    $method = "GET";
    $xml = $this->_sendRequest($url, $method);
    $results = array();
    foreach($xml->task as $task){
      $results[] = BugHerd_Task::fromXml($task);
    }
    return $results;
  }

  /**
   * List details of a task in a given project, includes a list of comments.
   *
   * @param int $project_id ID of project
   * @param int $task_id ID of Task
   * @return array
   */
  public function showTask($project_id, $task_id) {
    $url = self::URL."/".self::VERSION."/projects/{$project_id}/tasks/{$task_id}.xml";
    $method = "GET";
    $xml = $this->_sendRequest($url, $method);
    return BugHerd_Task::fromXml($xml);
  }

  /**
   * Add a new task in a project.
   *
   * Note that a new task always initially gets a status-id of 0 (backlog).
   *
   * @param int $project_id ID of project
   * @param BugHerd_Task $task
   */
  public function createTask($project_id, BugHerd_Task $task) {
    $url = self::URL."/".self::VERSION."/projects/{$project_id}/tasks.xml";
    $method = "POST";
    $xml = $task->toXml();
    $xml = $this->_sendRequest($url, $method, $xml);
    return BugHerd_Task::fromXml($xml);
  }

  /**
   * Update one of the tasks in a project.
   *
   * @param int $project_id ID of project
   * @param int $task_id ID of Task
   * @param BugHerd_Task $task
   */
  public function updateTask($project_id, $task_id, BugHerd_Task $task) {
    $url = self::URL."/".self::VERSION."/projects/{$project_id}/tasks/{$task_id}.xml";
    $method = "PUT";
    $xml = $task->toXml();
    return $this->_sendRequest($url, $method, $xml);
  }

  /**
   * Get a full list of comments for a task in chronological order.
   *
   * @param int $project_id ID of project
   * @param int $task_id ID of Task
   * @return array
   */
  public function listComments($project_id, $task_id) {
    $url = self::URL."/".self::VERSION."/projects/{$project_id}/tasks/{$task_id}/comments.xml";
    $method = "GET";
    $xml = $this->_sendRequest($url, $method);
    $results = array();
    foreach($xml->comment as $comment){
      $results[] = BugHerd_Comment::fromXml($comment);
    }
    return $results;
  }

  /**
   * List details of a comment.
   *
   * @param int $project_id ID of project
   * @param int $task_id ID of Task
   * @param int $comment_id ID of comment
   * @return array
   */
  public function showComment($project_id, $task_id, $comment_id) {
    $url = self::URL."/".self::VERSION."/projects/{$project_id}/tasks/{$task_id}/comments/{$comment_id}.xml";
    $method = "GET";
    $xml = $this->_sendRequest($url, $method);
    return BugHerd_Comment::fromXml($xml);
  }

  /**
   * Adds a new comment to the specified task.
   * @param int $project_id ID of project
   * @param int $task_id ID of Task
   * @param BugHerd_Comment $comment The comment itself
   */
  public function createComment($project_id, $task_id, BugHerd_Comment $comment) {
    $url = self::URL."/".self::VERSION."/projects/{$project_id}/tasks/{$task_id}/comments.xml";
    $method = "POST";
    $xml = $comment->toXml();
    $xml = $this->_sendRequest($url, $method, $xml);
    return BugHerd_Comment::fromXml($xml);
  }

  /**
   * Sends the API request and returns the response
   *
   * @param string $url The url to make the request to
   * @param string $method GET, POST, PUT, or DELETE
   * @param string $xml XML string sent as post body
   */
  protected function _sendRequest($url, $method = "GET", $xml = null) {
    if (!extension_loaded('curl')) {
      throw new BugHerd_Exception("cURL extension is missing.", BugHerd_Exception::CODE_NO_CURL);
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERPWD, $this->_credentials['email'] . ":" . $this->_credentials['password']);
    switch($method){
      case "POST":
        curl_setopt($ch, CURLOPT_POST, true);
        break;
      case "PUT":
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        break;
      case "DELETE":
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        break;
      case "GET":
      default:
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        break;
    }
    if($xml){
      curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/xml"));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    }
    $response = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if($response === false){
      // No response received
      $error = curl_error($ch);
      $errorno = curl_errno($ch);
      curl_close($ch);
      throw new BugHerd_Exception($error, $errorno);
    }elseif($status == 404){
      // The url was incorrect
      throw new BugHerd_Exception("The requested url was not found.", $status);
    }elseif(mb_substr($status,0,1) != '2'){
      // Not a sucessful status code
      $xml = @simplexml_load_string($response);
      if($xml === false){
        curl_close($ch);
        throw new BugHerd_Exception("Invalid xml response", BugHerd_Exception::CODE_INVALID_XML);
      }
      if(is_array($xml->error)){
        $errors = array();
        foreach($xml->error as $error){
          $errors[] = (string) $error;
        }
        $error = implode(PHP_EOL, $errors);
      }else{
        $error = (string) $xml->error;
      }
      // Build Error
      curl_close($ch);
      throw new BugHerd_Exception($error, $status);
    }else{
      // Sucessful response
      curl_close($ch);
      $xml = @simplexml_load_string($response);
      return ($xml !== false) ? $xml : true;
    }
  }

}