<?php
/*
Plugin Name: PageRating
Plugin URI: https://ii.up.krakow.pl/
Description: Wtyczka do oceniania stron internetowych zbudowanych w oparciu o system CMS WordPress
Version: 1.0
Author: Julian Cichor
*/

add_shortcode('ratingform','create_form');

function admin_panel()
{
    add_menu_page("PageRating","PageRating","read","admin_panel","admin_panel_menu",'',30);
}

register_activation_hook( __FILE__, 'pagerating_plugin_activation');
register_deactivation_hook( __FILE__, 'pagerating_plugin_deactivation');
register_uninstall_hook( __FILE__, 'pagerating_plugin_uninstall');

add_action('admin_menu','admin_panel');

function admin_panel_menu()
{
  echo'<div class="wrap"><div class="panel">
    <table class="wp-list-table widefat fixed striped table-view-list pages rating_table" lang="pl">
      <thead>
        <tr>
          <th scope="col" class="manage-column">Lp.</th>
          <th scope="col" class="manage-column">Wygląd strony</th>
          <th scope="col" class="manage-column">Poruszanie się po stronie</th>
          <th scope="col" class="manage-column">Jakość umieszczonych na stronie informacji</th>
          <th scope="col" class="manage-column">Dostosowanie strony do potrzeb osób z niepełnosprawnościami</th>
          <th scope="col" class="manage-column">Opinie</th>
        </tr>
        </thead>
        <tbody id="the-list">';
  $ratings=$GLOBALS['wpdb']->get_results("SELECT * FROM ratings", ARRAY_A);
  foreach($ratings as $rating)
  {
    echo '<tr class="iedit">';
    echo '<td class="column">'.$rating['id'].'</td>';
    echo '<td class="column">'.$rating['rate_apperance'].'</td>';
    echo '<td class="column">'.$rating['rate_navigation'].'</td>';
    echo '<td class="column">'.$rating['rate_info'].'</td>';
    echo '<td class="column">'.$rating['rate_usability'].'</td>';
    echo '<td class="column">'.$rating['opinions'].'</td>';
    echo '</tr>';
  }
  echo '</tbody></table></div></div>';
}

