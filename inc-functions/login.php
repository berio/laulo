<?php
function cr(&$fields, &$errors) {

    // Check args and replace if necessary
    if (!is_array($fields))     $fields = array();
    if (!is_wp_error($errors))  $errors = new WP_Error;

    // Check for form submit
    if (isset($_POST['submit'])) {
        // Get fields from submitted form
        $fields = cr_get_fields();

        // Validate fields and produce errors
        if (cr_validate($fields, $errors)) {

            $fields['role'] = 'editor';
            // If successful, register user
            $user_id = wp_insert_user($fields);
            $user_info = get_userdata($user_id);

            $to = $user_info->user_email;
            $subject = '[Cousateca] Conta creada';
            $body = 'Ola '.$user_info->user_login.'!';
            $body .= '<br /><br />A túa conta na Cousateca foi creada.';
            $body .= '<br /><br />Benvido!';
            $headers = array('Content-Type: text/html; charset=UTF-8','From: Cousateca <info@cousateca.info');
            wp_mail( $to, $subject, $body, $headers );

            // And display a message
            echo '<div id="mensaxe_consola" class="visible">Rexistro completado. Agora xa podes <a href="/engadir-unha-cousa/">engadir unha cousa</a>.<button type="button"><i class="material-icons">close</i></button></div>';

            // Clear field data
            $fields = array();
        }
    }

    // Santitize fields
    cr_sanitize($fields);

    // Generate form
    cr_display_form($fields, $errors);
}

function cr_sanitize(&$fields) {
    $fields['user_login']   =  isset($fields['user_login'])  ? sanitize_user($fields['user_login']) : '';
    $fields['user_pass']    =  isset($fields['user_pass'])   ? esc_attr($fields['user_pass']) : '';
    $fields['user_email']   =  isset($fields['user_email'])  ? sanitize_email($fields['user_email']) : '';
}

function cr_display_form($fields = array(), $errors = null) {

  // Check for wp error obj and see if it has any errors
  if (is_wp_error($errors) && count($errors->get_error_messages()) > 0) {

    // Display errors
    ?><div id="mensaxe_consola" class="visible"><ul><?php
    foreach ($errors->get_error_messages() as $key => $val) {
      ?><li>
        <?php echo $val; ?>
      </li><?php
    }
    ?></ul><button type="button"><i class="material-icons">close</i></button></div><?php
  }

  // Disaply form

  ?><form action="<?php $_SERVER['REQUEST_URI'] ?>" method="post" class="form_02">
    <div>
      <label for="user_login">Nome ou e-mail <strong>*</strong></label>
      <input type="text" name="user_login" value="<?php echo (isset($fields['user_login']) ? $fields['user_login'] : '') ?>">
    </div>

    <div>
      <label for="user_pass">Contrasinal <strong>*</strong></label>
      <input type="password" name="user_pass">
    </div>

    <div>
      <label for="email">E-mail <strong>*</strong></label>
      <input type="text" name="user_email" value="<?php echo (isset($fields['user_email']) ? $fields['user_email'] : '') ?>">
    </div>

    <input type="submit" name="submit" value="Rexistrar">
    </form><?php
}

function cr_get_fields() {
  return array(
    'user_login'   =>  isset($_POST['user_login'])   ?  $_POST['user_login']   :  '',
    'user_pass'    =>  isset($_POST['user_pass'])    ?  $_POST['user_pass']    :  '',
    'user_email'   =>  isset($_POST['user_email'])   ?  $_POST['user_email']        :  '',
  );
}

function cr_validate(&$fields, &$errors) {

  // Make sure there is a proper wp error obj
  // If not, make one
  if (!is_wp_error($errors))  $errors = new WP_Error;

  // Validate form data

  if (empty($fields['user_login']) || empty($fields['user_pass']) || empty($fields['user_email'])) {
    $errors->add('field', 'Algún campo obrigatorio non está cuberto');
  }

  if (strlen($fields['user_login']) < 4) {
    $errors->add('username_length', 'O nome de usarix é demasiado curto. Precísanse alomenos 4 caracteres');
  }

  if (username_exists($fields['user_login']))
    $errors->add('user_name', 'Sentímolo, esx usuarix xa existe!');

  if (!validate_username($fields['user_login'])) {
    $errors->add('username_invalid', 'Sentímolo, x usuarix que introduciches non é valido');
  }

  if (strlen($fields['user_pass']) < 5) {
    $errors->add('user_pass', 'O contrasinal debe ter máis de 5 caracteres');
  }

  if (!is_email($fields['user_email'])) {
    $errors->add('email_invalid', 'O email non é valido');
  }

  if (email_exists($fields['user_email'])) {
    $errors->add('email', 'O email xa se está usando');
  }

  // If errors were produced, fail
  if (count($errors->get_error_messages()) > 0) {
    return false;
  }

  // Else, success!
  return true;
}



///////////////
// SHORTCODE //
///////////////

// The callback function for the [cr] shortcode
function cr_cb() {
  $fields = array();
  $errors = new WP_Error();

  // Buffer output
  ob_start();

  // Custom registration, go!
  cr($fields, $errors);

  // Return buffer
  return ob_get_clean();
}
add_shortcode('cr', 'cr_cb');
