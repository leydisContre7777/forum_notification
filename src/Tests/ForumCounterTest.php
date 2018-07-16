<?php
/**
 * Created by PhpStorm.
 * User: ldcontreras
 * Date: 8/06/18
 * Time: 10:02
 */

namespace Drupal\forum_innovation\Tests;


/**
 * Test the  ForumCounter Class.
 * @coversDefaultClass  \Drupal\forum_innovation\Forum
 * @group utility
 */
class ForumCounterTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @covers::setForumCounter
	 */

	public function testSetForumCounter() {
		$set_counter = $this->getMockBuilder('Drupal\forum_innovation\Forum\ForumCounter')
			->setMethods(array('setForumCounter'))
			->getMock();

		$set_counter->expects($this->once())
			->method('setForumCounter')->will($this->returnValue(TRUE));

		$set_counter->setForumCounter(83, 3024);
	}

	/**
	 * @covers::getForumNotification
	 */
	public function testGetForumNotification() {
		$get_forum_notification = $this->getMockBuilder('Drupal\forum_innovation\Forum\ForumCounter')
			->setMethods(array('getForumNotification'))
			->getMock();

		$get_forum_notification->expects($this->once())
			->method('getForumNotification')->will($this->returnValue(1));

		$get_forum_notification->getForumNotification(83, 3024);


	}

	/**
	 * @covers::forumNotification
	 */
	public function testForumNotification() {
		$forum_notification = $this->getMockBuilder('Drupal\forum_innovation\Forum\ForumCounter')
			->setMethods(array('forumNotification'))
			->getMock();

		$forum_notification->expects($this->once())
			->method('forumNotification')->will($this->returnValue(1));

		$forum_notification->ForumNotification(83, 3024,1);


	}



}
