<?php

/**
 * BugHerd API Exception Class
 *
 * @author Jonathan Bernardi <spekkionu@gmail.com>
 * @license New BSD http://www.opensource.org/licenses/bsd-license.php
 * @package BugHerd
 */
class BugHerd_Exception extends Exception
{
  /**
   * Error code for when json extension is missing
   */

  const CODE_NO_JSON = 1001;

  /**
   * Error code for when curl exentsion is missing
   */
  const CODE_NO_CURL = 1002;

  /**
   * Error code for when simplexml extension is missing
   */
  const CODE_NO_SIMPLEXML = 1003;


  /**
   * Error code when no response is received from api server
   */
  const CODE_NO_RESPONSE = 1004;

  /**
   * Response contained invalid xml
   */
  const CODE_INVALID_XML = 1005;

}