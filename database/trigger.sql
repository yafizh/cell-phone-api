CREATE TRIGGER 
	after_insert_supply_stock
AFTER INSERT 
ON 
	supply_stock 
FOR EACH ROW 
BEGIN
	UPDATE 
		items 
	SET 
		stock = stock + NEW.stock 
	WHERE 
		id = NEW.item_id 
END

CREATE TRIGGER 
	after_update_supply_stock
AFTER UPDATE
ON 
	supply_stock 
FOR EACH ROW 
BEGIN
	UPDATE 
		items 
	SET 
		stock = stock - OLD.stock + NEW.stock 
	WHERE 
		id = NEW.item_id 
END

CREATE TRIGGER 
	after_delete_supply_stock
AFTER DELETE
ON 
	supply_stock 
FOR EACH ROW 
BEGIN
	UPDATE 
		items 
	SET 
		stock = stock - OLD.stock
	WHERE 
		id = NEW.item_id 
END