use pac_dwes;
select management from setup;
UPDATE setup SET management  = 1;

select user.id from user inner join setup on user.id = setup.superadmin_id;

SELECT user.id FROM user INNER JOIN setup ON user.id = setup.superadmin_id 
WHERE user.full_name = 'Jack Blue' AND user.email = 'jack@blue.com';

select user.email, user.full_name from user;
select * from user;
select user.id, user.email, user.full_name, user.enabled from user;
