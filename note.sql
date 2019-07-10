 CREATE TABLE note(
		id_note int(3) NOT NULL auto_increment,
		membre_id1 int(3) NOT NULL,
		membre_id2 int(3) NOT NULL,
		note int (3) NOT NULL,
    	avis text,
    	date_enregistrement datetime NOT NULL,
		PRIMARY KEY (id_note)
	)ENGINE=InnoDB;
 

INSERT INTO  note(
		id_note int(3) NOT NULL auto_increment,
		membre_id1 int(3) NOT NULL,
		membre_id2 int(3) NOT NULL,
		note int (3) NOT NULL,
    	avis text,
    	date_enregistrement datetime NOT NULL,
		PRIMARY KEY (id_note)
	)ENGINE=InnoDB;
    
 
    