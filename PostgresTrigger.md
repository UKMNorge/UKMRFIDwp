BEGIN
  IF ( (SELECT id FROM person WHERE person.rfid = NEW.rfid) IS NULL ) THEN
    RAISE EXCEPTION 'No user with that RFID registered';
  END IF;
  IF (NEW.direction = 'in') THEN
    INSERT INTO person_in_area(person_id,area_id) VALUES ( (SELECT id FROM person WHERE person.rfid = NEW.rfid) ,NEW.area);
  ELSIF (NEW.direction = 'out') THEN
    DELETE FROM person_in_area WHERE person_id = (SELECT id FROM person WHERE person.rfid = NEW.rfid);
  END IF;
  RETURN NULL;
END;