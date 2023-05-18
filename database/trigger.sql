DELIMITER $$

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
		stock = stock - OLD.count 
	WHERE 
		id = OLD.item_id;
END $$

-- 

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
		stock = (stock + OLD.count) - NEW.count 
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

-- 

DELIMITER ;