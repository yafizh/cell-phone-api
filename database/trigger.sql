DELIMITER $$

CREATE TRIGGER 
	after_insert_item_sale_details
AFTER INSERT 
ON 
	item_sale_details 
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
	after_update_item_sale_details
AFTER UPDATE
ON 
	item_sale_details 
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
	after_delete_item_sale_details
AFTER DELETE 
ON 
	item_sale_details 
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

CREATE TRIGGER 
	after_insert_item_supply_details
AFTER INSERT 
ON 
	item_supply_details 
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
	after_update_item_supply_details
AFTER UPDATE 
ON 
	item_supply_details 
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
	after_delete_item_supply_details
AFTER DELETE 
ON 
	item_supply_details 
FOR EACH ROW 
BEGIN
	UPDATE 
		items
	SET 
		stock = stock - OLD.count 
	WHERE 
		id = OLD.item_id;
END $$