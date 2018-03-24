# newmedassoc

Database design project for CS 631851-Data Mgt Systems Design, New Jersey Institute of Technology.

Build database and web application to meet all the requirements of a fictional medical clinic - Newark Medical Associates.

ER Diagrams and relational models built using MySql Workbench and Yed software.

Database built using MyphpAdmin.

Web application built using php scripts.

As part of course requirement for NJIT’s graduate program, Data Management System Design; we were required to design and build a database that answered the needs of a factitious organization called the Newark Medical Associates.

Working in concert with my project partner, Yassine Chafi Berrehouma, we conducted an analysis to determine what the needs and requirements were.  Those requirements were outlined in the following:

Database_design - http://www.hyochangkim.com/wp-content/uploads/2018/01/Database_design.pdf

Once we understood the requirements, we began working through our conceptual schema design.  We looked at the various database structures, semantics, interrelationships, and constraints.  We used a top-down approach, starting with abstraction and refining as we progressed.

MySql Workbench played a key role in developing our ER model from which we would eventually build our physical database.

ER Diagram - http://www.hyochangkim.com/wp-content/uploads/2018/01/Term-Project.pdf

Clinic DB report - http://www.hyochangkim.com/wp-content/uploads/2018/01/clinic-DB-report.pdf

With these two diagrams completed and with an understanding of the database design requirements, we proceeded to build our database using PHP script.  Our initial efforts were to create our databases with sql statements embedded in the php scripts.  However, as the complexity of our design evolved, we found it more efficient to use MAMP and phpMyAdmin to directly build the databases.

We initially used localhost as our test server prior to uploading live on a website that we bought.

We began with 12 tables and ended with 28 as we continually refined our database and sought greater levels of normalization.

http://www.hyochangkim.com/wp-content/uploads/2018/01/Screen-Shot-2018-01-08-at-1.58.53-PM.png

In addition to the database, we also needed to build a web application to access the database.  The requirements were as follows:

app_requirements - http://www.hyochangkim.com/wp-content/uploads/2018/01/clinic-DB-report.pdf

In building our web application, we decided to build our site from scratch.  This meant buying a website and writing the necessary scripts to make it run.  Although templates, apps and programs exist that would have made this an “easier” process; we felt it would be a greater learning experience to go from the bottom up.

And it was.  Our website is fairly basic, yet we were able to build a good deal of functionality to it.  We learned the process of using foreign keys to populate multiple tables simultaneously.  Entering data into one page, such as “schedule surgery” would call most current information on surgeons, nurses, etc. to populate that table.

www.newarkmedicalassociates.xyz
