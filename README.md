# Random-Generator

This is a program with the main purpose of auto generating random characters that can be useful for generating password.

To use this as a default:

INSTRUCTIONS:
1. Create a database name 'personal_base'
2. Create a table name 'randomgen' or you can copy and paste this to SQL.
CREATE TABLE randomgen (
id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
name VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL
)
3. Run the program.
