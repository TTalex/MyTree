<p align="center">
<img src ="MyTreeLogo.png" alt="MyTreeLogo"/>
</p>
##Introduction
MyTree uses the <a href="http://opendata.paris.fr">opendata Paris</a> database to retrieve planting dates of trees in the capital city, a list of trees planted near your birth date is then generated and displayed on a google map.

##Used APIs
* <a href="http://opendata.paris.fr">Opendata Paris</a> to get a database of all trees planted in Paris
* <a href="https://developers.google.com/maps/">Google Maps</a> to display the position of the resulted trees

##Running it
1. Make sure php is installed on your machine
2. Move to your public web folder

  ```bash
  cd /var/www/
  ```

3. Clone the repo

  ```bash
  git clone https://github.com/TTalex/MyTree.git
  ```

4. Access [localhost/MyTree](http://localhost/MyTree)

##Demo
[Demo on heroku](https://ttalex-mytree.herokuapp.com/)
