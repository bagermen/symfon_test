UPDATE 
	user u
    LEFT JOIN (
		SELECT account_owner_id, MAX(updated_at) updated_at
		FROM user_recipient
		GROUP BY account_owner_id) ur ON u.id = ur.account_owner_id 
SET lastActivityDate = IFNULL(ur.updated_at, u.updated_at)
