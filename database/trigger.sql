DELIMITER $$

-- Items Trigger - In
CREATE TRIGGER 
	after_insert_item_in
AFTER INSERT 
ON 
	item_in 
FOR EACH ROW 
BEGIN
	UPDATE 
		items
	SET 
		stock = stock + NEW.count 
	WHERE 
		id = NEW.item_id;
END $$

CREATE TRIGGER 
	after_update_item_in
AFTER UPDATE 
ON 
	item_in 
FOR EACH ROW 
BEGIN
	UPDATE 
		items
	SET 
		stock = (stock - OLD.count) + NEW.count 
	WHERE 
		id = NEW.item_id;
END $$

CREATE TRIGGER 
	after_delete_item_in
AFTER DELETE 
ON 
	item_in 
FOR EACH ROW 
BEGIN
	UPDATE 
		items
	SET 
		stock = (stock - (OLD.count - NEW.count)) 
	WHERE 
		id = OLD.item_id;
END $$

-- Items Trigger - Out 

CREATE TRIGGER 
	after_insert_item_out
AFTER INSERT 
ON 
	item_out 
FOR EACH ROW 
BEGIN
	UPDATE 
		items
	SET 
		stock = stock - NEW.count 
	WHERE 
		id = NEW.item_id;
END $$

CREATE TRIGGER 
	after_update_item_out
AFTER UPDATE
ON 
	item_out 
FOR EACH ROW 
BEGIN
	UPDATE 
		items
	SET 
		stock = (stock + (OLD.count - NEW.count)) 
	WHERE 
		id = NEW.item_id;
END $$

CREATE TRIGGER 
	after_delete_item_out
AFTER DELETE 
ON 
	item_out 
FOR EACH ROW 
BEGIN
	UPDATE 
		items
	SET 
		stock = stock + OLD.count 
	WHERE 
		id = OLD.item_id;
END $$

-- Credits Trigger - In
CREATE TRIGGER 
	after_insert_credit_in
AFTER INSERT 
ON 
	credit_in 
FOR EACH ROW 
BEGIN
	UPDATE 
		credits
	SET 
		balance = balance + NEW.amount 
	WHERE 
		id = NEW.credit_id;
END $$

CREATE TRIGGER 
	after_update_credit_in
AFTER UPDATE 
ON 
	credit_in 
FOR EACH ROW 
BEGIN
	UPDATE 
		credits
	SET 
		balance = (balance - (OLD.amount - NEW.amount)) 
	WHERE 
		id = NEW.credit_id;
END $$

CREATE TRIGGER 
	after_delete_credit_in
AFTER DELETE 
ON 
	credit_in 
FOR EACH ROW 
BEGIN
	UPDATE 
		credits
	SET 
		balance = balance - OLD.amount 
	WHERE 
		id = OLD.credit_id;
END $$

-- Credits Trigger - Out 

CREATE TRIGGER 
	after_insert_credit_out
AFTER INSERT 
ON 
	credit_out 
FOR EACH ROW 
BEGIN
	UPDATE 
		credits
	SET 
		balance = balance - NEW.amount 
	WHERE 
		id = NEW.credit_id;
END $$

CREATE TRIGGER 
	after_update_credit_out
AFTER UPDATE
ON 
	credit_out 
FOR EACH ROW 
BEGIN
	UPDATE 
		credits
	SET 
		balance = (balance + (OLD.amount - NEW.amount)) 
	WHERE 
		id = NEW.credit_id;
END $$

CREATE TRIGGER 
	after_delete_credit_out
AFTER DELETE 
ON 
	credit_out 
FOR EACH ROW 
BEGIN
	UPDATE 
		credits
	SET 
		balance = balance + OLD.amount 
	WHERE 
		id = OLD.credit_id;
END $$

-- Topups Trigger - In
CREATE TRIGGER 
	after_insert_topup_in
AFTER INSERT 
ON 
	topup_in 
FOR EACH ROW 
BEGIN
	UPDATE 
		topups
	SET 
		balance = balance + NEW.amount 
	WHERE 
		id = NEW.topup_id;
END $$

CREATE TRIGGER 
	after_update_topup_in
AFTER UPDATE 
ON 
	topup_in 
FOR EACH ROW 
BEGIN
	UPDATE 
		topups
	SET 
		balance = (balance - (OLD.amount - NEW.amount)) 
	WHERE 
		id = NEW.topup_id;
END $$

CREATE TRIGGER 
	after_delete_topup_in
AFTER DELETE 
ON 
	topup_in 
FOR EACH ROW 
BEGIN
	UPDATE 
		topups
	SET 
		balance = balance - OLD.amount 
	WHERE 
		id = OLD.topup_id;
END $$

-- Topups Trigger - Out 

CREATE TRIGGER 
	after_insert_topup_out
AFTER INSERT 
ON 
	topup_out 
FOR EACH ROW 
BEGIN
	UPDATE 
		topups
	SET 
		balance = balance - NEW.amount 
	WHERE 
		id = NEW.topup_id;
END $$

CREATE TRIGGER 
	after_update_topup_out
AFTER UPDATE
ON 
	topup_out 
FOR EACH ROW 
BEGIN
	UPDATE 
		topups
	SET 
		balance = (balance + (OLD.amount - NEW.amount)) 
	WHERE 
		id = NEW.topup_id;
END $$

CREATE TRIGGER 
	after_delete_topup_out
AFTER DELETE 
ON 
	topup_out 
FOR EACH ROW 
BEGIN
	UPDATE 
		topups
	SET 
		balance = balance + OLD.amount 
	WHERE 
		id = OLD.topup_id;
END $$

DELIMITER ;