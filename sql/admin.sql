USE simple_blog;
CREATE TABLE admin (
  admin_id INT NOT NULL AUTO_INCREMENT,
  email    TEXT,
  password VARCHAR(32),
  PRIMARY KEY (admin_id)
);
