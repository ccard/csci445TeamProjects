Term Project csci445
===================

&nbsp;&nbsp;_Authors_: Chris Card, Mike Hughes, Jothan Phillips

# Intro #
&nbsp;&nbsp;This is our final project for csci445 for more explicite details on the project structure please visit the project [page](http://eecs.mines.edu/Courses/csci445/ASSIGN/TeamUnit3.html).

------
# Running the project #
&nbsp;&nbsp;This section will discribe how to run our program and the necessary commands and file requirements.
 - If you wish to use a different '.csv' file than what the database has already been seeded with then please insure that the formates are updated to the following for students.csv replace the header `First,Last,CWID,Email`&rarr;`firstname,lastname,password,username`, for the projects.csv file replace the header `Client,Project`&rarr;`company,title,min,max`
 - If you followed the previous step or simply want to reset the database using the csv files that we provided. Run the command `php artisan migrate:refresh --seed`
 - This uses the sqlite database not mysql
 - Once this is done run `php artisan serv` and go to http://localhost:8000 and you should be redirected to the appropriate page