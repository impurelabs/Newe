<?php

class myUser extends neweUser
{
	public function isFrappAdmin($frapp)
	{
		/**
		 * Checks if the user is an admin or the creator of the passed frapp
		 *
		 * @return boolean
		 */
		if (!array_key_exists('admin_ids', $frapp) or !array_key_exists('creator_id', $frapp)){
			throw new sfException('$the frapp format is invalid in myUser::isFrappAdmin');
		}

		if ($this->getAccountId() != $frapp['creator_id'] && !array_key_exists($this->getAccountId(), $frapp['admin_ids'])){
			return false;
		} else {
			return true;
		}
	}

	public function isFrappCreator($frapp)
	{
		/**
		 * Checks if the user is the creator of the passed frapp
		 *
		 * @return boolean
		 */
		if (!array_key_exists('creator_id', $frapp)){
			throw new sfException('$the frapp format is invalid in myUser::isFrappAdmin');
		}

		if ($this->getAccountId() != $frapp['creator_id']){
			return false;
		} else {
			return true;
		}
	}
}
