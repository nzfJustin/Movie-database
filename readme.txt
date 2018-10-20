P1C.zip
 |
 +- Folder named with 804840297
     |
     www
       |
       +- Add_Actor_Director.php
       |
       +- Add_Movie.php
       |
       +- Add_Comments.php
       |
       +- Add_M_A_R.php
       |
       +- Add_M_D_R.ph
       |
       +- search.php
       |
       +- Show_A.php
       |
       +- Show_M.php
       |
       +- P1C.html
       |
       +- welcome.html
       |    
       +- header.html
       |
       +- navi.html  
       |
       +- css (folder)
       |
       +- js (folder)
       |   
     sql
       |
       +- create.sql
       |
       +- load.sql   

* P1C.html
     This is our main page of the project. It contains a html frameset that combines the
    header, side navigation, and the multiple php files.

* welcome.html
     Contains the basic utility introduction of the whole website.

* header.html
     The header of the website.

* navi.html
     The side navigation of the website. It contains the implementation of the accordion 
    menu, which will redirect the user to multiple functional pages.

* Add_Actor_Director.php:
     A page that let users to add actor / director information, which includes their
    last name, first name, gender, dob, dod. If the user chooses to add an actor, then    
    insert the tuple into Director database, if the user chooses to add actor/actress.    
    Then insert the tuple into Actor table. 

* Add_Movie.php
     A page that let users to add movie information, which includes title, year, rate and 
   company. A scroll table is created for user to choose the rating and user need to input 
   other informations manually, once the user fill in all information and select Add 
   button, this new movie will be inserted into Movie table. 

* Add_Comments.php
     A page that let users to add comment to a movie. The page includes a scroll table 
   allowing user to select sorted movie title, another scroll table allowing user to select 
   rating (1-5). Then a text area for user to type in comments. Once the user fill in the 
   page and select Add. User's information, together with the movie and its comment, and 
   the time that the user add the comment, will be inserted into Review table.  

* Add_M_A_R.php
     A page that let users to add actor to movie relation. The page includes a scroll 
  table that go over all actor names in the Actor table, allowing user to choose a 
  specific actor. Another scroll table that go over all movie names in the Movie table, 
  allowing user to choose a movie name. Both table are sorted. Finally a text area 
  allowing user to input actor's row in the movie. Once user fill in the content and 
  press Add button, the tuple will be inserted into MovieActor table. 

* Add_M_D_R.php
     A page that let users to add director to movie relation. The page includes a scroll 
   table that go over all director names in the sorted Director table, allowing user to 
   choose a Specific director. Another scroll table that go over all movie names in the Movie 
   table, allowing user to choose a movie name.Once user fill in the content and press Add 
   button, the tuple will be inserted into MovieDirector table. 

* search.php
     A page that lets users search for an actor/actress/movie through a keyword search 
    interface. It supports the multi-word search, our implementation match the input word
    one by one and filter out the un-matched entries.

* Show_A.php
     A page that shows actor information, including . This page is usually redirected from the search
    page, via clicking the actor name in a search result. It will show the basic information
    of an actor, and all the movie the actor was in. The actor id is the key that pass from
    search.php/Show_M.php to Show_A.php, and will serve for the query access. It also shows 
    links to the movies that the actor was in. By clicking the links, the user will be directed 
    to the Show_M.php page.   

* Show_M.php
     A page that shows movie basic information. The basic information includes movie title,
    producer, MPAA Rating, director, and genre of this movie. All the actors/actresses that were 
    in this movie are also listed in a table. Links are added to their name, and via clicking 
    names, user will be directed to Show_A.php. Noticing that both Show_A.php and search.php 
    can pass a movie id to this page, and the id will serve for accessing the above information 
    from the database. A movie sometimes has multiple genres or multiple directors, and these
    information will show on this page. The page will also show average score based on user feedbacks
    of this movie, average can be calculated via aggregation function. All the user comments 
    are listed, contains username, score and a timestamp. A link to the "Add Comment" page 
    is attached.

* css folder
     Contains the basic Foundation style framework.

* js folder
     Contains the js script that supports the Foundation style. 


Collaboration 
  The workload is basically partitioned evenly. Zifan Nie mostly worked on the implementation 
  of the first four php files Add_Actor_Director.php, Add_Movie.php, Add_Comments.php, and 
  Add_M_A_R.php, and Dongyun Zhang mostly worked on the implementation of the last four php 
  Add_M_D_R.php, search.php, Show_A.php, and Show_M.php. We learned a lot on how to combine 
  html and php, also spend a lot of time to learn css framework. We basically met for group 
  study once every two days. At first our progress was pretty slow, since both of us are not 
  familiar with php and html, and most of the time was put on debugging the code. After we 
  finished the first three php's, we made much faster progress, and we fulfilled all the 
  implementation requirements that asked in project specification.


reference: 
   PHP manual
   http://oak.cs.ucla.edu/classes/cs143/project/php/php_db.html
   http://us2.php.net/manual/en/mysql.php
   http://www.anyexample.com/programming/php/php_mysql_example__display_table_as_html.xml