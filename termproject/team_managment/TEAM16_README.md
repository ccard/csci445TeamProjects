Term Project csci445
===================

&nbsp;&nbsp;_Team_: Team16

&nbsp;&nbsp;_Authors_: Chris Card, Mike Hughes, Jothan Phillips

# Intro #
&nbsp;&nbsp;This is our final project for csci445 for more explicite details on the project structure please visit the project [page](http://eecs.mines.edu/Courses/csci445/ASSIGN/TeamUnit3.html).

------
# Running the project #
## if using artisan ##
&nbsp;&nbsp;This section will discribe how to run our program and the necessary commands and file requirements.
 - The first command you should run is `composer update` to ensure that all dependencies are meet or installed
 - All you should have to do is run `php artisan serve` and navigate to [http://localhost:8000](http://localhost:8000): to login as the admin username is _admin@admin.com_, pass is _admin_
 - If you  want to reset the database using the csv files that we provided or have trouble logging in. Run the command `php artisan migrate:refresh --seed`
 - This uses the sqlite database not mysql
 - __note:__ to login as a non admin user look at the students.csv file in /app/database/seeds/csvs/students.csv file and the username is in there and the password is the cwid.  and the first time you login you should be redirected to the home/firstlogin page, you should be able to fill out the fields and save the form.

------
##if running from luna ##
&nbsp;&nbsp;This section will discribe how to run our program and the necessary commands and file requirements.
 - go to [luna.mines.edu/team16/team_managment/public](luna.mines.edu/team16/team_managment/public)
 - to login as admin username:admin@admin.com pass:admin
 - to login as user username:dvader@mines.edu pass:223344 or any one from students.csv where the email is the username and the password is the cwid


------
#Week 3#
##if running from luna ##
&nbsp;&nbsp;This section will discribe how to run our program and the necessary commands and file requirements.
 - go to [luna.mines.edu/team16/team_managment/public](luna.mines.edu/team16/team_managment/public)
 - to login as admin username:admin@admin.com pass:admin
 - to login as user username:dvader@mines.edu pass:223344 or any one from students.csv where the email is the username and the password is the cwid
 - Generating teams
  - first fill out all the sutdents first time login forms
  - then login as the admin and on the home page click the here button for generate teams
  - it will generate the teams and then show them on home page