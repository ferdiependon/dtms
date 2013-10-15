--
-- Database: dtms
--
CREATE DATABASE IF NOT EXISTS dtms DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE dtms;

-- --------------------------------------------------------

--
-- Table structure for table task
--

CREATE TABLE IF NOT EXISTS task (
  id int(16) NOT NULL AUTO_INCREMENT,
  user_id int(8) NOT NULL,
  date date NOT NULL,
  title varchar(32) NOT NULL,
  summary varchar(64) NOT NULL,
  details varchar(128) NOT NULL,
  status varchar(16) NOT NULL,
  complete int(3) NOT NULL,
  hours float NOT NULL,
  PRIMARY KEY (id),
  KEY task_ibfk_1 (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table user
--

CREATE TABLE IF NOT EXISTS user (
  id int(8) NOT NULL AUTO_INCREMENT,
  username varchar(32) NOT NULL,
  password varchar(32) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table task
--
ALTER TABLE task
  ADD CONSTRAINT task_ibfk_1 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE ON UPDATE CASCADE;
