CREATE TABLE IF NOT EXISTS bookList (
  `_record_number` INT AUTO_INCREMENT NOT NULL,
  `Work_ID` VARCHAR(50),
  `Title` VARCHAR(500),
  `Authors` VARCHAR(500),
  `First_Publish_Year` VARCHAR(10),
  `Edition_ID` VARCHAR(50),
  `Rating` NUMERIC(4,2),
  `Total` INTEGER,
  PRIMARY KEY (`_record_number`)
);


CREATE TABLE IF NOT EXISTS cart (
  username VARCHAR(50) NOT NULL,
  edition_id VARCHAR(50) NOT NULL,
  title VARCHAR(500) NOT NULL,
  authors VARCHAR(500) NOT NULL,
  quantity INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS users (
  id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(50) NOT NULL,
  firstName VARCHAR(50) NOT NULL,
  lastName VARCHAR(50) NOT NULL,
  type VARCHAR(50) NOT NULL,
  profilePic VARCHAR(1000),
  loginAttemps INT(11),
  lastLoginTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS wishList (
  id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  edition_id VARCHAR(50) NOT NULL,
  title VARCHAR(500) NOT NULL,
  authors VARCHAR(500) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);