function create_form()
{
    $content = '
    <script>
    function validateForm() {
      var error_message = "";
      var rate_apperance_check = document.forms["my-form"]["rate_apperance"].value;
      if (rate_apperance_check == "") {
        error_message+="<p>"+"Oceń wygląd strony!"+"</p>";
      }
      var rate_navigation_check = document.forms["my-form"]["rate_navigation"].value;
      if (rate_navigation_check == "") {
        error_message+="<p>"+"Oceń poruszanie się po stronie!"+"</p>";
      }
      var rate_info_check = document.forms["my-form"]["rate_info"].value;
      if (rate_info_check == "") {
        error_message+="<p>"+"Oceń jakość informacji umieszczonych na stronie!"+"</p>";
      }
      var rate_usability_check = document.forms["my-form"]["rate_usability"].value;
      if (rate_usability_check == "") {
        error_message+="<p>"+"Oceń dostosowanie strony do potrzeb osób z niepełnosprawnościami!"+"</p>";
      }      
      var opinions_check = document.getElementById("opinion").value;
      if (opinions_check == "") {
        error_message+="<p>"+"Podaj swoją opinię o stronie!"+"</p>";
      }
      if(error_message != "")
      {
        document.getElementById("validator").innerHTML = error_message;
        return false;
      }   
    }
    </script>
    <div id="validator"></div>
    <div id="container">
        <table class="rating_table" lang="pl">
              <form action="" method="post" onsubmit="return validateForm()" class="form-data" name="my-form">
              <tr>
                <td class="rating_table" lang="pl"></td>
                <td class="rating_table" lang="pl">1</td>
                <td class="rating_table" lang="pl">2</td>
                <td class="rating_table" lang="pl">3</td>
                <td class="rating_table" lang="pl">4</td>
                <td class="rating_table" lang="pl">5</td>
                <td class="rating_table" lang="pl">6</td>
                <td class="rating_table" lang="pl">7</td>
                <td class="rating_table" lang="pl">8</td>
                <td class="rating_table" lang="pl">9</td>
                <td class="rating_table" lang="pl">10</td>
              </tr>
              <tr>
                <td class="rating_table" lang="pl">Wygląd strony</td>
                <td><input type="radio" name="rate_apperance" value="1"></td>
                <td><input type="radio" name="rate_apperance" value="2"></td>
                <td><input type="radio" name="rate_apperance" value="3"></td>
                <td><input type="radio" name="rate_apperance" value="4"></td>
                <td><input type="radio" name="rate_apperance" value="5"></td>
                <td><input type="radio" name="rate_apperance" value="6"></td>
                <td><input type="radio" name="rate_apperance" value="7"></td>
                <td><input type="radio" name="rate_apperance" value="8"></td>
                <td><input type="radio" name="rate_apperance" value="9"></td>
                <td><input type="radio" name="rate_apperance" value="10"></td>
              </tr>
              <tr>
                <td class="rating_table" lang="pl">Poruszanie się po stronie</td>
                <td><input type="radio" name="rate_navigation" value="1"></td>
                <td><input type="radio" name="rate_navigation" value="2"></td>
                <td><input type="radio" name="rate_navigation" value="3"></td>
                <td><input type="radio" name="rate_navigation" value="4"></td>
                <td><input type="radio" name="rate_navigation" value="5"></td>
                <td><input type="radio" name="rate_navigation" value="6"></td>
                <td><input type="radio" name="rate_navigation" value="7"></td>
                <td><input type="radio" name="rate_navigation" value="8"></td>
                <td><input type="radio" name="rate_navigation" value="9"></td>
                <td><input type="radio" name="rate_navigation" value="10"></td>
              </tr>
              <tr>
                <td class="rating_table" lang="pl">Jakość umieszczonych <br>na stronie informacji</td>
                <td><input type="radio" name="rate_info" value="1"></td>
                <td><input type="radio" name="rate_info" value="2"></td>
                <td><input type="radio" name="rate_info" value="3"></td>
                <td><input type="radio" name="rate_info" value="4"></td>
                <td><input type="radio" name="rate_info" value="5"></td>
                <td><input type="radio" name="rate_info" value="6"></td>
                <td><input type="radio" name="rate_info" value="7"></td>
                <td><input type="radio" name="rate_info" value="8"></td>
                <td><input type="radio" name="rate_info" value="9"></td>
                <td><input type="radio" name="rate_info" value="10"></td>
              </tr>
              <tr>
                <td class="rating_table" lang="pl">Dostosowanie strony do potrzeb <br>osób z niepełnosprawnościami</td>
                <td><input type="radio" name="rate_usability" value="1"></td>
                <td><input type="radio" name="rate_usability" value="2"></td>
                <td><input type="radio" name="rate_usability" value="3"></td>
                <td><input type="radio" name="rate_usability" value="4"></td>
                <td><input type="radio" name="rate_usability" value="5"></td>
                <td><input type="radio" name="rate_usability" value="6"></td>
                <td><input type="radio" name="rate_usability" value="7"></td>
                <td><input type="radio" name="rate_usability" value="8"></td>
                <td><input type="radio" name="rate_usability" value="9"></td>
                <td><input type="radio" name="rate_usability" value="10"></td>
              </tr>
        </table>
        <br>
        <textarea rows="7" cols="50" name="opinion" id="opinion" placeholder="Tutaj możesz wpisać swoje uwagi dotyczące strony"></textarea>
        <br>
        <input type="submit" value="Wyślij" name="send">
        </form>
    </div>';
    if(isset($_POST['send']))
    {
      $rate_apperance = $_POST['rate_apperance'];
      $rate_navigation = $_POST['rate_navigation'];
      $rate_info = $_POST['rate_info'];
      $rate_usability = $_POST['rate_usability'];
      $opinion = sanitize_textarea_field($_POST['opinion']);
      if($GLOBALS['wpdb']->query("INSERT INTO ratings VALUES (NULL,$rate_apperance,$rate_navigation,$rate_info,$rate_usability,'$opinion')"))
      {
        echo "<script>
        window.onload = function(){
          var take_div = document.getElementById('container');
          take_div.style.backgroundColor = '#F5EFE0';
          take_div.innerHTML = '<h3 style=\"text-align: center;\">Dziękujemy za wypełnienie ankiety!</h3><p style=\"font-size: 24px; text-align: center;\">Aby przejść na stronę główną, naciśnij <a href=\"https://projektjks.pl/\" alt=\"Strona główna\">tutaj</a>.</p>';
        }
        </script>";
      }
      else
      {
        echo "<script>
        window.onload = function(){
          var take_div = document.getElementById('container');
          take_div.style.backgroundColor = '#F5EFE0';
          take_div.innerHTML = '<h3 style=\"text-align: center;\">Niestety, z powodu błędu wyniki nie zostały zapisane.</h3><p style=\"font-size: 24px; text-align: center;\">Spróbuj ponownie później. Aby przejść na stronę główną, naciśnij <a href=\"https://projektjks.pl/\" alt=\"Strona główna\">tutaj</a>.</p>';
        }
        </script>";
      }
    }
  return $content;
}

function pagerating_plugin_activation(){
	$GLOBALS['wpdb']->query("CREATE TABLE IF NOT EXISTS `ratings` (
    `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `rate_apperance` int NOT NULL,
    `rate_navigation` int NOT NULL,
    `rate_info` int NOT NULL,
    `rate_usability` int NOT NULL,
    `opinions` varchar(512) NOT NULL)
    ");
	return true;
}

function pagerating_plugin_deactivation(){
	return true;
}

function pagerating_plugin_uninstall()
{
  $GLOBALS['wpdb']->query("DROP TABLE `ratings`");
  return true;
}

add_action('wp_head', 'main_css');

function main_css()
{
    echo '<link rel="stylesheet" href="'.plugins_url( 'style.css', __FILE__ ).'"/>';
}

?>
