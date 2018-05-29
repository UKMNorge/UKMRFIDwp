BEGIN
  IF (NEW.direction = 'in') THEN
    INSERT INTO users_in_area(user_id,area_id) VALUES (NEW.rfid,NEW.area);
  ELSIF (NEW.direction = 'out') THEN
    DELETE FROM users_in_area WHERE user = NEW.rfid;
  END IF;
  RETURN NULL;
END;