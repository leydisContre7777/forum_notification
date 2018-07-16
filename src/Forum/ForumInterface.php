<?php

namespace Drupal\forum_notification\Forum;
/**
 * Created by PhpStorm.
 * User: ldcontreras
 * Date: 30/05/18
 * Time: 18:26
 */
interface ForumInterface {

	public  function setForumCounter($forum, $uid);
	
	public  function getForumNotification($forum, $uid);
	
}