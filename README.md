# Simple-Message
I hacked this up one Sunday evening for a module, Internet Programming, that I was not doing.

Users register via logging in.
Once logged in, a user can view previous posts and submit his/her own post.

## Installation

You will need an http server that can process php files, along with a mysql server.

Copy the contents of this respository to the http directory.

Create the message board schema by importing ```msgbrd.sql```.
Example, on bash command line:
```bash
mysql -u root -p < msgbrd.sql
```
Assuming that your working directory is where msgbrd.sql is.

