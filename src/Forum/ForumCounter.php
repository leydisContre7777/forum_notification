<?php
namespace Drupal\forum_notification\Forum;

/**
 * Created by PhpStorm.
 * User: ldcontreras
 * Date: 30/05/18
 * Time: 18:26
 */
class ForumCounter implements ForumInterface {

	/**
	 * @param $forum
	 * @param $uid
	 * @return array()
	 */
	public function setForumCounter($forum, $uid) {
		$counterState = db_update('forum_counter_states')
			->fields(array(
				'state' => 'read',
			))
			->condition('uid', $uid)
			->condition('tid', $forum)
			->execute();

		return $counterState;

	}



	/**
	 * @param $forum
	 * @param $uid
	 * @return array()
	 */
	public function getForumNotification($forum, $uid) {
		$unReadNotifications =
			db_query('SELECT count(*) as counter 
								FROM {forum_counter_states} as f WHERE f.uid = :uid AND f.state = :state AND f.tid = :forum',
				array(
					':uid' => $uid,
					':forum' => $forum,
					':state' => 'unread'
				)
			)->fetchAll();

		return $unReadNotifications[0]->counter;
	}
	
	

	/*****
	 * @param $nid
	 * @param $tid
	 * @param $author
	 * 
	 *  Save the new forum participation for each forum participant.
	 */
	function forumNotification($nid, $tid, $author) {
		$forum_type = taxonomy_term_load($tid);

		$forum = variable_get('forum_notification_vocabulary');
		
		if ($forum_type->name == $forum) {
			$forum_users = db_query('SELECT  ur.uid FROM {forum_access}  
											as fa INNER JOIN {users_roles}  as ur 
											WHERE fa.rid = ur.rid AND fa.tid= :tid AND ur.uid<> :author',
				array(
					':tid' => $tid,
					':author' => $author
				)
			)->fetchAll();

			foreach ($forum_users as $key => $value) {
				db_insert('forum_counter_states')
					->fields(array('tid', 'nid', 'state', 'uid'))
					->values(array(
						'tid' => $tid,
						'nid' => $nid,
						'state' => 'unread',
						'uid' => $value->uid
					))
					->execute();
			}
		}
	}
}