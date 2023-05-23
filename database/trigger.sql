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
		stock = (stock - (CAST(OLD.count AS SIGNED) - CAST(NEW.count AS SIGNED))) 
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
		stock = stock - OLD.count 
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
		stock = (stock + (CAST(OLD.count AS SIGNED) - CAST(NEW.count AS SIGNED))) 
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

-- Balances Trigger - In
CREATE TRIGGER 
	after_insert_balance_in
AFTER INSERT 
ON 
	balance_in 
FOR EACH ROW 
BEGIN
	UPDATE 
		balances
	SET 
		balance = balance + NEW.amount 
	WHERE 
		id = NEW.balance_id;
END $$

CREATE TRIGGER 
	after_update_balance_in
AFTER UPDATE 
ON 
	balance_in 
FOR EACH ROW 
BEGIN
	UPDATE 
		balances
	SET 
		balance = (balance - (CAST(OLD.amount AS SIGNED) - CAST(NEW.amount AS SIGNED))) 
	WHERE 
		id = NEW.balance_id;
END $$

CREATE TRIGGER 
	after_delete_balance_in
AFTER DELETE 
ON 
	balance_in 
FOR EACH ROW 
BEGIN
	UPDATE 
		balances
	SET 
		balance = balance - OLD.amount 
	WHERE 
		id = OLD.balance_id;
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
		balances 
	INNER JOIN 
		credits 
	ON 
		credits.balance_id=balances.id
	SET 
		balance = balance - NEW.amount 
	WHERE 
		credits.id=NEW.credit_id;
END $$

CREATE TRIGGER 
	after_update_credit_out
AFTER UPDATE
ON 
	credit_out 
FOR EACH ROW 
BEGIN
	UPDATE 
		balances 
	INNER JOIN 
		credits 
	ON 
		credits.balance_id=balances.id
	SET 
		balance = (balance + (CAST(OLD.amount AS SIGNED) - CAST(NEW.amount AS SIGNED))) 
	WHERE 
		credits.id=NEW.credit_id;
END $$

CREATE TRIGGER 
	after_delete_credit_out
AFTER DELETE 
ON 
	credit_out 
FOR EACH ROW 
BEGIN
	UPDATE 
		balances 
	INNER JOIN 
		credits 
	ON 
		credits.balance_id=balances.id
	SET 
		balance = balance + OLD.amount 
	WHERE 
		credits.id=OLD.credit_id;
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
		balances 
	INNER JOIN 
		topups 
	ON 
		topups.balance_id=balances.id
	SET 
		balance = balance - NEW.amount
	WHERE 
		topups.id=NEW.topup_id; 
END $$

CREATE TRIGGER 
	after_update_topup_out
AFTER UPDATE
ON 
	topup_out 
FOR EACH ROW 
BEGIN
	UPDATE 
		balances 
	INNER JOIN 
		topups 
	ON 
		topups.balance_id=balances.id
	SET 
		balance = (balance + (CAST(OLD.amount AS SIGNED) - CAST(NEW.amount AS SIGNED))) 
	WHERE 
		topups.id=NEW.topup_id; 
END $$

CREATE TRIGGER 
	after_delete_topup_out
AFTER DELETE 
ON 
	topup_out 
FOR EACH ROW 
BEGIN
	UPDATE 
		balances 
	INNER JOIN 
		topups 
	ON 
		topups.balance_id=balances.id
	SET 
		balance = balance + OLD.amount 
	WHERE 
		topups.id=OLD.topup_id; 
END $$


DELIMITER ;