CREATE TABLE begriffe (
  id int(11) NOT NULL AUTO_INCREMENT,
  titel varchar(255) NOT NULL,
  text text,
  PRIMARY KEY (id)
);

INSERT INTO begriffe (id, titel, text) VALUES
(1, 'PHP', 'PHP Hypertext Preprocessor'),
(2, 'CSS', 'Cascading Style Sheets'),
(3, 'JS', 'JavaScript'),
(4, 'C#', 'C-Sharp'),
(5, 'Sass', 'Syntactically awesome style sheets');
