select * from responses

truncate table responses
	
ALTER TABLE responses
DROP CONSTRAINT responses_question_id_fkey;

ALTER TABLE responses
ADD CONSTRAINT responses_question_id_fkey
FOREIGN KEY (question_id)
REFERENCES questions(id)
ON DELETE CASCADE;
